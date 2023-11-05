@extends('template.BaseView')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('kriteria/'.$j->kode)}}" id="toolbar" method="GET">
                    <h4 class="card-title">Filter</h4>
                    <div class="row">

                        <div class="col-3">
                            <select class="form-control" id="level" name="level">
                                <option value="">-- Semua Level --</option>
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                                <option value="4">Level 4</option>

                            </select>
                        </div>
                        <div class="col-3">
                            <!-- <h4 class="card-title">Aksi</h4> -->
                            <button type="button" class="btn btn-primary btn-sm float-right" id="CreateNew">
                                Tambah LV 1
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                <th>Lv1</th>
                                <th>Lv2</th>
                                <th>Lv3</th>
                                <th>Lv4</th>
                                <th>Kode</th>
                                <th>Name</th>
                                <th width="10px">Level</th>
                                <th width="120px">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            function renderBtnK($lv, $id, $kode)
                            {
                                return
                                    '
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                ' . ($lv != 4 ? ('<a class="addsub dropdown-item" data-id="' . $id . '" data-lv="' . $lv . '" ><i class="fa fa-plus"></i> Tambah Sub </a>') : '') . '
                                                    <a class="edit dropdown-item" data-id="' . $id . '" data-lv="' . $lv . '" ><i class="fa fa-pencil"></i> Edit </a>
                                                     <a class="delete dropdown-item text-danger" data-id="' . $id . '" data-lv="' . $lv . '" ><i class="fa fa-trash"></i> Hapus </a>
                                                      </div>
                                                </div>
                                               ' . ($lv != 4 ? (' <button data-name="' . $kode . '"  data-curstatus="show" id="headingOne" data-target=".kode-' . str_replace('.', '-', $kode) . '" class="btn-colapsed btn btn-info"><i class="fa fa-eye"></i></button>') : '');
                            }
                            ?>
                            @foreach ($r as $i)
                            <tr>
                                <td>{{ $i['kode'] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $i['kode'] }}</td>
                                <td>{{ $i['s_name'] }}</td>
                                <td>1</td>
                                <td width="150px">
                                    <?= renderBtnK(1, $i['id'], $i['kode']) ?>
                                </td>
                            </tr>
                            @foreach($i['lv2'] as $l2)
                            @if(!empty($l2['id']))
                            <tr class="kode-{{ str_replace('.','-',$i['kode']) }}" class="btn-colapsed" data-parent="">
                                <td>{{ $l2['kode1'] }}</td>
                                <td>{{ $l2['kode'] }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $l2['kode'] }}</td>
                                <td>{{ $l2['s_name'] }}</td>
                                <td>2</td>
                                <td width="150px">
                                    <?= renderBtnK(2, $l2['id'], $l2['kode']) ?>
                                </td>
                            </tr>
                            @endif
                            @foreach($l2['lv3'] as $l3)
                            @if(!empty($l3['id']))
                            <tr class="kode-{{ str_replace('.','-',$i['kode']) }} kode-{{ str_replace('.','-',$l2['kode']) }}" data-parent="">
                                <td>{{ $l3['kode1'] }}</td>
                                <td>{{ $l3['kode2'] }}</td>
                                <td>{{ $l3['kode'] }}</td>
                                <td></td>
                                <td>{{ $l3['kode'] }}</td>
                                <td>{{ $l3['s_name'] }}</td>
                                <td>3</td>
                                <td width="150px">
                                    <?= renderBtnK(3, $l3['id'], $l3['kode']) ?>
                                </td>
                            </tr>
                            @endif
                            @foreach($l3['lv4'] as $l4)
                            @if(!empty($l4['id']))
                            <tr class="kode-{{ str_replace('.','-',$i['kode']? $i['kode'] : '') }} kode-{{ str_replace('.','-',$l2['kode']? $l2['kode'] : '') }} kode-{{ str_replace('.','-', !empty($l3['kode'])? $l3['kode'] : '') }}" data-parent="">
                                <td>{{ $l4['kode1'] }}</td>
                                <td>{{ $l4['kode2'] }}</td>
                                <td>{{ $l4['kode3'] }}</td>
                                <td>{{ $l4['kode'] }}</td>
                                <td>{{ $l4['kode'] }}</td>
                                <td>{{ $l4['s_name'] }}</td>
                                <td>4</td>
                                <td width="150px">
                                    <?= renderBtnK(4, $l4['id'], $l4['kode']) ?>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="modalKritNew" tabindex="-1" role="dialog" style="background : rgba(158, 167, 170, 0.6) !important" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="krit_form_new">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Kriteria LV 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Parent</label>
                        <input type="text" name="parent_name" id="parent_name" class="form-control" placeholder="" readonly aria-describedby="helpId" required>

                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="*contoh : C.1.2. Profil Unit" aria-describedby="helpId" required>
                        <input hidden type="text" name="lv" id="lv" class="form-control" value="">
                        <input hidden type="text" name="id" id="id" class="form-control" value="">
                        <input hidden type="text" name="parent" id="parent" class="form-control" value="">
                        <input hidden type="text" name="jenjang" class="form-control" value="{{ $j->id }}">
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
<div class="modal fade" id="modalKrit" tabindex="-1" role="dialog" style="background : rgba(158, 167, 170, 0.6) !important" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="krit_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Kriteria X</h5>
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
                        <input type="text" name="name" id="name" class="form-control" placeholder="*contoh : C.1.2. Profil Unit" aria-describedby="helpId" required>
                        <input hidden type="text" name="lv" id="lv" class="form-control" value="">
                        <input hidden type="text" name="id" id="id" class="form-control" value="">
                        <input hidden type="text" name="parent" id="parent" class="form-control" value="">
                        <input hidden type="text" name="jenjang" class="form-control" value="{{ $j->id }}">
                        <input hidden type="text" name="url" class="form-control" value="{{ request()->url() }}">
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

        var toolbar = {
            'form': $('#toolbar'),
            'level': $('#toolbar').find('#level'),
        }

        toolbar.level.on('change', function() {
            console.log('ch')
            toolbar.form.submit();
        })

        var ModalKritNew = {
            'self': $('#modalKritNew'),
            'form': $('#modalKritNew').find('#krit_form_new'),
            'id': $('#modalKritNew').find('#id'),
            'name': $('#modalKritNew').find('#name'),
            'parent_name': $('#modalKritNew').find('#parent_name'),
            'kode': $('#modalKritNew').find('#kode'),
            'parent': $('#modalKritNew').find('#parent'),
            'lv': $('#modalKritNew').find('#lv'),
        };


        $('.btn-colapsed')
            .on('click', function() {
                target = $(this).data('target');
                const curstatus = $(this).data('curstatus');
                if (curstatus == 'show') {
                    $(this)
                        .find('.fa-eye')
                        .removeClass("fa-eye")
                        .addClass("fa-eye-slash");
                    $(target).css('display', 'none')
                    $(this).data('curstatus', 'hide');
                } else {
                    $(this)
                        .find('.fa-eye-slash')
                        .removeClass("fa-eye-slash")
                        .addClass("fa-eye");
                    $(target).css('display', '')
                    $(this).data('curstatus', 'show');
                }
            });

        var collapsedGroups = {};
        var TKriteria = $('#TKriteria').DataTable({
            "paging": false,
            "columns": [{
                    "visible": false
                },
                {
                    "visible": false
                },
                {
                    "visible": false
                },
                {
                    "visible": false
                },
                null,
                null,
                null,
                null,
            ],
        });

        $('#CreateNew').on('click', () => {
            console.log('cr');
            ModalKritNew.self.modal('show')
            ModalKritNew.form.trigger('reset');
            ModalKritNew.lv.val('1');
            ModalKritNew.parent.val('');
        })
        TKriteria.on('click', '.addsub', function() {
            var id = $(this).data('id');
            var lv = $(this).data('lv');
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

                    ModalKritNew.self.modal('show')
                    ModalKritNew.form.trigger('reset');
                    ModalKritNew.lv.val(lv + 1);
                    ModalKritNew.parent.val(id);
                    ModalKritNew.parent_name.val(curDat['name']);
                },
                error: function(e) {}
            });


        })
        TKriteria.on('click', '.edit', function() {

            var id = $(this).data('id');
            var lv = $(this).data('lv');
            ModalKrit.form.trigger('reset');

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
                    ModalKrit.self.modal('show')
                    ModalKrit.id.val(curDat['id'])
                    ModalKrit.lv.val(curDat['lv'])
                    ModalKrit.kode.val(curDat['kode1'])
                    ModalKrit.name.val(curDat['name'])
                },
                error: function(e) {}
            });

        });
        ModalKrit.form.on('submit', function(ev) {
            ev.preventDefault();

            Swal.fire(SwalOpt()).then((result) => {
                if (!result.isConfirmed) {
                    return;
                }
                swalLoading();
                $.ajax({
                    url: `<?= url('kriteria/rubah/') ?>`,
                    'type': 'PUT',
                    data: ModalKrit.form.serialize(),
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swalError(json['message'], "Simpan Gagal !!");
                            return;
                        }
                        swalBerhasil();
                        location.reload()
                    },

                    error: function(e) {}
                });
            });

        });
        ModalKritNew.form.on('submit', function(ev) {
            ev.preventDefault();

            Swal.fire(SwalOpt()).then((result) => {
                if (!result.isConfirmed) {
                    return;
                }
                swalLoading();
                $.ajax({
                    url: `<?= url('kriteria/tambahbaru/') ?>`,
                    'type': 'POST',
                    data: ModalKritNew.form.serialize(),
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swalError(json['message'], "Simpan Gagal !!");
                            return;
                        }
                        swalBerhasil();
                        location.reload()
                    },

                    error: function(e) {}
                });
            });

        });
        TKriteria.on('click', '.delete', function() {
            var id = $(this).data('id');
            var lv = $(this).data('lv');

            Swal.fire(SwalOpt('Apakah anda yakin?', 'data akan dihapus!')).then((result) => {
                if (!result.isConfirmed) {
                    return;
                }
                swalLoading();
                $.ajax({
                    url: `<?= url('kriteria/delete/') ?>`,
                    'type': 'DELETE',
                    data: {
                        lv: lv,
                        id: id,
                        _token: '<?= csrf_token() ?>'
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        Swal.close();
                        if (json['error']) {
                            swalError(json['message'], "Hapus Gagal !!");
                            return;
                        }
                        swalBerhasil();
                        location.reload();
                    },
                    error: function(e) {}
                });
            });

        });


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