function fn (e) {
    e.preventDefault();

    let query = $("#country");
    let results = $("#result");
    let uri = "world.php";

    if ($("#show-all:checked").length === 1)
        uri += "?all=true";
    else if (query.val() !== "")
        uri += "?country=" + query.val();

    $.ajax({
        url: uri
    }).done(function (data) {
        results.html(data);
    });
}
