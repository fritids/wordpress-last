<?php
    
get_header();

get_sidebar();

?>

<div id="main">
    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>
            <div <?php post_class(); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                
                <?php the_content(''); ?>
                <ul class="meta">
                    <li><?php the_time('F jS, Y'); ?></li>
                    <li>Posted in <?php the_category(); ?></li>
                    <li><?php comments_number('No coments', '1 comment', '% comments'); ?></li>
                </ul>
            </div>
        <?php endwhile; ?>
        
        <div class="pagination">
            <ul>
                <li class="older"><?php previous_posts_link('Older'); ?></li>
                <li class="newer"><?php next_posts_link('Never'); ?></li>
            </ul>
        </div>
        <?php else : ?>
            <h2>Nothing found</h2>
            <p>There is no content to display here.</p>
            <p><a href="<?php echo get_option('home'); ?>">Return to homepage</a></p>
    <?php endif; ?>
            
<?php get_footer(); ?>