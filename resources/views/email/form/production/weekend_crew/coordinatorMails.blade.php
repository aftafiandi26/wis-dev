<div class="row">
    <div class="col-lg-12">
        Dear <b>{{ $producer->getFullName() }}</b>,<br><br>
        The following is a list of weekend crew tables, You could find the details in the WIS.
        <br>
        <br>
        Coordinator : {{ $coordinator->getFullName() }}
        <br>
        Producer : {{ $producer->getFullName() }}
        <br>
        <br>
        <br>
        <table class="table condensed table" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employes</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($crew as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->user()->getFullName() }}</td>
                        <td>{{ $item->user()->position }}</td>
                        <td>{{ $item->extra }}</td>
                        <td>{{ date('Y-m-d', strtotime($item->start)) }} - {{ date('Y-m-d', strtotime($item->end)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
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
