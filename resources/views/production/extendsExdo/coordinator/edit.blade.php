<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $init->user()->getFullName() }}</h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-condensed table-bordered table-striped" id="tableEdit" width="100%">
                    <thead>
                        <tr>
                            <th>Created</th>
                            <th>Amount</th>
                            <th>Expired</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $init->input_date }}</td>
                            <td>{{ $init->initial }}</td>
                            <td>{{ $init->expired }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('coordinator/exdo-extends/store', $init->id) }}" method="post" class="form-inline" id="formExtends">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="expired">Expired:</label>
                        <input type="date" name="expired" id="expired" class="form-control" value="{{ $init->expired }}">
                    </div>
                    <div class="form-group">
                        <label for="approved">Approval:</label>
                        <select name="approved" id="selectApproval1" class="form-control">
                            <option value=""></option>
                            @foreach ($selectPM as $producer)
                                <option value="{{ $producer->id }}">{{ $producer->getFullName() }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h5>
                    <b>You have a chance <span style="color:red;">{{ 4 - $init->limiter . 'x' }}</span></b>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-condensed table-boredred table-striped" id="tableRecored" width="100%">
                    <thead>
                        <tr>
                            <th>Record Expired</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-primary" id="submitExtend">Submit</button>
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
</div>

<script>
    $(document).ready(function() {
        $('#submitExtend').on('click', function(e) {
            $('#formExtends').submit();
        });
    });
</script>
