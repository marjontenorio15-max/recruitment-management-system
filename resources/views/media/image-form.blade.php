

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
    <div class="alert alert-danger rounded-2xl p-3 mb-3 shadow-sm">
        <ul class="mb-0 ps-3 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success d-flex align-items-center gap-2 rounded-2xl p-3 mb-3 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        <strong class="small">{{ $message }}</strong>
    </div>
@endif

<form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data" multiple="true">
    @csrf

    <div class="row g-3 align-items-end">
        <div class="col-12 col-md-5">
            <div class="form-group mb-0">
                <label for="name" class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1">Photo Title / Label *</label>
                <input type="text" class="form-control rounded-xl text-sm" name="name" id="name" placeholder="e.g. Profile Headshot 2025" required>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group mb-0">
                <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1">Choose Photo File *</label>
                <input type="file" class="form-control rounded-xl text-sm" name="image" required accept="image/*">
            </div>
        </div>

        <div class="col-12 col-md-3">
            <button type="submit" class="btn btn-dark w-100 rounded-xl py-2 small fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-1.5">
                <i class="bi bi-upload"></i>
                <span>Upload Photo</span>
            </button>
        </div>
    </div>
</form>

