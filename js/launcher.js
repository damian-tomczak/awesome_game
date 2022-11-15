var slideIndex = 1;

function formatTime($var) {
    return ("0" + $var).slice(-2);
}

function updateClock() {
    const $time = new Date($.now());
    $("#clock").text(formatTime($time.getHours()) +
        ":" + formatTime($time.getMinutes()) +
        ":"+ formatTime($time.getSeconds()));
    $("#date").text(formatTime($time.getDate()) +
        "-" + formatTime($time.getUTCMonth()+1) +
        "-" + formatTime($time.getUTCFullYear()));
}


function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
    else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
    }
}

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    console.log(av_colors);
    var i;
    var x = document.getElementsByClassName("slides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    x[slideIndex-1].style.display = "block";
}

$(document).ready(() => {
    if (localStorage.hasOwnProperty('color')) {
        $("#color").val(localStorage.getItem('color'));
    }
    else {
        $("#color").text("red");
    }
    const $toggle_switch =  document.getElementById('theme-switch');
    const $current_theme = localStorage.getItem('theme');
    if ($current_theme) {
        document.documentElement.setAttribute('data-theme', $current_theme);
        if ($current_theme === 'dark') {
            $toggle_switch.checked = true;
        }
    }
    $toggle_switch.addEventListener('change', switchTheme, false);
    updateClock();
    setInterval(() => {
        updateClock()
    }, 1000);
    $(document).on('click', '#logout', function () {
        console.log("123");
        location.href = "../logout.php";
    });
    showDivs(slideIndex);
});
