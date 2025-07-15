{{-- Memberitahu Blade untuk menggunakan layout 'app.blade.php' --}}
@extends('user.layouts.app')

{{-- Mengisi 'title' yang ada di layout --}}
@section('title', 'Eatery Page')

{{-- Mengisi 'content' yang ada di layout --}}
@section('content')

    <!-- Hero Section -->
    <section class="hero-section text-white" style="background-image: url('{{ asset('img/Eatery Background.svg') }}');">
        <div class="overlay"></div>
        <div class="container-fluid content d-flex flex-column justify-content-center align-items-start">
            <h1 class="display-1 fw-bold text-brand-orange mb-md-1 mb-sm-2">Craving something</h1>
            <p class="display-4 mb-4 mb-sm-5">delicious?</p>
            <a href="#interactive-filters"
                class="btn hero-order-button btn-light fw-semibold rounded-3 shadow-sm transition-all duration-300">
                Order Now
            </a>
        </div>
    </section>

    <!-- Search Bar Section -->
    <section class="py-3 search-bar-section" style="margin-top: -3rem;">
        <div class="container">
            <form method="GET" action="{{ url('/eatery') }}#interactive-filters"
                class="search-form position-relative mx-auto bg-white shadow-lg rounded-4 d-flex align-items-center"
                style="max-width: 45rem;">

                {{-- HIDDEN INPUTS: untuk membawa parameter filter & sort --}}
                @if (request()->has('filter'))
                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                @endif
                @if (request()->has('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                <div class="position-absolute top-50 start-0 translate-middle-y ps-4">
                    <svg style="width: 2.9rem; height: 2.9rem;" class="text-dark" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <input type="search" id="searchInput" name="query" value="{{ $searchQuery ?? '' }}"
                    class="form-control form-control-lg border-0 bg-transparent rounded-4"
                    placeholder="What would you like to eat?">
                <button type="reset" id="clearSearchButton"
                    class="btn btn-link btn-clear-search position-absolute top-50 end-0 translate-middle-y pe-4 text-decoration-none">
                    <svg style="width: 2.75rem; height: 2.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9l-6 6M9 9l6 6" />
                    </svg>
                </button>
            </form>
        </div>
    </section>

    <!-- Main Content: Filters & Product Grid -->
    <main class="container-fluid pt-4 pb-2">

        @php
            $sortQuery = request()->has('sort') ? 'sort=' . request('sort') : '';
            $filterQuery = request()->has('filter') ? 'filter=' . request('filter') : '';
            $otherParams = http_build_query(request()->except('location'));
        @endphp

        <div id="interactive-filters"
            class="mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center gy-3 gy-md-0">
            <!-- Filter and Sort Section -->
            <div class="d-flex flex-wrap align-items-center gap-3">
                <div class="dropdown">
                    <button
                        class="btn btn-light btn-transparent-dropdown dropdown-toggle fw-semibold d-flex align-items-center fs-6 px-3 py-2 rounded-2"
                        type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="selected-sort-text-html">Sort</span>
                    </button>
                    <ul class="dropdown-menu shadow-lg" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item py-2 px-3 {{ $selectedSort == 'default' ? 'active' : '' }}"
                                href="{{ url('/eatery?sort=default&' . $filterQuery) }}#interactive-filters">
                                Sort by (Default)</a></li>
                        <li><a class="dropdown-item py-2 px-3 {{ $selectedSort == 'most-popular' ? 'active' : '' }}"
                                href="{{ url('/eatery?sort=most-popular&' . $filterQuery) }}#interactive-filters">
                                Most Popular</a></li>
                        <li><a class="dropdown-item py-2 px-3 {{ $selectedSort == 'best-rating' ? 'active' : '' }}"
                                href="{{ url('/eatery?sort=best-rating&' . $filterQuery) }}#interactive-filters">
                                Best Rating</a></li>
                        <li><a class="dropdown-item py-2 px-3 {{ $selectedSort == 'newest' ? 'active' : '' }}"
                                href="{{ url('/eatery?sort=newest&' . $filterQuery) }}#interactive-filters">
                                Newest</a></li>
                    </ul>
                </div>

                <a href="{{ url('/eatery?' . $sortQuery) }}#interactive-filters"
                    class="btn {{ !$selectedFilter ? 'bg-brand-orange text-white' : 'btn-light text-dark border' }} shadow-sm fw-semibold px-4 py-2 rounded-2">
                    All
                </a>

                <a href="{{ url('/eatery?filter=lunch&' . $sortQuery) }}#interactive-filters"
                    class="btn {{ $selectedFilter == 'lunch' ? 'bg-brand-orange text-white' : 'btn-light text-dark border' }} shadow-sm fw-semibold px-4 py-2 rounded-2">
                    Pick up lunch
                </a>

                <a href="{{ url('/eatery?filter=dinner&' . $sortQuery) }}#interactive-filters"
                    class="btn {{ $selectedFilter == 'dinner' ? 'bg-brand-orange text-white' : 'btn-light text-dark border' }} shadow-sm fw-semibold px-4 py-2 rounded-2">
                    Pick up dinner
                </a>
            </div>

            <!-- Chosen Location Dropdown -->
            <div class="dropdown">
                <button type="button" id="location-button"
                    class="btn btn-link text-success fw-semibold fs-5 d-flex align-items-center dropdown-toggle text-decoration-none px-2 py-1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <svg style="width: 1.75rem; height: 1.75rem;" class="me-2" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span id="selected-location-text">
                        Chosen location: {{ $selectedLocation ?? 'All' }}
                    </span>
                </button>
                <ul id="location-dropdown-menu" class="dropdown-menu dropdown-menu-end shadow-lg"
                    aria-labelledby="location-button">
                    <li><a href="{{ url('/eatery?' . $otherParams) }}#interactive-filters"
                            class="dropdown-item py-2 px-3 {{ !$selectedLocation ? 'active' : '' }}">
                            All Locations</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @php $locations = ['Bogor', 'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta']; @endphp
                    @foreach ($locations as $location)
                        <li>
                            <a href="{{ url('/eatery?location=' . $location . '&' . $otherParams) }}#interactive-filters"
                                class="location-item dropdown-item py-2 px-3 {{ $selectedLocation == $location ? 'active' : '' }}">
                                {{ $location }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row row-cols-1 row-cols-xl-3 row-cols-lg-3 g-md-5">
            @foreach ($eateries as $eatery)
                <div class="col">
                    <a href="{{ route('eatery.detail', ['restaurant' => $eatery->restaurant_id]) }}"
                        class="text-decoration-none d-block h-100">
                        <div class="card product-card d-flex flex-column h-100">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $eatery->restaurant_picture_path) }}"
                                    alt="{{ $eatery->name }}" class="product-card-img">
                                <span
                                    class="position-absolute top-0 start-0 mt-3 ms-3 badge badge-custom-1 fw-bold shadow-sm">
                                    {{ ($eatery->lunch_stock ?? 0) + ($eatery->dinner_stock ?? 0) }} left
                                </span>
                                @if (method_exists($eatery, 'isNew') && $eatery->isNew())
                                    <span
                                        class="position-absolute top-0 end-0 mt-3 me-3 badge badge-custom-2 fw-bold shadow-sm">
                                        New
                                    </span>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column p-2 p-md-4">
                                <h3 class="fw-bold text-brand-green mb-1">{{ $eatery->name }}</h3>
                                <p class="text-secondary mb-2">Surprise Bag</p>
                                <div class="mb-4">
                                    <span class="text-secondary me-2">Pick up:</span>
                                    @if (($eatery->lunch_stock ?? 0) > 0)
                                        <span class="badge rounded-pill pickup-badge shadow-sm me-2">Lunch</span>
                                    @endif
                                    @if (($eatery->dinner_stock ?? 0) > 0)
                                        <span class="badge rounded-pill pickup-badge shadow-sm">Dinner</span>
                                    @endif
                                    @if (($eatery->lunch_stock ?? 0) == 0 && ($eatery->dinner_stock ?? 0) == 0)
                                        <span class="text-muted fst-italic">Sold Out</span>
                                    @endif
                                </div>
                                <hr class="hr-dashed">
                                <div class="mt-auto d-flex justify-content-between align-items-center pt-1">
                                    <div class="d-flex align-items-center">
                                        <svg style="width: 1.75rem; height: 1.75rem;" class="text-warning me-2"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-dark fw-medium">{{ $eatery->rating ?? '-' }}</span>
                                    </div>
                                    <span class="fw-bolder text-dark">
                                        Rp {{ number_format($eatery->pricing_tier ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </main>
@endsection
