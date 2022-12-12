@extends('layouts.app-master')
@section('content')
   <div class="container">
       <div class="card shadow mt-3">
           <div class="card-header text-center bg-primary">
               <h2 class="text-white">Edit Remarks</h2>
           </div>
           <div class="card-body">
               <div class="row">
                   <div class="col-lg-12 margin-tb">
                       <div class="pull-left">

                       </div>
                       <div class="pull-right">
                           @if(auth()->user()->role_id == 2)
                               <a class="btn btn-outline-dark shadow icon-back" href="{{ route('employer-applicant-table-record') }}"> Back</a>
                           @else
                               <a class="btn btn-outline-dark shadow icon-back" href="{{ route('apply.index') }}"> Back</a>
                           @endif
                       </div>
                   </div>
               </div>
               <br><br>
               @if ($errors->any())
                   <div class="alert alert-danger">
                       <strong>Whoops!</strong> There were some problems with your input.<br><br>
                       <ul>
                           @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                   </div>
               @endif

               <form action="{{ route('employer_remarks.update', $employer_remark->id) }}" method="POST">
                   @csrf
                   @method('PUT')

{{--                   @foreach($remark as $remarks)--}}
                       <div class="row">
{{--                           <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                               <div class="form-group">--}}
{{--                                   <strong>Applicant_ID:</strong>--}}
{{--                                   <input type="number" name="applicant_id" value="{{ $employer_remark->applicant_id }}" class="form-control" placeholder="Applicant Id">--}}
{{--                               </div>--}}
{{--                           </div>--}}
                           <div class="col-xs-12 col-sm-12 col-md-12">
                               <div class="form-group form-floating">
{{--                                   <input type="text" id="remarks" name="remarks" value="{{ $employer_remark->remarks}}" class="form-control">--}}
                                   <select class="form-select" aria-label="Default select example" name="remarks">
{{--                                       <option selected>{{ $employer_remark->remarks}}</option>--}}
                                       <option value="Pending">Pending</option>
                                       <option value="Reject">Reject</option>
                                       <option value="Hired">Hired</option>
                                       <option value="For Interview">For Interview</option>
                                   </select>
                                   <label for="remarks">remarks:</label>
                               </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12">
                               <div class="form-group">
                                   <label for="description">Description:</label>
                                   <textarea style="height: 250px"
                                             type="text" id="description" name="description"
                                             class="form-control"
                                             placeholder="Remarks">{{$employer_remark->description}}</textarea>
                               </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                               <button type="submit" class="btn btn-outline-success shadow icon-paper-plane">Submit</button>
                           </div>
                       </div>
{{--                   @endforeach--}}

               </form>
           </div>
       </div>
   </div>
@endsection
