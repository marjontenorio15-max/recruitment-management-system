<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="text-muted small">
        <i class="bi bi-info-circle me-1"></i> Add your previous employment history, key responsibilities, and certificates.
    </div>
    <button class="btnAddWE btn btn-dark rounded-pill px-3 py-1.5 small fw-semibold shadow-sm d-inline-flex align-items-center gap-1.5">
        <i class="bi bi-plus-lg"></i>
        <span>Add Work Experience</span>
    </button>
</div>

<div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-3">
    <table class="tblWE table align-middle mb-0 text-sm">
        <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
            <tr>
                <th scope="col" class="py-3 px-3">#</th>
                <th scope="col" class="py-3 px-3">Job Title</th>
                <th scope="col" class="py-3 px-3">Company Name</th>
                <th scope="col" class="py-3 px-3">Duration</th>
                <th scope="col" class="py-3 px-3">Responsibilities & Achievements</th>
                <th scope="col" class="py-3 px-3">Certificate</th>
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
<div class="modal fade" id="mdlAddWE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="weModalLabel" aria-hidden="true">
    <form class="frmSaveWE" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-3xl border-0 shadow-lg overflow-hidden">
                <div class="modal-header bg-slate-900 text-white px-4 py-3 border-0">
                    <h5 class="modal-title fs-6 fw-bold text-white mb-0" id="weModalLabel">
                        <i class="bi bi-briefcase me-2"></i>Work Experience & Career Record
                    </h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-slate-50">
                    <input type="hidden" name="applicant_id" value="{{ auth()->user()?->id }}">
                    <input type="hidden" name="we_id">

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="job_title">Job Title *</label>
                                <input type="text" name="job_title" id="job_title" class="form-control rounded-xl text-sm" placeholder="e.g. Senior Software Engineer" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="company_name">Company Name *</label>
                                <input type="text" name="company_name" id="company_name" class="form-control rounded-xl text-sm" placeholder="e.g. Acme Corporation" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="period_employed">Experience Duration *</label>
                                <select class="form-select rounded-xl text-sm" name="period_employed" id="period_employed" required>
                                    <option value="Less than 1 year">Less than 1 year</option>
                                    <option value="1 year">1 year</option>
                                    <option value="2 years">2 years</option>
                                    <option value="3 years">3 years</option>
                                    <option value="4 years">4 years</option>
                                    <option value="5 years">5 years</option>
                                    <option value="6 years">6 years</option>
                                    <option value="7 years">7 years</option>
                                    <option value="8 years">8 years</option>
                                    <option value="9 years">9 years</option>
                                    <option value="10 years">10 years</option>
                                    <option value="10+ years">10+ years</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="certificate">Certificate / Proof (Optional)</label>
                                <input class="form-control rounded-xl text-sm" name="certificate" type="file">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="achievements">Responsibilities & Major Achievements</label>
                                <textarea class="form-control rounded-xl text-sm" style="height: 120px" id="achievements" name="achievements" placeholder="Describe key accomplishments, technologies used, leadership roles..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white px-4 py-3 border-top border-slate-100">
                    <button type="button" class="btn btn-light rounded-pill px-4 small fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 small fw-semibold shadow-sm">Save Experience</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="mdlDeleteWE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteWeLabel" aria-hidden="true">
    <form class="frmDeleteWE" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content rounded-3xl border-0 shadow-lg overflow-hidden">
                <div class="modal-body p-4 text-center">
                    <input type="hidden" name="we_id">
                    <div class="rounded-circle bg-rose-50 text-rose-600 d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                        <i class="bi bi-trash3 fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark fs-6 mb-1">Delete Work Experience</h5>
                    <p class="text-muted small mb-0">Are you sure you want to remove this record from your profile?</p>
                </div>
                <div class="modal-footer bg-slate-50 px-4 py-3 border-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-3 small fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-3 small fw-semibold shadow-sm">Confirm Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>

<input type="hidden" class="txtStorage" value="<?php echo asset("storage/uploads/file_name")?>">

<script type="text/javascript">
  $(document).ready(function() {
    GetWE();
    var storage = $('.txtStorage').val();

    $('.btnAddWE').click(function(){
        $('.frmSaveWE')[0].reset();
        $('.frmSaveWE input[name="we_id"]').val('');
        $('#mdlAddWE').modal('show');
    });

    $('.frmSaveWE').submit(function(e){
      e.preventDefault();
      SaveWE();
    });

    $(document).on('click', '.btnEditWE', function(){
        var weId = $(this).attr('we-id');
        $('.frmSaveWE')[0].reset();
        GetWEById(weId);
    });

    $(document).on('click', '.btnDeleteWE', function(){
        var weId = $(this).attr('we-id');
        $('.frmDeleteWE input[name="we_id"]').val(weId);
        $('#mdlDeleteWE').modal('show');
    });

    $('.frmDeleteWE').submit(function(e){
      e.preventDefault();
      DeleteWE();
    });

    function GetWE() {
        $.ajax({
            url: "{{ url('/getWE') }}",
            data: null,
            beforeSend: function() {
                var html ='<tr><td colspan="7" class="text-center py-4 text-muted small">Loading records...</td></tr>';
                $('.tblWE tbody').html(html);
            },
            success: function(result){
                var html = '';
                if(result && result.data && result.data.length > 0) {
                    for (var index = 0; index < result.data.length; index++) {
                      html += '<tr class="hover:bg-slate-50/80 transition-colors">';
                         html += '<td class="py-3 px-3 fw-bold text-slate-700">' + (index + 1) + '</td>';
                         html += '<td class="py-3 px-3 fw-semibold text-slate-900">' + (result.data[index].job_title || '') + '</td>';
                         html += '<td class="py-3 px-3 text-slate-700">' + (result.data[index].company_name || '') + '</td>';
                         html += '<td class="py-3 px-3"><span class="badge bg-amber-50 text-amber-800 border border-amber-200 rounded-pill px-2.5 py-1 text-xs">' + (result.data[index].period_employed || '') + '</span></td>';
                         html += '<td class="py-3 px-3 text-slate-600 text-xs max-w-xs">' + (result.data[index].achievements || '') + '</td>';
                         if(result.data[index].certificate != null && result.data[index].certificate != '') {
                          html += '<td class="py-3 px-3"><a href="' + storage.replace('file_name', result.data[index].certificate)  + '" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-2.5 py-0.5 text-xs d-inline-flex align-items-center gap-1"><i class="bi bi-download"></i> View</a></td>';
                         }
                         else {
                          html += '<td class="py-3 px-3 text-slate-400 text-xs">—</td>';
                         }
                         html += '<td class="py-3 px-3 text-end">';
                         html += '<div class="btn-group btn-group-sm rounded-xl overflow-hidden border border-slate-200 shadow-sm">';
                             html += '<button type="button" class="btnEditWE btn btn-light text-slate-700 hover:bg-slate-100" we-id="' + result.data[index].id + '" title="Edit"><i class="bi bi-pencil"></i></button>';
                             html += '<button type="button" class="btnDeleteWE btn btn-light text-rose-600 hover:bg-rose-50" we-id="' + result.data[index].id + '" title="Delete"><i class="bi bi-trash3"></i></button>';
                         html += '</div>';
                         html += '</td>';
                      html += '</tr>';
                    }
                }
                else {
                    html ='<tr><td colspan="7" class="text-center py-4 text-muted small">No work experience records added yet.</td></tr>';
                }

                $('.tblWE tbody').html(html);
            }
        });
    }

    function GetWEById(id) {
        $.ajax({
            url: "{{ url('/getWEById') }}",
            data: {
                id: id,
            },
            beforeSend: function() {

            },
            success: function(result){
                if(result && result.data) {
                    $('.frmSaveWE input[name="we_id"]').val(result.data.id);
                    $('.frmSaveWE input[name="applicant_id"]').val(result.data.applicant_id);
                    $('.frmSaveWE input[name="job_title"]').val(result.data.job_title);
                    $('.frmSaveWE input[name="company_name"]').val(result.data.company_name);
                    $('.frmSaveWE select[name="period_employed"]').val(result.data.period_employed);
                    $('.frmSaveWE textarea[name="achievements"]').val(result.data.achievements);
                    $('#mdlAddWE').modal('show');
                }
            }
        });
    }

    function SaveWE() {
        $.ajax({
            url: "{{ url('/saveWE') }}",
            data: new FormData($('.frmSaveWE')[0]),
            method: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(result){
                GetWE();
                $('#mdlAddWE').modal('hide');
                $('.frmSaveWE')[0].reset();
            }
        })
    }

    function DeleteWE() {
        $.ajax({
            url: "{{ url('/deleteWE') }}",
            data: $('.frmDeleteWE').serialize(),
            method: 'post',
            beforeSend: function() {

            },
            success: function(result){
                GetWE();
                $('#mdlDeleteWE').modal('hide');
                $('.frmDeleteWE')[0].reset();
            }
        })
    }

  });
</script>