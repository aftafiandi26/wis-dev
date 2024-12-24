<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $user->getFullName() }}</h4>
    </div>
    <div class="modal-body">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12">
                <form action="{{ route('hrd/project-group/project1', $user->id) }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <label for="project1">Project 1:</label>
                    <select name="project1" id="project1" class="form-control">
                        <option value=""></option>
                        @foreach ($projectGroup as $group)
                            <optgroup label="{{ $group->group_name }}">
                                @foreach ($projects as $project)
                                    @if ($project->group === $group->id)
                                        <option value="{{ $project->id }}"
                                            @if ($project->id === $user->project_category_id_1) selected style="color: red;" @endif>
                                            {{ $project->project_name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-default">Update</button>
                </form>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12">
                <form action="{{ route('hrd/project-group/project2', $user->id) }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <label for="project2">Project 2:</label>
                    <select name="project2" id="project2" class="form-control">
                        <option value=""></option>
                        @foreach ($projectGroup as $group)
                            <optgroup label="{{ $group->group_name }}">
                                @foreach ($projects as $project)
                                    @if ($project->group === $group->id)
                                        <option value="{{ $project->id }}"
                                            @if ($project->id === $user->project_category_id_2) selected style="color: red;" @endif>
                                            {{ $project->project_name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-default">Update</button>
                </form>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12">
                <form action="{{ route('hrd/project-group/project3', $user->id) }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <label for="proejct3">Project 3:</label>
                    <select name="proejct3" id="proejct3" class="form-control">
                        <option value=""></option>
                        @foreach ($projectGroup as $group)
                            <optgroup label="{{ $group->group_name }}">
                                @foreach ($projects as $project)
                                    @if ($project->group === $group->id)
                                        <option value="{{ $project->id }}"
                                            @if ($project->id === $user->project_category_id_3) selected style="color: red;" @endif>
                                            {{ $project->project_name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-default">Update</button>
                </form>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12">
                <form action="{{ route('hrd/project-group/project4', $user->id) }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <label for="project4">Project 4:</label>
                    <select name="project4" id="project4" class="form-control">
                        <option value=""></option>
                        @foreach ($projectGroup as $group)
                            <optgroup label="{{ $group->group_name }}">
                                @foreach ($projects as $project)
                                    @if ($project->group === $group->id)
                                        <option value="{{ $project->id }}"
                                            @if ($project->id === $user->project_category_id_4) selected style="color: red;" @endif>
                                            {{ $project->project_name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-default">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
