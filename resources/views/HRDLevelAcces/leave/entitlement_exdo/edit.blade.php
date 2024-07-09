<form action="{{ route('hr/entitlement/exdo/update', [$query->id]) }}" method="post">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $query->user()->getFullName() }}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">Data Employee</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="nik">NIK:</label>
                                    <input type="hidden" name="year" value="{{ date('Y', strtotime($query->expired)) }}">
                                    <input type="text" name="nik" id="nik" class="form-control" value="{{ $query->user()->nik }}">
                                </div>
                                <div class="col-lg-3">
                                    <label for="employee">Employee:</label>
                                    <input type="text" name="employee" id="employee" class="form-control" value="{{ $query->user()->getFullName() }}">
                                </div>
                                <div class="col-lg-3">
                                    <label for="department">Department:</label>
                                    <input type="text" name="department" id="department" class="form-control" value="{{ $query->user()->getDepartment() }}">
                                </div>
                                <div class="col-lg-3">
                                    <label for="position">Position</label>
                                    <input type="text" name="position" id="position" class="form-control" value="{{ $query->user()->position }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Edit Entitlement Exdo</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="expired">Exdo Expired:</label>
                                    <input type="date" name="expired" id="expired" class="form-control" value="{{ $query->expired }}" required>
                                </div>
                                <div class="col-lg-3">
                                    <label for="initial">Entitlement Exdo</label>
                                    <input type="text" name="initial" id="initial" class="form-control" value="{{ $query->initial }}" required>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="note">Note Date</label>
                                    <textarea name="note" id="note" cols="30" rows="10" class="form-control">{{ $query->note }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label for="note2">Note</label>
                                    <textarea name="note2" id="note2" cols="30" rows="10" class="form-control">{{ $query->note2 }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
</form>
