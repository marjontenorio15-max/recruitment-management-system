<button class="btnAddWE btn btn-outline-success shadow icon-plus m-3" style="float: right;"> Add Work Experience </button>
<table class="tblWE table table-bordered shadow">
  <thead>
     <tr>
        <th>No</th>
        <th>Job Title</th>
        <th>Company Name</th>
        <th>Work Experience</th>
        <th>Responsibilities & Achievements</th>
        <th>Certificate</th>
        <th>Action</th>
     </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="8">Loading...</td>
    </tr>
  </tbody>
</table>

<div class="modal fade" id="mdlAddWE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <form class="frmSaveWE" method="post">
    @csrf
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-center" id="staticBackdropLabel">Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">                        
                        <div class="col-xs-12 col-sm-12 col-md-12" style="display: none;">
                           <div class="form-group">
                               <input type="text" name="applicant_id" class="form-control" value="{{auth()->user()->id}}">
                               <input type="text" name="we_id" class="form-control"
                                      placeholder="ID" readonly="true">
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="job_title">Job Title:</label>
                               <input type="text" name="job_title" id="job_title" class="form-control" placeholder="Enter Job Title">
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="company_name">Company Name:</label>
                               <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name">
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="achievements">Achievements:</label>
                               <textarea class="form-control" style="height:150px" id="achievements" name="achievements" placeholder="Enter Achievements"></textarea>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="achievements">Certificate:</label>
                               <input class="form-control" name="certificate" type="file">
                           </div>
                       </div>

{{--                       <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                           <div class="form-group">--}}
{{--                               <label for="period_employed">Period Employed:</label>--}}
{{--                               <input type="date" name="period_employed" id="period_employed" class="form-control" placeholder="Enter Period Employed">--}}
{{--                           </div>--}}
{{--                       </div>--}}
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               {{--                                    <input type="text" name="work_exp" class="form-control" placeholder="Qualification/Work Experience ">--}}
                               <label for="period_employed">Work Experience:</label>
                               <select class="form-control" name="period_employed" id="period_employed">
                                   <option value="1 year">1 year</option>
                                   <option value="2 years">2 years</option>
                                   <option value="3 years">3 years</option>
                                   <option value="4 years">4 year</option>
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
                </div>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
  </form>
</div>

<div class="modal fade" id="mdlDeleteWE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <form class="frmDeleteWE" method="post">
    @csrf
    <div class="modal-dialog modal-dialog-scrollable modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="we_id" class="form-control" placeholder="ID" readonly="true" style="display: none;">
                <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
  </form>
</div>

<input type="text" class="txtStorage" value="<?php echo asset("storage/uploads/file_name")?>" style="display: none;">

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    GetWE();
    var storage = $('.txtStorage').val();

    $('.btnAddWE').click(function(){
        $('.frmSaveWE')[0].reset();
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
            url: "getWE",
            data: null,
            beforeSend: function() {
                var html ='<td colspan="8">Loading...</td>';
                $('.tblWE tbody').html(html);
            },
            success: function(result){
                var html = '';
                if(result.data.length > 0) {
                    for (var index = 0; index < result.data.length; index++) {
                      html += '<tr>';
                         html += '<td scope="row"><b>' + (index + 1) + '</b></td>';
                         html += '<td>' + result.data[index].job_title + '</td>';
                         html += '<td>' + result.data[index].company_name + '</td>';
                         html += '<td>' + result.data[index].period_employed + '</td>';
                         html += '<td>' + result.data[index].achievements + '</td>';
                         if(result.data[index].certificate != null && result.data[index].certificate != '') {
                          html += '<td><a href="' + storage.replace('file_name', result.data[index].certificate)  + '" target="_blank" style="color: blue;"><span class="icon-download"></span> Download</a></td>';
                         }
                         else {
                          html += '<td>N/A</td>';
                         }
                         html += '<td>';
                         html += '<div class="btn-group shadow">';
                             html += '<button class="btnEditWE btn btn-outline-primary shadow icon-edit" we-id="' + result.data[index].id + '"></button>';
                             html += '<button class="btnDeleteWE btn btn-outline-danger icon-trash-7 shadow" we-id="' + result.data[index].id + '"></button>';
                         html += '</div>';

                         html += '</td>';
                       html += '</tr>';
                    }
                }
                else {
                    html ='<td colspan="8">No record found.</td>';
                }

                $('.tblWE tbody').html(html);
            }
        });
    }

    function GetWEById(id) {
        $.ajax({
            url: "getWEById",
            data: {
                id: id,
            },
            beforeSend: function() {
                
            },
            success: function(result){
                $('.frmSaveWE input[name="we_id"]').val(result.data.id);
                $('.frmSaveWE input[name="applicant_id"]').val(result.data.applicant_id);
                $('.frmSaveWE input[name="job_title"]').val(result.data.job_title);
                $('.frmSaveWE input[name="company_name"]').val(result.data.company_name);
                $('.frmSaveWE select[name="period_employed"]').val(result.data.period_employed);
                $('.frmSaveWE textarea[name="achievements"]').val(result.data.achievements);
                $('#mdlAddWE').modal('show');
            }
        });
    }

    function SaveWE() {
        $.ajax({
            url: "saveWE",
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
                alert('Record Saved!');
            }
        })
    }

    function DeleteWE() {
        $.ajax({
            url: "deleteWE",
            data: $('.frmDeleteWE').serialize(),
            method: 'post',
            beforeSend: function() {
                
            },
            success: function(result){
                GetWE();
                $('#mdlDeleteWE').modal('hide');
                $('.frmDeleteWE')[0].reset();
                alert('Record Deleted!');
            }
        })
    }

  });
</script>