<?php
/*
Template Name: User comments
*/

get_header();?>

<div id="user_comments_wrapper">
    <div id="inner_comments_wrapper">
    <h2 id="user_comments_title"><?php the_title(); ?></h2>
    
<?php
if(!is_user_logged_in()) {
    echo "<p>Musisz byc zalogowany, aby zobaczyc swoje komentarze.</p>";
?>
    
<?php
}
else { 
    $user_id = get_current_user_id();
    $args = array(
	'user_id' => $user_id //return only the count
    );
    $comments = get_comments($args); 
    
    foreach($comments as $comment) {
        $com_post = get_post($comment->comment_post_ID); ?>
        
    <div class="single_user_comment">
        <h4 class="user_comment_title">
            Commented <a href="<?php echo $com_post->guid; ?>"><?php echo $com_post->post_title; ?></a> at <?php echo $com_post->post_date; ?>
        </h4>
        <div class="user_comment_content">
            <?php echo $comment->comment_content; ?>
        </div>
    </div>
        
<?php
    }
    
    //var_dump($com_post);
    //echo "<br><br>";
    //var_dump($comment);
    
}
?>
    
</div>
</div>

<?php
get_footer();

?>