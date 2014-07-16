<?php
?>

<!DOCTYPE HTML>
<head>
    <title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('title');?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/scripts.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/scripts/likes_scripts.js"></script>
    
    <?php if(is_page(36)) { ?>
        <link rel='stylesheet' typr='text/css' href='<?php bloginfo('template_url'); ?>/styles/profile.css' />
    <?php } ?>
    <?php if(is_page(34)) { ?>
        <link rel='stylesheet' typr='text/css' href='<?php bloginfo('template_url'); ?>/styles/login.css' />
    <?php } ?>
    <?php if(is_page(30)) { ?>
        <link rel='stylesheet' typr='text/css' href='<?php bloginfo('template_url'); ?>/styles/register.css' />
    <?php } ?>
    <?php if(is_page(42)) { ?>
        <link rel='stylesheet' typr='text/css' href='<?php bloginfo('template_url'); ?>/styles/add-post.css' />
        <script src="<?php bloginfo('template_url'); ?>/scripts/add-post-scripts.js"></script>
    <?php } ?>
    <?php if(is_page(47) || is_page(50)) { ?>
        <link rel='stylesheet' typr='text/css' href='<?php bloginfo('template_url'); ?>/styles/user-comments-posts.css' />
    <?php } ?>
                    
    <?php if(is_singular()) wp_enqueue_script ('comment-reply'); ?>
    
    <?php wp_head(); ?>
</head>

<body>
    <div id="wrapper">
            <div id="header_wrapper">
                <div id="header_banner">
                    <p><a class="home_page" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>
                </div>
                <div id="user_links">
                        <?php if(!is_user_logged_in()) { ?>
                    <a class="action_link" href="http://localhost/wordpress/?page_id=34">Logowanie</a><br><br>
                            <a class="action_link" href="http://localhost/wordpress/?page_id=30">Rejestracja</a>
                        <?php } else { 
                            $home = home_url();
                            echo "<a class='action_link' href='" . wp_logout_url($home) . "'>Wyloguj</a><br><br>";
                            echo "<a class='action_link' href='http://localhost/wordpress/?page_id=36'>Mój profil</a>";
                        } ?>
                </div>
            </div>
        
        <?php 
                if(is_home()) {
                  $path = get_stylesheet_directory() . "/helpers/get_admin_msg.php";
                  require_once($path);
                  $data = get_admin_msg();

                  if ( $data!=0 ) {
                      echo "<div id='messages_div'>";
                      foreach($data as $msg) {
                          echo "<div class='sigle_message'>";
                          echo "<p>" . $msg['ID']. ". " . $msg['Content'] . "</p>";
                          echo "</div>";          
                      }
                      echo "</div>";
                  }
                }
        ?>
            <div id="content_wrapper">