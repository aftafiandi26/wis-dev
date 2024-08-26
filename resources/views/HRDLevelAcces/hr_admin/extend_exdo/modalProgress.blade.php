<style>
    .color-green {
        color: green;
    }
    .color-red {
        color: red;
    }
</style>

<div class="modal-content" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $data->getUser($data->user_id)->getFullName() }} Exdo</h4>
    </div>
    <div class="modal-body" style="height: 450px;">
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
                                <td>{{ $data->getUser($data->producer_id)->getFullName() }} - <small><i class="{{ $styleProducer }}" >{{ $ketProducer }}</i></small></td>
                                <td>{{ $data->getUser($data->gm_id)->getFullName() }} - <small><i class="{{ $styleGM }}">{{ $ketGM }}</i></small></td>
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
                                        @if ($cout->ap_producer == 2 or $cout->ap_gm == 2 or $cout->ver_hr == 2)
                                            Disapproved
                                        @endif
                                        @if ($cout->ap_producer == 0 and $cout->ap_gm == 0 and $cout->ver_hr == 0)
                                            {{ $cout->getUser($cout->producer_id)->getFullName() }} | Pending
                                        @endif
                                        @if ($cout->ap_producer == 1 and $cout->ap_gm == 0 and $cout->ver_hr == 0)
                                            {{ $cout->getUser($cout->gm_id)->getFullName() }} | Pending
                                        @endif
                                        @if ($cout->ap_producer == 1 and $cout->ap_gm == 1 and $cout->ver_hr == 0)
                                            HR Verifying
                                        @endif
                                        @if ($cout->ap_producer == 1 and $cout->ap_gm == 1 and $cout->ver_hr == 1)
                                            Approved
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
        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#showModalReminder">reminder</a>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

<div id="showModalReminder" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('hrd/exdo-extended/reminders') }}" method="post" id="formSentReminder">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">To:</label>
                        <input type="email" name="email" id="email" class="form-control" readonly value="dede.aftafiandi@infinitestudios.id">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                    </div>
                    <div class="form-group">
                        <label for="messages">Message Note:</label>
                        <textarea name="message" id="message" cols="10" rows="10" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" id="sentReminder">Sent</button>
            <button type="button" class="btn btn-default btn-sm" id="disCLoseRemind">Close</button>
            </div>
        </div>  
    </div>
</div>

<script>
    $(document).ready(function() {
        $('button#sentReminder').on('click', function(e) {
            e.preventDefault();
            $('form#formSentReminder').submit();
        });

        $('button#disCLoseRemind').on('click', function (e) {
            e.preventDefault();
            $('#showModalReminder').modal('hide');
        });
    });
</script>