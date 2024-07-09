<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>   
    <table class="table-borderless">
        <tr>
            <th>Code item</th>
            <th>:</th>
            <th>{{ $water->kode_barang }}</th>
        </tr>
        <tr>
            <th>Period</th>
            <th>:</th>
            <th>{{ date('Y-m') }}-{{ $date }}</th>
        </tr>
    </table>
  </div>
  <div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <table class="table-bordered table-condensed table-striped" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>User</th>
                        <th>Out Stock</th>
                        <th>Description</th>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $water->name_item }}</td>
                            <td>{{ $item->employes }}</td>
                            <td>{{ $item->out_stock }}</td>
                            <td>{{ $item->describe }}</td>
                            <td>
                                <a class="btn btn-xs btn-default" title="edit this transaction" id="edit" href="{{ route('mineral/transaction/edit', [$item->id]) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-xs btn-danger" title="delete this transaction" id="delete" href="{{ route('mineral/transaction/delete', [$item->id]) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>