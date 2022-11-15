function loadlink(){
    $("#test").load("test.php");
}

$(document).ready(() => {
    if (screen.availWidth < 1280 || screen.availHeight < 720) {
        $("html").html("Website doesn't support mobile devices!")
    }
    loadlink();
    setInterval(() => {
        loadlink()
    }, 2000);

    $("#nowplay").click(() => {
        window.location.href = 'login.php';
    });
});