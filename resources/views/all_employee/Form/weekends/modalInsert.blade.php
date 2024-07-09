<form action="{{ route('coordinator/working/weekends/form/insert') }}" method="post" >
    {{ csrf_field() }}
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title text-center' id='showModalLabel'>Form Weekend Crew</h4>
    </div>
    <div class='modal-body'>
        <div class="row">
            <div class="col-lg-12">               
                <div class="form-group">
                    <label for="Employes">Employes:</label>
                    <input type="text" name="employes" id="employes" readonly required class="form-control" value="{{ $findUser->getFullName() }}">
                </div>
                <div class="form-group">
                    <label for="start">Start Date:</label>
                    <input type="datetime-local" name="start" id="start" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="end">End Date:</label>
                    <input type="datetime-local" name="end" id="end" required class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class='modal-footer'>
        <button type='submit' class='btn btn-sm btn-success'>Insert</button>
        <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
    </div>    
</form>