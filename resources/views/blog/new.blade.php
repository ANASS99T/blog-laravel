@extends('layout.app')

@section('content')

    <div class="container">
        <h1 class='text-center my-2'>New blog page</h1>

        <form method="post" action={{ route('blog.new') }} enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="author" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="author" name='author'>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name='title'>
                </div>
                <div class="col-12 mb-3">
                    <div class="input-group ">
                        <label class="input-group-text" for="image">Upload Image</label>
                        <input type="file" id="image" name='image' class="form-control">
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <textarea class="ckeditor form-control" name="body"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
