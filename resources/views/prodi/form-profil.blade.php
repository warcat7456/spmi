@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profil Prodi {{ $i->name }}</h4>
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <form action="/edit-profil-prodi/put/{{ $i->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <hr>
                        <h5>Data Profil</h5>
                        <div class="form-group">
                            <label for="">Gambar</label>
                            <input type="file" name="foto_file" accept="image/*" class="form-control"
                                placeholder="Urutan" aria-describedby="helpId">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="ganti_gambar" name="ganti_gambar">
                            <label class="form-check-label" for="ganti_gambar">Ganti Gambar</label>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $i->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Visi</label>
                            <textarea name="visi" id="visi" class="form-control">{{ $i->visi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Misi</label>
                            <textarea name "misi" id="misi" class="form-control">{{ $i->misi }}</textarea>
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
            $('#ganti_gambar').on('change', function() {
                if (this.checked) {
                    // Aktifkan input file
                    $('#foto_file').prop('disabled', false);
                } else {
                    // Nonaktifkan input file
                    $('#foto_file').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
