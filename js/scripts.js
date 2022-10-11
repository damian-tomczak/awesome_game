function loadlink(){
    $('#test').load('test.php');
}

$( document ).ready(function() {
    loadlink();
    setInterval(function() {
        loadlink()
    }, 2000);
});