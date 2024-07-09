<style>
    .text-bold {
        font-weight: bold;
    }

    .table-container {
    overflow-y: auto; /* Aktifkan overflow-y untuk menampilkan scrollbar jika konten lebih panjang dari tinggi maksimum */
    max-height: 300px; /* Atur tinggi maksimum yang diinginkan */
    }

    .table-container table.scroll {
    width: 100%; /* Pastikan tabel memenuhi lebar container */
    border-collapse: collapse; /* Gabungkan garis tepi sel */
    }

    .table-container thead {
    position: sticky; /* Tetapkan posisi thead */
    top: 0; /* Atur posisi thead di bagian atas */
    background-color: #fff; /* Atur warna latar belakang thead */
    }

    .table-container th, .table-container td {
    padding: 8px; /* Atur padding untuk sel */
    border: 1px solid #ddd; /* Atur garis tepi sel */
    }

</style>
<div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
    <h3 class='modal-title text-center' id='showModalLabel2'>List Weekend Crew</h3>
</div>
<div class='modal-body'>
<div class="row">
    <div class="col-lg-12">
        <p class="text-bold">Coordinator : {{ $sent->coordinator()->getFullName() }}</p>
        <p class="text-bold">Producer : {{ $sent->producer()->getFullName() }}</p>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 table-container">
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
                @foreach ($array as $key => $work)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $work['employes']}}</td>
                        <td>{{ $work['position'] }}</td>
                        <td>{{ $work['project'] }}</td>
                        <td>{{ $work['started'] }}</td>
                        <td>{{ $work['ended'] }}</td>
                        <td>{{ $work['time'] }}</td>
                    </tr>
                @endforeach
            </tbody>      
        </table>
    </div>
</div>
</div>

<div class='modal-footer'>  
    <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
</div> 