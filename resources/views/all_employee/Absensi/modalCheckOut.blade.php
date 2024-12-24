<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Attendance</h4>
    </div>

    <div class="modal-body">
        <form action="{{ route('attendance/checkOut/post') }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-condensed table-borderles table-light">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <th>: {{ auth()->user()->getFullName() }}</th>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <th>: {{ auth()->user()->nik }}</th>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <th>: {{ auth()->user()->position }}</th>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <th>: {{ auth()->user()->getDepartment() }}</th>
                            </tr>
                            <tr>
                                <td>Date & Time</td>
                                <th>: {{ $date->toFormattedDateString() . ' ' . $date->toTimeString() }}</th>
                            </tr>
                            <tr>
                                <td>Work From</td>
                                <th>: <span id="value_work">{{ $attendance->status_in }}</span></th>
                            </tr>
                            @if (auth()->user()->project_category_id_1)
                                <tr>
                                    <td>Project Selection</td>
                                    <th>:
                                        <select name="project" id="projects">
                                            @foreach ($viewProjects as $index => $project)
                                                @if ($project)
                                                    <option value="{{ $viewIdProjects[$index] }}"
                                                        @if ($attendance->relationsQuest->group == $viewIdProjects[$index]) selected
                                                        @else
                                                        disabled @endif>
                                                        {{ $project }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        </select>
                                    </th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="reset" class="btn btn-default btn-sm  pull-right" data-dismiss="modal"
                        id="modalClose">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm  pull-right" style="margin-right: 5px;"
                        id="modalCheckOut" style="margin-right: 10xp;">Check Out</button>
                </div>
            </div>
            <div class="row" hidden>
                <input type="text"name="value_work" class="form-control" id="value_work_input" hidden
                    value="{{ $attendance->status_in }}">

            </div>
        </form>
    </div>
</div>
<script></script>
