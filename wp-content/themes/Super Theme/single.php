<?php

require_once(get_stylesheet_directory() . "/includes/like_class.php");

get_header();

?>
    <div id="post_main">
        <?php if(have_posts()) : 
            while(have_posts()) : the_post();
        ?>
        <div class="post">
            <h2 class="title"><?php the_title(); ?></h2>
            <?php the_content(); 
            
            echo "<div id='likes_div'>";
            echo "<input id='like_uid' type='hidden' value='".  get_current_user_id()."'/>";
            echo "<input id='like_aid' type='hidden' value='".get_the_ID()."'/>";

            $like = new Like(get_the_ID());

            //getting like information
            if(is_user_logged_in()) {
                echo "<h4>What do you think about the post?</h4>";
                $likeType = $like->checkLike(get_current_user_id());

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
            
            echo "<h4 id='score_header'>Overall post score: ";
            echo "<p class='like_score' id='like_score_neu'></p>";
            echo "</h4></div>";


            comments_template(); ?>
        </div>
        <?php
            endwhile;
            endif;
        ?>
    </div>   

<?php get_footer(); ?>

