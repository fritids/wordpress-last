<?php
get_header();
get_sidebar();
?>

<div id="content">
    <?php
        $id = $_GET['p'];
        echo $id;
        $post = wp_get_post($id);
        
        echo "<h2>" . $post->post_title . "</h2>";
    ?>
            
</div>

