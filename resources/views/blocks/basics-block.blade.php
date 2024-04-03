@dd($is_preview);

@if(isset($is_preview) && $is_preview)
  <div class="internal-editor">
    {{ __('Add contents to this block to get a preview', 'basics') }}
  </div>
@else
  <div class="{{ $block->classes }}">
    <h2>{{ $title }}</h2>
    <article>{!! $text !!}</article>
    @if ($items)
      <ul>
        @foreach ($items as $item)
          <li>{{ $item['item'] }}</li>
        @endforeach
      </ul>
    @else
      <p>{{ $block->preview ? 'Add an item...' : 'No items found!' }}</p>
    @endif

    <div>
      <InnerBlocks />
    </div>
  </div>
@endif
