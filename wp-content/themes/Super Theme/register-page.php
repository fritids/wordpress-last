<?php
/*
Template Name: My Custom Page
*/

get_header();
require_once(get_template_directory() . '/recaptchalib.php');
?>

<div id="form_wrapper">
    <div id="register_form">
        <h2> Zarejestruj się </h2>
        <p>Pola oznaczone gwiazdką * są obowiązkowe</p><br>
        <form method="POST" action="http://localhost/wordpress/?page_id=32">
            <p> Nazwa użytkownika * </p>
            <input class="text_input" type="text" name="username" required />
            <p> Email * </p>
            <input class="text_input" type="email" name="email" required />
            <p> Hasło * </p>
            <input class="text_input" type="password" name="password" required />
            <p> Powtórzone hasło * </p>
            <input class="text_input" type="password" name="confirm" required />
            <p>
            <p> Lokalizacja </p>
            <input class="text_input" type="text" name="localization" />
            <p> 
            <label for="birtyear">Year of birth<br>
                <select name="birthyear" name="birtyear" id="birthyear" class="input" value="" >
                    <option value=""></option>
                    <?php 
                        for($i=2014; $i>=1920; $i--)
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                    ?>
                </select>
            </label>
            </p>
        
            <p>
            <label for="gender">Gender<br>
                <select name="gender" name="gender" id="gender" class="input" value="" >
                    <option value=""></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </label>
            </p>
        
        <?php $publickey = "6LeCzPYSAAAAAIEv1oHMSASUzwDlImmMK9m6dcYp";
        echo recaptcha_get_html($publickey); ?>
            <br><input class="reg_submit" type="submit" name="zarejestruj" value="Zarejestruj" />
        </form>
    </div>
</div>

<?php
get_footer();
?>