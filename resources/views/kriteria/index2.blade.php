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

        /* .codeLevel-1 {
                                                        padding-left: 20px;
                                                    } */
        /* .codeLevel-1::before {
                                    content: "\25B2";
                                    padding-right: 10px;
                                } */

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
                    <form action="{{ route('kriteria2') }}" method="GET" id="filterForm">
                        <h4 class="card-title">Filter</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" name="level" id="level">
                                    <option value="">-- Semua Level --</option>
                                    @foreach (range(1, 4) as $lv)
                                        <option value="{{ $lv }}"
                                            {{ (request('level') || $filter['level']) == $lv ? 'selected' : '' }}>
                                            Level {{ $lv }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="lembaga_id" id="lembagaFilter">
                                    <option value="">-- Lembaga --</option>
                                    @foreach ($lembaga as $lembagaItem)
                                        <option value="{{ $lembagaItem->id }}"
                                            {{ (request('lembaga_id') || $filter['lembaga_id']) == $lembagaItem->id ? 'selected' : '' }}>
                                            {{ $lembagaItem->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                {{-- Uncommented jenjang filter
                                <select class="form-control" name="jenjang" id="jenjang">
                                    <option value="">-- Jenjang --</option>
                                    @foreach ($jenjang as $jen)
                                        <option value="{{ $jen->id }}" {{ request('jenjang') == $jen->id ? 'selected' : '' }}>
                                            {{ $jen->name }}
                                        </option>
                                    @endforeach
                                </select>
                                --}}
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-sm float-right" id="CreateNew">
                                    Tambah LV 1
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
                $('#lembagaFilter, #level, #jenjang').on('change', function() {
                    $('#filterForm').submit();
                });

                // CreateNew button click handler
                $('#CreateNew').on('click', function() {
                    // Add your logic for creating a new LV 1 item
                    alert('Create new LV 1 item');
                });
            });
        </script>
    @endpush
@endsection
