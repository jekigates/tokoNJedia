@extends('layouts.document')

@section('chats', 'text-primary')

@section('root')
    <x-loading />
    <x-header :recommendations='$recommendations' />

    <div class="py-8 flex justify-center">
        <div class="w-full max-w-screen-xl">
            @if (Auth::user()->rooms->count() > 0)
                <section class="flex rounded-lg border border-gray-light">
                    <div class="w-1/3 p-4 border-e border-gray-light ">
                        <p class="text-lg font-bold mb-4">Chats</p>
                        <x-form.input type="search" placeholder="Search merchant"/>

                        @foreach (Auth::user()->rooms as $room_item)
                            <a href="{{ route('chats.show', ['room_id' => $room_item->id]) }}" class="flex items-center gap-4 mt-4 hover:text-primary">
                                <img
                                    src="{{ asset($room_item->roomable_merchant()->merchant->getImage()) }}"
                                    alt=""
                                    class="rounded-full w-14 h-14 object-cover"
                                />
                                <p>{{ $room_item->roomable_merchant()->merchant->name }}</p>
                            </a>
                        @endforeach
                    </div>
                    <div class="w-2/3 min-h-96 bg-slate-100">
                        @yield('content')
                    </div>
                </section>
            @else
                <div class="text-center py-16">
                    <img src="{{ asset('img/chat/chat.png') }}" alt="" class="h-40 inline-flex mb-8">
                    <p class="text-black font-bold text-2xl mb-2">Welcome To Chat</p>
                    <p class="text-gray text-semibold mb-4 text-sm">Explore to start conversation</p>
                    <x-button variant="primary" href="{{ route('home.index') }}">See store recommendations</x-button>
                </div>
            @endif
        </div>
    </div>

    <x-footer />
@endsection
