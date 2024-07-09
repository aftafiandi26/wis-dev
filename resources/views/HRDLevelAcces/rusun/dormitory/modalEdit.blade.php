<form action="{{ route('hr/management/dorm/update', $data->id) }}" method="post">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dormitory</h4>
    </div>
    <div class="modal-body"> 
      <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="employee">Employee</label>
                <input type="text" name="employee" id="employee" class="form-control" value="{{ $data->getUser()->getFullName() }}" readonly>
              </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" value="{{ $data->getUser()->nik }}" readonly>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" name="department" id="department" class="form-control" value="{{ $data->getUser()->getDepartment() }}" readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="{{ $data->getUser()->position }}" readonly>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="block">Block</label>
                <select name="block" id="block" class="form-control">                    
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" @if ($data->room_block === $i)
                            selected
                        @endif>TB0{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="room">Room</label>
                <input type="number" name="room" id="room" min="0" class="form-control" placeholder="0" value="{{ $data->room_number }}">
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="status">Status Room</label>
                <select name="status" id="status" class="form-control">
                    <option value="Single Free" @if ($data->room_stat === "Single Free")
                        selected
                    @endif>Single Free</option>
                    <option value="Sharing" @if ($data->room_stat === "Sharing")
                        selected
                    @endif>Sharing</option>
                    <option value="Single Paid" @if ($data->room_stat === "Single Paid")
                        selected
                    @endif>Single Paid</option>
                </select>
            </div>
        </div>
      </div>
      
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success">Change</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</form>