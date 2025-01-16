@extends('layout')

@section('title')
    Employee Time Sheet (gm)
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c6101' => 'active',
    ])
@stop

@push('style')
    <style>
        .mb-5 {
            margin-bottom: 5px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }
    </style>
@endpush
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Employee Project Time Sheet</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('gm/employee-time-sheet/dataFilter') }}" method="post" class="form-inline">
                {{ csrf_field() }}
                <label for="">Search :</label>
                <select name="" id="" class="form-control">
                    <option value="6">Production</option>
                </select>
                <label for="month">Date :</label>
                {{-- <select name="month" id="month" class="form-control" required>
                    <option value="">- choose a month -</option>
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}">
                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                        </option>
                    @endforeach
                </select> --}}
                <input type="date" name="start" id="start" class="form-control" required> -
                <input type="date" name="end" id="end" class="form-control" required>
                {{-- <label for="year">Year :</label>
                <select name="year" id="year" class="form-control" required>
                    <option value="">- choose a year -</option>
                    @for ($i = date('Y', strtotime('-1 years')); $i <= date('Y', strtotime('+1 years')); $i++)
                        <option value="{{ $i }}"">
                            {{ $i }}</option>
                    @endfor
                </select> --}}
                <label for="">Counting :</label>
                <select name="counting" id="" class="form-control" required>
                    <option value="">- choosee a counting -</option>
                    <option value="1">Percantage</option>
                    <option value="2">Day</option>
                </select>
                <button type="submit" class="btn btn-sm btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_4')
    @include('assets_script_7')
@stop

@push('js')
    <script>
        $(document).ready(function() {
            // Ambil nilai dari input date
            const startDateInput = document.getElementById('start'); // Input untuk tanggal mulai
            const endDateInput = document.getElementById('end'); // Input untuk tanggal akhir

            // Fungsi untuk memeriksa tanggal
            function validateDates() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                if (endDate < startDate) {
                    alert("Date End cannot be earlier than Date Start!");
                }
            }

            // Event listener untuk memvalidasi saat user mengubah nilai tanggal
            endDateInput.addEventListener('change', validateDates);
            startDateInput.addEventListener('change', validateDates);
        });
    </script>
@endpush
