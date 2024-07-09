<form action="{{ route('form/progressing/delete/post', $id) }}" method="post">
    {{ csrf_field() }}
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title text-center' id='showModalLabel2'>Form Remote Access Request Above 23.00</h4>
    </div>
    <div class='modal-body'>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Are u sure? <br>the form request will be removed from the database.</p>
                <button type='submit' class='btn btn-danger'>Yes</button>
                <button type='button' class='btn btn-success' data-dismiss='modal'>No</button>
            </div>
        </div>
    </div>
    <div class='modal-footer'>

    </div> ";
</form>
