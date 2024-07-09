<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $gm->getFullName() }}</b>,<br><br>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($crew as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->user()->getFullName() }}</td>
                        <td>{{ date('Y-m-d', strtotime($item->start)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br><br>
        Regard's,<br>
        - WIS -<br><br>
    </div>
    
    <div class="col-lg-12">
        <a href="{!! route('index') !!}">click here to login to WIS</a>
    </div>
</div>