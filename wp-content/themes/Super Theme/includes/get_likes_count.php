<?php

require("like_class.php");

function get_count($aid) {
    $like = new Like($aid);
    $result = $like->getLikesCount();
    
    echo $result;
}

if(isset($_POST['articleid'])) {
    get_count($_POST['articleid']);
}

