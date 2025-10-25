@props(['reverse' => false])

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
    @if(!$reverse)
        <div data-aos="fade-right">
            {{ $image }}
        </div>
        <div data-aos="fade-left">
            {{ $content }}
        </div>
    @else
        <div data-aos="fade-right" class="lg:order-2">
            {{ $image }}
        </div>
        <div data-aos="fade-left" class="lg:order-1">
            {{ $content }}
        </div>
    @endif
</div>