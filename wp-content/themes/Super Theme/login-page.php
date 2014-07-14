<?php
/*
Template Name: Login page
*/

get_header();?>
<div id="login_page_wrapper">
<?php
if(is_user_logged_in()) {
    ?>

    <div id="login_info">
        <p>Jesteś już zalogowany</p>
        <p>Przejdź do <a href="<?php echo home_url(); ?>">strony głównej</a></p>
    </div>
<?php
}
else { ?>
    <div id="form_wrapper">
        <form action="" method="POST">
            <h2><?php the_title(); ?></h2>
            <p>
                <label for="login">Nazwa uzytkownika/hasło:<br>
                <input class="login_input" type="text" name="login" required/>
                </label>
            </p>
            <p>
                <label for="password">Hasło:<br>
                <input class="login_input" type="password" name="password" required/>
                </label>
            </p>
            <input type="submit" class="login_submit" name="log_in" value="Zaloguj"/><br>
            <a href="">Przypomnij hasło</a>
        </form>

        <div id="login_option_div">
            <p>Nie masz konta?</p>
            <p><a href="#" id="register_btn">Zarejestruj się</a></p>
        </div>
    </div>
<?php }

if(isset($_POST['log_in'], $_POST['login'], $_POST['password'])) {
    $creds = array(
        'user_login' => $_POST['login'],
        'user_password' => $_POST['password'],
        'remember' => 'true',
    );
    
    $user = wp_signon($creds, false);
    if(is_wp_error($user)) {
        echo "<div id='error_div'>"
        . "<p>" . $user->get_error_message() . "</p>"
        . "</div>";
    }
    else {
        wp_redirect(home_url());
    }
}?>
</div>
<?php
get_footer();

?>