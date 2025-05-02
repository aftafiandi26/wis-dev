<style>
    #showingFeel {
        max-height: auto;
        background: #f5f5f5;
        text-align: center;
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
        font-family: 'Open Sans', sans-serif;
    }

    #showingFeel section {
        padding: 100px;
        box-sizing: border-box;
        height: 100%;
    }

    #showingFeel p {
        margin: 40px 0;
    }

    /* Buttons */
    #showingFeel input {
        display: none;
    }

    #showingFeel label {
        background: #FFCD00;
        border: 0;
        color: #B57700;
        padding: 15px;
        min-width: 60px;
        font-size: 18px;
        font-weight: bold;
        margin: 10px
    }

    /* Smiley */
    #showingFeel .smiley {
        background: linear-gradient(135deg, rgb(255, 233, 25) 0%, rgb(251, 192, 0) 100%);
        border-radius: 100%;
        padding: 25px;
        position: relative;
        width: 120px;
        height: 120px;
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(calc(-50% - 121px));
        box-shadow: rgba(211, 165, 110, 0.498039) 0px 30px 30px 1px, rgb(245, 245, 245) 0px 20px 10px 1px;
        margin-top: 30%;
    }

    #showingFeel .mouth {
        width: 60%;
        height: 30%;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 100px;
        border-bottom-right-radius: 100px;
        box-sizing: border-box;
        position: absolute;
        bottom: 18%;
        left: 50%;
        margin-left: -30%;
        background: #B57700;
        transition: all 300ms cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    #showingFeel .eyes {
        width: 100%;
        margin-top: 15%;
        box-sizing: border-box;
        padding: 0 5px;
        transition: all 300ms cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    #showingFeel .eyes .eye {
        width: 20px;
        height: 20px;
        background: #B57700;
        float: left;
        border-radius: 100%;
        position: relative;
    }

    #showingFeel .eyes .eye:nth-of-type(2) {
        float: right;
    }

    #showingFeel .eyes .eye::after {
        content: "";
        display: block;
        position: absolute;
        width: 0%;
        height: 0%;
        background: #fed800;
        transform: rotate(0deg);
        top: -15px;
        left: 5px;
        transition: all 300ms cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    #showingFeel .eyes .eye:first-of-type::after {
        transform: rotate(0deg);
        left: auto;
        right: 5px;
    }

    /* Normal animation */
    #showingFeel .smiley.normal .mouth,
    #normal[type=radio]:checked~.smiley .mouth {
        border-top-left-radius: 100px;
        border-top-right-radius: 100px;
        border-bottom-left-radius: 100px;
        border-bottom-right-radius: 100px;
        height: 10%;
        width: 40%;
        bottom: 25%;
        margin-left: -20%;
    }

    .smiley.normal .eyes,
    #normal[type=radio]:checked~.smiley .eyes {
        margin-top: 30%
    }

    /* angry animation */
    .smiley.angry .mouth,
    #angry[type=radio]:checked~.smiley .mouth {
        width: 40%;
        height: 20%;
        border-top-left-radius: 100%;
        border-top-right-radius: 100%;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        bottom: 18%;
        left: 50%;
        margin-left: -20%;
        border-bottom: 0;
    }

    .smiley.angry .eyes,
    #angry[type=radio]:checked~.smiley .eyes {
        margin-top: 35%
    }

    .smiley.angry .eye::after,
    #angry[type=radio]:checked~.smiley .eye::after {
        width: 120%;
        height: 50%;
        transform: rotate(-35deg);
        top: -3px;
        left: -5px;
        border-radius: 0;
    }

    .smiley.angry .eye:first-of-type::after,
    #angry[type=radio]:checked~.smiley .eye:first-of-type::after {
        transform: rotate(35deg);
        left: auto;
        right: -5px;
    }

    /* Furious copy of angry */
    .smiley.furious .mouth,
    #furious[type=radio]:checked~.smiley .mouth {
        width: 40%;
        height: 20%;
        border-top-left-radius: 100%;
        border-top-right-radius: 100%;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        bottom: 18%;
        left: 50%;
        margin-left: -20%;
        border-bottom: 0;
    }

    .smiley.furious .eyes,
    #furious[type=radio]:checked~.smiley .eyes {
        margin-top: 35%
    }

    .smiley.furious .eye::after,
    #furious[type=radio]:checked~.smiley .eye::after {
        width: 120%;
        height: 50%;
        transform: rotate(-35deg);
        top: -3px;
        left: -5px;
        border-radius: 0;
    }

    .smiley.furious .eye:first-of-type::after,
    #furious[type=radio]:checked~.smiley .eye:first-of-type::after {
        transform: rotate(35deg);
        left: auto;
        right: -5px;
    }

    /* */
    .smiley.happy .mouth,
    #happy[type=radio]:checked~.smiley .mouth {
        animation: move-mouth-down 6s;
        animation-delay: 5s;
        animation-iteration-count: infinite;
    }

    #showingFeel @keyframes move-mouth-down {
        0% {
            bottom: 18%;
        }

        4.55% {
            bottom: 16%;
        }

        8.45% {
            bottom: 16%;
        }

        13% {
            bottom: 18%;
        }

        100% {
            bottom: 18%;
        }
    }

    .smiley.happy .eyes,
    #happy[type=radio]:checked~.smiley .eyes {
        animation: move-eyes-down 6s;
        animation-delay: 5s;
        animation-iteration-count: infinite;
    }

    #showingFeel @keyframes move-eyes-down {
        0% {
            margin-top: 15%;
        }

        4.55% {
            margin-top: 19%;
        }

        8.45% {
            margin-top: 19%;
        }

        13% {
            margin-top: 15%;
        }

        100% {
            margin-top: 15%;
        }
    }

    .smiley.happy .eye:nth-of-type(2),
    #happy[type=radio]:checked~.smiley .eye:nth-of-type(2) {
        height: 20px;
        margin-top: 0;
        animation: wink 6s;
        animation-delay: 5s;
        animation-iteration-count: infinite;
    }

    #showingFeel @keyframes wink {
        0% {
            height: 20px;
            margin-top: 0;
        }

        3.9% {
            height: 3px;
            margin-top: 8px;
        }

        9.1% {
            height: 3px;
            margin-top: 8px;
        }

        13% {
            height: 20px;
            margin-top: 0;
        }

        100% {
            height: 20px;
            margin-top: 0;
        }
    }

    .smiley.normal .eye,
    #normal[type=radio]:checked~.smiley .eye {
        height: 20px;
        margin-top: 0;
        animation: blink 6s;
        animation-delay: 5s;
        animation-iteration-count: infinite;
    }

    #normal[type=radio]:checked~.squiggle {
        color: transparent;
    }

    #showingFeel @keyframes blink {
        0% {
            height: 20px;
            margin-top: 0;
        }

        3.25% {
            height: 2px;
            margin-top: 8px;
        }

        6.5% {
            height: 20px;
            margin-top: 0;
        }

        9.75% {
            height: 2px;
            margin-top: 8px;
        }

        13% {
            height: 20px;
            margin-top: 0;
        }

        100% {
            height: 20px;
            margin-top: 0;
        }
    }

    .smiley.angry .eyes,
    .smiley.angry .mouth,
    #angry[type=radio]:checked~.smiley .eyes,
    #angry[type=radio]:checked~.smiley .mouth {
        animation: move-angry-head 6s;
        animation-delay: 5s;
        animation-iteration-count: infinite;
    }

    @keyframes move-angry-head {
        0% {
            transform: translateX(0%);
        }

        2.6% {
            transform: translateX(-20%);
        }

        5.2% {
            transform: translateX(15%);
        }

        7.8% {
            transform: translateX(-10%);
        }

        10.4% {
            transform: translateX(5%);
        }

        13% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(0%);
        }
    }

    /* Furious */
    .smiley.furious .eyes,
    .smiley.furious .mouth,
    #furious[type=radio]:checked~.smiley .eyes,
    #furious[type=radio]:checked~.smiley .mouth {
        animation: move-angry-head 6s;
        animation-delay: 5s;
        animation-iteration-count: infinite;
    }

    #furious[type=radio]:checked~.smiley .steam-container {
        display: block;
    }

    @keyframes move-angry-head {
        0% {
            transform: translateX(0%);
        }

        2.6% {
            transform: translateX(-20%);
        }

        5.2% {
            transform: translateX(15%);
        }

        7.8% {
            transform: translateX(-10%);
        }

        10.4% {
            transform: translateX(5%);
        }

        13% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(0%);
        }
    }

    /* STEAM */
    .steam-container {
        position: relative;
        width: 100px;
        height: 0px;
        top: -40px;
        display: none;
    }

    .squiggle-container {
        width: 10px;
        height: 30px;
        display: inline-block;
    }

    .squiggle-container-1 {
        transform: translate(-10px, 20px);
    }

    .squiggle-container-1 .squiggle {
        animation: move-and-fade 2.5s linear infinite;
        animation-delay: 0.2s;
        width: 10px;
    }

    @keyframes move-and-fade {
        0% {
            opacity: 0;
            transform: translate(0, 10px);
        }

        50% {
            opacity: 1;
        }

        75% {
            opacity: 0;
        }

        100% {
            transform: translateY(100px);
            opacity: 0;
        }
    }

    .squiggle-container-2 {
        transform: translateY(10px);
    }

    .squiggle-container-2 .squiggle {
        animation: move-and-fade 2.5s linear infinite;
        animation-delay: 0s;
        width: 10px;
    }

    @keyframes move-and-fade {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        50% {
            opacity: 1;
        }

        75% {
            opacity: 0;
        }

        100% {
            transform: translateY(-20px);
            opacity: 0;
        }
    }

    .squiggle-container-3 {
        transform: translate(10px, 20px);
    }

    .squiggle-container-3 .squiggle {
        animation: move-and-fade 2.5s linear infinite;
        animation-delay: 0.4s;
        width: 10px;
    }

    @keyframes move-and-fade {
        0% {
            opacity: 0;
            transform: translateY(0);
        }

        50% {
            opacity: 1;
        }

        75% {
            opacity: 0;
        }

        100% {
            transform: translateY(-15px);
            opacity: 0;
        }
    }

    .squiggle {
        stroke-dasharray: 100;
    }

    .squiggle path {
        stroke: #fc635d;
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        50% {
            stroke-dashoffset: 500;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    h4#feelText {
        /* margin-top: -15%; */
    }
</style>

<div class="modal-content" id="showingFeel">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="modalClose">&times;</button>

    </div>
    <div class="modal-body">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

        <input id="happy" type="radio" name="smiley" value="Happy">
        <label for="happy">:)</label>
        <input id="normal" type="radio" name="smiley" value="Normal">
        <label for="normal">:|</label>

        <div class="smiley">
            <div class="steam-container">
                <div class="squiggle-container squiggle-container-1">
                    <div class="squiggle">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.1 80.6"
                            style="enable-background:new 0 0 28.1 80.6;" xml:space="preserve">
                            <path class="" fill="none" stroke-width="11" stroke-linecap="round"
                                stroke-miterlimit="10"
                                d="M22.6,75.1c-8-5.6-15.2-10.5-15.2-19.9c0-12.1,14.1-17.2,14.1-29.6c0-9.1-6.7-15.7-16-20.1" />
                        </svg>
                    </div> <!-- end .squiggle-->
                </div>
                <div class="squiggle-container squiggle-container-2">
                    <div class="squiggle">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.1 80.6"
                            style="enable-background:new 0 0 28.1 80.6;" xml:space="preserve">
                            <path class="" fill="none" stroke="#fff" stroke-width="11" stroke-linecap="round"
                                stroke-miterlimit="10"
                                d="M22.6,75.1c-8-5.6-15.2-10.5-15.2-19.9c0-12.1,14.1-17.2,14.1-29.6c0-9.1-6.7-15.7-16-20.1" />
                        </svg>
                    </div> <!-- end .squiggle-->
                </div>
                <div class="squiggle-container squiggle-container-3">
                    <div class="squiggle">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.1 80.6"
                            style="enable-background:new 0 0 28.1 80.6;" xml:space="preserve">
                            <path class="" fill="none" stroke="#fff" stroke-width="11" stroke-linecap="round"
                                stroke-miterlimit="10"
                                d="M22.6,75.1c-8-5.6-15.2-10.5-15.2-19.9c0-12.1,14.1-17.2,14.1-29.6c0-9.1-6.7-15.7-16-20.1" />
                        </svg>
                    </div> <!-- end .squiggle-->
                </div>
            </div>

            <div class="eyes">
                <div class="eye"></div>
                <div class="eye"></div>
            </div>
            <div class="mouth"></div>

        </div>

        @if ($bitFeel == 'feel')
            <h4 id="feelText">Hi {{ auth()->user()->getFullName() }}, are you feeling better?</h4>
        @elseif ($bitFeel == 'health')
            <h4 id="feelText">Hi {{ auth()->user()->getFullName() }}, has your health improved?</h4>
        @else
            <h4>**************************</h4>
        @endif

    </div>
    <div class="modal-footer">
        <a class="btn btn-sm btn-success pull-left" id="checkYes" data-toggle="modal" data-target="#showModal1"
            data-role="{{ route('attendance/checkInYes') }}">Yes, i'm ok!</a>
        <a class="btn btn-sm btn-warning pull-right" id="checkYes" data-toggle="modal" data-target="#showModal1"
            data-role="{{ route('attendance/checkInNo') }}">No, i'm not ok!</a>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("button#modalClose").on('click', function() {
            location.reload();
        });

        $(document).on('click', 'a[id="checkYes"]', function(e) {

            var id = $(this).attr('data-role');
            $.ajax({
                url: id,
                success: function(e) {
                    $('div#showModal').modal('hide');
                    $("#modal-content-1").html(e);
                    $('.checkIn-select2-element').select2();
                }
            });

        });
    });
</script>
