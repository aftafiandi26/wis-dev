<form action="{{ route('employes/profile/modal/post', $id) }}" method="post">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select the project you are currently working on.</h4>
    </div>
    <div class="modal-body">
    
    
        <label for="project">Your Project : {{ $id }}</label>
        <select name="project" id="project" class="form-control">
        @foreach ($allprojects as $item)
            <option value="{{ $item->id }}" @if ($item->id == $project)
                selected
            @endif>{{ $item->project_name }}</option>
        @endforeach
        </select>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success">Change</button>

        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</form>