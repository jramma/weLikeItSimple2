@if (isset($is_preview) && $is_preview)
    <div class="internal-editor">
        {{ __('Add contents to this block to get a preview', 'basics') }}
    </div>
@else
    <section>
        <div class="container lg:flex flex-row  gap-6 items-center py-6	lg:py-12">
            <div class="basis-1/2 mb-5 lg:mb-0">
                <h2 class="text-xl pb-3 lg:hidden text-center">{!! $title !!}</h2>
                <img class="w-full h-full object-cover rounded-md" src="{!! esc_url($image_content['url']) !!}"
                    alt="{!! esc_attr($image_content['alt']) !!}">
            </div>
            <div class="basis-1/2">
                <h2 class="text-gray-1 text-center font-gilroy text-2xl font-bold leading-3.625 pb-5 lg:block hidden">{!!$title!!}</h2>
                <div class="text-center pb-5 lg:text-lg lg:pb-9  lg:text-left text-gray-1">
                    {!! $text !!}
                </div>
                <div class="w-full mx-auto text-center mb-5 lg:text-left lg:mb-0">
                    <a href="#" class="rounded bg-black text-base text-white py-3 px-4 ">Buy now</a>
                </div>
            </div>
        </div>
    </section>
@endif
