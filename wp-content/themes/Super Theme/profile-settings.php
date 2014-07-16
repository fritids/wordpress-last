<?php
/*
Template Name: Profile setting page
*/

get_header();

//updating data if user filled in update form
if(isset($_POST['update'])) {
    $updated = false;
    $user_id = get_current_user_id();
    
    if(isset($_POST['localization']) && strlen(trim($_POST['localization']))>0) {
        $updated = update_user_meta($user_id, 'localization', $_POST['localization']);
    }
    if(isset($_POST['birthyear']) && strlen(trim($_POST['birthyear']))>0) {
        $updated = update_user_meta($user_id, 'birthyear', $_POST['birthyear']);
    }
    if(isset($_POST['gender']) && strlen(trim($_POST['gender']))>0) {
        $updated = update_user_meta($user_id, 'gender', $_POST['gender']);
    }
}

?>

<div id='profile_settings_wrapper'>

<?php
//if user is logged in
if(is_user_logged_in()) {
    $user_id = get_current_user_id();
    
    $user = get_userdata($user_id);
    
    $localization = get_user_meta($user_id, 'localization', true);
    $birthyear = get_user_meta($user_id, 'birthyear', true);
    $gender = get_user_meta($user_id, 'gender', true);
    
    ?>
    
    <h3><?php the_title(); ?></h3>
    <p>Podstawowe ustawienia znajdują się <a href="<?php echo admin_url('profile.php'); ?>">tutaj</a>.</p>
    <h3>Ustawienia dodatkowe:</h3>
    
    <form action="" method="POST">
        <label for="localization">Lokalizacja: 
            <input type="text" name="localization" placeholder="<?php echo $localization; ?>" />
        </label><br>
        <label for="birthyear">Rok urodzenia (aktualnie <?php echo $birthyear; ?>): 
            <select name="birthyear">
                <option value=""></option>
                <?php
                for($i=2014; $i>=1900; $i--) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                } ?>
            </select>
        </label><br>
        <label for="gender">Płeć (aktualnie <?php echo $gender; ?>): 
            <select name="gender">
                <option value=""></option>
                <option value="female">Kobieta</option>
                <option value="male">Mężczyzna</option>
            </select>
        </label><br>
        <input type="submit" name="update" value="Zapisz"/>
    </form>
    
    <div id="update_result">
        <?php
            if(isset($_POST['update']) && $updated) {
                echo "<p>Pomyślnie uaktualniono dane.</p>";
            }
            else if(isset($_POST['update']) && !$updated){
                echo "<p>Nie udało się uaktualnić danych. Prawdopodobnie nie wpisałeś danych, lub podałeś dane takie same jak aktualne.</p>";
            }
        ?>
    </div>
    <?php
}
else { ?>
    
    <h3>Nie masz uprawnień do przeglądania tej strony. Zaloguj się.</h3> 
    
<?php
}
?>

</div>
    
<?php
get_footer();
?>