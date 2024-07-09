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
    a#waiting {
        background-color: cyan;
        color: black;
    }
    a#waiting:hover {
        background-color: rgb(3, 202, 202);
        color: white;
    }
    table#list th, td {
        text-align: center;
    }
</style>

<div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
    <h3 class='modal-title text-center' id='showModalLabel2'>Weekend Crew <span id="homan">(Allowance)</span> on <i> on <i>{{ date('Y-m-d', strtotime($works[0]['start'])) }}</i>.</h3>
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
                    <th hidden>Id</th>
                    <th hidden>cekStat</th>
                    <th>Employes</th>
                    <th>Position</th>
                    <th>Project</th>
                    <th>Started</th>
                    <th>ended</th>
                    <th>Work Status</th>
                    <th>Change WIth:</th>
                    <th>Time</th>
                    <th>Approved</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($works as $key => $work)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td hidden>{{ $work->id }}</td>
                        <td hidden>{{ $work->status }}</td>
                        <td>{{ $work->user()->getFullName() }}</td>
                        <td>{{ $work->user()->position }}</td>
                        <td>{{ $work->project }}</td>
                        <td>{{ $work->start }}</td>
                        <td>{{ $work->end }}</td>
                        <td>{{ strtoupper($work->workStat) }}</td>
                        <td>{{ title_case($work->extra) }}</td>
                        <td>{{ sprintf("%02d:%02d", $work->hourly, $work->minutely)}}</td>
                        <td>
                            <select name="pushApp" id="pushApp">
                                <option value="0" @if ($work->approved == false)
                                    selected
                                @endif>Pending</option>
                                <option value="1" @if($work->approved == true)
                                    selected
                                @endif>Yes</option>
                                <option value="2" @if ($work->approved == '2')
                                    selected
                                @endif>No</option>
                            </select>
                        </td>
                    </tr> 
                @endforeach                
            </tbody>
        </table>
    </div>
</div>
</div>
<form id="formPushApp" method="post" hidden>
    {{ csrf_field() }}
</form>
<div class='modal-footer'>
    @if ($getId->ap_producer == true)
        <a href={{ route('gm/working-on-weekends/approved', $getId->id) }} class='btn btn-sm btn-default' id="approved">All Approved [<span id="getApp">{{ $allApproved }}</span>]</a>
        <a href="{{ route('gm/working-on-weekends/disapproved', $getId->id) }}" class='btn btn-sm btn-default' id="disapproved">All Disapproved [ <span id="asd">{{ $allDisapproved }}</span> ]</a>      
    @else
        <a href="#" class='btn btn-sm btn-default' id="waiting">Waiting {{ $getId->producer()->getFullName() }} Approval</a>  
    @endif
    <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
</div> 

<script>
$('select#pushApp').on('change', function () {
    var approved = $(this).val();

    var id = $(this).closest('tr').find('td:eq(1)').text();
    var stat = $(this).closest('tr').find('td:eq(2)').text();
    var csrfToken = document.querySelector('input[name="_token"]').value;
    
    var data = {
        approved: approved,
        id: id,
        stat: stat,
        _token: csrfToken,
    };

    var url = "{{ route('gm/working-on-weekends/ajaxPush') }}";

    $.ajax({
        url: url, // URL tujuan
        method: 'POST',
        data: data, // Data yang dikirim
        dataType: 'json',
        success: function(response) {
            // Tanggapan dari server
            document.getElementById('getApp').innerHTML =  response.allApproved;
            document.getElementById('asd').innerHTML =  response.allDisapproved;
            alert(response.message);
        },
        error: function(xhr, status, error) {
            // Penanganan error
            console.error(xhr.responseText);
        }
    });

});
</script>