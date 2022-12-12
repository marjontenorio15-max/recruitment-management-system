@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card shadow mt-3">
            <div class="card-header bg-primary">
                <h2 class="text-center text-white">Show Company</h2>
            </div>
            <div class="card-body p-3 m-3">
                <a class="btn btn-outline-dark icon-back shadow m-3" href="{{ route('company.index') }}"> Back</a><br><br>
                {{--            @php--}}
                {{--                $data = DB::table('companies')->select('companies.company_name', 'companies.address',--}}
                {{--            'companies.contact_no', 'users.email', 'users.username', 'companies.id')--}}
                {{--             ->join('users', 'users.id', 'companies.company_id')->get()--}}
                {{--            @endphp--}}
                {{--            @foreach($data as $company)--}}

                <div class="row m-3 p-3">
                    {{--               <div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--                   <div class="form-group">--}}
                    {{--                       <strong>Company ID:</strong>--}}
                    {{--                       {{ $company->company_id}}--}}
                    {{--                   </div>--}}
                    {{--               </div>--}}
                    {{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <strong>Email Address:</strong>--}}
                    {{--                            {{$company->email}}--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <strong>User Name:</strong>--}}
                    {{--                            {{$company->username}}--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Company Name:</strong>
                                {{$company->company_name}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Address:</strong>
                                {{$company->address}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Contact Number:</strong>
                                {{$company->contact_no}}
                            </div>
                        </div>
                    </div>

                    {{--            @endforeach--}}
                </div>

            </div>
        </div>
        </div>
{{--   <div class="container">--}}
{{--       <div class="card m-3 p-3">--}}
{{--           <div class="row">--}}
{{--               <div class="col-lg-12 margin-tb">--}}
{{--                   <div class="pull-left">--}}
{{--                       <a class="btn btn-outline-dark icon-back shadow m-3" href="{{ route('company.index') }}"> Back</a>--}}
{{--                       <h2 class="text-center m-3">Show Company</h2>--}}
{{--                   </div>--}}

{{--               </div>--}}
{{--           </div>--}}
{{--            @php--}}
{{--                $data = DB::table('companies')->select('companies.company_name', 'companies.address',--}}
{{--            'companies.contact_no', 'users.email', 'users.username', 'companies.id')--}}
{{--             ->join('users', 'users.id', 'companies.company_id')->get()--}}
{{--            @endphp--}}
{{--           @foreach($data as $company)--}}


{{--           <div class="row m-3 p-3">--}}
{{--               <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                   <div class="form-group">--}}
{{--                       <strong>Company ID:</strong>--}}
{{--                       {{ $company->company_id}}--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--               <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                   <div class="form-group">--}}
{{--                       <strong>Email Address:</strong>--}}
{{--                       {{$company->email}}--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--               <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                   <div class="form-group">--}}
{{--                       <strong>User Name:</strong>--}}
{{--                       {{$company->username}}--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--           </div>--}}
{{--           <div class="row m-3 p-3">--}}
{{--               <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                   <div class="form-group">--}}
{{--                       <strong>Company Name:</strong>--}}
{{--                       {{$company->company_name}}--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--               <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                   <div class="form-group">--}}
{{--                       <strong>address:</strong>--}}
{{--                       {{$company->address}}--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--           </div>--}}
{{--           <div class="row m-3 p-3">--}}
{{--               <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                   <div class="form-group">--}}
{{--                       <strong>Contact Number:</strong>--}}
{{--                       {{$company->contact_no}}--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--           </div>--}}
{{--           @endforeach--}}
{{--   </div>--}}
@endsection
