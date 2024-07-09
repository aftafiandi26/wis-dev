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
            <form action="{{ route('freelance/modalEmail/send', $data->id) }}" method="post" class="form-horizontal" id="formMessage">
                {{ csrf_field() }}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="emailFrom">From:</label>
                                <input type="email" name="emailFrom" id="emailFrom" class="form-control" value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="emailTo">To:</label>
                                <input type="email" name="emailTo" id="emailTo" class="form-control" readonly value="wis@infinitestudios.co.id">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" required value="Request Username">
                            </div>
                            <div class="form-group">
                                <label for="summary">Message:</label>
                                <textarea name="summary" id="summary" class="form-control" cols="30" rows="20" required style="height: 150px;" placeholder="ex: write here">{{ old('summary') }}</textarea>
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
    // Get the form and the button
    const form = document.getElementById('formMessage');
    const submitButton = document.getElementById('buttonMessage');

    // Add event listener to the button
    submitButton.addEventListener('click', function() {
        form.submit(); // Submit the form
    });
</script>