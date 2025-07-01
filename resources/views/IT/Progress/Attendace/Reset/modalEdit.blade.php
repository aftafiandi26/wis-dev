<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Attendance</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('dev/attendance/reset/update', $att->id) }}" method="post" id="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nik">NIK:</label>
                        <input type="text" class="form-control" value="{{ $att->relationsUser->nik }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="emp">Employee:</label>
                        <input type="text" class="form-control" value="{{ $att->relationsUser->getFullName() }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="dept">Department:</label>
                        <input type="text" class="form-control" value="{{ $att->relationsUser->getDepartment() }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="start">Check In:</label>
                        <input type="datetime-local" value="{{ $att->start }}" name="start" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end">Check Out:</label>
                        <input type="datetime-local" value="{{ $att->end }}" name="end" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Work From :</label>
                        <select name="status" id="status" class="form-control">
                            <option value="wfs"
                                @if ($att->status_in == 'wfs') @checked(true) @endif>WFS</option>
                            <option value="wfh"
                                @if ($att->status_in == 'wfh') @checked(true) @endif>WFH</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success" id="update">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("button#update").on('click', function(event) {
            event.preventDefault();

            const form = document.getElementById('form'); // Perbaiki di sini
            form.submit();
        });
    });
</script>
