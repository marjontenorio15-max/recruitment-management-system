@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger border-0 shadow-sm d-flex align-items-start gap-2 mb-3 text-start" role="alert" style="border-left: 4px solid var(--ae-red, #e31837) !important;">
        <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0 text-danger mt-1"></i>
        <div class="w-100">
            <ul class="list-unstyled mb-0 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Session::has('success'))
    @php $successData = Session::get('success'); @endphp
    @if (is_array($successData))
        @foreach ($successData as $msg)
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-3 text-start" role="alert" style="border-left: 4px solid #198754 !important;">
                <i class="bi bi-check-circle-fill fs-5 flex-shrink-0 text-success"></i>
                <div class="small w-100">{{ $msg }}</div>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @else
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-3 text-start" role="alert" style="border-left: 4px solid #198754 !important;">
            <i class="bi bi-check-circle-fill fs-5 flex-shrink-0 text-success"></i>
            <div class="small w-100">{{ $successData }}</div>
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif
