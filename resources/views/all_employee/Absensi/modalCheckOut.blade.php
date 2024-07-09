<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Attendance</h4>
    </div>

    <div class="modal-body">
        <form action="{{ route('attendance/checkOut/post') }}"   method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" name="name" id="name" value="{{ auth()->user()->id }}">
                    <input type="text" class="form-control" id="name" value="{{ auth()->user()->getFullName() }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="nik" class="control-label col-sm-2">NIK:</label>
                <div class="col-sm-10">
                    <input type="text" name="nik" id="nik" class="form-control" value="{{ auth()->user()->nik }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="position" class="control-label col-sm-2">Position:</label>
                <div class="col-sm-10">
                    <input type="text" name="position" id="position" class="form-control" value="{{ auth()->user()->position }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="department" class="control-label col-sm-2">Department:</label>
                <div class="col-sm-10">
                    <input type="text" name="department" id="department" class="form-control" value="{{ auth()->user()->getDepartment() }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="date">Datetime:</label>
                <div class="col-sm-10">
                    <input type="datetime"name="datetime" class="form-control" id="date" value="{{ $date->toFormattedDateString(). ' ' . $date->toTimeString() }}" readonly>
                </div>               
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="value_work">Work Form:</label>
                <div class="col-sm-10">
                    <input type="text"name="value_work" class="form-control" id="value_work" required readonly value="{{ $attendance->status_in }}">
                </div>               
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-sm" id="modalCheckOut" style="margin-right: 10xp;">Check Out</button>
                    <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal" id="modalClose">Close</button>   
                </div>
            </div>
        </form>       
    </div>
</div>
<script>
    
</script>