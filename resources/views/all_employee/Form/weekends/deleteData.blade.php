
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title text-center' id='showModalLabel'>Form Weekend Crew</h4>
    </div>
    <div class='modal-body'>
        <div class="row">
            <div class="col-lg-12">               
                <div class="form-group">
                    <label for="Employes">Employes:</label>
                    <input type="text" name="employes" id="employes" readonly required class="form-control" value="{{ $user->getFUllName() }}">
                </div>
                <div class="form-group">
                    <label for="start">Start Date:</label>
                    <input type="datetime-local" name="start" id="start" readonly class="form-control" value="{{ $data->start }}">
                </div>
                <div class="form-group">
                    <label for="end">End Date:</label>
                    <input type="datetime-local" name="end" id="end" readonly class="form-control" value="{{ $data->end }}">
                </div>
                <div class="form-group">
                    <label for="project">Project:</label>
                    <input type="text" name="project" id="project" readonly class="form-control" value="{{ $data->project }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 id="removed">Are your sure remove this record?</h4>
            </div>
        </div>
    </div>
    <div class='modal-footer'>
        <a href="{{ route('coordinator/working/weekends/remove', $data['id']) }}" class='btn btn-sm btn-danger'>Remove</a>
        <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
    </div>    
