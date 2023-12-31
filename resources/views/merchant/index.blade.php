@extends('layouts.merchant')

@section('title', 'Merchant')

@section('home', 'text-primary')

@section('content')
    <section class="p-8">
        <div class="bg-black/5 rounded-lg p-8 mb-8">
            <p class="font-bold">Pending Orders</p>
            <div class="text-center">
                <img src="{{ asset('img/merchants/no-pending.png') }}" alt="" class="inline-flex h-40 mb-4 object-cover">
                <p class="font-bold text-xl mb-2">No Pending Orders</p>
                <p>Start promoting your products to reach more customers</p>
            </div>
        </div>
        <div class="bg-black/5 rounded-lg p-8">
            <p class="font-bold">Shipped Orders</p>
            <div class="text-center">
                <img src="{{ asset('img/merchants/no-shipping.png') }}" alt="" class="inline-flex h-40 mb-4 object-cover">
                <p class="font-bold text-xl mb-2">No Shipped Orders</p>
                <p>Start completing pending orders</p>
            </div>
        </div>
    </section>
@endsection
