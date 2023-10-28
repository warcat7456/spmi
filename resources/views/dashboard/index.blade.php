@extends('template.BaseView')

@section('styles')
@endsection

@section('content')
    <div class="bg-white py-3 px-4">
        @if (!empty(auth()->user()->role == 'Admin'))
            <div class="row row-cols-1 row-cols-md-2">
                @foreach ($p as $prodi)
                    <div class="col mb-4">
                        <div class="card">
                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $prodi->name }}</h5>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <h1 class=" font-weight-bold text-info">
                        <u>Fakultas
                            {{ !empty(auth()->user()->prodi->fakultas->nama) ? auth()->user()->prodi->fakultas->nama : '' }}</u>
                    </h1>
                    <span class="border border-info py-2 px-2 rounded my-1 d-inline-block">Profil</span>
                    <div class="my-3">
                        {!! !empty(auth()->user()->prodi->fakultas->deskripsi) ? auth()->user()->prodi->fakultas->deskripsi : '' !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Foto -->
                    <!-- TODO:Gunakan css Card -->
                    <div style="min-width: 300px;min-height:300px"
                        class="bg-info align-items-center justify-content-center d-flex rounded">
                        <p class="text-white">Foto Fakultas</p>
                    </div>
                    <!-- Visi -->
                    <div class="my-2 py-2 text-center">
                        <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Visi</span>
                        <div class="my-3">
                            {!! !empty(auth()->user()->prodi->fakultas->visi) ? auth()->user()->prodi->fakultas->visi : '' !!}
                        </div>
                    </div>
                    <!-- Misi -->
                    <div class="my-2 py-2 text-center">
                        <span class="border border-info py-2 px-4 rounded my-1 d-inline-block mx-auto">Misi</span>
                        <div class="my-3">
                            {!! !empty(auth()->user()->prodi->fakultas->misi) ? auth()->user()->prodi->fakultas->misi : '' !!}
                        </div>

                    </div>
                </div>


            </div>
        @endif
    @endsection
