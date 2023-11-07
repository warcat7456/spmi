@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Buat Element</h4>
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <form action="{{ route('storeparent') }}" method="post" id="form_element" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Jenjang</label>
                                <select class="form-control" name="jenjang_id" id="jen" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Level 1</label>
                                <select class="form-control" name="l1_id" id="l1" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Level 2</label>
                                <select class="form-control" name="l2_id" id="l2">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Level 3</label>
                                <select class="form-control" name="l3_id" id="l3">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Level 4</label>
                                <select class="form-control" name="l4_id" id="l4">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Indikator</label>
                                <select class="form-control" name="ind_id" id="ind" required></select>
                            </div>
                        </div>
                        <div class="col-lg-12" id="divElement">
                            <a class="btn-primary btn-sm" id="btn_add_element"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="form-group">
                            <button class="btn-primary btn-sm" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('dec');
            CKEDITOR.replace('name');
            $('#jen').select2();
            $('#l1').select2();
            $('#l2').select2();
            $('#l3').select2();
            $('#l4').select2();
            $('#ind').select2();

            form_element = $('#form_element');
            divElement = $('#divElement');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            renderDivElement()
            $('#btn_add_element').on('click', () => {
                renderDivElement()
            })

            function renderDivElement(deskripsi = '', bobot = '') {
                div = `
                    <hr>
                    <div class="form-group">
                        <label>Nama Element</label>
                        <textarea type="text" class="form-control" name="deskripsi[]" required>${deskripsi}</textarea>
                        <input type="text" class="form-control" style="width: 100px" name="bobot[]" value="${bobot}" required>
                        <small id="helpId" class="text-muted">Masukan nilai bobot dengan menambahkan titik
                            3.50</small>
                    </div>`;
                divElement.append(div);

            }

            $.ajax({
                type: 'POST',
                url: '<?= route('getJen') ?>',
                cache: false,
                success: function(msg) {
                    $("#jen").html(msg);
                    <?php if (!empty($filter['jenjang_id'])) {
                        echo "$('#jen').val(" . $filter['jenjang_id'] . ").trigger('change');";
                    } ?>
                }
            });

            $("#jen").change(function() {
                var jenjang_id = $("#jen").val();
                $.ajax({
                    type: 'POST',
                    url: '<?= route('l1') ?>',
                    data: 'jenjang_id=' + jenjang_id,
                    cache: false,
                    success: function(msg) {
                        $("#l1").html(msg);
                    }
                });
            });
            $("#l1").change(function() {
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

            $("#jen, #l1, #l2, #l3, #l4").change(function() {
                var jenjang_id = $("#jen").val();
                $.ajax({
                    type: 'POST',
                    url: '<?= route('getInd') ?>',
                    data: form_element.serialize(),
                    cache: false,
                    success: function(msg) {
                        $("#ind").html(msg);
                        // searchIndikator();
                    }
                });
            });

            // function searchIndikator() {

            //     var jen = $('#jen').val();
            //     var pro = $('#pro').val();
            //     var l1 = $('#l1').val();
            //     var l2 = $('#l2').val();
            //     var l3 = $('#l3').val();
            //     var l4 = $('#l4').val();
            //     var ind_id = $("#ind").val();
            //     $.ajax({
            //         type: 'POST',
            //         url: '<?= route('searchIndikator') ?>',
            //         data: {
            //             'jen': jen,
            //             'pro': pro,
            //             'l1': l1,
            //             'l2': l2,
            //             'l3': l3,
            //             'l4': l4,
            //         },
            //         cache: false,
            //         success: function(msg) {
            //             $("#score").html(msg);
            //         }
            //     })
            // };

        });
    </script>
@endsection
