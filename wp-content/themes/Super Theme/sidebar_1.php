<?php
?>

<div id="nav">
    <h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
    
    <ul id="pages">
        <li><a href="<?php echo get_option('home');?>">Home</a></li>
        <?php wp_list_pages('title_li='); ?>
    </ul>
    
    <h2>Categories</h2>
    <ul id="categories">
        <?php wp_list_categories('show_count=0&title_li=&hide_empty=0&exclude=1'); ?>
    </ul>
</div>
