@extends('layout.app')

@section('content')

    <div class="container">
        <h1 class="text-center my-2">Blog list page</h1>

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>created at</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>


    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('blog') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'author',
                        name: 'author'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'created_at',
                        name: 'created _at',

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endsection
