<style>
    input[type="range"] {
        -webkit-appearance: none;
        width: 100%;
        height: 8px;
        background: linear-gradient(to right, #ff0000 0%, #ffff00 50%, #00ff00 100%);
        border-radius: 5px;
        outline: none;
        padding: 0;
        margin: 0;
        position: relative;
    }

    /* Styling thumb using pseudo-element */
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: var(--thumb-color, white);
        /* Default color */
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.3s ease;
        position: relative;
        z-index: 2;
    }

    input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: var(--thumb-color, white);
        /* Default color */
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.3s ease;
        position: relative;
        z-index: 2;
    }

    #emoji {
        text-align: center;
    }

    #sticker {
        text-align: center;
    }
</style>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="modalClose">&times;</button>
        <h4 class="modal-title">Form Attendance</h4>
    </div>
    <div class="modal-body">
        <form action="{{ route('attendance/checkin/post') }}" method="post" class="" id="formPost">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="name" id="name"
                                value="{{ auth()->user()->id }}">
                            <input type="text" class="form-control" id="name"
                                value="{{ auth()->user()->getFullName() }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nik" class="control-label col-sm-2">NIK:</label>
                        <div class="col-sm-10">
                            <input type="text" name="nik" id="nik" class="form-control"
                                value="{{ auth()->user()->nik }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="control-label col-sm-2">Position:</label>
                        <div class="col-sm-10">
                            <input type="text" name="position" id="position" class="form-control"
                                value="{{ auth()->user()->position }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="control-label col-sm-2">Department:</label>
                        <div class="col-sm-10">
                            <input type="text" name="department" id="department" class="form-control"
                                value="{{ auth()->user()->getDepartment() }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="date">Datetime:</label>
                        <div class="col-sm-10">
                            <input type="datetime"name="datetime" class="form-control" id="date"
                                value="{{ $date->toFormattedDateString() . ' ' . $date->toTimeString() }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="value_work">Work Form:</label>
                        <div class="col-sm-10">
                            <input type="text"name="value_work" class="form-control" id="value_work" required
                                readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col -lg-12">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="feel">Choose how you're feeling right
                            now?</label>
                        <div class="col-lg-8">
                            <input type="range" value="1" min="1" max="5"
                                oninput="updateSlider(this)" id="colorRange" name="feel" />
                        </div>
                        <div class="col-lg-2" id="emoji"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col -lg-12">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="health">How's your current health status?</label>
                        <div class="col-lg-8">
                            <input type="range" value="1" min="1" max="4"
                                oninput="updateSliderHealth(this)" id="colorHealth" name="health" />
                        </div>
                        <div class="col-lg-2" id="sticker"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="project">What project will you start today?:</label>
                        <select name="project[]" id="project" multiple class="form-control">
                            <option></option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="being">What will you work on the project?:</label>
                        <input type="text" name="being" id="being" class="form-control">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" id="buttonSubmit" style="margin-right: 10xp;">Check
            In</button>
        <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal" id="modalClose">Close</button>
    </div>
</div>

<script>
    function getCookie(name) {
        var nameEQ = name + "=";
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
            if (cookie.indexOf(nameEQ) === 0) return cookie.substring(nameEQ.length, cookie.length);
        }
        return null;
    }

    var work = document.getElementById('value_work');

    work.value = getCookie('checkIn');

    document.getElementById('buttonSubmit').addEventListener('click', function(e) {
        // console.log(123);
        document.getElementById('formPost').submit();
    });


    $(document).ready(function() {
        $('#project').select2({
            placeholder: "What is your current project?",
            allowClear: true,
            maximumSelectionLength: 2
        });
    });

    $("button#modalClose").on('click', function() {
        location.reload();
    });

    function updateSlider(input) {
        const emoji = document.getElementById('emoji');
        const value = parseInt(input.value);
        // Calculate thumb color
        // Calculate thumb color in HEX
        const min = parseInt(input.min);
        const max = parseInt(input.max);
        const percentage = (value - min) / (max - min);

        const red = percentage < 0.5 ? 255 : Math.floor(255 - ((percentage - 0.5) * 2 * 255));
        const green = percentage > 0.5 ? 255 : Math.floor((percentage * 2) * 255);

        // Convert RGB to HEX
        const toHex = (component) => {
            const hex = component.toString(16);
            return hex.length === 1 ? "0" + hex : hex;
        };

        const thumbColor = `#${toHex(red)}${toHex(green)}00`;

        // Apply thumb color and position using CSS variables
        input.style.setProperty('--thumb-color', thumbColor);
        input.style.setProperty('--percentage', percentage);

        if (value == 1) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="` +
                thumbColor + `" fill="#ffb3b3">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8 17C8.91212 15.7856 10.3643 15 12 15C13.6357 15 15.0879 15.7856 16 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 9.01067C7 9.01067 8.40944 8.88341 9.19588 9.50798M9.19588 9.50798L8.93275 10.3427C8.82896 10.6719 9.10031 11 9.4764 11C9.87165 11 10.1327 10.6434 9.92918 10.3348C9.74877 10.0612 9.50309 9.75196 9.19588 9.50798ZM17 9.01067C17 9.01067 15.5906 8.88341 14.8041 9.50798M14.8041 9.50798L15.0672 10.3427C15.171 10.6719 14.8997 11 14.5236 11C14.1283 11 13.8673 10.6434 14.0708 10.3348C14.2512 10.0612 14.4969 9.75196 14.8041 9.50798Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color: ` + thumbColor + `">Very Unpleasant</span>`;
        } else if (value == 2) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="` +
                thumbColor + `" fill="#ffcc99">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 8C7.20949 8.5826 7.77476 9 8.43922 9C9.10367 9 9.66894 8.5826 9.87843 8M14.1216 8C14.3311 8.5826 14.8963 9 15.5608 9C16.2252 9 16.7905 8.5826 17 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 13.5C13.6732 13.5 15.1098 14.4559 15.7297 15.8205C15.9802 16.3718 16.1055 16.6475 15.8889 16.8748C15.6723 17.1022 15.2907 16.9913 14.5274 16.7696C13.8039 16.5595 12.9019 16.3703 12 16.3703C11.0981 16.3703 10.1961 16.5595 9.47257 16.7696C8.70933 16.9913 8.32771 17.1022 8.11112 16.8748C7.89454 16.6475 8.01978 16.3718 8.27026 15.8205C8.89021 14.4559 10.3268 13.5 12 13.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color: ` + thumbColor + `">Unpleasant</span>`;
        } else if (value == 3) {
            emoji.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="#cccc00" fill="#ffffe6">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 16H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 9H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15 9H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color:#666600">Neutral</span>`;
        } else if (value == 4) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="#00e64d" fill="#e6ffcc">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 9C7.20949 9.5826 7.77476 10 8.43922 10C9.10367 10 9.66894 9.5826 9.87843 9M14.1216 9C14.3311 9.5826 14.8963 10 15.5608 10C16.2252 10 16.7905 9.5826 17 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8 15C8.91212 16.2144 10.3643 17 12 17C13.6357 17 15.0879 16.2144 16 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color: #00e64d">Pleasant</span>`;
        } else if (value == 5) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="#3cb371" fill="#e6ffcc">
                <path d="M3.07818 7.5C2.38865 8.85588 2 10.39 2 12.0148C2 17.5295 6.47715 22 12 22C17.5228 22 22 17.5295 22 12.0148C22 10.39 21.6114 8.85588 20.9218 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8 15C8.91212 16.2144 10.3643 17 12 17C13.6357 17 15.0879 16.2144 16 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <ellipse cx="12" cy="4" rx="10" ry="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 10.5C7 9.67154 7.67157 8.99997 8.5 8.99997C9.32843 8.99997 10 9.67154 10 10.5M14 10.4999C14 9.67151 14.6716 8.99994 15.5 8.99994C16.3284 8.99994 17 9.67151 17 10.4999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color: #3cb371">Very Pleasant</span>`;
        }

    }

    function updateSliderHealth(input) {
        const emoji = document.getElementById('sticker');
        const value = parseInt(input.value);
        // Calculate thumb color
        // Calculate thumb color in HEX
        const min = parseInt(input.min);
        const max = parseInt(input.max);
        const percentage = (value - min) / (max - min);

        const red = percentage < 0.5 ? 255 : Math.floor(255 - ((percentage - 0.5) * 2 * 255));
        const green = percentage > 0.5 ? 255 : Math.floor((percentage * 2) * 255);

        // Convert RGB to HEX
        const toHex = (component) => {
            const hex = component.toString(16);
            return hex.length === 1 ? "0" + hex : hex;
        };

        const thumbColor = `#${toHex(red)}${toHex(green)}00`;

        // Apply thumb color and position using CSS variables
        input.style.setProperty('--thumb-color', thumbColor);
        input.style.setProperty('--percentage', percentage);

        if (value == 1) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="` +
                thumbColor + `" fill="#ffb3b3">
                <path d="M9.5 21.685C10.299 21.8906 11.1368 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 12.3375 2.01672 12.6711 2.04938 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M5.02108 14L2.8602 16.0826C1.69974 17.2204 1.71976 19.0523 2.88023 20.1707C4.06071 21.2892 5.96146 21.2699 7.12193 20.1515C8.30241 19.0137 8.2824 17.1818 7.12193 16.0633L5.02108 14Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                <path d="M8.00897 8.4422H8M16 8.4422H15.991" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15 16C14.1644 15.3721 13.1256 15 12 15C11.0893 15 10.2354 15.2436 9.5 15.6692" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color: ` + thumbColor + `">Very Poor</span>`;
        } else if (value == 2) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="` +
                thumbColor + `" fill="#fff7e6">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8 15C8.91212 16.2144 10.3643 17 12 17C13.6357 17 15.0879 16.2144 16 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.00897 9L8 9M16 9L15.991 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color: ` + thumbColor + `">Good</span>`;
        } else if (value == 3) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="#00e64d" fill="#f7ffe6">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 9C7.20949 9.5826 7.77476 10 8.43922 10C9.10367 10 9.66894 9.5826 9.87843 9M14.1216 9C14.3311 9.5826 14.8963 10 15.5608 10C16.2252 10 16.7905 9.5826 17 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8 15C8.91212 16.2144 10.3643 17 12 17C13.6357 17 15.0879 16.2144 16 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> <br> <span style="color: #00e64d">Very Good</span>`;
        } else if (value == 4) {
            emoji.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" color="#e6ffcc" fill="#e6ffe6">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M7 9C7.20949 9.5826 7.77476 10 8.43922 10C9.10367 10 9.66894 9.5826 9.87843 9M14.1216 9C14.3311 9.5826 14.8963 10 15.5608 10C16.2252 10 16.7905 9.5826 17 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 17.5C10 17.5 8 16 7.5 14" stroke="currentColor" stroke-width="1.38889" stroke-linecap="round" stroke-linejoin="round" />
        </svg> <br> <span style="color:#e6ffcc">Excellent</span>`;
        }

    }


    // Initialize the slider with the correct thumb color
    updateSlider(document.getElementById('colorRange'));
    updateSliderHealth(document.getElementById('colorHealth'));
</script>
