@extends('template.BaseView')

@section('styles')
@endsection

@section('content')
<div class="bg-white py-3 px-4">
    <div class="row">
        <div class="col-md-8">
            <h1 class=" font-weight-bold text-info">
                <u>Program Studi {{ $p->name }}</u>
            </h1>
            <span class="border border-info py-2 px-2 rounded my-1 d-inline-block">Profil</span>
            @if($p->kode == Auth::user()->prodi_kode)
            <a class="btn btn-info py-2 px-2 rounded my-1 d-inline-block" href="{{ url('edit-profil-prodi')}}"><i class="fa fa-pencil"></i> Edit Profil</a>
            @endif
            <div class="my-3">
                {!! $p->deskripsi !!}
            </div>
        </div>
        <div class="col-md-4">
            <div style="min-width: 300px;min-height:300px" class="bg-info align-items-center justify-content-center d-flex rounded">
                <p class="text-white">Foto Fakultas</p>
            </div>
            <!-- Visi -->
            <div class="my-2 py-2 text-center">
                <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Visi</span>
                <div class="my-3">
                    {!! $p->visi !!}
                </div>
            </div>
            <!-- Misi -->
            <div class="my-2 py-2 text-center">
                <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Misi</span>
                <div class="my-3">
                    {!! $p->misi !!}
                </div>

            </div>
        </div>


    </div>
    @endsection