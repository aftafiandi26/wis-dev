<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $data->coordinator()->getFullName() }}</b>,<br><br>
        The following is a list of weekend crew tables has been disapproved. 
        <br>
        <br>
        Coordinator : {{ $data->coordinator()->getFullName() }}
        <br>
        Producer : {{ $data->producer()->getFullName() }}
        <br>
        <br>
        <table class="table condensed table" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employes</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($crew as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->user()->getFullName() }}</td>
                        <td>{{ date('Y-m-d', strtotime($item->start)) }}</td>
                        <td>Disapproved By {{ $disapproved }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
    
    <div class="col-lg-12">
        <a href="{!! route('index') !!}">click here to login to WIS</a>
    </div>
</div>