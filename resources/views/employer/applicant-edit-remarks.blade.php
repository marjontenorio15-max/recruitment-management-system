@extends('layouts.app-master')
@section('content')

    <div class="container">
        <div class="card m-3">
            <div class="card-header">
                <h3 class="text-center">Remarks</h3>
            </div>
            <div class="card-body">
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

                    @foreach($applicants as $applicant)
                        <form action="{{ route('employer_remarks.update', $applicant->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
{{--                                    <div class="form-group">--}}
{{--                                        <label for="applicant_id">Applicant_ID:</label>--}}
{{--                                        <input type="number" id="applicant_id" name="applicant_id"--}}
{{--                                               value="{{$applicant->id}}"--}}
{{--                                               class="form-control" placeholder="Applicant Id">--}}
{{--                                    </div>--}}
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="remarks">Remarks:</label>
                                        <textarea style="height: 250px"
                                                  type="text" id="remarks" name="remarks"
                                                  class="form-control"
                                                  placeholder="Remarks">{{$applicant->remarks}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea style="height: 250px"
                                                  type="text" id="description" name="description"
                                                  class="form-control"
                                                  placeholder="Remarks">{{$applicant->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-success shadow icon-arrows-cw float-end" >Update</button>
                                </div>
                            </div>

                        </form>
                   @endforeach

            </div>
        </div>
    </div>

@endsection
