@extends('layouts.dashboard')

@section('title', 'Home')

@push('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <style>
        /* Custom Swiper Navigation Buttons */
        .swiper-button-next,
        .swiper-button-prev {
            width: 40px !important;
            height: 40px !important;
            background: white !important;
            border-radius: 50% !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            margin-top: -20px !important;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 16px !important;
            font-weight: bold !important;
            color: #6b7280 !important;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #f9fafb !important;
        }

        .swiper-button-prev {
            left: 16px !important;
        }

        .swiper-button-next {
            right: 16px !important;
        }

        /* Custom pagination styling */
        .swiper-pagination {
            bottom: 20px !important;
            left: 20px !important;
            width: auto !important;
            text-align: left !important;
        }

        .swiper-pagination-bullet {
            width: 8px !important;
            height: 8px !important;
            background: white !important;
            opacity: 0.5 !important;
            margin: 0 4px !important;
        }

        .swiper-pagination-bullet-active {
            opacity: 1 !important;
        }
    </style>
@endpush

@section('content')
    <!-- Swiper.js Slider -->
    <section class="relative mt-0 mb-8 mx-auto">
        <div class="swiper" id="promos-swiper">
            <div class="swiper-wrapper">
                @foreach ($promos as $key => $promo)
                    <div class="swiper-slide">
                        <a href="{{ route('promos.index', ['id' => $promo->id]) }}">
                            <img src="{{ asset($promo->promo_image) }}" alt="" class="cursor-pointer w-full h-full object-cover aspect-[16/5] rounded-lg">
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Swiper Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Swiper Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="flex gap-8 p-4 rounded-lg border border-gray-light mb-8">
        <div class="w-1/2">
            <p class="text-xl font-bold mb-4 text-black">Favorite Categories</p>

            <div class="flex gap-2 items-start">
                @foreach ($categories as $key => $category)
                    <a href="{{ route('categories.show', ['id' => $category->id]) }}" class="flex-1 p-4 border border-gray-light text-center rounded-md">
                        <img src="{{ $category->products[0]->images[0]->image }}" alt="" class="block w-full aspect-[4/3] rounded-md object-cover mb-2">
                        <p class="text-sm font-semibold text-black">@str_limit($category->products[0]->name, 10)</p>
                    </a>
                @endforeach
            </div>
        </div>
        <form action="{{ route('bill.store') }}" method="POST" class="w-1/2">
            @csrf

            <p class="text-xl font-bold mb-4 text-black">Top up & Bills</p>

            <div class="mb-4">
                <x-form.label for="subscription_number">Subscription Number</x-form.label>
                <x-form.input name="subscription_number" id="subscription_number" type="text" min="100000000" max="999999999999" minlength="11" maxlength="12" pattern="[0-9]{11-12}" value="{{ old('subscription_number') }}" placeholder="ex. 12345678910" required/>
                <x-form.text>Must be between 11 and 12 numbers</x-form.text>
            </div>

            <div class="mb-4">
                <x-form.label for="nominal">Nominal</x-form.label>
                <x-form.input name="nominal" id="nominal" type="number" value="{{ old('nominal') }}" placeholder="ex. 50000" required min="10000" max="1000000"/>
                <x-form.text>Must be between 10000 and 1000000</x-form.text>
            </div>
            <x-button type="submit" variant="primary" block>Pay</x-button>
        </form>
    </section>

    @php
        $hourLeft = 24 - date('H') - 1;
        $minuteLeft = 60 - date('i') - 1;
        $secondLeft = 60 - date('s');
    @endphp
    @if (date('H') >= 22 && date('H') <= 23)
        <section class="rounded-lg mb-16">
            <p class="text-sm text-black font-bold">Flash Sale</p>
            <div class="flex items-end gap-4 mb-12 text-black">
                <p class="text-xl font-bold">Chasing Old Date Discount</p>
                <p class="flex items-end gap-2 text-gray">Ends in <span class="text-white px-2 py-1 bg-red rounded-md" id=hour-left>{{ str_pad($hourLeft, 2, '0', STR_PAD_LEFT) }}</span> : <span class="text-white px-2 py-1 bg-red rounded-md" id="minute-left">{{ str_pad($minuteLeft, 2, '0', STR_PAD_LEFT) }}</span> : <span class="text-white px-2 py-1 bg-red rounded-md" id="second-left">{{ str_pad($secondLeft, 2, '0', STR_PAD_LEFT) }}</span></p>
            </div>
            <div class="flex flex-wrap relative justify-end -m-2">
                <div class="bg-green-100 absolute left-2 px-12 top-1/2 -translate-y-1/2 rounded-lg w-80">
                    <img src="{{ asset('img/general/flash-sale.webp') }}" alt="" class="h-80 object-cover">
                </div>
                @foreach ($flash_sale_products as $flash_sale_product)
                    <x-product.card :product="$flash_sale_product->product" />
                @endforeach
            </div>
        </section>
    @endif

    @include('product.section')
@endsection

@push('scripts')
    @include('product.script')

    <!-- Swiper JS -->
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            updateTime();

            // Initialize Swiper
            const swiper = new Swiper('#promos-swiper', {
                // Optional parameters
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                // Pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                // Effects
                effect: 'slide',
                speed: 500,

                // Responsive breakpoints
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1,
                    },
                    1024: {
                        slidesPerView: 1,
                    },
                }
            });

            function updateTime()
            {
                var d = new Date();

                let hourLeft = {{ $hourLeft }};
                let minuteLeft = {{ $minuteLeft }};
                let secondLeft = {{ $secondLeft }};

                setInterval(() => {
                    d = new Date();
                    if (hourLeft != 0 || minuteLeft != 0 || secondLeft != 0) {
                        var lblHourLeft = document.querySelector('#hour-left');
                        var lblMinuteLeft = document.querySelector('#minute-left');
                        var lblSecondLeft = document.querySelector('#second-left');
                        if (lblHourLeft && lblMinuteLeft && lblSecondLeft) {
                            lblHourLeft.innerHTML = hourLeft.toString().padStart(2, '0');
                            lblMinuteLeft.innerHTML = minuteLeft.toString().padStart(2, '0');
                            lblSecondLeft.innerHTML = secondLeft.toString().padStart(2, '0');
                        }
                    }

                    hourLeft = 24 - d.getHours() - 1;
                    minuteLeft = 60 - d.getMinutes() - 1;
                    secondLeft = 60 - d.getSeconds();
                }, 1000);
            }
        });
    </script>
@endpush
