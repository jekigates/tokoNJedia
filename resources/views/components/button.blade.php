@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $buttonClasses()]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $buttonClasses()])->merge(['type' => 'button']) }}>
        {{ $slot }}
    </button>
@endif
