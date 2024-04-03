@if (isset($is_preview) && $is_preview)
    <div class="internal-editor">
        {{ __('Add contents to this block to get a preview', 'basics') }}
    </div>
@else
    <section>
        <div class="container text-center py-8 pt-0 lg:py-16 lg:w-3/4">

            <h1 class="text-gray-1 text-center font-gilroy text-2xl font-bold leading-3.625 pb-5">{{ $title }}
            </h1>
            <p class="lg:text-lg lg:px-12 text-gray-1 font-400">{!! $text !!}</p>

        </div>
    </section>
@endif
