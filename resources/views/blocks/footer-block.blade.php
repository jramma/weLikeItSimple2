@if (isset($is_preview) && $is_preview)
    <div class="internal-editor">
        {{ __('Add contents to this block to get a preview', 'basics') }}
    </div>
@else
    <footer class="text-white bg-gray-1">
        <div class="container lg:grid grid-cols-5 py-8 lg:py-16">
            <div class="col-start-1 col-end-2">
                <div class="text-base font-bold pb-5">{!! $title !!}</div>
                <p class="pb-7 lg:pb-0">
                    {!! $text_footer !!}
                </p>
            </div>
            <div class="col-start-5 ">
                <div class="text-base font-bold pb-5">{!! $social_title !!}</div>
                <div class="flex gap-4">
                    @foreach ($repeater_social as $social)
                        <a href="{{ $social['url_social'] }}" class="block">
                            {!! get_svg('images.icons.' . ucfirst($social['select_icon'])) !!}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="border-gray-300">
        <div class="container lg:grid grid-cols-4 py-7 lg:py-14">
            <div class="col-start-1 col-end-3 pb-9 lg:pb-0">
                <a href="#" class="text-base font-bold mr-3">Privacy policy</a>
                <a href="#" class="text-base font-bold mr-3">Legal Notice</a>
            </div>
            <div class="col-start-4 ">
                <a href="https://mortensen.cat" target="_blank" rel="noopener"
                    title="Mortensen: digital agency in Barcelona. UX/UI Design and development">Made with <i
                        class="transition not-italic group-hover:text-[red]">&#x1F49C;</i> by Mortensen</a>
            </div>
        </div>
    </footer>
@endif
