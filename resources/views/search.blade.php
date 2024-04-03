@extends('layouts.app')

@section('content')

  {!! get_search_form() !!}

  @while(have_posts()) @php the_post() @endphp
    {{-- Results --}}
  @endwhile

@endsection
