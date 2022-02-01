@extends('layout.app')

@section('content')

    <div class="container">
        <h1 class='text-center my-2'>Blog update page</h1>

        @if ($blog)
            <form method="post" action={{ route('blog.update') }} enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="text" style="display: none" name="id" value={{ $blog->id }}>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name='author' value={{ $blog->author }}>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name='title' value={{ $blog->title }}>
                    </div>
                    <div class="col-12 mb-3">

                        <p style="text-align:center">
                            <img src="{{ url('storage/images/' . $blog->image) }}" alt="Image" style='max-width: 400px; max-height: 400px;' />
                        </p>
                        <div class="input-group my-2">
                            <label class="input-group-text" for="image">Upload Image</label>
                            <input type="file" id="image" name='image' class="form-control">
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="body" value={{ $blog->body }}>{{ $blog->body }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        @else
            <p class="text-danger">no blog found</p>
        @endif
    </div>


    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>

    <script type="text/javascript">
        CKEDITOR.replace('wysiwyg-editor', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>


@endsection
