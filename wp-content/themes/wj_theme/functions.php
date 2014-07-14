<?php

if(function_exists("register_sidebar")) {
    register_sidebar(array(
        'before_widget' => '<div class="side-box">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}

function custom_login_css() {
    echo "<link rel='stylesheet' type='text/css' href='" . get_stylesheet_directory_uri() . "/login/login-styles.css />";
}

add_action('login_head', 'custom_login_css');