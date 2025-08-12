@extends('layouts.document')

@section('merchant', 'text-primary')

@section('root')
    <x-loading />
    <x-header :recommendations='$recommendations' />

    <div class="flex justify-center">
        <div class="w-full flex">
            <div class="w-1/6 bg-white border-e border-gray-light py-4 px-8">
                <a href="{{ route('merchant.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary @yield('home')">
                    <x-heroicon-o-home class="w-6 h-6" />
                    Home
                </a>
                <a href="{{ route('merchant.chats.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary">
                    <x-heroicon-o-chat-bubble-left class="w-6 h-6" />
                    Chat
                </a>
                <a href="{{ route('merchant.transactions.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary @yield('transactions')">
                    <x-heroicon-o-clipboard-document-list class="w-6 h-6" />
                    Transactions
                </a>
                <a href="{{ route('merchant.profile.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary @yield('profile')">
                    <x-heroicon-o-identification class="w-6 h-6" />
                    Profile
                </a>
                <a href="{{ route('merchant.products.index') }}" class="flex gap-4 items-center mb-4 hover:text-primary @yield('products')">
                    <x-heroicon-o-archive-box class="w-6 h-6" />
                    Product
                </a>
                <a href="{{ route('merchant.products.index') }}" class="flex gap-4 items-center mb-4 text-gray hover:text-primary @yield('products.index')">
                    <x-heroicon-o-archive-box class="w-6 h-6 opacity-0" />
                    List
                </a>
                <a href="{{ route('merchant.products.create') }}" class="flex gap-4 items-center text-gray hover:text-primary @yield('products.create')">
                    <x-heroicon-o-archive-box class="w-6 h-6 opacity-0" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    Create
                </a>
            </div>
            <div class="w-5/6 bg-white p-8">
                @yield('content')
            </div>
        </div>
    </div>

    <x-footer />
@endsection
