<?php

require("like_class.php");

function like() {
    $uid = $_POST['userid'];
    $aid = $_POST['articleid'];
    $type = $_POST['liketype'];
        $like = new Like($aid);
        $result = $like->addLike($uid, $type);

        if($result=="1")
            echo "D";
        if($result=="2")
            echo "U";
        if($result=="3")
            echo "A";
}



if(isset($_POST['userid'], $_POST['articleid'], $_POST['liketype'])) {
    like();
}
?>