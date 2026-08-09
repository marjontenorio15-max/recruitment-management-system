@php use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="shadow m-3">
            <div class="header">
                <nav class="header" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Charts</li>
                    </ol>
                </nav>
            </div>

            <div class="container">
                <div class="row m-3">
                    <div class="col-lg-3 col-6">
                        <div class="card bg-primary shadow">
                            <div class="card-header">
                                @php
                                    $total = DB::table('apply')
                                    ->Where('tbl_job_list.company_id', auth()->user()->id)
                                    ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                    ->select(DB::raw("COUNT(*) as countTotal"))->get();
                                @endphp
                                <h3 class="text-white">
                                    @foreach($total as $totals)
                                        {{ $totals->countTotal }}
                                    @endforeach
                                </h3>
                                <p class="text-white">Total Applicant <i class="icon-list-add"></i></p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{route('employer-applicant-table-record')}}" class="text-white">More info<i
                                        class="icon-right-circled"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card bg-success shadow">
                            <div class="card-header">
                                @php
                                    $apply = DB::table('apply')
                                    ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                     ->Where('tbl_job_list.company_id', auth()->user()->id)
                                      ->where('apply.remarks', 'Hired')
                                    ->select(DB::raw("COUNT(*) as countJob"))->get();
                                @endphp
                                <h3 class="text-white">
                                    @foreach($apply as $users)
                                        {{ $users->countJob }}
                                    @endforeach
                                </h3>
                                <p class="text-white">Hired Applicant <i class="icon-chart-bar"></i></p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{route('generate-reports')}}" class="text-white">More info<i
                                        class="icon-right-circled"></i></a>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card bg-info shadow">
                            @php
                                $apply = DB::table('apply')
                                     ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                      ->Where('tbl_job_list.company_id', auth()->user()->id)
                                       ->where('apply.remarks', 'For Interview')
                                     ->select(DB::raw("COUNT(*) as count"))->get();
                            @endphp

                            <div class="card-header">
                                <h3 class="text-white">
                                    @foreach($apply as $users)
                                        {{ $users->count }}
                                    @endforeach
                                </h3>
                                <p class="text-white">For Interview<i class="icon-user-add"></i></p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{route('generate-reports')}}" class="text-white">More info <i
                                        class="icon-right-circled"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="card bg-danger shadow">
                            <div class="card-header">
                                @php
                                    $apply = DB::table('apply')
                                    ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                     ->Where('tbl_job_list.company_id', auth()->user()->id)
                                      ->where('apply.remarks', 'Reject')
                                    ->select(DB::raw("COUNT(*) as count"))->get();
                                        @endphp
                                <h3 class="text-white">
                                    @foreach($apply as $users)
                                        {{ $users->count }}
                                    @endforeach
                                </h3>
                                <p class="text-white">Reject <i class=" icon-building"></i></p>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('company.index')}}" class="text-white">More info <i
                                        class="icon-right-circled"></i></a>
                            </div>
                        </div>
                    </div>


                </div>

                {{--           @if (\Session::has('print'))--}}
                {{--               <div class="alert alert-success">--}}
                {{--                   <ul>--}}
                {{--                       <li>{!! \Session::get('print') !!}</li>--}}
                {{--                   </ul>--}}
                {{--               </div>--}}
                {{--           @endif--}}

                <div class="m-3 ">
                    <div class="col-lg-3 col-6">
                        <div class="card bg-warning shadow">
                            <div class="card-header">
                                @php
                                    $apply = DB::table('apply')
                                    ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                     ->Where('tbl_job_list.company_id', auth()->user()->id)
                                      ->where('apply.remarks', 'Pending')
                                    ->select(DB::raw("COUNT(*) as count"))->get();
                                @endphp
                                <h3 class="text-white">
                                    @foreach($apply as $users)
                                        {{ $users->count }}
                                    @endforeach
                                </h3>
                                <p class="text-white">Pending <i class=" icon-building"></i></p>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('generate-reports')}}" class="text-white">More info <i
                                        class="icon-right-circled"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3"></div>

            </div>
            {{--       <button onclick="window.print()">Print this page</button>--}}

        </div>
    </div>

@endsection
