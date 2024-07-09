<form action="{{ route('coordinator/working/weekends/update', $data['id']) }}" method="post" >
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
                    <input type="text" name="employes" id="employes" readonly required class="form-control" value="{{ $user->getFUllName() }}" readonly>
                </div>
                <div class="form-group">
                    <label for="start">Start Date:</label>
                    <input type="datetime-local" name="start" id="start" required class="form-control" value="{{ $data->start }}" required>
                </div>
                <div class="form-group">
                    <label for="end">End Date:</label>
                    <input type="datetime-local" name="end" id="end" required class="form-control" value="{{ $data->end }}" required>
                </div>
                <div class="form-group">
                    <label for="project">Project:</label>
                    <input type="text" name="project" id="project" class="form-control" value="{{ $data->project }}">
                </div>
                <div class="form-group">
                    <label for="workStatus">Work Stat:</label>                    
                    <select name="workStatus" class="form-control">
                        <option {{ !$data->workstat ? 'selected' : '' }}></option>
                        <option value="wfs" @if ('wfs' == $data->workStat)
                            selected
                        @endif>WFS</option>
                        <option value="wfh" @if ('wfh' == $data->workStat)
                            selected
                        @endif>WFH</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="over">Change With:</label>
                    <select name="over" id="over" class="form-control">                        
                        <option value="exdo" @if ('exdo' == $data->extra)
                            selected
                        @endif>Exdo</option>
                        <option value="allowance" @if ('allowance' == $data->extra)
                            selected
                        @endif>Allowance</option>                      
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class='modal-footer'>
        <button type='submit' class='btn btn-sm btn-success'>Update</button>
        <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
    </div>    
</form>