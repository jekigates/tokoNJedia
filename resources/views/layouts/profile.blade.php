@extends('layouts.document')

@section('profile', 'text-primary')

@section('root')
    <x-loading />
    <x-header :recommendations='$recommendations' />

    <div class="py-8 flex justify-center">
        <div class="w-full max-w-screen-lg xl:max-w-screen-xl">
            <section class="flex gap-8">
                <div class="w-1/3 border border-gray-light rounded-lg p-4 text-black">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ asset(Auth::user()->getImage()) }}" alt="" class="w-12 h-12 rounded-full">
                        <p class="font-bold">{{ Auth::user()->username }}</p>
                    </div>
                    <hr class="mb-4 text-gray-light">
                    <a href="{{ route('general.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary @yield('general')">
                        <x-heroicon-o-home class="w-6 h-6" />
                        General
                    </a>
                    <a href="{{ route('locations.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary @yield('location')">
                        <x-heroicon-o-map-pin class="w-6 h-6" />
                        Location
                    </a>
                    <a href="{{ route('history-transaction.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary @yield('history')">
                        <x-heroicon-o-shopping-bag class="w-6 h-6" />
                        History Transaction
                    </a>
                    <a href="{{ route('following-list.index') }}" class="flex gap-4 items-center mb-8 hover:text-primary @yield('following')">
                        <x-heroicon-o-heart class="w-6 h-6" />
                        Following List
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="flex gap-4 items-center hover:text-primary w-full">
                            <x-heroicon-o-arrow-right-on-rectangle class="w-6 h-6" />
                            Logout
                        </button>
                    </form>
                </div>
                <div class="w-2/3">
                    <p class="font-bold text-black flex items-center gap-4 text-2xl mb-4">
                        <x-heroicon-o-user-circle class="w-6 h-6" />
                        {{ Auth::user()->username }}
                    </p>

                    <div class="rounded-lg border border-gray-light p-8">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
    </div>

    <x-footer />
@endsection
