@if (isset($is_preview) && $is_preview)
    <div class="internal-editor">
        {{ __('Add contents to this block to get a preview', 'basics') }}
    </div>
@else
    <header>
        <div class="container">
            @if (!empty($header_logo))
                <a href="/" class="block w-32 mt-8 lg:ml-36 md:ml-15">
                {!! wp_get_attachment_image($header_logo['id'], 'full', false, ['class' => 'w-30']) !!}
                </a>
            @endif
        </div>
    </header>
@endif
