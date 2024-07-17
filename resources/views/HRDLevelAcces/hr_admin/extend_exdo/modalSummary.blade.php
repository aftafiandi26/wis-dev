<div class="modal-content" >
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
                                <th colspan="6" style="background-color: whitesmoke; text-align: center;">Form Extended of Exdo</th>
                            </tr>
                            <tr>
                                <th>Requestor</th>
                                <th>Producer</th>
                                <th>General Manager</th>
                                <th>Expired</th>
                                <th>Amount</th>
                                <th>Changed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $data->getUser($data->create_by)->getFullName() }}</td>
                                <td>{{ $data->getUser($data->producer_id)->getFullName() }} - <small><i style="color: green;" >Approved</i></small></td>
                                <td>{{ $data->getUser($data->gm_id)->getFullName() }} - <small><i style="color: green;" >Approved</i></small></td>
                                <td>{{ $data->expired }}</td>
                                <td>{{ $data->initial_leave()->initial }}</td>
                                <td>{{ $data->change_to }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th colspan="5" style="background-color: whitesmoke; text-align: center;">Remark Tables</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Expired</th>
                                <th>Changed</th>
                                <th>Status</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coutless as $key => $cout)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $cout->expired }}</td>
                                    <td>{{ $cout->change_to }}</td>
                                    <td>
                                        @if ($cout->ap_producer == 0 and $cout->ap_gm == 0 and $cout->ver_hr == 0)
                                            {{ $cout->getUser($cout->producer_id)->getFullName() }} | Pending
                                        @endif
                                        @if ($cout->ap_producer == 1and $cout->ap_gm == 0 and $cout->ver_hr == 0)
                                            {{ $cout->getUser($cout->ap_gm)->getFullName() }} | Pending
                                        @endif
                                        @if ($cout->ap_producer == 1and $cout->ap_gm == 1 and $cout->ver_hr == 0)
                                            HR Verifying
                                        @endif
                                        @if ($cout->ap_producer == 1and $cout->ap_gm == 1 and $cout->ver_hr == 1)
                                            Successed
                                        @endif
                                    </td>
                                    <td>{{ $cout->initial_leave()->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</div>