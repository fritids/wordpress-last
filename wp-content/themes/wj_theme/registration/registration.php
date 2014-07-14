<?php

function wj_registration_form() {
    if(!is_user_logged_in()) {
        global $wj_load_css;
        
        $wj_global_css = true;
        
        $registration_enabled = get_option('users_can_register');
        
        if($registration_enabled) {
            $output = wj_registration_form_fields();
        }
        else {
            $output = __('User registration is not enabled');
        }
        
        return $output;
    }
}

add_shortcode('register_form', 'wj_registration_form');


function wj_login_form() {
    if(!is_user_logged_in()) {
        global $wj_load_css;
        
        $wj_load_css = true;
        
        $output = wj_login_form_fields();
    }
    else {
        
    }
    
    return $output;
}
add_shortcode('login_form', 'wj_login_form');

function wj_registration_form_fields() {
 
	ob_start(); ?>	
		<h3 class="wj_header"><?php _e('Zarejestruj'); ?></h3>
 
		<?php 
		// show any error messages after form submission
		wj_show_error_messages(); ?>
 
		<form id="wj_registration_form" class="wj_form" action="" method="POST">
			<fieldset>
				<p>
					<label for="wj_user_login"><?php _e('Nazwa uzytkownika'); ?></label>
					<input name="wj_user_login" id="wj_user_login" class="required" type="text"/>
				</p>
				<p>
					<label for="wj_user_email"><?php _e('Email'); ?></label>
					<input name="wj_user_email" id="wj_user_email" class="required" type="email"/>
				</p>
				<p>
					<label for="password"><?php _e('Hasło'); ?></label>
					<input name="wj_user_pass" id="password" class="required" type="password"/>
				</p>
				<p>
					<label for="password_again"><?php _e('Powtórz hasło'); ?></label>
					<input name="wj_user_pass_confirm" id="password_again" class="required" type="password"/>
				</p>
                                <p>
					<label for="localization"><?php _e('Lokalizacja'); ?></label>
					<input name="localization" id="localization" class="required" type="text"/>
				</p>
                                <p>
					<label for="birtyear"><?php _e('Rok urodzenia'); ?></label>
					<input name="birtyear" id="birtyear" class="required" type="text"/>
				</p>
                                <p>
					<label for="sex"><?php _e('Płeć'); ?></label>
					<input name="sex" id="sex" class="required" type="text"/>
				</p>
				<p>
					<input type="hidden" name="wj_register_nonce" value="<?php echo wp_create_nonce('wj-register-nonce'); ?>"/>
					<input type="submit" value="<?php _e('Zarejestruj'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}


function wj_login_form_fields() {
 
	ob_start(); ?>
		<h3 class="wj_header"><?php _e('Zaloguj'); ?></h3>
 
		<?php
		// show any error messages after form submission
		wj_show_error_messages(); ?>
 
		<form id="wj_login_form"  class="wj_form" action="" method="post">
			<fieldset>
				<p>
					<label for="wj_user_login">Nazwa użytkownika</label>
					<input name="wj_user_login" id="wj_user_login" class="required" type="text"/>
				</p>
				<p>
					<label for="wj_user_pass">Hasło</label>
					<input name="wj_user_pass" id="wj_user_pass" class="required" type="password"/>
				</p>
				<p>
					<input type="hidden" name="wj_login_nonce" value="<?php echo wp_create_nonce('wj-login-nonce'); ?>"/>
					<input id="wj_login_submit" type="submit" value="Zaloguj"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}