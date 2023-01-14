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

$(document).ready(() => {
    const $toggle_switch =  document.getElementById('theme-switch');
    const $current_theme = localStorage.getItem('theme');
    if (!$current_theme) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
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
});
