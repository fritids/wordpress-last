<?php 
/* The function that creates the HTML on the front-end, based on the parameters
* supplied in the product-catalog shortcode */
function Insert_Register_Form($atts) {
		// Include the required global variables, and create a few new ones
		global $wpdb, $user_message, $feup_success;
		global $ewd_feup_fields_table_name;
		
		$Custom_CSS = get_option("EWD_FEUP_Custom_CSS");
		$Salt = get_option("EWD_FEUP_Hash_Salt");
		$Time = time();
		
		$Sql = "SELECT * FROM $ewd_feup_fields_table_name ";
		$Fields = $wpdb->get_results($Sql);
		
		$ReturnString = "";
		
		// Get the attributes passed by the shortcode, and store them in new variables for processing
		extract( shortcode_atts( array(
						 								 		'redirect_page' => '#',
																'redirect_field' => "",
																'redirect_array_string' => "",
																'submit_text' => __('Register', 'EWD_FEUP')),
																$atts
														)
												);
		
		if ($feup_success and $redirect_field != "") {$redirect_page = Determine_Redirect_Page($redirect_field, $redirect_array_string, $redirect_page);}
		
		if ($feup_success and $redirect_page != '#') {FEUPRedirect($redirect_page);}
		
		$ReturnString .= "<style type='text/css'>";
		$ReturnString .= $Custom_CSS;
		$ReturnString .= "</style>";
		
		$ReturnString .= "<div id='ewd-feup-register-form-div'>";
		$ReturnString .= $user_message['Message'];
		$ReturnString .= "<form action='#' method='post' id='ewd-feup-register-form' class='pure-form pure-form-aligned' enctype='multipart/form-data'>";
		$ReturnString .= "<input type='hidden' name='ewd-feup-check' value='" . sha1(md5($Time.$Salt)) . "'>";
		$ReturnString .= "<input type='hidden' name='ewd-feup-time' value='" . $Time . "'>";
		$ReturnString .= "<input type='hidden' name='ewd-feup-action' value='register'>";
		$ReturnString .= "<div class='pure-control-group'>";
		$ReturnString .= "<label for='Username' id='ewd-feup-register-username-div' class='ewd-feup-field-label'>" . __('Username', 'EWD_FEUP') . ": </label>";
		if (isset($_POST['Username'])) {$ReturnString .= "<input type='text' class='ewd-feup-text-input' name='Username' value='" . $_POST['Username'] . "'>";}
		else {$ReturnString .= "<input type='text' class='ewd-feup-text-input' name='Username' placeholder='" . __('Username', 'EWD_FEUP') . "...'>";}
		$ReturnString .= "</div>";
		$ReturnString .= "<div class='pure-control-group'>";
		$ReturnString .= "<label for='Password' id='ewd-feup-register-password-div' class='ewd-feup-field-label'>" . __('Password', 'EWD_FEUP') . ": </label>";
		if (isset($_POST['User_Password'])) {$ReturnString .= "<input type='password' class='ewd-feup-text-input' name='User_Password' value='" . $_POST['User_Password'] . "'>";}
		else {$ReturnString .= "<input type='password' class='ewd-feup-text-input' name='User_Password'>";}
		$ReturnString .= "</div>";
		$ReturnString .= "<div class='pure-control-group'>";
		$ReturnString .= "<label for='Repeat Password' id='ewd-feup-register-password-confirm-div' class='ewd-feup-field-label'>" . __('Repeat Password', 'EWD_FEUP') . ": </label>";
		if (isset($_POST['Confirm_User_Password'])) {$ReturnString .= "<input type='password' class='ewd-feup-text-input' name='Confirm_User_Password' value='" . $_POST['Confirm_User_Password'] . "'>";}
		else {$ReturnString .= "<input type='password' class='ewd-feup-text-input' name='Confirm_User_Password'>";}
		$ReturnString .= "</div>";
		
		foreach ($Fields as $Field) {
				$ReturnString .= "<div class='pure-control-group'>";
				$ReturnString .= "<label for='" . $Field->Field_Name . "' id='ewd-feup-register-" . $Field->Field_ID . "' class='ewd-feup-field-label'>" . $Field->Field_Name . ": </label>";
				if ($Field->Field_Type == "text" or $Field->Field_Type == "mediumint") {
					  if (isset($_POST[str_replace(" ", "_", $Field->Field_Name)])) {$ReturnString .= "<input name='" . $Field->Field_Name . "' id='ewd-feup-register-input-" . $Field->Field_ID . "' class='ewd-feup-text-input pure-input-1-3' type='text' value='" . $_POST[str_replace(" ", "_", $Field->Field_Name)] . "' />";}
						else {$ReturnString .= "<input name='" . $Field->Field_Name . "' id='ewd-feup-register-input-" . $Field->Field_ID . "' class='ewd-feup-text-input pure-input-1-3' type='text' placeholder='" . $Field->Field_Name . "' />";}
				}
				elseif ($Field->Field_Type == "date") {
						$ReturnString .= "<input name='" . $Field->Field_Name . "' id='ewd-feup-register-input-" . $Field->Field_ID . "' class='ewd-feup-date-input pure-input-1-3' type='date' value='" . $Value . "' />";
				}
				elseif ($Field->Field_Type == "datetime") {
						$ReturnString .= "<input name='" . $Field->Field_Name . "' id='ewd-feup-register-input-" . $Field->Field_ID . "' class='ewd-feup-datetime-input pure-input-1-3' type='datetime-local' value='" . $Value . "' />";
				}
				elseif ($Field->Field_Type == "file") {
						$ReturnString .= "<input name='" . $Field->Field_Name . "' id='ewd-feup-register-input-" . $Field->Field_ID . "' class='ewd-feup-date-input pure-input-1-3' type='file' value='' />";
				}
				elseif ($Field->Field_Type == "textarea") {
						$ReturnString .= "<textarea name='" . $Field->Field_Name . "' id='ewd-feup-register-input-" . $Field->Field_ID . "' class='ewd-feup-textarea pure-input-1-2'>" . $_POST[str_replace(" ", "_", $Field->Field_Name)] . "</textarea>";
				} 
				elseif ($Field->Field_Type == "select") { 
						$Options = explode(",", $Field->Field_Options);
						$ReturnString .= "<select name='" . $Field->Field_Name . "' id='ewd-feup-register-input-" . $Field->Field_ID . "' class='ewd-feup-select pure-input-1-3'>";
			 			foreach ($Options as $Option) {
								$ReturnString .= "<option value='" . $Option . "' ";
								if (isset($_POST[str_replace(" ", "_", $Field->Field_Name)]) and $Option == $_POST[str_replace(" ", "_", $Field->Field_Name)]) {$ReturnString .= "selected='selected'";}
								$ReturnString .= ">" . $Option . "</option>";
						}
						$ReturnString .= "</select>";
				} 
				elseif ($Field->Field_Type == "radio") {
						$Counter = 0;
						$Options = explode(",", $Field->Field_Options);
						foreach ($Options as $Option) {
								if ($Counter != 0) {$ReturnString .= "</div><div class='pure-control-group ewd-feup-negative-top'><label class='pure-radio'></label>";}
								$ReturnString .= "<input type='radio' name='" . $Field->Field_Name . "' value='" . $Option . "' class='ewd-feup-radio' ";
								if (isset($_POST[str_replace(" ", "_", $Field->Field_Name)]) and $Option == $_POST[str_replace(" ", "_", $Field->Field_Name)]) {$ReturnString .= "checked='checked'";}
								$ReturnString .= ">" . $Option  . "<br/>";
								$Counter++;
						} 
				} 				
				elseif ($Field->Field_Type == "checkbox") {
  					$Counter = 0;
						$Options = explode(",", $Field->Field_Options);
						foreach ($Options as $Option) {
								if ($Counter != 0) {$ReturnString .= "</div><div class='pure-control-group ewd-feup-negative-top'><label class='pure-radio'></label>";}
								$ReturnString .= "<input type='checkbox' name='" . $Field->Field_Name . "[]' value='" . $Option . "' class='ewd-feup-checkbox' ";
								if (isset($_POST[str_replace(" ", "_", $Field->Field_Name)])) {if (in_array($Option, $_POST[str_replace(" ", "_", $Field->Field_Name)])) {$ReturnString .= "checked";}}
								$ReturnString .= ">" . $Option . "</br>";
								$Counter++;
						}
				}
				$ReturnString .= "</div>";
		}
		
		$ReturnString .= "<div class='pure-control-group'><label for='submit'></label><input type='submit' class='ewd-feup-submit pure-button pure-button-primary' name='Register_Submit' value='" . $submit_text . "'></div>";
		$ReturnString .= "</form>";
		$ReturnString .= "</div>";
		
		return $ReturnString;
}
add_shortcode("register", "Insert_Register_Form");
