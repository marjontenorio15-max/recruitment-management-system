<button class="btnAddEB btn btn-outline-success shadow icon-plus m-3" style="float: right;"> Add Educational Background </button>
<table class="tblEB table table-bordered shadow">
  <thead>
     <tr>
         <th scope="col">No</th>
         <th scope="col">School Name</th>
         <th scope="col">School Location</th>
         <th scope="col">Degree</th>
         <th scope="col">Field of Study</th>
         <th scope="col">Month Graduate</th>
         <th scope="col">Year Graduate</th>
         <th scope="col">Action</th>
     </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="8">Loading...</td>
    </tr>
  </tbody>
</table>

<div class="modal fade" id="mdlAddEB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <form class="frmSaveEB" method="post">
    @csrf
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-center" id="staticBackdropLabel">Educational Background</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                                <input type="text" name="eb_id" class="form-control"
                                      placeholder="ID" readonly="true" style="display: none;">
                               <label for="school_name">School Name:</label>
                               <input type="text" name="school_name"
                                      id="school_name" class="form-control"
                                      placeholder="Enter Title" required="required">
                               <div class="valid-feedback">
                                   Looks good!
                               </div>
                               <div class="invalid-feedback">
                                   Please Enter Your School Name.
                               </div>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="school_location">School Location:</label>
                               <input type="text" name="school_location" id="school_location"
                                      class="form-control" placeholder="Enter Title" required="required">
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
{{--                           <div class="form-group">--}}
{{--                               <label for="degree">Degree:</label>--}}
{{--                               <input type="text" name="degree" id="degree" class="form-control" placeholder="Enter Title">--}}
{{--                           </div>--}}
                           <div class="form-group">
                               <label for="degree">Degree</label>
                               <select class="form-control" name="degree" id="degree" required>
                                   <option value="Elementary Diploma">Elementary Diploma</option>
                                   <option value="High School Diploma">High School Diploma</option>
                                   <option value="GED">GED</option>
                                   <option value="Associate of Arts">Associate of Arts</option>
                                   <option value="Associate of Science">Associate of Science</option>
                                   <option value="Associate of Applied Science">Associate of Applied Science</option>
                                   <option value="Bachelor of Arts">Bachelor of Arts</option>
                                   <option value="Bachelor of Science">Bachelor of Science</option>
                                   <option value="BBA">BBA</option>
                               </select>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="field_of_study">Field of Study:</label>
                               <input type="text" name="field_of_study"
                                      id="field_of_study" class="form-control"
                                      placeholder="Enter Title" required>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label  for="month_graduate">Month Graduate:</label>
                               <input type="text" name="month_graduate" id="month_graduate"
                                      class="form-control" placeholder="Enter Title" required>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="year_graduate" id="ui-datepicker-calendar">Year Graduate:</label>
                               <input type="number" name="year_graduate" id="year_graduate"
                                       class="form-control" placeholder="Enter Year Graduate" required>
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

<div class="modal fade" id="mdlDeleteEB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <form class="frmDeleteEB" method="post">
    @csrf
    <div class="modal-dialog modal-dialog-scrollable modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="eb_id" class="form-control" placeholder="ID" readonly="true" style="display: none;">
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

<script type="text/javascript">
  $(document).ready(function() {
    GetEB();

    $('.btnAddEB').click(function(){
        $('.frmSaveEB')[0].reset();
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
                var html ='<td colspan="8">Loading...</td>';
                $('.tblEB tbody').html(html);
            },
            success: function(result){
                var html = '';
                if(result && result.data && result.data.length > 0) {
                    for (var index = 0; index < result.data.length; index++) {
                      html += '<tr>';
                         html += '<td scope="row"><b>' + (index + 1) + '</b></td>';
                         html += '<td>' + (result.data[index].school_name || '') + '</td>';
                         html += '<td>' + (result.data[index].school_location || '') + '</td>';
                         html += '<td>' + (result.data[index].degree || '') + '</td>';
                         html += '<td>' + (result.data[index].field_of_study || '') + '</td>';
                         html += '<td>' + (result.data[index].month_graduate || '') + '</td>';
                         html += '<td>' + (result.data[index].year_graduate || '') + '</td>';
                         html += '<td>';
                         html += '<div class="btn-group shadow">';
                             html += '<button class="btnEditEB btn btn-outline-primary shadow icon-edit" eb-id="' + result.data[index].id + '"></button>';
                             html += '<button class="btnDeleteEB btn btn-outline-danger icon-trash-7 shadow" eb-id="' + result.data[index].id + '"></button>';
                         html += '</div>';

                         html += '</td>';
                       html += '</tr>';
                    }
                }
                else {
                    html ='<td colspan="8">No record found.</td>';
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
                alert('Record Saved!');
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
                alert('Record Deleted!');
            }
        })
    }

  });
</script>