@if (isset($is_preview) && $is_preview)
    <div class="internal-editor">
        {{ __('Add contents to this block to get a preview', 'basics') }}
    </div>
@else
    <section>
        <div class="relative container text-center py-8 lg:py-16 lg:w-3/4">
            <h1 class="text-gray-1 text-center font-gilroy text-2xl font-bold leading-3.625 pb-5">{{ $title }}
            </h1>
            <div class="mb-12 lg:text-lg lg:px-12 text-gray-1 font-gilroy-regular text-1.25  font-400 leading-1.875">
                {!! $text !!}</div>
            @if ($gallery_field)
                <div class="w-full h-full mySwiper overflow-x-hidden relative pb-0">
                    <div class="swiper-wrapper ">
                        @foreach ($gallery_field as $image)
                            <div class="swiper-slide">
                                <div class="w-full aspect-video ">
                                    <img class="w-full h-full object-cover rounded-md" src="{!! esc_url($image['url']) !!}"
                                        alt="{!! esc_attr($image['alt']) !!}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class=" -bottom-22  mySwiper-pagination z-10 color-black"></div>
            @endif
            <div class="cursor-pointer absolute -right-16 top-5/8  z-10 mySwiper-button-next hidden lg:flex">
                {!! get_svg('images.icons.chevron', 'h-8 w-auto rotate-180') !!}
            </div>
            <div class="cursor-pointer absolute -left-16 top-5/8  z-10 mySwiper-button-prev hidden lg:flex">
                {!! get_svg('images.icons.chevron', 'h-8 w-auto') !!}
            </div>
        </div>
    </section>
@endif
