@extends('template.BaseView')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="row">
    <div class="col">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kriteria {{ $j->name }}</h6>
            </div>
            <div class="card-body">
                @if (session()->has('pesan'))
                {!! session()->get('pesan') !!}
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="TKriteria" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Lv</th>
                                <th>Lv1</th>
                                <th>Lv2</th>
                                <th>Lv3</th>
                                <th>Lv4</th>
                                <th>Kode</th>
                                <th>Name</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>

                        <!-- <tbody>
                            @foreach ($r as $i)
                            <tr>
                                <td>1</td>
                                <td>{{ $i['kode1'] }}</td>
                                <td>{{ $i['s_name'] }}</td>
                                <td width="150px">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modelEdit{{ $i['id'] }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelHapus{{  $i['id'] }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @foreach($i['lv2'] as $l2)
                            <tr>
                                <td>2</td>
                                <td>{{ $l2['kode2'] }}</td>
                                <td>{{ $i['s_name'] }}</td>
                                <td width="150px">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modelEdit{{ $i['id'] }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelHapus{{  $i['id'] }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody> -->
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
                    Tambah Kriteria
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/kriteria/store" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Butir Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="kode" class="form-control" placeholder="*contoh : C.1.2. " aria-describedby="helpId" required>
                        <input type="text" name="name" class="form-control" placeholder="*contoh : Profil Unit" aria-describedby="helpId" required>
                        <input type="text" name="jenjang" class="form-control" value="{{ $j->id }}" required>
                        <input type="text" name="url" class="form-control" value="{{ request()->url() }}" required>
                        <small id="helpId" class="text-muted">Nama
                            kode harus di akhiri dengan tanda titik (.) contoh : C.1.3<strong>.</strong>
                        </small>
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

<!-- Modal -->
<div class="modal fade" id="modalKrit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/kriteria/store" method="post" id="krit_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <!-- <label for="parent">Sub level</label> -->
                        <!-- <select class="form-control" style="width : 100%" name="parent" id="parent" multiple="multiple">
                        </select> -->
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>

                        <!-- <input type="text" name="kode" id="kode" class="form-control" placeholder="*contoh :  " aria-describedby="helpId" required> -->
                        <input type="text" name="name" id="name" class="form-control" placeholder="*contoh : C.1.2. Profil Unit" aria-describedby="helpId" required>
                        <input type="text" name="lv" id="lv" class="form-control" value="" required>
                        <input type="text" name="parent" id="parent" class="form-control" value="parent">
                        <input type="text" name="jenjang" class="form-control" value="{{ $j->id }}">
                        <input type="text" name="url" class="form-control" value="{{ request()->url() }}">
                        <small id="helpId" class="text-muted">Nama
                            kode harus di akhiri dengan tanda titik (.) contoh : C.1.3<strong>.</strong>
                        </small>
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

<script>
    $(document).ready(function() {

        // $('#parent').select2();
        var ModalKrit = {
            'self': $('#modalKrit'),
            'form': $('#modalKrit').find('#krit_form'),
            'id': $('#modalKrit').find('#id'),
            'name': $('#modalKrit').find('#name'),
            'kode': $('#modalKrit').find('#kode'),
            'parent': $('#modalKrit').find('#parent'),
            'lv': $('#modalKrit').find('#lv'),
        };

        var collapsedGroups = {};
        var TKriteria = $('#TKriteria').DataTable({
            // order: [
            //     [1, 'asc']
            // ],
            // "columns": [{
            //         "visible": false
            //     },
            //     null,
            //     null,
            //     null,
            // ],
            "ordering": false,
            rowGroup: {
                // Uses the 'row group' plugin
                dataSrc: 1,
                startRender: function(rows, group) {
                    var collapsed = !!collapsedGroups[group];

                    rows.nodes().each(function(r) {
                        r.style.display = collapsed ? 'none' : '';
                    });

                    // Add category name to the <tr>. NOTE: Hardcoded colspan
                    return $('<tr/>')
                        .append('<td colspan="8">' + group + ' (' + rows.count() + ')</td>')
                        .attr('data-name', group)
                        .toggleClass('collapsed', collapsed);
                }
            }
        });
        TKriteria.on('click', 'tr.group-start', function() {
            var name = $(this).data('name');
            collapsedGroups[name] = !collapsedGroups[name];
            TKriteria.draw(false);
        });
        var dataKriteria = <?= json_encode($r) ?>;
        console.log(dataKriteria);
        renderKriteria(dataKriteria)

        function renderBtnK(lv, id) {
            return `
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="edit dropdown-item" data-id="${id}" data-lv="${lv}" ><i class="mdi mdi-pencil-outline"></i> Edit </a>
                             <a class="delete dropdown-item text-danger" data-id="${id}" data-lv="${lv}" ><i class="mdi mdi-trash-can-outline"></i> Hapus </a>
                             </div>
                        </div>`;
        }

        function renderKriteria(data) {
            if (data == null || typeof data != "object") {
                console.log("User::UNKNOWN DATA");
                return;
            }
            // var i = 0;


            var renderData = [];
            Object.values(data).forEach((d) => {
                var button = renderBtnK(1, d['id'])
                renderData.push([
                    '1', d['kode1'], '', '', '', '',
                    d['s_name'], button
                ]);

                Object.values(d['lv2']).forEach((l2) => {
                    var button = renderBtnK(2, l2['id'])
                    renderData.push([
                        '2', l2['kode1'], l2['kode2'], '', '', l2['kode2'], l2['s_name'], button
                    ]);

                    Object.values(l2['lv3']).forEach((l3) => {
                        var button = renderBtnK(3, d['id'])
                        renderData.push([
                            '3', l3['kode3'], l3['s_name'], button
                        ]);
                        Object.values(l3['lv4']).forEach((l4) => {
                            var button = renderBtnK(4, d['id'])
                            renderData.push([
                                '4', l4['kode4'], l4['s_name'], button
                            ]);
                        });
                    });
                });
            });

            TKriteria.clear().rows.add(renderData).draw('full-hold');
        }
        TKriteria.on('click', '.edit', function() {

            var id = $(this).data('id');
            var lv = $(this).data('lv');

            console.log(id)
            console.log(lv)

            swalLoading();
            $.ajax({
                url: `<?= url('search-kriteria') ?>/${lv}/${id}`,
                'type': 'GET',
                data: {},
                success: function(data) {
                    var json = JSON.parse(data);
                    Swal.close();
                    if (json['error']) {
                        swalError(json['message'], "Simpan Gagal !!");
                        return;
                    }
                    var curDat = json['data'];
                    console.log(curDat)
                    // var user = json['data']
                    // dataDusun[user['id']] = user;
                    ModalKrit.self.modal('show')
                    ModalKrit.id.val(curDat['id'])
                    ModalKrit.lv.val(curDat['lv'])
                    ModalKrit.kode.val(curDat['kode1'])
                    ModalKrit.name.val(curDat['name'])
                    // if (curDat['lv'] == 1) {
                    //     ModalKrit.parent.val('');
                    // }
                },
                error: function(e) {}
            });

        });

        // $("#parent").change(function() {
        //     var l1_id = $("#l1").val();
        //     $.ajax({
        //         type: 'POST',
        //         url: '<?= route('l2') ?>',
        //         data: 'l1_id=' + l1_id,
        //         cache: false,
        //         success: function(msg) {
        //             $("#l2").html(msg);
        //         }
        //     });
        // });

        function swalLoading() {
            Swal.fire({
                title: 'Loading!',
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light d-none'
                },
                buttonsStyling: false
            });
            Swal.showLoading();
        }

        function swalBerhasil(label = 'Berhasil !!', btn = true) {
            btnclass = btn ? '' : 'd-none';
            Swal.fire({
                title: label,
                icon: 'success',
                showClass: {
                    popup: 'animate__animated animate__flipInX'
                },
                allowOutsideClick: false,
                customClass: {
                    confirmButton: `btn btn-primary waves-effect waves-light ${btnclass}`
                },
                buttonsStyling: false
            });
        }

        function swalError(message = '', label = 'Gagal !!', btn = true) {
            Swal.fire({
                title: label,
                icon: 'error',
                text: message,
                showClass: {
                    popup: 'animate__animated animate__flipInX'
                },
                allowOutsideClick: true,
                customClass: {
                    confirmButton: `btn btn-primary waves-effect waves-light`
                },
                buttonsStyling: false
            });
        }

        function SwalOpt(title = 'Apakah anda yakin ?', text = 'Data akan disimpan!', icon = 'warning') {
            return {
                title: title,
                icon: icon,
                text: text,
                allowOutsideClick: false,

                showCancelButton: true,
                confirmButtonText: 'Ya !!',
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-outline-danger waves-effect'
                }
            };
        }

    })
</script>


@endsection