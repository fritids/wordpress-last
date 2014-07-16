<div id="sidebar">
    <?php
    if(!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : ?>
    <div class='side-box'>
        <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
        </ul>
    </div>
    <?php endif; ?>
</div>


