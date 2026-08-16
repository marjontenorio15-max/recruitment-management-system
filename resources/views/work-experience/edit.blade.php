@extends('layouts.app-master')

@section('content')
   <div class="container">
       <div class="card m-3 shadow">
            <div class="card-header bg-primary">
                <h2 class="text-white text-center">Edit Work Experience</h2>
            </div>
           <div class="card-body m-3">
               <div class="row">
                   <div class="col-lg-12 margin-tb">
                       <div class="pull-right">
                           <a class="btn btn-dark icon-back shadow m-3" href="{{ route('job-experience.index') }}"> Back</a>
                       </div>
                   </div>
               </div>

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

               <form action="{{ route('job-experience.update',$job_experience->id) }}" method="POST">
                   @csrf
                   @method('PUT')

                   <div class="row">

                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="job_title">Job Title:</label>
                               <input type="text" name="job_title" value="{{ $job_experience->job_title }}" id="job_title" class="form-control" placeholder="Enter Job Title">
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="company_name">Company Name:</label>
                               <input type="text" name="company_name" value="{{ $job_experience->company_name }}" id="company_name" class="form-control" placeholder="Enter Company Name">
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                               <label for="achievements">Achievements:</label>
                               <textarea class="form-control" id="achievements"
                                         name="achievements" placeholder="Enter Achievements"
                                         style="height:150px">{{ $job_experience->achievements }}</textarea>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
{{--                               <label for="period_employed">Period Employed:</label>--}}
{{--                               <input type="date" name="period_employed" value="{{ $job_experience->period_employed }}"--}}
{{--                                      id="period_employed" class="form-control" placeholder="Enter Period Employed">--}}
                               <label for="period_employed">Work Experience:</label>
                               <select class="form-control" name="period_employed" id="period_employed">
                                   <option selected value="{{ $job_experience->period_employed }}">{{ $job_experience->period_employed }}</option>
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
                       <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                           <button type="submit" class="btn btn-success icon-paper-plane shadow">Submit</button>
                       </div>
                   </div>

               </form>
           </div>
       </div>
   </div>
@endsection
