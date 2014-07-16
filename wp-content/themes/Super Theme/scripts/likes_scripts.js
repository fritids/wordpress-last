$(function() {
    $(".like_button").on("click", function() {
        //getting like id
        var currentButton = $(this);
        var type = $(this).attr("id");
        var data = null;
        var uid = $("#like_uid").val();
        var aid = $("#like_aid").val();

        //inserting proper data value
        if(type=="like_up") {
            data = "U";
        }
        if(type=="like_down") {
            data = "D";
        }

        //executing ajax query
        if(uid && aid) {
            $.ajax({
                type: "POST",
                url: "http://localhost/wordpress/wp-content/themes/Super Theme/includes/add_like.php",
                data: {userid: uid, articleid: aid, liketype: data}
            })
                .done(function(msg) {
                    //alert(msg);
                    if(msg=="A") {
                        currentButton.addClass("checked_like");
                    }
                    else if(msg=="D") {
                        currentButton.removeClass("checked_like");
                    }
                    else if(msg=="U") {
                        currentButton.addClass("checked_like");
                        if(data=="U") {
                            $("#like_down").removeClass("checked_like");
                        }
                        else {
                            $("#like_up").removeClass("checked_like");
                        }
                    }

                });
                
            $.ajax({
                type: "POST",
                url: "http://localhost/wordpress/wp-content/themes/Super Theme/includes/get_likes_count.php",
                data: {articleid: aid}
            })
                .done(function(msg) {
                    //alert(msg);
                    $("#like_score_neu").text(msg);
                    if(msg<0) {
                        $("#like_score_neu").addClass('score_negative');
                        $("#like_score_neu").removeClass('score_positive');
                    }
                    else if(msg>0) {
                        $("#like_score_neu").addClass('score_positive');
                        $("#like_score_neu").removeClass('score_negative');
                    }
                    else {
                        $("#like_score_neu").addClass('score_neutral');
                        $("#like_score_neu").removeClass('score_negative');
                        $("#like_score_neu").removeClass('score_positive');
                    }
                });
        }

    });
    
    
    var aid = $("#like_aid").val();
    $.ajax({
                type: "POST",
                url: "http://localhost/wordpress/wp-content/themes/Super Theme/includes/get_likes_count.php",
                data: {articleid: aid}
            })
                .done(function(msg) {
                    //alert(msg);
                    $("#like_score_neu").text(msg);
                    if(msg<0) {
                        $("#like_score_neu").addClass('score_negative');
                    }
                    else if(msg>0) {
                        $("#like_score_neu").addClass('score_positive');
                    }
                    else {
                        $("#like_score_neu").addClass('score_neutral');
                    }
                });
});