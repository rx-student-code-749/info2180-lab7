function fn (e) {
    e.preventDefault();

    let query = $("#country");
    let results = $("#result");
    let uri = "world.php";

    if (query.val() !== "")
        uri += "?q=" + query.val();

    $.ajax({
        url: uri
    }).done(function (data) {
        results.html(data);
    });
}
