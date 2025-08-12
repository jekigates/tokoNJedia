<header>
    <div class="flex justify-between px-8 py-2 bg-slate-100 text-sm text-gray-dark">
        <div>
            <a href="" class="hover:text-primary flex items-center gap-2">
                <x-heroicon-o-device-phone-mobile class="w-6 h-6" />
                Download TokoNJedia App
            </a>
        </div>

        <div class="flex gap-8">
            <a href="" class="hover:text-primary">Tentang Tokopedia</a>
            <a href="" class="hover:text-primary">Mitra Tokopedia</a>
            <a href="" class="hover:text-primary">Mulai Berjualan</a>
            <a href="" class="hover:text-primary">Promo</a>
            <a href="" class="hover:text-primary">TokoNJedia Care</a>
        </div>
    </div>

    <div class="flex justify-between items-start px-8 py-4 bg-white border-b border-b-gray-light text-sm gap-8">
        <div class="flex items-end gap-2">
            <div class="h-8 flex items-center">
                <x-logo />
            </div>

            @if (Auth::check() && Auth::user()->merchant != null)
                <p>Seller</p>
            @endif
        </div>

        <div class="flex-grow">
            <form action="{{ route('home.search') }}" method="GET">
                <x-form.input type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Search" required/>
            </form>

            @isset($recommendations)
                <div class="flex gap-4 text-sm text-gray mt-4">
                    @foreach ($recommendations as $recommendation)
                        <a href="{{ route('home.search', ['keyword' => $recommendation->name]) }}" name="keyword" class="hover:text-primary">{{ $recommendation->name }}</a>
                    @endforeach
                </div>
            @endisset
        </div>

        @if (Auth::check())
            <div class="flex items-center gap-4 h-8">
                <a href="{{ route('cart.index') }}" class="relative text-black hover:text-primary @yield('cart')">
                    <x-heroicon-o-shopping-cart class="w-6 h-6" />

                    @if (Auth::user()->carts->count() > 0)
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-red text-white rounded-full p-1 text-xs flex items-center justify-center">
                            {{ Auth::user()->carts->count() }}
                        </div>
                    @endif
                </a>
                <a href="{{ route('chats.index') }}" class="text-black hover:text-primary">
                    <x-heroicon-o-chat-bubble-left class="w-6 h-6" />
                </a>
            </div>

            @if (Auth::user()->merchant != null)
                <a href="{{ route('merchant.index') }}" class="flex items-center gap-2 text-black hover:text-primary @yield('merchant')">
                    <img src="{{ asset(Auth::user()->merchant->getImage()) }}" alt="" class="w-8 h-8 rounded-full object-cover">
                    <p>@str_limit(Auth::user()->merchant->name, 10)</p>
                </a>
            @else
                <x-button variant="primary" outline href="{{ route('merchant.register.index') }}">Be Merchant</x-button>
            @endif

            <a href="{{ route('general.index') }}" class="flex items-center gap-2 text-black hover:text-primary @yield('profile')">
                <img src="{{ asset(Auth::user()->getImage()) }}" alt="" class="w-8 h-8 rounded-full">
                <p>{{ Auth::user()->username }}</p>
            </a>
        @else
            <div class="flex gap-2">
                <x-button href="{{ route('login.index') }}" variant="primary">Login</x-button>
                <x-button href="{{ route('register.index') }}" variant="primary" outline>Register</x-button>
            </div>
        @endif
    </div>
</header>
