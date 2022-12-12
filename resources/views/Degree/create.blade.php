@extends('layouts.app-master')

@section('content')
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <div class="container">
       <div class="card m-3 shadow">
           <div class="card-header bg-primary text-center">
               <div class="pull-left">
                   <h2 class="text-white">Add Educational Background</h2>
               </div>
           </div>
           <div class="card-body">
               <a class="btn btn-outline-dark shadow m-3 icon-back" href="{{ route('educational_background.index') }}"> Back</a>
{{--               <div class="row">--}}
{{--                   <div class="col-lg-12 margin-tb">--}}
{{--                       <div class="pull-right m-3">--}}
{{--                           <a class="btn btn-outline-dark icon-back shadow" href="{{ route('educational_background.index') }}"> Back</a>--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--               </div>--}}

{{--               @if ($errors->any())--}}
{{--                   <div class="alert alert-danger">--}}
{{--                       <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--                       <ul>--}}
{{--                           @foreach ($errors->all() as $error)--}}
{{--                               <li>{{ $error }}</li>--}}
{{--                           @endforeach--}}
{{--                       </ul>--}}
{{--                   </div>--}}
{{--               @endif--}}

               <form action="{{ route('educational_background.store') }}" method="POST">
                   @csrf

                   <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
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
                       <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                           <button type="submit" class="btn btn-outline-success icon-paper-plane"> Submit</button>
                       </div>
                   </div>

               </form>
           </div>
       </div>
   </div>
   <script>
       $(function() {
           $( "#datepicker" ).datepicker({dateFormat: 'yy'});
       });
   </script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
