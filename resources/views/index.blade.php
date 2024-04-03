@extends('layouts.app')

@section('content')

  Hola
  @php the_content() @endphp

  @while(have_posts()) @php the_post() @endphp
    @title
    {{-- <article @php post_class() @endphp>

      <div class="entry-content">
        @php the_content() @endphp
      </div>

    </article> --}}
  @endwhile

@endsection
