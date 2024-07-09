<div class="row">
    <div class="col-lg-12">
        Dear <b>HRD</b>,<br><br>
        Please verify this data.
        <br>
        The following is a list of weekend crew tables, You could find the details in the WIS.    
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
                        <td>
                            @if ($item->approved == 1)
                                Approved
                            @endif
                            @if ($item->approved == 2)
                                Disapproved
                            @endif
                            @if ($item->approved == 0)
                                Pending
                            @endif
                        </td>
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