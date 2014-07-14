$(function() {
    
    var clicked = false;
    $("#source").on('change', function() {
        var value = $("#source").val();
        if(value=="link") {
            var appended = "<label for='link'>Link: <input type='text' name='link' /></label>";
            $("#source_options").empty();
            $("#source_options").append(appended);
        }
        else if(value=="paper") {
            var appended = "<label for='paper_title'>Tytuł: <input type='text' name='paper_title' /></label><label for='issue'>Numer wydania: <input type='text' name='issue' /></label>";
            $("#source_options").empty();
            $("#source_options").append(appended);
        }
        else {
            $("#source_options").empty();
        }
    });
});


