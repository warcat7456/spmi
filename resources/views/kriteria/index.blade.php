@extends('template.BaseView')

@section('content')
    <style>
        .hr-lv1,
        .hr-lv2,
        .hr-lv3,
        .hr-lv4 {
            border: 1px solid;
            display: inline-block;
            vertical-align: middle;
        }

        .hr-lv1 {
            width: 1px;
        }

        .hr-lv2 {
            width: 10px;
        }

        .hr-lv3 {
            width: 20px;
        }

        .hr-lv4 {
            width: 30px;
        }

        .parent-row td {
            border-bottom: none !important;
        }

        .parent-row {
            border-bottom: none !important;
        }

        .children {
            border-top: none !important;
        }

        .children td {
            border-top: none !important;
        }

        .codeLevel-2 {
            padding-left: 10px;
        }

        .codeLevel-2::before {
            content: "\2014";
            /* en dash */
        }

        .codeLevel-3 {
            padding-left: 20px;
        }

        .codeLevel-3::before {
            content: "\2014 \2014";
            /* two en dashes */
        }

        .codeLevel-4 {
            padding-left: 10px;
        }

        .codeLevel-4::before {
            content: "\2014 \2014 \2014";
            /* three en dashes */
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kriteria.index') }}" method="GET" id="filterForm">
                        <h4 class="card-title">Filter</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" name="flevel" id="flevel">
                                    <option value="">-- Semua Level --</option>
                                    @foreach (range(1, 4) as $lv)
                                        <option value="{{ $lv }}" {{ $filter['level'] == $lv ? 'selected' : '' }}>
                                            Level {{ $lv }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="flembaga_id" id="flembaga">
                                    <option value="">-- Lembaga --</option>
                                    @foreach ($lembaga as $lembagaItem)
                                        <option value="{{ $lembagaItem->id }}"
                                            {{ $filter['lembaga_id'] == $lembagaItem->id ? 'selected' : '' }}>
                                            {{ $lembagaItem->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="fjenjang_id" id="fjenjang">
                                    <option value="">-- Jenjang --</option>
                                    @foreach ($jenjang as $jen)
                                        <option value="{{ $jen->id }}"
                                            {{ $filter['jenjang_id'] == $jen->id ? 'selected' : '' }}>
                                            {{ $jen->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button id="btnCreate" type="button"
                                    class="btn btn-success float-right d-flex justify-content-between align-items-center"
                                    data-toggle="modal" data-target="#createModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        style="fill:currentColor;" viewBox="0 0 256 256">
                                        <path
                                            d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                                        </path>
                                    </svg>
                                    <span class="ml-1">Tambah Kriteria</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kriteria</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        @if ($kriteria->isNotEmpty())
                            <table class="table table-bordered" id="TKriteria" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Name</th>
                                        <th width="10px">Level</th>
                                        <th width="120px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('kriteria.partials.row', ['kriteria' => $kriteria])
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    @include('kriteria.partials.create-modal')

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize Datatable
                var TKriteria = $('#TKriteria').DataTable({
                    "order": [
                        [0, 'asc']
                    ],
                    paging: false
                });

                // Filtering
                $('#flembaga, #flevel, #fjenjang').on('change', function() {
                    $('#filterForm').submit();
                });
            });
        </script>
    @endpush
@endsection
