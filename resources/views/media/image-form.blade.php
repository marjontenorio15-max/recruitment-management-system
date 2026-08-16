

{{--    <!-- Container (Contact Section) -->--}}
{{--    <div id="contact">--}}
{{--        <h4>Upload Image</h4>--}}
{{--        @if ($message = Session::get('success'))--}}
{{--            <div class="alert alert-success alert-block">--}}
{{--                <strong>{{$message}}</strong>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <form method="post" action="{{ route('image.store') }}" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <input type="file" class="form-control" name="image" />--}}

{{--            <button type="submit" class="btn btn-outline-primary mt-3">Upload</button>--}}
{{--        </form>--}}
{{--    </div>--}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>
        @endif
<form action="{{ route('image.store')}}" method="post" enctype="multipart/form-data" multiple="true">
    <!-- Add CSRF Token -->
    @csrf

    <h3>Image file</h3>
    <div class="form-group">
        <label for="name">Image Name</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>
    <div class="form-group">
        <input type="file" name="image" required>
    </div>
   <div class="float-end">
       <button type="submit" class="btn btn-success form-group icon-upload shadow ">Upload Image</button>
   </div>
</form>

