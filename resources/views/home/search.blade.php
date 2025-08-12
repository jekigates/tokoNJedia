@extends('layouts.dashboard')

@section('title', 'Search')

@section('content')
    <section class="mb-8">
        <div class="mb-4 flex gap-8 border-b-2 border-gray-light">
            <button class="text-primary flex gap-2 font-bold items-center border-b-2 border-primary pb-2 tab tab-active" onclick="changeTab(this)" id="tab-product">
                <x-heroicon-o-archive-box class="w-6 h-6" />
                Product
            </button>
            <button class="text-gray flex gap-2 font-bold items-center border-b-2 border-transparent pb-2 hover:text-primary tab" onclick="changeTab(this)" id="tab-shop">
                <x-heroicon-o-building-storefront class="w-6 h-6" />
                Shop
            </button>
        </div>

        <p class="text-gray mb-4">Searching for <span class="text-black font-bold">"{{ $keyword }}"</span></p>

        @if ($sProducts->count() > 0)
            <section class="tab-section tab-section-active" id="section-product">
                <div class="flex flex-wrap -m-2">
                    @foreach ($sProducts as $sProduct)
                        <x-product.card :product="$sProduct" />
                    @endforeach
                </div>
            </section>
        @else
            <div class="tab-section tab-section-active" id="section-product">
                <div class="rounded-xl border border-gray-light py-8 px-16 gap-8 flex">
                    <img src="{{ asset('img/checkout/not-found.png') }}" alt="" class="h-32 object-cover">
                    <div>
                        <p class="font-bold text-xl mb-2">Oops, we think it hides somewhere</p>
                        <p class="mb-4">Try another keyword or check product recommendation below.</p>
                        <a href="{{ route('home.index') }}" class="inline-flex text-white bg-primary font-bold py-2 px-8 rounded-md border border-primary hover:text-primary hover:bg-white text-sm">Go Back Home</a>
                    </div>
                </div>
            </div>
        @endif

        @if ($sMerchants->count() > 0)
            <section class="hidden tab-section" id="section-shop">
                <div class="flex flex-wrap -m-2">
                    @foreach ($sMerchants as $sMerchant)
                        <div class="w-1/3 p-2">
                            <div class="border border-gray-light rounded-lg p-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset($sMerchant->getImage()) }}" alt="" class="h-14 w-14 object-cover rounded-full">
                                    <div>
                                        <p class="font-bold text-black">@str_limit($sMerchant->name)</p>
                                        <p class="text-xs text-gray">@str_limit($sMerchant->location->city)</p>
                                    </div>
                                    <x-button href="{{ route('merchant.show', ['id' => $sMerchant->id]) }}" variant="primary" outline class="ms-auto">View Shop</x-button>
                                </div>

                                @if ($sMerchant->products->count() > 0)
                                    <div class="flex gap-4 mt-4">
                                        @foreach ($sMerchant->products->take(3) as $sMerchant_product)
                                            <a href="{{ route('products.show', ['id' => $sMerchant_product->id]) }}" class="w-1/3">
                                                <img src="{{ asset($sMerchant_product->images[0]->image) }}" alt="" class="w-full h-24 object-cover mb-2 rounded-lg">
                                                <p class="font-semibold text-sm">@money($sMerchant_product->variants->min('price'))</p>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @else
            <div class="hidden tab-section" id="section-shop">
                <div class="rounded-xl border border-gray-light py-8 px-16 gap-8 flex">
                    <img src="{{ asset('img/checkout/not-found.png') }}" alt="" class="h-32 object-cover">
                    <div>
                        <p class="font-bold text-xl mb-2">Oops, we think it hides somewhere</p>
                        <p class="mb-4">Try another keyword or check product recommendation below.</p>
                        <a href="{{ route('home.index') }}" class="inline-flex text-white bg-primary font-bold py-2 px-8 rounded-md border border-primary hover:text-primary hover:bg-white text-sm">Go Back Home</a>
                    </div>
                </div>
            </div>
        @endif
    </section>

    @include('product.section')
@endsection

@push('scripts')
    @include('product.script')
    <script>
        function changeTab(selectedTab) {
            document.querySelectorAll(".tab").forEach((element) => {
                if (element != selectedTab) {
                    element.className = "text-gray flex gap-2 font-bold items-center border-b-2 border-gray-light border-transparent pb-2 hover:text-primary tab";
                } else {
                    element.className = "text-primary flex gap-2 font-bold items-center border-b-2 border-gray-light border-primary pb-2 tab tab-active";
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
