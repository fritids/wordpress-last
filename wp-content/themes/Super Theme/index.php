<?php
    
get_header();

?>
                <div id="main">
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
                    </ol><br>
                    
                    <h3>Wygasające posty</h3>
                    <?php
                    global $wpdb;
                    
                    $results = $wpdb->get_results("SELECT * FROM wp_posts p LEFT JOIN wp_postmeta pm ON p.id = pm.post_id WHERE pm.meta_key = '_expiration-date' ORDER BY pm.meta_value DESC", OBJECT);
                    
                    echo "<ol>";
                    foreach($results as $result) {
                        ?>
                    
                        <li><a href="<?php echo $result->guid; ?>"><?php echo $result->post_title; ?></li>
                    
                    <?php
                    }
                    echo "</ol>";
                    ?>

                    <p><a class="add_post_link" href="http://localhost/wordpress/?page_id=42">Dodaj post</a></p>
                </div>
            
<?php 
    get_sidebar();
    get_footer(); 
?>