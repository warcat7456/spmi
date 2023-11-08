@extends('template.BaseView')
@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Indikator {{ $j->name }}</h6>
            </div>
            <div class="card-body">
                @if (session()->has('pesan'))
                {!! session()->get('pesan') !!}
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Name</th>
                                <th width="150px">Score</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Kriteria</th>
                                <th>Name</th>
                                <th width="150px">Score</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($d as $i)
                            <tr>
                                <td>

                                    <?= !empty($i->l1->name) ? $i->l1->name : '' ?>
                                    <?= !empty($i->l2->name) ? '<br>' . $i->l2->name : '' ?>
                                    <?= !empty($i->l3->name) ? '<br>' . $i->l3->name : '' ?>
                                    <?= !empty($i->l4->name) ? '<br>' . $i->l4->name : '' ?>
                                </td>
                                <td>{!! $i->dec !!}</td>
                                <td width="150px">
                                    <a href="{{ url('indikator/input-score') . '/' . $i->id }}" class="btn btn-info btn-sm">
                                        Input Score
                                    </a>
                                    <hr>
                                    <a href="{{ url('indikator/cek-score') . '/' . $i->id }}" class="btn btn-primary btn-sm">Cek
                                        Score</a>
                                </td>
                                <td width="150px">
                                    <a href="{{ url('indikator/edit/' . $i->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <hr>
                                    <a href="{{ url('indikator/konfirmasi/' . $i->id) }}" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Aksi</h4>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modelTambah">
                    Tambah Indikator
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/indikator/store" method="post" id="form_indikator">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Indikator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Level 1</label>
                        <select class="form-control" name="l1_id" id="l1" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Level 2</label>
                        <select class="form-control" name="l2_id" id="l2">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Level 3</label>
                        <select class="form-control" name="l3_id" id="l3">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Level 4</label>
                        <select class="form-control" name="l4_id" id="l4">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Indikator</label>
                        <textarea id="dec" name="dec" id="dec" class="form-control"></textarea>
                        <input type="text" name="jenjang" hidden class="form-control" value="{{ $j->id }}" required>
                        <input type="text" name="url" hidden class="form-control" value="{{ request()->url() }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        start_search()

        var indikator = {
            'form': $('#form_indikator'),
            'l1': $('#form_indikator').find('#l1'),
            'l2': $('#form_indikator').find('#l2'),
            'l3': $('#form_indikator').find('#l3'),
            'l4': $('#form_indikator').find('#l4'),
            'dec': $('#form_indikator').find('#dec'),
        }

        function start_search() {
            $.ajax({
                type: 'POST',
                url: '<?= route('l1') ?>',
                data: 'jenjang_id=<?= $j->id ?>',
                cache: false,
                success: function(msg) {
                    $("#l1").html(msg);
                }
            });
        }

        indikator.l1.change(function() {
            var l1_id = $("#l1").val();
            $.ajax({
                type: 'POST',
                url: '<?= route('l2') ?>',
                data: 'l1_id=' + l1_id,
                cache: false,
                success: function(msg) {
                    $("#l2").html(msg);
                }
            });
        });

        $("#l2").change(function() {
            var l2_id = $("#l2").val();
            $.ajax({
                type: 'POST',
                url: '<?= route('l3') ?>',
                data: 'l2_id=' + l2_id,
                cache: false,
                success: function(msg) {
                    $("#l3").html(msg);
                }
            });
        });

        $("#l3").change(function() {
            var l3_id = $("#l3").val();
            $.ajax({
                type: 'POST',
                url: '<?= route('l4') ?>',
                data: 'l3_id=' + l3_id,
                cache: false,
                success: function(msg) {
                    $("#l4").html(msg);
                }
            });
        });

    });
</script>
@endsection