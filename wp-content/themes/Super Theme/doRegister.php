<?php
/*
Template Name: Do Register Template
*/
require_once(get_template_directory() . '/recaptchalib.php');

get_header();

var_dump($_POST);

if(isset($_POST["recaptcha_response_field"], $_POST['zarejestruj'], $_POST['username'], $_POST['password'], $_POST['confirm'], $_POST['email'])) {
    $error = false;
}
else {
    $error = true;
    ?>
    <div id="error">
        <p>Nie wypełniłeś wymaganego pola</p>
    </div>
<?php
}

if(!$error) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $birthyear = $_POST['birthyear'];
    $gender = $_POST['gender']; 
    $email = $_POST['email'];
    $localization = $_POST['localization'];
    
    if($password != $confirm) { 
        $error = true;
?>
        <div id="error">
            <p>Podane hasła nie są takie same.</p>
        </div>
<?php   
    }
    
    //checking recaptcha field
    require_once(get_template_directory() . '/recaptchalib.php');
    $privatekey = "6LeCzPYSAAAAABlD-3ljv7cj872r0lZRSaM2COUJ";
    $resp = recaptcha_check_answer ($privatekey,
                                  $_SERVER["REMOTE_ADDR"],
                                  $_POST["recaptcha_challenge_field"],
                                  $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
      // What happens when the CAPTCHA was entered incorrectly
      $error = true;
      echo "<div id=\"error\">
            <p>Podane hasła nie są takie same.</p>
        </div>";
    }
    
    if(!$error) {
        $id = register_new_user($username, $email);
    }
    
    if ( !is_wp_error($id) ) {
	wp_set_password($password, $id);
        update_user_meta($id, 'localization', $localization);
        update_user_meta($id, 'birthyear', $birthyear);
        update_user_meta($id, 'gender', $gender);
    }
}



get_footer();

?>