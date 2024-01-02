@extends('layouts.merchant')

@section('title', 'Merchant Product Create')

@section('products', 'text-primary')
@section('products.create', 'text-primary font-bold')

@section('content')
    <section>
        <p class="font-bold text-xl mb-8">Add Product</p>

        <div class="border border-gray-light rounded-lg p-8 mb-8">
            <p class="font-bold text-xl mb-4">Product Information</p>

            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Name <span class="text-red font-bold">*</span></p>
                    <x-form.label for="name">Product name min. 3 character</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="text" name="name" id="name" placeholder="Example: Nike Man Shoes (Product Type/Category/Brand/Other)"/>
                </div>
            </div>
            <div class="flex items-center gap-16">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Category <span class="text-red font-bold">*</span></p>
                    <x-form.label for="category_name">Choose category from the list</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.select>
                        <option value="">Product Category</option>
                    </x-form.select>
                </div>
            </div>
        </div>

        <div class="border border-gray-light rounded-lg p-8 mb-8">
            <p class="font-bold text-xl mb-4">Product Detail</p>

            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Image <span class="text-red font-bold">*</span></p>
                    <x-form.label>File Size: Maximum 10.000.000 bytes (10 Megabytes). File extension allowed: .JPG, .JPEG, .PNG</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="text"/>
                </div>
            </div>
            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold">Condition <span class="text-red font-bold">*</span></p>
                </div>
                <div class="flex-grow flex justify-center">
                    <div class="flex gap-8">
                        <div>
                            <input type="radio" name="condition" id="new">
                            <label for="new">New</label>
                        </div>
                        <div>
                            <input type="radio" name="condition" id="used">
                            <label for="used">Used</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-16">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Description <span class="text-red font-bold">*</span></p>
                    <x-form.label for="name">Make sure the product description contains a detailed explanation regarding your product so that buyers can easily understand and find your product</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.textarea rows="6"></x-form.textarea>
                </div>
            </div>
        </div>

        <div class="border border-gray-light rounded-lg p-8">
            <p class="font-bold text-xl mb-1">Product Variant</p>
            <p class="mb-4 text-sm">Add variant so that customer can choose the right<br>product. Enter max. 5 types of variants</p>

            <hr class="text-gray-light mb-4">
            <p class="font-bold mb-4">Product Variant 1</p>
            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Variant Name <span class="text-red font-bold">*</span></p>
                    <x-form.label>Product variant name min. 3 character</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="text" placeholder="Example: Nike Man Shoes (Product Type/Category/Brand/Other)"/>
                </div>
            </div>
            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Variant Price <span class="text-red font-bold">*</span></p>
                    <x-form.label>Product variant price must be more than 0</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="number" placeholder="Example: 50000"/>
                </div>
            </div>
            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Variant Stock <span class="text-red font-bold">*</span></p>
                    <x-form.label>Product variant stock must be more than 0</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="number" placeholder="Example: 50"/>
                </div>
            </div>

            <hr class="text-gray-light mb-4">
            <p class="font-bold mb-4">Product Variant 2</p>
            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Variant Name <span class="text-red font-bold">*</span></p>
                    <x-form.label>Product variant name min. 3 character</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="text" placeholder="Example: Nike Man Shoes (Product Type/Category/Brand/Other)"/>
                </div>
            </div>
            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Variant Price <span class="text-red font-bold">*</span></p>
                    <x-form.label>Product variant price must be more than 0</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="number" placeholder="Example: 50000"/>
                </div>
            </div>
            <div class="flex items-center gap-16 mb-4">
                <div class="min-w-60 max-w-60">
                    <p class="text-gray font-semibold mb-1">Product Variant Stock <span class="text-red font-bold">*</span></p>
                    <x-form.label>Product variant stock must be more than 0</x-form.label>
                </div>
                <div class="flex-grow">
                    <x-form.input type="number" placeholder="Example: 50"/>
                </div>
            </div>

            <x-button variant="primary" outline>+ Add Variant</x-button>
        </div>
    </section>
@endsection
