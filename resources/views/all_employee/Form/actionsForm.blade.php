<a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalProject" data-role="{{ route('form/progressing/data/modal', $form->id) }}" title="Detail"><i class="fa fa-file"></i></a>
@if ($form->app_coor == false)
    <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEdit" data-role="{{ route('form/progressing/edit/index', $form->id) }}" title="edit"><i class="fa fa-pencil"></i></a>    

    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDelete" data-role="{{ route('form/progressing/delete', $form->id) }}" title="delete"><i class="fa fa-trash"></i></a> 
@endif