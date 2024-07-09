<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Form Freelance</h4>
    <h5 class="modal-title">
        Created by : {{ title_case($create_by) }} <sup>({{ $freelancer->created_at }})</sup>
    </h5>
</div>
<div class="modal-body">
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <table class="table tabel-condensed table-striped table-bordered table-hover" id="tabelDestroy">
                <tr>
                    <td>Username:</td>
                    <td>{{ $freelancer->username }}</td>
                </tr>
                <tr>
                    <td>Fullname:</td>                  
                    <td>{{ title_case($freelancer->fullname() ) }}</td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td>{{ title_case($freelancer->position) }}</td>
                </tr>
                <tr>
                    <td>Join Date</td>
                    <td>{{ $freelancer->joinDate }}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{ $freelancer->endDate }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>Freelance</td>
                </tr>
                <tr>
                    <td>Project:</td>
                    <td>
                        @foreach ($projects as $project)
                            {{ $project['project'] . ',' }}
                        @endforeach
                    </td>
                </tr>
            </table>         
        </div>
    </div>
</div>
<div class="modal-footer">
    <a class="btn btn-xs btn-danger" id="buttonDelete" href="{{ route('freelance/destroy', $freelancer->id) }}">Yes</a>
    <a class="btn btn-xs btn-default" data-dismiss="modal">No</a>
</div>

