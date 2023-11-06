@extends('template.BaseView')
@section('styles')
    <style>
        .detail-content {
            border: 1px solid #ccc;
            /* Add a border for better separation */
            padding: 10px;
            /* Add some padding for spacing */
            max-height: 300px;
            /* Set a maximum height to limit the size */
            overflow: auto;
            /* Add scrollbars if content exceeds the maximum height */
            min-height: 30vh;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Halaman</h6>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-static-page" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Judul Halaman</th>
                                    <th>Tautan (URL)</th>
                                    <th>Tgl dibuat</th>
                                    <th>Tgl diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div style="min-width:80vw;min-height:50vh;" class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Static Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="detailTitle">Title</label>
                        <input type="text" class="form-control" id="detailTitle" name="title" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailSlug">Slug</label>
                        <input type="text" class="form-control" id="detailSlug" name="slug" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailContent">Konten</label>
                        <div class="form-control detail-content" id="detailContent"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Static Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group">
                            <label for="editTitle">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title">
                        </div>
                        <div class="form-group">
                            <label for="editSlug">Slug</label>
                            <input type="text" class="form-control" id="editSlug" name="slug">
                        </div>
                        <div class="form-group">
                            <label for="editContent">Konten</label>
                            <textarea id="dec" name="content"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Halaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="deleteId">
                        <p id="delete-confirmation-text"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {

            CKEDITOR.replace('dec');
            var editor = CKEDITOR.instances.dec;

            // Function to generate slug from title
            function generateSlug(title) {
                // Replace spaces with hyphens and convert to lowercase
                return title.trim().replace(/\s+/g, '-').toLowerCase();
            }

            // Update the slug when the title field changes
            $('#editTitle').on('input', function() {
                var title = $(this).val();
                var slug = generateSlug(title);
                $('#editSlug').val(slug);
            });
            var table = $('#table-static-page').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('halaman.datatable') }}',
                columns: [{
                        data: 'title',
                        name: 'title',
                        title: 'Judul Halaman'
                    },
                    {
                        data: 'slug',
                        name: 'slug',
                        title: 'Tautan (URL)'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Tgl dibuat',
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY HH:mm:ss');
                        }
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        title: 'Tgl diubah',
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY HH:mm:ss');
                        }
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        title: 'Aksi',
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary btn-sm detail-action my-1" data-toggle="modal" data-target="#detailModal" ' +
                                'data-id="' + row.id + '" data-title="' + row.title +
                                '" data-slug="' + row.slug +
                                '">Detail</button>' +
                                ' <button class="btn btn-warning text-dark btn-sm edit-action my-1" data-toggle="modal" data-target="#editModal" ' +
                                'data-id="' + row.id + '" data-title="' + row.title +
                                '" data-slug="' + row.slug + '">Edit</button>' +
                                ' <button class="btn btn-danger btn-sm delete-action my-1" data-toggle="modal" data-target="#deleteModal" ' +
                                'data-id="' + row.id + '"  data-title="' + row.title +
                                '">Delete</button>';
                        }
                    }
                ]
            });



            // Detail
            $('#table-static-page').on('click', '.detail-action', async function() {
                var halaman
                var id = $(this).data('id');
                var title = $(this).data('title');
                var slug = $(this).data('slug');
                await $.ajax({
                    url: '/detail-halaman/' + id,
                    method: 'GET',
                    success: function(response) {
                        halaman = response.page
                    },
                    error: function() {
                        alert('terdapat kesalahan')
                    }
                });
                $('#detailTitle').val(title);
                $('#detailSlug').val(slug);
                $('#detailContent').html(halaman.content);
            });

            // Edit
            $('#table-static-page').on('click', '.edit-action', async function() {
                var halaman
                var id = $(this).data('id');
                await $.ajax({
                    url: '/detail-halaman/' + id,
                    method: 'GET',
                    success: function(response) {
                        halaman = response.page
                    },
                    error: function() {
                        alert('terdapat kesalahan')
                    }
                });

                $('#editForm').attr('action', '/halaman/' + id);
                $('#editId').val(id);
                $('#editTitle').val(halaman.title);
                $('#editSlug').val(halaman.slug);
                editor.setData(halaman.content);
            });

            // Delete
            $('#table-static-page').on('click', '.delete-action', function() {
                $('#delete-confirmation-text').html("Apakah anda yakin ingin menghapus halaman " +
                    "<span class='font-weight-bold text-primary'>" + $(
                        this).data('title') + "</span>" + " ?");
                var id = $(this).data('id');
                $('#deleteForm').attr('action', '/halaman/' + id);
                $('#deleteId').val(id);
            });
        });
    </script>
@endsection
