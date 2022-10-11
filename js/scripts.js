function loadlink(){
    $('#test').load('test.php');
}

$(document).ready(function() {
    if (screen.availWidth < 1280 || screen.availHeight < 720) {
        $('html').html("Website doesn't support mobile devices!")
    }
    loadlink();
    setInterval(function() {
        loadlink()
    }, 2000);
});