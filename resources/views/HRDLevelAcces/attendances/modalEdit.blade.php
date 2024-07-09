<form action="{{ route('hr/summary/attendance/update', $data->id) }}" method="post" >
    {{ csrf_field() }}
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title text-center' id='showModalLabel'>Data Attendance</h4>
    </div>
    <div class='modal-body'>
        <div class="row">
            <div class="col-lg-12">    
                <div class="form-group">
                    <label for="nik">NIK:</label>
                    <input type="text" name="nik" id="nik" readonly required class="form-control" value="{{ $data->user()->nik }}">
                </div>           
                <div class="form-group">
                    <label for="Employes">Employes:</label>
                    <input type="text" name="employes" id="employes" readonly required class="form-control" value="{{ $data->user()->getFullName() }}">
                </div>
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input type="text" name="department" id="department" readonly required class="form-control" value="{{ $data->user()->getDepartment() }}">
                </div>
                <div class="form-group">
                    <label for="start">Check In:</label>
                    <input type="datetime-local" name="start" id="start" required class="form-control" value="{{ $data->start }}">
                </div>
                <div class="form-group">
                    <label for="end">Check Out:</label>
                    <input type="datetime-local" name="end" id="end" required class="form-control" value="{{ $data->end }}">
                </div>
                <div class="form-group">
                    <label for="status">Work From...</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="wfs" @if ($data->status_in === "wfs")
                            selected
                        @endif>WFS</option>
                        <option value="wfh" @if ($data->staus_in === "wfh")
                            selected
                        @endif>WFh</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="remarks">Note</label>
                    <textarea name="remarks" id="remarks" cols="30" rows="10" placeholder="type hit.." class="form-control text-lowercase">{{ $data->remarks }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class='modal-footer'>
        <button type='submit' class='btn btn-sm btn-success'>Update</button>
        <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
    </div>    
</form>