@extends('layouts.app-master')
@section('content')
     <div class="container">
         <div class="card">
             <div class="card-header bg-primary">
                 <div class="row">
                     <div class="col-lg-12 margin-tb">
                         <div class="pull-left">
                             <h2 class="text-center text-white"> Remarks </h2>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="card-body">
                 <div class="pull-right">
                     <a class="btn btn-success" href="{{ route('employer_remarks.create') }}"> Create New Post</a>
                 </div>
                 @if ($message = Session::get('success'))
                     <div class="alert alert-success">
                         <p>{{ $message }}</p>
                     </div>
                 @endif

                 <table class="table table-bordered p-3 m-3">
                     <tr>
                         <th>No</th>
                         <th>Applicant_ID</th>
                         <th>Remarks</th>
                         <th>Action</th>
                     </tr>
                     @foreach ($data as $key => $value)
                         <tr>
                             <td>{{++$i}}</td>
                             <td>{{ $value->applicant_id }}</td>
                             <td>{{ $value->remarks }}</td>
                             <td>
                                 <form action="{{ route('employer_remarks.destroy', $value->id) }}" method="POST">
                                     <a class="btn btn-info" href="{{ route('employer_remarks.show', $value->id) }}">Show</a>
                                     <a class="btn btn-primary" href="{{ route('employer_remarks.edit', $value->id) }}">Edit</a>
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-danger">Delete</button>
                                 </form>
                             </td>
                         </tr>
                     @endforeach
                 </table>
                 <div class="float-end">
                     {!! $data->links() !!}
                 </div>
             </div>
         </div>
     </div>


@endsection
