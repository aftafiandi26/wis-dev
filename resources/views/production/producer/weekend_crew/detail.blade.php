<style>
    table#list {
        font-size: 12px;
    }
    p {
        font-weight: bold;
    }
    .btn-default {
        border-radius: 15px;
    }
    a#approved {
        background-color: greenyellow;
        color: black;
        
    }
    a#approved:hover {
        background-color: rgb(143, 210, 44);
        color: black;
        
    }
    a#disapproved {
        background-color: red;
        color: white;
        
    }
    a#disapproved:hover {
        background-color: rgb(198, 15, 15);
        color: white;
        
    }
    table#list th, td {
        text-align: center;
    }
    .panel-heading {
        text-align: center;
        font-weight: bold;
    }
    span#homan {
        font-style: italic;
        color: red;
    }
</style>

<div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
    <h3 class='modal-title text-center' id='showModalLabel2'>List employes for working on weekends.</h3>
</div>
<div class='modal-body'>
<div class="row">
    <div class="col-lg-12">
        <p>Coordinator : {{ $getId->coordinator()->getFullName() }}</p>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">Form Weekend Crew <span id="homan">(Allowance)</span></div>
                <div class="panel-body table-wrapper">
                    <table class="table table-condensed table-hover table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employes</th>
                                <th>Position</th>
                                <th>Project</th>
                                <th>Work Status</th>
                                <th>Change With:</th>
                                <th>Started</th>
                                <th>ended</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allowances as $key => $allowance)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $allowance->user()->getFullName() }}</td>
                                    <td>{{ $allowance->user()->position }}</td>
                                    <td>{{ $allowance->project }}</td>
                                    <td>{{ strtoupper($allowance->workStat) }}</td>
                                    <td>{{ title_case($allowance->extra) }}</td>
                                    <td>{{ $allowance->start }}</td>
                                    <td>{{ $allowance->end }}</td>
                                    <td>{{ sprintf("%02d:%02d", $allowance->hourly, $allowance->minutely)}}</td>
                                </tr>                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Form Weekend Crew <span id="homan">(Exdo)</span></div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employes</th>
                                <th>Position</th>
                                <th>Project</th>
                                <th>Work Status</th>
                                <th>Change With:</th>
                                <th>Started</th>
                                <th>ended</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exdoed as $key => $exdo)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $exdo->user()->getFullName() }}</td>
                                    <td>{{ $exdo->user()->position }}</td>
                                    <td>{{ $exdo->project }}</td>
                                    <td>{{ strtoupper($exdo->workStat) }}</td>
                                    <td>{{ title_case($exdo->extra) }}</td>
                                    <td>{{ $exdo->start }}</td>
                                    <td>{{ $exdo->end }}</td>
                                    <td>{{ sprintf("%02d:%02d", $exdo->hourly, $exdo->minutely)}}</td>
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>       
    </div>
</div>
</div>

<div class='modal-footer'>
    <a href={{ route('producer/weekend-crew/approved', $getId->id) }} class='btn btn-sm btn-default' id="approved">Approved</a>
    <a href="{{ route('producer/weekend-crew/disapproved', $getId->id) }}" class='btn btn-sm btn-default' id="disapproved">Disapproved</a>
    <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
</div> 