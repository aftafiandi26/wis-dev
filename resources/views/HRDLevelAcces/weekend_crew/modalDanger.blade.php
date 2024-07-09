<style>
    table#list {
        font-size: 12px;
    }
    p {
        font-weight: bold;
    }
    .btn {
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
    a#waiting {
        background-color: cyan;
        color: black;
    }
    a#waiting:hover {
        background-color: rgb(3, 202, 202);
        color: white;
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
        <p>Producer : {{ $getId->producer()->getFullName() }}</p>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-striped table-bordered" id="list">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employes</th>
                    <th>Position</th>
                    <th>Project</th>
                    <th>Started</th>
                    <th>ended</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($works as $key => $work)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $work->user()->getFullName() }}</td>
                        <td>{{ $work->user()->position }}</td>
                        <td>{{ $work->project }}</td>
                        <td>{{ $work->start }}</td>
                        <td>{{ $work->end }}</td>
                        <td>{{ $work->hourly . " Hours, " . $work->minutely . " Minutes" }} </td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<div class='modal-footer'>  
    <a href="{{ route('hrd/weekend-crew/summary/delete/push', $getId->id) }}" class='btn btn-sm btn-danger'>Delete</a>    
    <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
</div> 