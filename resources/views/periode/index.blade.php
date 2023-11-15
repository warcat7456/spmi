@extends('template.BaseView')
@section('content')
<div class="row">
    <div class="col">
        <div class="card  mb-2">
            <div class="card-body mr-auto" id="toolbar_form">
                <button type="button" class="btn btn-primary btn-sm float-right d-block w-100" id="addPeriode" disabled>
                    <i class="fa fa-plus"></i> Tambah Periode
                </button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Periode</h6>
            </div>
            <div class="card-body">
                @if (session()->has('pesan'))
                {!! session()->get('pesan') !!}
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="FDataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Prode</th>
                                <th>Prodi</th>
                                <th>Auditor</th>
                                <th>Revisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modal_periode" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_periode">
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
                        <label>Name</label>
                        <input class="form-control" type="hidden" id="id_periode" name="id" />
                        <input class="form-control" id="name" name="name" />
                    </div>

                    <div class="form-group">
                        <label>Periode</label>
                        <div class="input-group input-daterange">
                            <input type="date" class="form-control" id="periode_start" name="periode_start">
                            <div class="input-group-append">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="date" class="form-control" id="periode_end" name="periode_end">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Periode pengisian data oleh Prodi</label>
                        <div class="input-group input-daterange">
                            <input type="date" class="form-control" id="prodi_start" name="prodi_start">
                            <div class="input-group-append">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="date" class="form-control" id="prodi_end" name="prodi_end">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Periode penilaian oleh Auditor</label>
                        <div class="input-group input-daterange">
                            <input type="date" class="form-control" id="auditor_start" name="auditor_start">
                            <div class="input-group-append">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="date" class="form-control" id="auditor_end" name="auditor_end">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Periode Revisi</label>
                        <div class="input-group input-daterange">
                            <input type="date" class="form-control" id="revisi_start" name="revisi_start">
                            <div class="input-group-append">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="date" class="form-control" id="revisi_end" name="revisi_end">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addBtn" data-action="add">Tambah</button>
                        <button type="submit" class="btn btn-primary" id="editBtn" data-action="edit">Simpan Perubahan</button>
                    </div>
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

        var toolbar = {
            'form': $('#toolbar_form'),
            'addPeriode': $('#toolbar_form').find('#addPeriode'),
        }

        var FDataTable = $('#FDataTable').DataTable({
            // 'columnDefs': [],
            // responsive: true,
            // deferRender: true,
            // "order": [
            //     [0, "desc"]
            // ]
        });

        var dataD = [];
        var addPeriode = $('#addPeriode');
        var ModalPeriode = {
            'self': $('#modal_periode'),
            'form': $('#modal_periode').find('#form_periode'),
            'addBtn': $('#modal_periode').find('#addBtn'),
            'editBtn': $('#modal_periode').find('#editBtn'),
            'idPeriode': $('#modal_periode').find('#id_periode'),
            'name': $('#modal_periode').find('#name'),
            'periode_start': $('#modal_periode').find('#periode_start'),
            'periode_end': $('#modal_periode').find('#periode_end'),
            'prodi_start': $('#modal_periode').find('#prodi_start'),
            'prodi_end': $('#modal_periode').find('#prodi_end'),
            'auditor_start': $('#modal_periode').find('#auditor_start'),
            'auditor_end': $('#modal_periode').find('#auditor_end'),
            'revisi_start': $('#modal_periode').find('#revisi_start'),
            'revisi_end': $('#modal_periode').find('#revisi_end'),
            'dec': $('#modal_periode').find('#dec'),
            'bobot': $('#modal_periode').find('#bobot'),
        }


        $.when(getAllPeriode()).then((e) => {
            toolbar.addPeriode.prop('disabled', false);
        }).fail((e) => {
            console.log(e)
        });

        function getAllPeriode() {
            swalLoading();
            return $.ajax({
                url: `<?= url('periode/getData/') ?>`,
                'type': 'get',
                data: toolbar.form.serialize(),
                success: function(data) {
                    Swal.close();
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataD = json['data'];
                    renderDataTable(dataD);
                },
                error: function(e) {}
            });
        }

        function renderDataTable(data) {
            if (data == null || typeof data != "object") {
                console.log("User::UNKNOWN DATA");
                return;
            }
            var i = 0;

            var renderData = [];
            Object.values(data).forEach((d) => {
                var button = `
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="edit dropdown-item" data-id="${d['id']}" ><i class="fa fa-pencil"></i> Edit </a>
                                <a class="delete dropdown-item text-danger" data-id="${d['id']}" ><i class="fa fa-trash"></i> Hapus </a>
                        </div>
                    </div>   `;
                renderData.push([d['id'], d['name'],
                    d['periode_start'] + ' s/d ' + d['periode_end'],
                    d['prodi_start'] + ' s/d ' + d['prodi_end'],
                    d['auditor_start'] + ' s/d ' + d['auditor_end'],
                    d['revisi_start'] + ' s/d ' + d['revisi_end'],
                    button
                ]);
            });
            FDataTable.clear().rows.add(renderData).draw('full-hold');
        }

        toolbar.addPeriode.on('click', () => {
            ModalPeriode.self.modal('show');
            ModalPeriode.editBtn.hide();
            ModalPeriode.addBtn.show();
            ModalPeriode.form.trigger('reset');


        })

        FDataTable.on('click', '.edit', function() {
            var id = $(this).data('id');
            var curData = dataD[id];
            console.log(curData);
            ModalPeriode.addBtn.hide();
            ModalPeriode.editBtn.show();

            ModalPeriode.form.trigger('reset');

            ModalPeriode.self.modal('show');
            ModalPeriode.idPeriode.val(curData['id']);
            ModalPeriode.name.val(curData['name']);
            ModalPeriode.periode_start.val(curData['periode_start']);
            ModalPeriode.periode_end.val(curData['periode_end']);
            ModalPeriode.prodi_start.val(curData['prodi_start']);
            ModalPeriode.prodi_end.val(curData['prodi_end']);
            ModalPeriode.auditor_start.val(curData['auditor_start']);
            ModalPeriode.auditor_end.val(curData['auditor_end']);
            ModalPeriode.revisi_start.val(curData['revisi_start']);
            ModalPeriode.revisi_end.val(curData['revisi_end']);
        });
        ModalPeriode.addBtn.on('click', () => {
            submit_form('<?= url('periode/store') ?>', 'POST');
        });

        ModalPeriode.editBtn.on('click', () => {
            submit_form('<?= url('periode/put') ?>', 'PUT');
        });

        function submit_form(url, metode) {

            ModalPeriode.form.submit(function(event) {
                event.preventDefault();
                var target = $(this).data('target');
                console.log(target)
                Swal.fire(SwalOpt()).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    swalLoading();
                    $.ajax({
                        url: url,
                        'type': metode,
                        data: ModalPeriode.form.serialize(),
                        success: function(data) {
                            var json = JSON.parse(data);
                            if (json['error']) {
                                swalError(json['message'], "Simpan Gagal !!");
                                return;
                            }
                            var d = json['data']
                            dataD[d['id']] = d;
                            swalBerhasil();
                            renderDataTable(dataD);
                            ModalPeriode.self.modal('hide');

                            // DusunForm.self.modal('hide');
                        },
                        error: function(e) {}
                    });
                });
            });
        }

        FDataTable.on('click', '.delete', function() {
            event.preventDefault();
            var id = $(this).data('id');
            Swal.fire(SwalOpt('Konfirmasi hapus ?', 'Data ini akan dihapus!', )).then((result) => {
                if (!result.isConfirmed) {
                    return;
                }
                $.ajax({
                    url: "<?= url('periode/delete') ?>",
                    'type': 'DELETE',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            Swal.fire("Delete Gagal", json['message'], "error");
                            return;
                        }
                        delete dataD[id];
                        Swal.fire("Delete Berhasil", "", "success");
                        renderDataTable(dataD);
                    },
                    error: function(e) {}
                });
            });
        });

    });
</script>
@endsection