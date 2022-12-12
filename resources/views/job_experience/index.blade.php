@extends('layouts.app-master')
@section('content')
    <style>

        .modal-confirm {
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }
        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }
        .modal-confirm .modal-body {
            color: #999;
        }
        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }
        .modal-confirm .modal-footer a {
            color: #999;
        }
        .modal-confirm .icons-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }
        .modal-confirm .icons-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }
        .modal-confirm .btn, .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }
        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }
        .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }
        .modal-confirm .btn-danger {
            background: #f15e5e;
        }
        .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }
        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
    <div class="container">
        <div class="card m-3 shadow">
            <div class="card-header bg-primary">
                <h2 class="text-center text-white">Work Experience</h2>
            </div>
            <div class="card-body m-3">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success icon-plus shadow m-3 float-end" href="{{ route('job-experience.create') }}"> Create Job Exp</a>
                        <a class="btn btn-outline-dark icon-back shadow m-3" href="{{ route('account-profile') }}"> Back</a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-bordered shadow">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Job Title</th>
                        <th>Company Name</th>
                        <th>Work Experience</th>
                        <th>Responsibilities & Achievements</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($data as $key => $value)
                        <tr>
                            <td><b>{{ ++$i }}</b></td>
                            <td>{{ $value->job_title }}</td>
                            <td>{{ $value->company_name }}</td>
                            <td>{{ $value->period_employed }}</td>
                            <td>{{ \Str::limit($value->achievements, 100) }}</td>
                            <td class="text-center">

                               <div class="btn-group shadow">
                                   <a class="btn btn-outline-info icon-eye shadow" href="{{ route('job-experience.show',$value->id) }}"></a>
                                   <a class="btn btn-outline-primary icon-edit shadow" href="{{ route('job-experience.edit',$value->id) }}"></a>
                                   <a href="#myModal" data-toggle="modal" class="btn btn-outline-danger icon-trash-7 shadow"></a>
                               </div>
                                <div id="myModal" class="modal fade">
                                    <div class="modal-dialog modal-confirm">
                                        <div class="modal-content">
                                            <div class="modal-header flex-column">
                                                <div class="icons-box">
                                                    <i class="icon-cancel-1"></i>
                                                </div>
                                                <h4 class="modal-title w-100">Are you sure?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to delete these records? This process cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('job-experience.destroy',$value->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
{{--                {!! $data->links() !!}--}}
            </div>
        </div>
    </div>

@endsection
