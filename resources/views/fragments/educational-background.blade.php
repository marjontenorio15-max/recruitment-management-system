<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="text-muted small">
        <i class="bi bi-info-circle me-1"></i> Add your educational history starting from the highest degree attained.
    </div>
    <button class="btnAddEB btn btn-dark rounded-pill px-3 py-1.5 small fw-semibold shadow-sm d-inline-flex align-items-center gap-1.5">
        <i class="bi bi-plus-lg"></i>
        <span>Add Education</span>
    </button>
</div>

<div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-3">
    <table class="tblEB table align-middle mb-0 text-sm">
        <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
            <tr>
                <th scope="col" class="py-3 px-3">#</th>
                <th scope="col" class="py-3 px-3">School Name</th>
                <th scope="col" class="py-3 px-3">School Location</th>
                <th scope="col" class="py-3 px-3">Degree</th>
                <th scope="col" class="py-3 px-3">Field of Study</th>
                <th scope="col" class="py-3 px-3">Graduation</th>
                <th scope="col" class="py-3 px-3 text-end">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <tr>
                <td colspan="7" class="text-center py-4 text-muted small">Loading records...</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="mdlAddEB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ebModalLabel" aria-hidden="true">
    <form class="frmSaveEB" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-3xl border-0 shadow-lg overflow-hidden">
                <div class="modal-header bg-slate-900 text-white px-4 py-3 border-0">
                    <h5 class="modal-title fs-6 fw-bold text-white mb-0" id="ebModalLabel">
                        <i class="bi bi-mortarboard me-2"></i>Educational Background
                    </h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-slate-50">
                    <input type="hidden" name="eb_id">

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="school_name">School Name *</label>
                                <input type="text" name="school_name" id="school_name" class="form-control rounded-xl text-sm" placeholder="e.g. University of the Philippines" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="school_location">School Location *</label>
                                <input type="text" name="school_location" id="school_location" class="form-control rounded-xl text-sm" placeholder="e.g. Quezon City, Metro Manila" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="degree">Degree *</label>
                                <select class="form-select rounded-xl text-sm" name="degree" id="degree" required>
                                    <option value="Elementary Diploma">Elementary Diploma</option>
                                    <option value="High School Diploma">High School Diploma</option>
                                    <option value="GED">GED</option>
                                    <option value="Associate of Arts">Associate of Arts</option>
                                    <option value="Associate of Science">Associate of Science</option>
                                    <option value="Associate of Applied Science">Associate of Applied Science</option>
                                    <option value="Bachelor of Arts">Bachelor of Arts</option>
                                    <option value="Bachelor of Science">Bachelor of Science</option>
                                    <option value="BBA">BBA</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Doctorate Degree">Doctorate Degree</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="field_of_study">Field of Study / Major *</label>
                                <input type="text" name="field_of_study" id="field_of_study" class="form-control rounded-xl text-sm" placeholder="e.g. Information Technology" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="month_graduate">Month Graduated *</label>
                                <input type="text" name="month_graduate" id="month_graduate" class="form-control rounded-xl text-sm" placeholder="e.g. March / June" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="year_graduate">Year Graduated *</label>
                                <input type="number" name="year_graduate" id="year_graduate" class="form-control rounded-xl text-sm" placeholder="e.g. 2023" min="1950" max="2099" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white px-4 py-3 border-top border-slate-100">
                    <button type="button" class="btn btn-light rounded-pill px-4 small fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 small fw-semibold shadow-sm">Save Record</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="mdlDeleteEB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteEbLabel" aria-hidden="true">
    <form class="frmDeleteEB" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content rounded-3xl border-0 shadow-lg overflow-hidden">
                <div class="modal-body p-4 text-center">
                    <input type="hidden" name="eb_id">
                    <div class="rounded-circle bg-rose-50 text-rose-600 d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                        <i class="bi bi-trash3 fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark fs-6 mb-1">Delete Education Record</h5>
                    <p class="text-muted small mb-0">Are you sure you want to delete this educational record? This action cannot be undone.</p>
                </div>
                <div class="modal-footer bg-slate-50 px-4 py-3 border-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-3 small fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-3 small fw-semibold shadow-sm">Confirm Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    GetEB();

    $('.btnAddEB').click(function(){
        $('.frmSaveEB')[0].reset();
        $('.frmSaveEB input[name="eb_id"]').val('');
        $('#mdlAddEB').modal('show');
    });

    $('.frmSaveEB').submit(function(e){
      e.preventDefault();
      SaveEB();
    });

    $(document).on('click', '.btnEditEB', function(){
        var ebId = $(this).attr('eb-id');
        $('.frmSaveEB')[0].reset();
        GetEBById(ebId);
    });

    $(document).on('click', '.btnDeleteEB', function(){
        var ebId = $(this).attr('eb-id');
        $('.frmDeleteEB input[name="eb_id"]').val(ebId);
        $('#mdlDeleteEB').modal('show');
    });

    $('.frmDeleteEB').submit(function(e){
      e.preventDefault();
      DeleteEB();
    });

    function GetEB() {
        $.ajax({
            url: "{{ url('/getEB') }}",
            data: null,
            beforeSend: function() {
                var html ='<tr><td colspan="7" class="text-center py-4 text-muted small">Loading records...</td></tr>';
                $('.tblEB tbody').html(html);
            },
            success: function(result){
                var html = '';
                if(result && result.data && result.data.length > 0) {
                    for (var index = 0; index < result.data.length; index++) {
                      html += '<tr class="hover:bg-slate-50/80 transition-colors">';
                         html += '<td class="py-3 px-3 fw-bold text-slate-700">' + (index + 1) + '</td>';
                         html += '<td class="py-3 px-3 fw-semibold text-slate-900">' + (result.data[index].school_name || '') + '</td>';
                         html += '<td class="py-3 px-3 text-slate-500">' + (result.data[index].school_location || '') + '</td>';
                         html += '<td class="py-3 px-3"><span class="badge bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-pill px-2.5 py-1 text-xs">' + (result.data[index].degree || '') + '</span></td>';
                         html += '<td class="py-3 px-3 text-slate-700">' + (result.data[index].field_of_study || '') + '</td>';
                         html += '<td class="py-3 px-3 text-slate-500 text-xs">' + (result.data[index].month_graduate || '') + ' ' + (result.data[index].year_graduate || '') + '</td>';
                         html += '<td class="py-3 px-3 text-end">';
                         html += '<div class="btn-group btn-group-sm rounded-xl overflow-hidden border border-slate-200 shadow-sm">';
                             html += '<button type="button" class="btnEditEB btn btn-light text-slate-700 hover:bg-slate-100" eb-id="' + result.data[index].id + '" title="Edit"><i class="bi bi-pencil"></i></button>';
                             html += '<button type="button" class="btnDeleteEB btn btn-light text-rose-600 hover:bg-rose-50" eb-id="' + result.data[index].id + '" title="Delete"><i class="bi bi-trash3"></i></button>';
                         html += '</div>';
                         html += '</td>';
                      html += '</tr>';
                    }
                }
                else {
                    html ='<tr><td colspan="7" class="text-center py-4 text-muted small">No educational background records added yet.</td></tr>';
                }

                $('.tblEB tbody').html(html);
            }
        });
    }

    function GetEBById(id) {
        $.ajax({
            url: "{{ url('/getEBById') }}",
            data: {
                id: id,
            },
            beforeSend: function() {

            },
            success: function(result){
                if(result && result.data) {
                    $('.frmSaveEB input[name="eb_id"]').val(result.data.id);
                    $('.frmSaveEB input[name="school_name"]').val(result.data.school_name);
                    $('.frmSaveEB input[name="school_location"]').val(result.data.school_location);
                    $('.frmSaveEB select[name="degree"]').val(result.data.degree);
                    $('.frmSaveEB input[name="field_of_study"]').val(result.data.field_of_study);
                    $('.frmSaveEB input[name="month_graduate"]').val(result.data.month_graduate);
                    $('.frmSaveEB input[name="year_graduate"]').val(result.data.year_graduate);
                    $('#mdlAddEB').modal('show');
                }
            }
        });
    }

    function SaveEB() {
        $.ajax({
            url: "{{ url('/saveEB') }}",
            data: $('.frmSaveEB').serialize(),
            method: 'post',
            beforeSend: function() {

            },
            success: function(result){
                GetEB();
                $('#mdlAddEB').modal('hide');
                $('.frmSaveEB')[0].reset();
            }
        })
    }

    function DeleteEB() {
        $.ajax({
            url: "{{ url('/deleteEB') }}",
            data: $('.frmDeleteEB').serialize(),
            method: 'post',
            beforeSend: function() {

            },
            success: function(result){
                GetEB();
                $('#mdlDeleteEB').modal('hide');
                $('.frmDeleteEB')[0].reset();
            }
        })
    }

  });
</script>