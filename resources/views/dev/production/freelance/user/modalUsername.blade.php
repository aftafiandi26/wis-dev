<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Form Request Username
        <br>
        {{ $data->fullname() }}
    </h4>
</div>
<div class="modal-body">
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <form action="{{ route('dev/user/freelance/username/post', $data->id) }}" method="post" class="form-horizontal" id="formMessage">
                {{ csrf_field() }}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required value="{{ $data->username }}">
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" required value="{{ $nik }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control" readonly value="Batam2024">
                            </div>
                            <div class="form-group">
                                <label for="fullname">fullname</label>
                                <input type="text" class="form-control" value="{{ $data->fullname() }}">
                            </div>
                            <div class="form-group">
                                <label>Project</label>
                                <textarea class="form-control" cols="5" rows="2">@foreach ($array as $arr){{ $arr.', ' }}@endforeach</textarea>
                            </div>
                            <div class="form-group">
                                <label>Created</label>
                                <input type="text" class="form-control" value="{{ $user->getFullName() }}">
                            </div>
                        </div>                        
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-xs btn-danger" id="buttonMessage">Yes</button>
    <a class="btn btn-xs btn-default" data-dismiss="modal">No</a>
</div>

<script>
    $(document).ready(function() {
        // Get the form and the button
        const form = document.getElementById('formMessage');
        const submitButton = document.getElementById('buttonMessage');

        // Add event listener to the button
        submitButton.addEventListener('click', function() {
            form.submit(); // Submit the form
        });
    })
</script>