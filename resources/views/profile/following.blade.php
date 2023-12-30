@extends('layouts.profile')

@section('title', 'Following List')

@section('following', 'text-green-500')

@section('content')
    <section class="text-black">
        <p class="font-bold text-xl mb-4">Following</p>
        <div class="flex gap-4">
            <img src="{{ asset('img/general/no-following.png') }}" alt="" class="h-40 object-cover">
            <div>
                <p class="font-bold text-lg">No Following</p>
                <p class="text-gray">Find your favorite store and follow them to get the latest update!</p>
            </div>
        </div>
    </section>
@endsection
