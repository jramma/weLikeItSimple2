@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <article @php post_class() @endphp>

      @php the_content() @endphp

      <h1>This is a H1</h1>
      <h2>This is a H2</h2>
      <h3>This is a H3</h3>
      <h4>This is a H4</h4>
      <h5>This is a H5</h5>
      <h6>This is a H6</h6>
      <p>This is a paragraph</p>
      <p>This is a paragraph with a <a href="#">link</a></p>
      <p>This is a paragraph with a <strong>strong</strong> tag</p>
      <p>This is a paragraph with an <em>emphasized</em> tag</p>
      <p>This is a paragraph with a <u>underlined</u> tag</p>
      <ul>
        <li>This is a list item</li>
        <li>This is a list item</li>
        <li>This is a list item</li>
      </ul>
      <ol>
        <li>This is a list item</li>
        <li>This is a list item</li>
        <li>This is a list item</li>
      </ol>
      <blockquote>This is a blockquote</blockquote>
      <table>
        <thead>
          <tr>
            <th>Table Header</th>
            <th>Table Header</th>
            <th>Table Header</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Table Cell</td>
            <td>Table Cell</td>
            <td>Table Cell</td>
          </tr>
          <tr>
            <td>Table Cell</td>
            <td>Table Cell</td>
            <td>Table Cell</td>
          </tr>
          <tr>
            <td>Table Cell</td>
            <td>Table Cell</td>
            <td>Table Cell</td>
          </tr>
        </tbody>
      </table>
      <div class="wp-block-image">
        <figure class="aligncenter">
          <img src="https://source.unsplash.com/random/800x600" alt="" class="wp-image-1" />
          <figcaption>This is a caption</figcaption>
        </figure>
      </div>
    </article>
  @endwhile
@endsection
