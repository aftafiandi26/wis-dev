@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade in">
        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif