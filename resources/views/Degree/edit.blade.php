@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="card m-3 shadow">
            <div class="card-header bg-primary text-center">
                <div class="pull-left">
                    <h2 class="text-white">Edit Details</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-outline-dark icon-back m-4 shadow" href="{{ route('educational_background.index') }}"> Back</a>
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

                <form action="{{ route('educational_background.update',$educational_background->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="school_name">School Name:</label>
                                <input type="text" name="school_name" id="school_name" value="{{ $educational_background->school_name }}" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="school_location">School Location:</label>
                                <input type="text" name="school_location" id="school_location" value="{{ $educational_background->school_location }}" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="degree">Degree</label>
                                <select class="form-control" name="degree" id="degree">
                                    <option selected value="{{ $educational_background->degree }}">{{ $educational_background->degree }}</option>
                                    <option value="High School Diploma">High School Diploma</option>
                                    <option value="Elementary Diploma">Elementary Diploma</option>
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
                                <input type="text" name="field_of_study" id="field_of_study" value="{{ $educational_background->field_of_study }}" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="month_graduate">Month Graduate:</label>
                                <input type="text" name="month_graduate" id="month_graduate" value="{{ $educational_background->month_graduate }}" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="year_graduate">Year Graduate:</label>
                                <input type="text" name="year_graduate"  id="year_graduate" value="{{ $educational_background->year_graduate }}" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-success icon-paper-plane shadow"> Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
