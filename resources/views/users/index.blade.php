@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary mb-3" href="{{ route('tambah') }}"><i class="fa fa-plus"></i> Tambah Pengguna</a>
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Prodi</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Prodi</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $i)
                                    <tr>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->role }}</td>
                                        <td>{{ $i->prodi?->name }}</td>
                                        <td width="150px">
                                            <a href="{{ url('users/edit/' . $i->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="users/hapus/{{ $i->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
