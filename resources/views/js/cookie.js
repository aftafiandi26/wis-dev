function setCookie(name, value, daysToExpire) {
    var expires = "";
    if (daysToExpire) {
        var date = new Date();
        date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

// Contoh penggunaan
// setCookie("username", "john_doe", 7);  // Membuat cookie "username" dengan nilai "john_doe" yang akan kadaluwarsa dalam 7 hari

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

// Contoh penggunaan
//var username = getCookie("username");  // Mendapatkan nilai cookie "username"


function deleteCookie(name) {
    setCookie(name, "", -1);  // Mengatur masa berlaku cookie menjadi masa lalu, sehingga browser akan menghapusnya
}

// Contoh penggunaan
// deleteCookie("username");  // Menghapus cookie "username"
