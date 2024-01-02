@extends('layouts.merchant')

@section('title', 'Merchant Product Index')

@section('products', 'text-primary')
@section('products.index', 'text-primary font-bold')

@section('content')
    <section>
        <div class="flex justify-between mb-4">
            <p class="font-bold text-xl">Product List</p>
            <x-button href="{{ route('merchant.products.create') }}" variant="primary">+ Add Product</x-button>
        </div>

        <div class="border border-gray-light rounded-lg">
            <button
                class="inline-flex text-primary px-4 py-2 border-b-2 border-primary font-bold"
            >
                All Products
            </button>
            <div class="p-4 border-t border-gray-light">
                <x-form.input type="text" placeholder="Search Product"/>
            </div>
            <div>
                <table class="table-auto w-full text-left text-sm">
                    <thead class="border-y border-gray-light">
                        <tr>
                            <th class="p-4 font-normal">Product Information</th>
                            <th class="p-4 font-normal">Name</th>
                            <th class="p-4 font-normal">Price</th>
                            <th class="p-4 font-normal">Stock</th>
                            <th class="p-4 font-normal">Category</th>
                            <th class="p-4 font-normal"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->merchant->products as $product)
                            <tr>
                                <td class="p-4 font-normal">
                                    <img src="{{ asset($product->images[0]->image) }}" alt="" class="w-20 h-20 object-cover">
                                </td>
                                <td class="p-4 font-normal">{{ $product->name }}</td>
                                <td class="p-4 font-normal">@money($product->variants[0]->price)</td>
                                <td class="p-4 font-normal">{{ $product->variants[0]->stock }}</td>
                                <td class="p-4 font-normal">{{ $product->category->name }}</td>
                                <td class="p-4 font-normal">
                                    <x-form.select>
                                        <option value="">--- Manage ---</option>
                                        <option value="">Add Variant</option>
                                        <option value="">Edit</option>
                                        <option value="">Delete</option>
                                    </x-form.select>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold bg-gray text-white" colspan="6">
                                    <div class="flex justify-between">
                                        <p>Look Product Variant</p>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                            </svg>
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg> --}}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($product->variants as $variant)
                            <tr class="bg-gray-light">
                                <td class="p-4 font-normal" colspan="2">{{ $variant->name }}</td>
                                <td class="p-4 font-normal">@money($variant->price)</td>
                                <td class="p-4 font-normal" colspan="2">{{ $variant->stock }}</td>
                                <td class="p-4 font-normal">
                                    <x-form.select>
                                        <option value="">--- Manage ---</option>
                                        <option value="">Add Variant</option>
                                        <option value="">Edit</option>
                                        <option value="">Delete</option>
                                    </x-form.select>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
