<!-- Modal Tambah Kriteria -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Tambah Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="slevel">Pilih Level</label>
                            <select class="form-control" name="slevel" id="slevel">
                                @foreach (range(1, 4) as $lv)
                                    <option value="{{ $lv }}">
                                        Level {{ $lv }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jenjang_id">Pilih Jenjang</label>
                            <select class="form-control" name="sjenjang_id" id="sjenjang_id">
                                @foreach ($jenjang as $jen)
                                    <option value="{{ $jen->id }}">
                                        {{ $jen->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jenjang_id">Pilih Lembaga</label>
                            <select class="form-control" name="flembaga_id" id="lembagaFilter">
                                @foreach ($lembaga as $lembagaItem)
                                    <option value="{{ $lembagaItem->id }}">
                                        {{ $lembagaItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="code">Kode</label>
                            <input type="text" name="code" class="form-control " id="code">
                        </div>
                        <div class="col-md-8 mt-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control " id="name">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
