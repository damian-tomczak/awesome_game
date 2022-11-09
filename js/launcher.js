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
    const $toggleSwitch =  document.getElementById('theme-switch');
    const $currentTheme = localStorage.getItem('theme');
    if ($currentTheme) {
        document.documentElement.setAttribute('data-theme', $currentTheme);
        if ($currentTheme === 'dark') {
            $toggleSwitch.checked = true;
        }
    }
    $toggleSwitch.addEventListener('change', switchTheme, false);
    updateClock();
    setInterval(() => {
        updateClock()
    }, 1000);
    $(document).on('click', '#logout', function () {
        console.log("123");
        location.href = "../logout.php";
    });
});
