@extends('layouts.merchant')

@section('title', 'Merchant Chat')

@section('merchant.chats', 'text-primary')

@section('content')
    <div class="text-center py-16">
        <img src="{{ asset('img/chat/chat.png') }}" alt="" class="h-40 inline-flex mb-8">
        <p class="text-black font-bold text-2xl mb-2">Welcome To Chat</p>
        <p class="text-gray text-semibold text-sm">No one has chat your store yet!</p>
    </div>
@endsection
