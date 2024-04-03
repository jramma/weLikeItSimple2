@if (isset($is_preview) && $is_preview)
    <div class="internal-editor">
        {{ __('Add contents to this block to get a preview', 'basics') }}
    </div>
@else
    <header>
        <div class="container">
            <a href="/" class="block w-32 mt-8 lg:ml-36 md:ml-15">
                {!! get_svg($image_header, 'w-30') !!}
            </a>
        </div>
    </header>
@endif
