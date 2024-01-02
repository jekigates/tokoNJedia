@extends('layouts.chat')

@section('title', 'Chat Show')

@section('content')
    <div class="h-20 flex items-center px-4 bg-white border-b border-gray-light">
        <a href="{{ route('chats.show', ['room_id' => $room->id]) }}" class="flex items-center gap-4 hover:text-primary">
            <img
                src="{{ asset($room->roomable_merchant()->merchant->getImage()) }}"
                alt=""
                class="rounded-full w-14 h-14 object-cover"
            />
            <p>{{ $room->roomable_merchant()->merchant->name }}</p>
        </a>
    </div>
    <div class="p-4 flex flex-col" style="height: calc(100% - 5rem);">
        <div>
            <div class="flex flex-col gap-4">
                @foreach ($room->messages as $message)
                    @if ($message->messageable_id == Auth::user()->id && $message->messageable_type == 'user')
                        <div class="flex items-end gap-4 ms-auto">
                            <div class="text-end">
                                <p class="text-black mb-1 text-sm">{{ Auth::user()->username }}</p>
                                <p class="bg-gray-dark text-white py-2 px-4 rounded-lg rounded-br-none mb-1 inline-flex">{{ $message->message}}</p>
                                <p class="text-xs text-gray">2023-12-20 02:10:19</p>
                            </div>
                            <img src="{{ asset(Auth::user()->getImage()) }}" alt="" class="w-8 h-8 rounded-full">
                        </div>
                    @else
                        <div class="flex items-end gap-4">
                            <img src="{{ asset($room->roomable_merchant()->merchant->getImage()) }}" alt="" class="w-8 h-8 rounded-full">
                            <div>
                                <p class="text-black mb-1 text-sm">{{ $room->roomable_merchant()->merchant->name }}</p>
                                <p class="bg-gray-dark text-white py-2 px-4 rounded-lg rounded-bl-none mb-1 inline-flex">Halo halo</p>
                                <p class="text-xs text-gray">2023-12-20 02:10:19</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <form action="{{ route('chats.store', ['room_id' => $room->id]) }}" method="POST" class="flex gap-4 mt-auto">
            @csrf
            <x-form.input type="text" name="message" placeholder="Send something as {{ Auth::user()->username }}" required/>
            <x-button type="submit" variant="primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </x-button>
        </form>
    </div>
@endsection
