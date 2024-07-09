<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>      
    <h4>Rename Category</h4>
</div>
<form action="{{ route('stationery/atk/category/update', [$category->id]) }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="unique">Unique Number</label>
                <input type="text" name="unique" id="unique" class="form-control" readonly value="{{ $category->unik_kategori }}">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="category">Category: </label>
                <input type="text" name="category" id="category" class="form-control" value="{{ $category->kategori_stock }}">
            </div>  
        </div>  
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-default">Update</button>
        <button type="button" class="btn btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>