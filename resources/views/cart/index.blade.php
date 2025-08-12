@extends('layouts.dashboard')

@section('title', 'Cart')

@section('cart', 'text-primary')

@section('content')
    @if (Auth::user()->carts->count() === 0)
        <section class="text-center mb-8">
            <img src="{{ asset('img/checkout/cart.jpg') }}" alt="" class="inline-flex mb-4 h-32">
            <p class="font-bold text-2xl">Your Cart is Empty</p>
            <p class="text-gray mb-4">Make your dream come true now!</p>
            <x-button href="{{ route('home.index') }}" variant="primary">Shop Now</x-button>
        </section>
    @else
        <section class="flex gap-8 mb-8">
            <div class="w-2/3">
                <p class="text-2xl font-bold mb-4 text-black">Cart</p>
                <div>
                    <div class="h-1 bg-gray-light mb-4"></div>
                    @php
                        $grand_total = 0;
                    @endphp

                    @foreach (Auth::user()->carts as $cart)
                        @php
                            $grand_total += $cart->variant->price;
                        @endphp
                        <div class="px-8">
                            <p class="font-bold font-lg text-black">{{ $cart->product->merchant->name }}</p>
                            <p class="text-gray mb-4">{{ $cart->product->merchant->location->city }}</p>
                            <div class="mb-4 flex gap-4 text-black">
                                <a href="{{ route('products.show', ['id' => $cart->product->id]) }}" class="w-16 h-16">
                                    <img src="{{ $cart->product->images[0]->image }}" alt="" class="w-full h-full object-cover rounded-lg">
                                </a>
                                <div>
                                    <p class="text-md">{{ $cart->product->name }}</p>
                                    <p class="text-md font-bold">@money ($cart->variant->price)</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mb-4">
                            <div class="flex items-center gap-16">
                                <button class="text-gray">
                                    <x-heroicon-o-trash class="w-6 h-6" />
                                </button>
                                <div class="border-b border-gray-light flex items-center gap-2">
                                    <button class="text-gray">
                                        <x-heroicon-o-minus-circle class="w-6 h-6" />
                                    </button>
                                    <input type="number" min="1" value="{{ $cart->quantity }}" class="text-center outline-none w-12">
                                    <button class="text-primary">
                                        <x-heroicon-o-plus-circle class="w-6 h-6" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="h-1 bg-gray-light mb-4"></div>
                    @endforeach
                </div>
            </div>
            <div class="w-1/3">
                <div class=" border border-gray-light rounded-xl p-4">
                    <p class="text-lg font-bold mb-4 text-black">Shopping Summary</p>
                    <p class="flex justify-between mb-2 text-gray">Total Price ({{ Auth::user()->carts->count() }} item) <span>@money($grand_total)</span></p>
                    <hr class="mb-2 text-gray-light">
                    <p class="flex justify-between text-xl font-bold mb-4 text-black">Grand Total <span>@money($grand_total)</span></p>
                    <x-button href="{{ route('checkout.index') }}" variant="primary" type="submit" block>Buy</x-button>
                </div>
            </div>
        </section>
    @endif

    @include('product.section')
@endsection

@push('scripts')
    @include('product.script')
@endpush
