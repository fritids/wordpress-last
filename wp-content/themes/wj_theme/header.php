<?php
?>
<!DOCTYPE HTML>
<head>
    <title><?php wp_title("", true);?> | <?php bloginfo('name'); ?></title>
    <meta charset=<?php bloginfo('charset'); ?>/>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>"/>
    <?php wp_head(); ?>
</head>

<body>
    <div id="main_header">
        <div id="banner">
            <div id="header_banner">
                To jest baner tytulowy
            </div>
            <div id="header_links_wrap">
                <a class="header_links" href="http://localhost/wordpress/wp-login.php">Logowanie</a><br>
                <a class="header_links" href="http://localhost/wordpress/wp-signup.php">Rejestracja</a>
            </div>
        </div>
        <div id="header_ad">
            To jest reklama
        </div>
        <div id="header_msg">
            To jest komunikat
        </div>
    </div>


