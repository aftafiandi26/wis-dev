<style>
    /* Tambahan styling agar textarea lebih menarik */
    .form-control {
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #66afe9;
        box-shadow: 0 2px 8px rgba(102, 175, 233, 0.6);
    }

    /* Styling tombol yang menarik */
    .btn-custom {
        background-color: #666600;
        /* Warna kuning gelap */
        border-color: #5a5a00;
        color: #ffffff;
        border-radius: 5px;
        transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
    }

    .btn-custom:hover {
        background-color: #808000;
        /* Warna kuning lebih terang saat hover */
        border-color: #737300;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-custom:focus,
    .btn-custom:active,
    .btn-custom.active {
        background-color: #5a5a00;
        /* Warna kuning gelap saat fokus atau aktif */
        border-color: #434300;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        outline: none;
    }

    /* Styling modal agar terpusat */
</style>

<div class="modal-content" id="showingFeel">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="modalClose">&times;</button>

    </div>

    <div class="modal-body" style="text-align: center;">
        <div class="row">
            <div class="col-lg-12">
                <h4>
                    We are sorry to hear that.
                    <br>
                    Could you please elaborate your current situation?
                </h4>
            </div>
        </div>

        <form action="{{ route('attendance/checkInNo/post') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <input type="hidden" name="bitFeel" value="{{ $bitFeel }}">
                    <textarea name="textArea" id="textArea" cols="30" rows="5" class="form-control"
                        placeholder="Please tell me.." required minlength="10"></textarea>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row">
                <div class="col-lg-5"></div>
                <div class="col-lg-2">
                    <button type="submit" class="btn-sm btn-custom">Send</button>
                </div>
                <div class="col-lg-5"></div>
            </div>
        </form>

    </div>

    <div class="modal-footer">

    </div>
</div>

<script>
    $(document).ready(function() {
        $("button#modalClose").on('click', function() {
            location.reload();
        });
    });
</script>
