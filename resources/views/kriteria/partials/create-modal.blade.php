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
                <form action="{{ route('kriteria.store') }}" id="formCreate">
                    @method('POST')
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <label for="sLevel">Pilih Level</label>
                            <select class="form-control" name="level" id="sLevel">
                                @foreach (range(1, 4) as $lv)
                                    <option value="{{ $lv }}">Level {{ $lv }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="sjenjang_id">Pilih Jenjang</label>
                            <select class="form-control" name="sjenjang_id" id="sjenjang_id">
                                @foreach ($jenjang as $jen)
                                    <option value="{{ $jen->id }}">{{ $jen->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="sLembaga">Pilih Lembaga</label>
                            <select class="form-control" name="lembaga_id" id="sLembaga">
                                @foreach ($lembaga as $lembagaItem)
                                    <option value="{{ $lembagaItem->id }}">{{ $lembagaItem->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-8 mt-3" id="parentKriteriaContainer" style="display: none;">
                            <label for="sParent">Parent Kriteria</label>
                            <select class="form-control" name="parent_kriteria" id="sParent">
                                <option value="">Select Parent Kriteria</option>
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="sCode">Kode</label>
                            <input type="text" name="code" placeholder="*contoh : C.1." class="form-control"
                                id="sCode">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="btnConfirmCreate" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            // TODO: remove this, Click on initialize for testing
            // $('#btnCreate').click()
            $('#btnConfirmCreate').on('click', function() {
                submitForm();
            });

            async function submitForm() {
                const form = document.getElementById('formCreate');
                const url = form.action;
                const formData = new FormData(form);
                try {
                    const response = await axios.post(url, formData);
                    if (response.data.success) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.data.message
                        });
                        $('#createModal').modal('hide');
                        // Optionally, refresh the page or update the kriteria list
                        // window.location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.data.message
                        });
                    }
                } catch (error) {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        let errorMessage = '<ul class="list-group-flush list-group">';
                        for (const field in errors) {
                            errorMessage +=
                                `<li class="alert-danger alert list-group-item">${errors[field][0]}</li>`;
                        }
                        errorMessage += '</ul>';

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: errorMessage
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again.'
                        });
                    }
                }
            }


            function updateParentKriteria() {
                const level = $('#sLevel').val();
                const jenjangId = $('#sjenjang_id').val();
                const lembagaId = $('#sLembaga').val();

                if (parseInt(level) > 1) {
                    $('#parentKriteriaContainer').show();
                    fetchParentKriteria(level, jenjangId, lembagaId);
                } else {
                    $('#parentKriteriaContainer').hide();
                }
            }

            async function fetchParentKriteria(level, jenjangId, lembagaId) {
                try {
                    const response = await axios.post('{{ route('kriteria.parent') }}', {
                        flevel: parseInt(level) - 1,
                        fjenjang_id: jenjangId,
                        flembaga_id: lembagaId
                    });

                    const {
                        kriteria
                    } = response.data;
                    populateParentKriteria(kriteria);
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to fetch data',
                        text: 'Please try again',
                        footer: 'Server Error!'
                    });
                }
            }

            function populateParentKriteria(kriteria) {
                const $select = $('#sParent');
                $select.empty();
                $select.append('<option value="">Select Parent Kriteria</option>');

                kriteria.forEach(item => {
                    $select.append(
                        `<option value="${item.id}">${item.kode} - ${item.name}</option>`);
                });
            }

            $('#sLevel, #sjenjang_id, #sLembaga').on('change', updateParentKriteria);

            // Initial update
            updateParentKriteria();

        })
    </script>
@endpush
