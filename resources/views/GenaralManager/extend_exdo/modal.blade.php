<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $data->getUser($data->user_id)->getFullName() }} Exdo</h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-condensed table-bordered table-stripped" width="100%">
                        <thead>
                            <tr>
                                <th>Requestor</th>
                                <th>Producer</th>
                                <th>Expired</th>
                                <th>Amount</th>
                                <th>Changed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $data->getUser($data->create_by)->getFullName() }}</td>
                                <td>{{ $data->getUser($data->producer_id)->getFullName() }} - <small><i style="color: green;" >Approved</i></small></td>
                                <td>{{ $data->initial_leave()->expired }}</td>
                                <td>{{ $data->initial_leave()->initial }}</td>
                                <td>{{ $data->expired }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ route('gm/exdo-extended/approval', $data->id) }}" class="btn btn-sm btn-primary">Approval</a>
        <a href="{{ route('gm/exdo-extended/disapproval', $data->id) }}" class="btn btn-sm btn-danger">Disapproval</a>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</div>