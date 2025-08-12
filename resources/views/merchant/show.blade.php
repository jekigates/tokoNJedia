@extends('layouts.dashboard')

@section('title', 'Merchant Show')

@section('content')
    <section>
        <div class="border border-gray-light rounded-lg p-4 mb-8">
            <div class="flex gap-16 items-center justify-between">
                <div class="flex items-center gap-4">
                    <img
                        src="{{ asset($merchant->getImage()) }}"
                        alt=""
                        class="rounded-full w-24 h-24 object-cover"
                    />
                    <div>
                        <p class="font-bold text-black text-lg">{{ $merchant->name }}</p>
                        <p class="text-gray mb-2">Online</p>
                        <div class="flex gap-2">
                            @if (Auth::check())
                                @if (Auth::user()->following($merchant->id) == null)
                                    <form action="{{ route('following-list.store') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="merchant_id" value="{{ $merchant->id }}">
                                        <x-button variant="primary" type="submit">Follow</x-button>
                                    </form>
                                @else
                                    <form action="{{ route('following-list.destroy') }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" name="merchant_id" value="{{ $merchant->id }}">
                                        <x-button variant="primary" type="submit">Unfollow</x-button>
                                    </form>
                                @endif
                            @else
                                <x-button variant="primary" href="{{ route('login.index') }}">Follow</x-button>
                            @endif
                            @if (Auth::check())
                                <form action="{{ route('chats.redirect', ['merchant_id' => $merchant->id]) }}" method="POST" class="inline">
                                    @csrf
                                    <x-button variant="primary" type="submit" outline>Chat Seller</x-button>
                                </form>
                            @else
                                <x-button variant="primary" href="{{ route('login.index') }}" outline>Chat Seller</x-button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex flex-col items-center border-e border-gray-light pe-8">
                        <div class="flex items-center gap-2">
                            <x-heroicon-s-star class="w-6 h-6 text-yellow-500" />
                            <p class="font-bold text-lg">0</p>
                        </div>
                        <p class="text-gray">Rating & Review</p>
                    </div>
                    <div class="text-center border-e border-gray-light px-8">
                        <p class="font-bold text-lg">{{ $merchant->process_time ? $merchant->process_time : '-' }}</p>
                        <p class="text-gray">Process Time</p>
                    </div>
                    <div class="text-center px-8">
                        <p class="font-bold text-lg">{{ $merchant->operational_time ? $merchant->operational_time : '-' }}</p>
                        <p class="text-gray">Operational Hours</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8 flex gap-8 border-b-2 border-gray-light">
            <button class="text-primary gap-2 font-bold border-b-2 border-primary pb-2 px-8 tab tab-active" onclick="changeTab(this)" id="tab-product">
                Home
            </button>
            <button class="text-gray gap-2 font-bold border-b-2 border-transparent pb-2 px-8 hover:text-primary tab" onclick="changeTab(this)" id="tab-shop">
                Shop
            </button>
        </div>

        <section class="tab-section tab-section-active" id="section-home">
            <img src="{{ asset($merchant->getBannerImage()) }}" alt="" class="w-full h-96 object-cover rounded-lg mb-8">
            <p class="font-bold text-gray mb-8 text-lg">Store Information {{ $merchant->name }}</p>
            <div class="text-sm text-black">
                <p class="font-bold text-gray mb-4">Description {{ $merchant->name }}</p>
                <p class="mb-8">{{ $merchant->description }}</p>
                <p class="font-bold text-gray mb-4">Open Since</p>
                <p class="mb-8">{{ date('F Y', strtotime($merchant->created_at)) }}</p>
                <p class="font-bold text-gray mb-4">{{ $merchant->catch_phrase }}</p>
                <p class="mb-8">{{ $merchant->full_description }}</p>
            </div>
        </section>

        <section class="hidden tab-section" id="section-shop">
            <p class="font-bold mb-4">All Product</p>
            <div class="flex flex-wrap -m-2">
                @foreach ($merchant->products as $sProduct)
                    <x-product.card :product="$sProduct" />
                @endforeach
            </div>
        </section>
    </section>
@endsection

@push('scripts')
    <script>
        function changeTab(selectedTab) {
            document.querySelectorAll(".tab").forEach((element) => {
                if (element != selectedTab) {
                    element.className = "text-gray gap-2 font-bold border-b-2 border-transparent pb-2 px-8 hover:text-primary tab";
                } else {
                    element.className = "text-primary gap-2 font-bold border-b-2 border-primary pb-2 px-8 tab tab-active";
                }
            });

            var tabName = selectedTab.textContent.trim().toLowerCase();
            var tabSectionName = 'section-' + tabName;

            document.querySelectorAll(".tab-section").forEach((element) => {
                if (element.getAttribute('id') == tabSectionName) {
                    element.classList.add('tab-section-active');
                    element.classList.remove('hidden');
                } else {
                    element.classList.remove('tab-section-active');
                    element.classList.add('hidden');
                }
            });
        }
    </script>
@endpush
