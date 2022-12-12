
<div class="container">
    <form action="{{route('save-file')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                File Upload
            </div>
            <div class="card-body">
                <div class="form-control">
                    <label for="name"> File Attachment : </label>
                    <input type="file" class="form-control" name="myfile">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">save</button>
            </div>
        </div>
    </form>
</div>
