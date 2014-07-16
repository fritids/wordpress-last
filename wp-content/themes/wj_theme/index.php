<?php
get_header();
get_sidebar();
?>
<div id="content">
     <?php $args = array(
        'numberposts' => 10,
        'offset' => 0,
        'category' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'include' => '',
        'exclude' => '',
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'post',
        'post_status' => 'draft, publish, future, pending, private',
        'suppress_filters' => true );
?>
    
    <h3>Najnowsze posty</h3>
    <ol>
        <?php
            $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
            foreach($recent_posts as $recent) {
                echo "<li><a href='" . get_permalink($recent['ID']) . "'>" . $recent['post_title'] . "</a></li><br>";
            }
        ?>
    </ol>
    
    <h3>Najpopularniejsze posty</h3>
    <ol>
        <?php
            $args = array( 'posts_per_page' => 5, 'orderby' => 'comment_count', 'order' => 'DESC' );

            $myposts = get_posts( $args );
            foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title();
        ?>                  
                    </a>
                </li>
        <?php endforeach; 
        wp_reset_postdata();?>
    </ol>
    
    <button id="add_post_btn" type="button">Dodaj post</button>
</div>
<?php get_footer(); ?>