<?php
/*
Template Name: User posts
*/
define('WP_USE_THEMES', false);
get_header();
?>

<div id="user_posts_wrapper">
    <div id="inner_posts_wrapper">
    <h2 id="user_posts_title"><?php the_title(); ?></h2>
    
<?php
if(!is_user_logged_in()) {
    echo "<p>Musisz byc zalogowany, aby zobaczyc swoje posty.</p>";
?>
    
<?php
}
else { 
    $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 10
      );
    
    $my_query = null;
    $my_query = new WP_Query($args);
    
    $user_id = intval(get_current_user_id());
    if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post();
            $current_id = intval(get_the_author_meta("ID"));
                if($user_id == $current_id) { ?>
                    <div class="single_user_post">
                        <h4 class="user_posts_title">
                            <a href="<?php the_permalink()?>"><?php the_title(); ?></a> written on <?php the_date(); ?>
                        </h4>
                        <div class="user_post_content">
                            <?php the_content(); ?>
                        </div>
                        <div class="post_actions">
                            <?php edit_post_link('Edit post'); ?>
                            <a href="<?php echo get_delete_post_link(get_the_ID()); ?>">Delete post</a>
                        </div>
                    </div>
                
                    <?php  }
        endwhile; endif;

    }
    
    //var_dump($com_post);
    //echo "<br><br>";
    //var_dump($comment);
    
?>
    
</div>
</div>

<?php
get_footer();

?>