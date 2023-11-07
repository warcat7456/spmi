@extends('template.BaseView')

@section('styles')
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-boy">
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <img style="width: 100%; border-radius : calc(0.35rem - 1px)" src="{{ $p->foto ? route('showimage', ['filename' => $p->foto]) : asset('home/img/about.png') }}">
                        </div>
                        <div class="col-md-9 d-flex align-items-center">
                            <h1 class="d-flex align-items-center font-weight-bold text-info">
                                <u>Program Studi {{ $p->name }}</u>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <span class="border border-info py-2 px-2 rounded my-1 d-inline-block">Profil</span>
                    @if ($p->kode == Auth::user()->prodi_kode && $edit == true)
                    <a class="btn btn-info py-2 px-2 rounded my-1 d-inline-block" href="{{ url('edit-profil-prodi') }}"><i class="fa fa-pencil"></i> Edit Profil</a>
                    @endif
                    <div class="my-3 text-justify" style="word-wrap: break-word">
                        {!! $p->deskripsi !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="my-2 py-2">
                        <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Visi</span>
                        <div class="my-3 text-justify" style="word-wrap: break-word ">
                            {!! $p->visi !!}
                        </div>
                    </div>
                    <div class="my-2 py-2">
                        <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Misi</span>
                        <div class="my-3 text-justify" style="word-wrap: break-word">
                            {!! $p->misi !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 card">
        <span class="border border-info py-2 px-2 rounded my-1 d-inline-block mt-3"><strong>Berkas Akreditasi</strong></span>
    </div>
</div>
@endsection