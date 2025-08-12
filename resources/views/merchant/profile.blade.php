@extends('layouts.merchant')

@section('title', 'Merchant Profile')

@section('profile', 'text-primary')

@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <p class="text-xl font-bold mb-4">Edit Profile</p>
        <div class="flex gap-8 mb-8 items-center">
            <div class="relative w-32 h-32">
                <img src="{{ asset(Auth::user()->merchant->getImage()) }}" alt="" class="w-full h-full rounded-full object-cover" id="img_merchant_image">
                <input type="file" name="image" id="merchant_image" class="hidden" accept=".jpg,.jpeg,.png" onchange="validateInputImage(this, 'img_merchant_image')">
                <button type="button" class="bg-gray-light text-black p-2 rounded-full absolute bottom-0 right-0" onclick="openInputImage('merchant_image')">
                    <x-heroicon-o-camera class="w-6 h-6" />
                </button>
            </div>
            <div class="flex-grow">
                <div class="mb-4 w-1/3">
                    <x-form.label for="merchant_name">Merchant Name</x-form.label>
                    <x-form.input type="text" name="name" id="merchant_name" placeholder="ABC Store" value="{{ Auth::user()->merchant->name }}" class="font-bold" maxlength="255"/>
                </div>
                <div class="flex gap-4">
                    <div class="w-1/3">
                        <x-form.label for="process_time">Process Time</x-form.label>
                        <x-form.input type="text" name="process_time" id="process_time" placeholder="Process Time" value="{{ Auth::user()->merchant->process_time }}" maxlength="255"/>
                    </div>
                    <div class="w-1/3">
                        <x-form.label for="operational_time">Operational Time</x-form.label>
                        <x-form.input type="text" name="operational_time" id="operational_time"  placeholder="Operational Time" value="{{ Auth::user()->merchant->operational_time }}" maxlength="255"/>
                    </div>
                    <div class="w-1/3">
                        <x-form.label for="status">Status</x-form.label>
                        <x-form.select value="{{ Auth::user()->merchant->status }}">
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </x-form.select>
                    </div>
                </div>
            </div>
        </div>
        <p class="mb-4">Banner Image</p>
        <button class="w-full h-96 hover:opacity-50" onclick="openInputImage('merchant_banner_image')" type="button">
            <img src="{{ asset(Auth::user()->merchant->getBannerImage()) }}" alt="" class="w-full h-full object-cover rounded-lg mb-8" id="img_merchant_banner_image">
            <input type="file" name="banner_image" id="merchant_banner_image" class="hidden" accept=".jpg,.jpeg,.png" onchange="validateInputImage(this, 'img_merchant_banner_image')">
        </button>
        <div class="flex gap-4 mb-4">
            <div class="w-3/4">
                <x-form.label for="description">Description</x-form.label>
                <x-form.input type="text" name="description" id="description" placeholder="Description" value="{{ Auth::user()->merchant->description }}" maxlength="255"/>
            </div>
            <div class="w-1/4">
                <x-form.label for="catch_phrase">Catchphrase</x-form.label>
                <x-form.input type="text" name="catch_phrase" id="catch_phrase" placeholder="ex. Thrive for the better" value="{{ Auth::user()->merchant->catch_phrase }}" maxlength="255"/>
            </div>
        </div>
        <div class="mb-8">
            <x-form.label for="about_store">About Store</x-form.label>
            <x-form.textarea name="full_description" id="about_store" placeholder="Tell your customer all about your store here" maxlength="255">{{ Auth::user()->merchant->full_description }}</x-form.textarea>
        </div>
        <div class="flex gap-4 justify-end">
            <x-button variant="red" class="flex items-center gap-2" type="reset" onclick="resetImages()">
                <x-heroicon-o-x-circle class="w-6 h-6" />
                Discard Changes
            </x-button>
            <x-button variant="primary" class="flex items-center gap-2" type="submit">
                <x-heroicon-o-pencil class="w-6 h-6" />
                Edit Profile
            </x-button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function resetImages() {
            $('#img_merchant_image').attr('src', '{{ asset(Auth::user()->merchant->getImage()) }}');
            $('#img_merchant_banner_image').attr('src', '{{ asset(Auth::user()->merchant->getBannerImage()) }}');
        }
    </script>
@endpush
