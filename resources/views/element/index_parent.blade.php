@extends('template.BaseView')
@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Element List {{ $j->name }}</h6>
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
                                <th>Indikator</th>
                                <th>Element</th>
                                <th>Bobot</th>
                            </tr>
                        </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>Indikator.</th>
                                <th>Indikator.</th>
                                <th>Element</th>
                                <th width="150px">Berkas & Ketentuan</th>
                            </tr>
                        </tfoot> -->
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($e as $i)
                            <?php $c_el = count($i->elements_parent);
                            if ($c_el == 0) $c_el = 1;
                            ?>

                            <tr>
                                <td rowspan="{{$c_el}}">
                                    <?= !empty($i->l1->name) ? $i->l1->name : '' ?>
                                    <?= !empty($i->l2->name) ? '<br>' . $i->l2->name : '' ?>
                                    <?= !empty($i->l3->name) ? '<br>' . $i->l3->name : '' ?>
                                    <?= !empty($i->l4->name) ? '<br>' . $i->l4->name : '' ?>
                                </td>
                                <td rowspan="{{$c_el}}"> {{ $i->dec }}</td>
                                <td>
                                    <?= !empty($i->elements_parent[0]->deskripsi) ? $i->elements_parent[0]->deskripsi : '<strong>Belum Ada Element</strong>' ?>
                                </td>
                                <td>
                                    <?= !empty($i->elements_parent[0]->bobot) ? $i->elements_parent[0]->bobot : '<strong>-</strong>' ?>
                                </td>
                            </tr>
                            <?php for ($a = 1; $a < $c_el; $a++) { ?>
                                <tr>
                                    <td>
                                        <?= !empty($i->elements_parent[$a]->deskripsi) ? $i->elements_parent[$a]->deskripsi : '<strong>Belum Ada Element</strong>' ?>
                                    </td>
                                    <td>
                                        <?= !empty($i->elements_parent[$a]->bobot) ? $i->elements_parent[$a]->bobot : '<strong>-</strong>' ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php $no++; ?>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card">
            @if(Auth::user()->role == 'Admin')
            <div class="card-body">
                <h4 class="card-title">Aksi</h4>
                <a href="{{ route('tambah-element-parent', 'jenjang='.$j->id) }}" class="btn btn-primary btn-sm float-right">
                    Tambah Element
                </a>
            </div>
            <hr>
            @endif
            <div class="card-body">
                <h4 class="card-title">Report</h4>
                Element = {{ $count_element }}<br>
            </div>
        </div>
    </div>
</div>
@endsection