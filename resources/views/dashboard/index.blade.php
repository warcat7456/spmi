@extends('template.BaseView')

@section('styles')
@endsection

@section('content')
<div class="bg-white py-3 px-4">
    <div class="row">
        <div class="col-md-8">
            <h1 class=" font-weight-bold text-info">
                <u>Fakultas {{ !empty(auth()->user()->prodi->fakultas->nama) ? auth()->user()->prodi->fakultas->nama : '' }}</u>
            </h1>
            <span class="border border-info py-2 px-2 rounded my-1 d-inline-block">Profil</span>
            <div class="my-3">
                {!! !empty(auth()->user()->prodi->fakultas->deskripsi) ? auth()->user()->prodi->fakultas->deskripsi : '' !!}
            </div>
        </div>
        <div class="col-md-4">
            <!-- Foto -->
            <!-- TODO:Gunakan css Card -->
            <div style="min-width: 300px;min-height:300px" class="bg-info align-items-center justify-content-center d-flex rounded">
                <p class="text-white">Foto Fakultas</p>
            </div>
            <!-- Visi -->
            <div class="my-2 py-2 text-center">
                <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Visi</span>
                <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem neque
                    odio dolore minus
                    temporibus officia optio culpa asperiores dolor adipisci, modi autem ad natus quae, porro cum!
                    Repudiandae, eaque ex?</p>
            </div>
            <!-- Misi -->
            <div class="my-2 py-2 text-center">
                <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Misi</span>
                <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem neque
                    odio dolore minus
                    temporibus officia optio culpa asperiores dolor adipisci, modi autem ad natus quae, porro cum!
                    Repudiandae, eaque ex?</p>

            </div>
        </div>


    </div>
    @endsection