@extends('template.BaseView')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profil Fakultas {{$i->nama}}</h4>
                @if (session()->has('pesan'))
                {!! session()->get('pesan') !!}
                @endif
                <form action="/fakultas/put/{{ $i->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div hidden>
                        <div class="form-group">
                            <label for="">Nama Fakultas</label>
                            <input type="text" name="nama" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $i->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">Singkatan</label>
                            <input type="text" name="singkatan" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $i->singkatan }}">
                        </div>
                        <div class="form-group">
                            <label for="">Urutan</label>
                            <input type="number" name="urutan" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $i->urutan }}" required>
                        </div>
                    </div>

                    <hr>
                    <h5>Data Profil</h5>
                    <div class="form-group">
                        <label for="">Gambar </label>
                        <input type="file" name="foto_file" class="form-control" placeholder="Urutan" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control">{{$i->deskripsi}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Visi</label>
                        <textarea name="visi" id="visi" class="form-control">{{$i->visi}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Misi</label>
                        <textarea name="misi" id="misi" class="form-control">{{$i->misi}}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn-primary btn-sm" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        CKEDITOR.replace('deskripsi');
        CKEDITOR.replace('visi');
        CKEDITOR.replace('misi');
    })
</script>
@endsection