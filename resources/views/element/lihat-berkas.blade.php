@extends('template.BaseView')
@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Berkas</h6>
            </div>
            <div class="card-body">
                @if (session()->has('pesan'))
                {!! session()->get('pesan') !!}
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th width="150px">Dec</th>
                                <th width="150px">Catatan Auditor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th width="150px">Dec</th>
                                <th width="150px">Catatan Auditor</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($berkas as $i)
                            <tr>
                                <td><a href="{{ url('berkas/' . $i->id) }}" target="_blank">{{ $i->file_name }}</a>
                                </td>
                                <td>{!! $i->dec !!}</td>
                                <td>{{ $i->catatan_auditor }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Rata - Rata</h4>
                {{ $avg }} -->
                <a href="{{ route('element-prodi', $prodi->kode) }}" class=" btn btn-primary btn-sm d-flex justify-content-start align-items-center mb-2 w-100">
                    <i class="fa fa-arrow-left mr-2"></i> Kembali
                </a>
                @if(Auth::user()->role == 'Admin')
                <button type="button" class="btn btn-warning btn-sm d-flex justify-content-start align-items-center mb-2 w-100" data-toggle="modal" data-target="#resetNilai">
                    <i class="fa fa-arrow-left mr-2"></i> Reset Nilai
                </button>
                @endif
                @if(in_array(Auth::user()->role,['Admin','Prodi']))
                <a href="{{ url('element/unggah-berkas/' . $element->id) }}" class="btn btn-info btn-sm d-flex justify-content-start align-items-center mb-2 w-100">
                    <i class="fa fa-upload mr-2"></i> Unggah Berkas
                </a>
                @endif
                @if(Auth::user()->role == 'Auditor')
                <button type="button" class="btn btn-primary btn-sm d-flex justify-content-start align-items-center mb-2 w-100" data-toggle="modal" data-target="#form_penilaian">
                    <i class="fa fa-wpforms  mr-2"></i> Form Auditor
                </button>
                @endif
                <hr>


                <h5 class="card-title">Bobot * Score</h5>
                <p>
                    {{ @$element->bobot }} * {{ @$element->score_auditor }} = {{ @$element->score_hitung }}
                </p>
                <hr>
                <h5 class="card-title">Keterangan Auditor</h5>
                <p>
                    {{ @$element->ket_auditor }}
                </p>
                <hr>



            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resetNilai" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/element/reset/{{ $element->id }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('delete')
                    Jika kamu melakukan reset data maka nilai pencapaian, data berkas dan data nilai ketentuan akan
                    dihapus secara permanent pada
                    sistem.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Tetap Reset
                        !!!</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="form_penilaian" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/element/penilaian-auditor/{{ $element->id }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Auditor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Score</label>
                        <input class="form-control" id="score_auditor" name="score_auditor" value="{{ @$element->score_auditor }}"></input>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" id="ket_auditor" name="ket_auditor" rows="5">{{ @$element->ket_auditor }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection