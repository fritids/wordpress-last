<?php
require_once("../classes/article_class.php");
require_once("../classes/sidebar_page.php");
require_once("../classes/comment_class.php");
require_once("../classes/like_class.php");

session_start();

$page = new SidebarPage();
$page->setTitle("Article");
$page->addStyles(array("styles/article_details.css", "styles/comments.css"));
$page->addScripts(array("scripts/article_view.js","scripts/comment_scripts.js", "ajax scripts/likes_scripts.js"));
$page->getStandardHeaderNav();

//start of content
//displaying article
$article  = new Article();
$article->getArticle($_GET['id']);

//getting comments data
$com = new Comment();
$comments = $com->getComments($_GET['id']);
$org_com = $com->getOrganizedComments($_GET['id']);

echo "<div id='likes_div'>";
echo "<h4>What do you think about an article?</h4>";
if(isset($_SESSION['username'])){
    echo "<input id='like_uid' type='hidden' value='".$_SESSION['userid']."'/>";
    echo "<input id='like_aid' type='hidden' value='".$_GET['id']."'/>";
}

$like = new Like($_GET['id']);
$likeCount = $like->getLikesCount();

//getting like information
if(isset($_SESSION['userid'])) {

    $likeType = $like->checkLike($_SESSION['userid']);

    if($likeType=="0") {
        echo "<button class='like_button' type='button' id='like_up'>Good</button>";
        echo "<button class='like_button' type='button' id='like_down'>Bad</button>";
    }
    else {
        if($likeType=="U") {
            echo "<button type='button' class='like_button checked_like' id='like_up'>Good</button>";
            echo "<button class='like_button' type='button' id='like_down'>Bad</button>";
        }
        if($likeType=="D") {
            echo "<button class='like_button' type='button' id='like_up'>Good</button>";
            echo "<button type='button' class='like_button checked_like' id='like_down'>Bad</button>";
        }
    }
}
else {
    echo "<button class='like_button' type='button' id='like_up'>Good</button>";
    echo "<button class='like_button' type='button' id='like_down'>Bad</button>";
}

$score = $likeCount['Positive']-$likeCount['Negative'];
echo "<h4 id='score_header'>Overall score: ";
if($score>0)
    echo "<p class='like_score' id='like_score_pos'>+".$score."</p>";
else if($score==0)
    echo "<p class='like_score' id='like_score_neu'>".$score."</p>";
else
    echo "<p class='like_score' id='like_score_neg'>".$score."</p>";
echo "</h4></div>";

//recursive function to display nested comments
echo "<div id='comments'>";
echo "<a id='coms'></a>";
echo "<h2>Comments</h2><br>";

if(count($org_com)>0) {
    foreach($org_com as $comment) {
       $com->displayNestedComments($comment);
    }
}
else {
    echo "<h3> There are no comments yet. Be the first!</h3>";
}

echo "</div>";

//new comment form
echo "<div id='comment_add'>";
echo "<h3 id='add_comment_header'>Add comment</h3>";
echo "<form action='submit_comment.php' method='POST'>
      <input type='hidden' id='add_pid' name='add_pid' value='-1'/>
      <input type='hidden' name='add_aid' value='".$_GET['id']."'/>
      <textarea name='add_content' required></textarea><br>
      <input class='submit_reply' id='submit_comment' type='submit' value='Add comment'/>
      </form>";
echo "</div>";

//ending page content
$page->endContent();

$page->openSidebar();
$page->closeSidebar();

$page->getStandardFooterEnd();
?>