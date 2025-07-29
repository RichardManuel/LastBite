<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Pickup;
use App\Models\Order;

class StripeController extends Controller
{

    public function showReservedPage()
    {
        if (!session()->has('checkout_data')) {
            return redirect()->back()->with('error', 'Checkout data not found.');
        }

        $data = session('checkout_data');

        return view('checkout.reserved', [
            'user' => User::find($data['user_id']),
            'restaurant' => Restaurant::find($data['restaurant_id']),
            'pickup' => Pickup::find($data['pickup_id']),
            'pickups' => Pickup::all(), // ✅ ini dia yang ditambahkan
        ]);
    }


    public function processReservedInfo(Request $request)
    {

        $userId = auth()->id();

        if (!$userId) {
            return back()->with('error', 'User ID tidak ditemukan.');
        }

        // Ambil dari request atau session sebagai fallback
        $restaurantId = $request->input('restaurant_id') ?? session('checkout_restaurant_id');
        $pickupId = $request->input('pickup_id') ?? session('checkout_pickup_id');


        if (!$restaurantId) {
            return back()->with('error', 'Restaurant ID tidak ditemukan.');
        }

        // Simpan ke session juga (opsional, untuk step selanjutnya)
        session([
            'checkout_data' => [
                'user_id' => $userId,
                'restaurant_id' => $restaurantId,
                'pickup_id' => $pickupId,
            ],
            'checkout_user_id' => $userId,
            'checkout_restaurant_id' => $restaurantId,
            'checkout_pickup_id' => $pickupId,
        ]);

        // Simpan order ke database
        $order = new Order();
        $order->order_id = Order::generateNewId();
        $order->user_id = auth()->id();
        $order->restaurant_id = $restaurantId;
        $order->item_name = $request->input('item_name');      // ✅ pastikan ini
        $order->item_price = $request->input('item_price');    // ✅ pastikan ini
        $order->status = 'Ongoing';
        $order->pickup_id = $pickupId; // Simpan pickup_id
        $order->save();


        return redirect()->route('checkout.reserved.show');
    }

    public function updatePickup(Request $request)
    {
        $request->validate([
            'pickup_id' => 'required|exists:pickups,id',
        ]);

        $userId = session('checkout_user_id');
        if (!$userId) {
            return redirect()->route('checkout.reserved.show')->with('error', 'User ID tidak ditemukan.');
        }

        $order = Order::where('user_id', $userId)->latest()->first();
        if (!$order) {
            return redirect()->route('checkout.reserved.show')->with('error', 'Order tidak ditemukan.');
        }

        // Update pickup_id dari form
        $order->pickup_id = $request->pickup_id;
        $order->save();

        return redirect()->route('checkout.review.show');
    }



    public function review()
    {
        dd(session()->all());
        // $userId = session('checkout_user_id');


        // if (!$userId) {
        //     return redirect()->route('checkout.reserved.store')->with('error', 'Session tidak ditemukan');
        // }
        // dd(session()->all());

        // $order = Order::with('restaurant')
        //     ->where('user_id', session('checkout_user_id'))
        //     ->where('status', 'Ongoing')
        //     ->latest()
        //     ->first();

        // if (!$order) {
        //     \Log::error('Order tidak ditemukan untuk user_id: ' . session('checkout_user_id'));
        //     dd(Order::where('user_id', session('checkout_user_id'))->get()); // Debug
        //     return redirect()->route('checkout.reserved.show')->with('error', 'Order tidak ditemukan');
        // }

        // // Ringkas perhitungan
        // $taxes = 1000;
        // $application_taxes = 1000;
        // $subtotal = (int) $order->order_price ?? 0;
        // $grand_total = $subtotal + $taxes + $application_taxes;

        // $summary = (object) [
        //     'taxes' => $taxes,
        //     'application_taxes' => $application_taxes,
        //     'grand_total' => $grand_total,
        // ];

        // return view('checkout.review', compact('order', 'summary'));
    }




    public function checkout(Request $request)
    {
        try {
            Stripe::setApiKey(config('stripe.secret'));

            $user = User::findOrFail($request->input('user_id'));
            $restaurant = Restaurant::findOrFail($request->input('restaurant_id'));
            $pickup = Pickup::find($request->input('pickup_id'));

            $order = Order::where('user_id', $user->id)->latest()->first();

            $subtotal_idr = (float) ($order->item_price ?? 0);
            $taxes_idr = 1000;
            $app_taxes_idr = 1000;
            $grand_total_idr = $subtotal_idr + $taxes_idr + $app_taxes_idr;

            $conversion_rate = 16943.38;
            $price_in_usd = $grand_total_idr / $conversion_rate;
            $price_in_usd_cents = (int) ceil($price_in_usd * 100);

            Log::info('Checkout debug', [
                'grand_total_idr' => $grand_total_idr,
                'usd_cents' => $price_in_usd_cents,
            ]);

            if ($price_in_usd_cents < 50) {
                return redirect()->route('checkout.review')->with('error', 'Total terlalu kecil untuk diproses.');
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $order->item_name ?? $restaurant->name,
                            ],
                            'unit_amount' => $price_in_usd_cents,
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.review'),
                'metadata' => [
                    'price_in_idr_grand_total' => $grand_total_idr,
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->restaurant_id,
                    'pickup_time' => $pickup ? "{$pickup->time_type}: " . date('H:i', strtotime($pickup->start_time)) . " - " . date('H:i', strtotime($pickup->end_time)) : 'Lunch',
                    'order_id' => $order->order_id,
                ],
            ]);

            return redirect()->away($session->url);

        } catch (\Exception $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
            return redirect()->route('checkout.review')->with('error', 'Terjadi kesalahan saat pembayaran.');
        }
    }

    public function success(Request $request)
    {
        $stripeSessionId = $request->query('session_id');
        $order_id_from_stripe = 'UNKNOWN';
        $restaurant_name = 'Unknown';
        $pickup_time_from_stripe = 'Unknown';
        $user_name = 'Guest';

        if ($stripeSessionId) {
            try {
                Stripe::setApiKey(config('stripe.secret'));
                $stripeSession = Session::retrieve($stripeSessionId);

                if (isset($stripeSession->metadata)) {
                    $order = Order::where('order_id', $stripeSession->metadata->order_id)->first();
                    $order_id_from_stripe = $order->order_id ?? $order_id_from_stripe;

                    if (isset($stripeSession->metadata->restaurant_id)) {
                        $restaurant = Restaurant::find($stripeSession->metadata->restaurant_id);
                        $restaurant_name = $restaurant->name ?? 'Unknown';
                    }

                    if (isset($stripeSession->metadata->pickup_time)) {
                        $pickup_time_from_stripe = $stripeSession->metadata->pickup_time;
                    }

                    if (isset($stripeSession->metadata->user_id)) {
                        $user = User::find($stripeSession->metadata->user_id);
                        $user_name = $user->name ?? 'Guest';
                    }
                }

            } catch (\Exception $e) {
                Log::error('Stripe success error: ' . $e->getMessage());
            }
        }

        return view('checkout.confirmation', [
            'user' => (object) ['name' => $user_name],
            'order_id' => $order_id_from_stripe,
            'store' => $restaurant, // for view compatibility
            'pickup_time' => $pickup_time_from_stripe,
        ]);
    }
}

