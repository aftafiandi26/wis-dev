<form action="{{ route('all_employes/leave/transaction/coordinator/mail/post', $id) }}" method="post">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center text-bold">Reminder</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="from">From:</label>
            <input type="hidden" name="from" id="from" value="{{ $status->email }}" readonly class="form-control">
            <input type="text" id="from" value="{{ auth()->user()->getFullName() }} ['{{ auth()->user()->email }}';]" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="send">To:</label>
            <input type="text" id="email" class="form-control" value="{{ $status->getFullName() }} ['{{}}';]" readonly>
            <input type="hidden" name="send" class="form-control" value="{{ $status->email }}" readonly>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" cols="10" rows="10" class="form-control" required></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Send</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</form>