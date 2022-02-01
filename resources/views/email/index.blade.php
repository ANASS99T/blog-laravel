@extends('layout.app')

@section('content')

<article>
    {!!html_entity_decode($blog->body)!!}
</article>

@endsection