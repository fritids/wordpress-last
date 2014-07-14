<?php
?>
<div id="clear_float"></div>
<div id="nav">
    <?php 
        $args = array(
            'smallest'                  => 8, 
            'largest'                   => 22,
            'unit'                      => 'pt', 
            'number'                    => 45,  
            'format'                    => 'flat',
            'separator'                 => ', ',
            'orderby'                   => 'name', 
            'order'                     => 'ASC',
            'exclude'                   => null, 
            'include'                   => null, 
            'topic_count_text_callback' => default_topic_count_text,
            'link'                      => 'view', 
            'taxonomy'                  => 'post_tag', 
            'echo'                      => true,
            'child_of'                   => null
        );

        wp_tag_cloud($args);
    ?>
</div>
