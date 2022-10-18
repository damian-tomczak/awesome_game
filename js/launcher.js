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

$(document).ready(() => {
    updateClock();
    setInterval(() => {
        updateClock()
    }, 1000);
});
