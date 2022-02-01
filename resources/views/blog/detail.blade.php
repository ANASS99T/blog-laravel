@extends('layout.app')

@section('content')

    <div class="container">
        <h1 class='text-center my-2'>Blog detail page</h1>

        @if ($blog)

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <span>Title: {{ $blog->title }}</span>
                </div>
                <div class="col-md-6 col-sm-12">
                    <span>Author: {{ $blog->author }}</span>
                </div>
                <div class="col-md-6 col-sm-12">
                    <span>Image:</span>
                    <p style="text-align:center">

                        <img src="{{ url('storage/images/' . $blog->image) }}" alt="Image" style='max-width: 400px; max-height: 400px;' />
                    </p>
                </div>
                <article class="col-md-12">
                    {{-- {{ $blog->body }} --}}
                    {!!html_entity_decode($blog->body)!!}
                </article>
            </div>

        @endif
    </div>

@endsection
