<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Pickup;
use App\Models\Order;

class StripeController extends Controller
{
    public function processReservedInfo(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'pickup_time' => 'required|in:1,2',
        ]);

        $customer = Customer::where('customer_name', $request->input('customer_name'))->first();

        if ($customer) {
            $store = $customer->store ?? Store::first();
            $store_id = $store->id ?? 1;

            // Ambil order yang sudah ada
            $order = Order::where('customer_id', $customer->id)
                ->where('store_id', $store_id)
                ->latest()
                ->first();

            if (!$order) {
                // Jika belum ada, buat baru
                $order = new Order();
                $order->customer_id = $customer->id;
                $order->pickup_id = $request->input('pickup_time');
                $order->store_id = $store_id;
                $order->order_name = 'Surprised Bag'; // fallback
                $order->order_price = $store->price ?? 50000;
                $order->order_code = strtoupper(uniqid('ORD-'));
                $order->save();
            }

            // Simpan ke session
            session([
                'checkout_customer_id' => $customer->id,
                'checkout_store_id' => $store_id,
                'checkout_pickup_id' => $request->input('pickup_time'),
            ]);
        }

        return redirect()->route('checkout.review');
    }

    public function review()
    {
        $customerId = session('checkout_customer_id');

        $order = Order::where('customer_id', $customerId)
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('checkout.reserved')->with('error', 'Order tidak ditemukan.');
        }

        $taxes = 1000;
        $application_taxes = 1000;
        $subtotal = (int)$order->order_price;
        $grand_total = $subtotal + $taxes + $application_taxes;

        $summary = (object)[
            'taxes' => $taxes,
            'application_taxes' => $application_taxes,
            'grand_total' => $grand_total,
        ];

        return view('checkout.review', compact('order', 'summary'));
    }

    public function checkout(Request $request)
    {
        try {
            Stripe::setApiKey(config('stripe.secret'));

            $customer = Customer::findOrFail($request->input('customer_id'));
            $store = Store::findOrFail($request->input('store_id'));
            $pickup = Pickup::find($request->input('pickup_id'));

            // Ambil order dari customer
            $order = Order::where('customer_id', $customer->id)->latest()->first();

            $subtotal_idr = (float)($order->order_price ?? 0);
            $taxes_idr = 1000;
            $app_taxes_idr = 1000;
            $grand_total_idr = $subtotal_idr + $taxes_idr + $app_taxes_idr;

            // Konversi ke USD cents
            $conversion_rate = 16943.38; // 1 USD = Rp 16.943,38
            $price_in_usd = $grand_total_idr / $conversion_rate;
            $price_in_usd_cents = (int)ceil($price_in_usd * 100);

            Log::info('Checkout debug', [
                'grand_total_idr' => $grand_total_idr,
                'usd_cents' => $price_in_usd_cents,
            ]);

            if ($price_in_usd_cents < 50) {
                return redirect()->route('checkout.review')->with('error', 'Total terlalu kecil untuk diproses.');
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $order->order_name ?? $store->store_name,
                        ],
                        'unit_amount' => $price_in_usd_cents,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.review'),
                'metadata' => [
                    'price_in_idr_grand_total' => $grand_total_idr,
                    'customer_id' => $customer->id,
                    'store_id' => $store->id,
                    'pickup_time' => $pickup ? "{$pickup->time_type}: " . date('H:i', strtotime($pickup->start_time)) . " - " . date('H:i', strtotime($pickup->end_time)) : 'Lunch',
                    'order_id' => $order->id,
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
        $order_id_from_stripe = strtoupper('ORD-' . rand(10000, 99999));
        $eatery_name_from_stripe = 'Unknown';
        $pickup_time_from_stripe = 'Unknown';
        $customer_name = 'Guest';

        if ($stripeSessionId) {
            try {
                Stripe::setApiKey(config('stripe.secret'));
                $stripeSession = Session::retrieve($stripeSessionId);

                if (isset($stripeSession->metadata)) {
                    if (isset($stripeSession->metadata->order_id)) {
                        $order = Order::find($stripeSession->metadata->order_id);
                        $order_id_from_stripe = $order->order_code ?? $order_id_from_stripe;
                    }

                    if (isset($stripeSession->metadata->store_id)) {
                        $store = Store::find($stripeSession->metadata->store_id);
                        $eatery_name_from_stripe = $store->store_name ?? 'Unknown';
                    }

                    if (isset($stripeSession->metadata->pickup_time)) {
                        $pickup_time_from_stripe = $stripeSession->metadata->pickup_time;
                    }

                    if (isset($stripeSession->metadata->customer_id)) {
                        $customer = Customer::find($stripeSession->metadata->customer_id);
                        $customer_name = $customer->customer_name ?? 'Guest';
                    }
                }

            } catch (\Exception $e) {
                Log::error('Stripe success error: ' . $e->getMessage());
            }
        }

        return view('checkout.confirmation', [
            'user' => (object)['name' => $customer_name],
            'order_id' => $order_id_from_stripe,
            'store' => $store, // <== pastikan ini dikirim ke view
            'pickup_time' => $pickup_time_from_stripe,
        ]);
    }
}
