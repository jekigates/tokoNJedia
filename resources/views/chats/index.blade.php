@extends('layouts.dashboard')

@section('title', 'Chat Index')

@section('chats', 'text-primary')

@section('content')
    <div class="text-center py-16">
        <img src="{{ asset('img/chat/chat.png') }}" alt="" class="h-40 inline-flex mb-8">
        <p class="text-black font-bold text-2xl mb-2">Welcome To Chat</p>
        <p class="text-gray text-semibold mb-4 text-sm">Explore to start conversation</p>
        <x-button variant="primary" href="{{ route('home.index') }}">See store recommendations</x-button>
    </div>
@endsection
