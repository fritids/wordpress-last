<?php
/*
Template Name: New post page
*/

get_header();

if(!isset($_POST['save'])) {
?>
<div id="post_page_wrapper">
    <h2><?php the_title(); ?></h2>
    <p>Wszystkie pola są obowiązkowe</p>

    <div id="add_post_wrapper">
        <form action="" method="POST">
            <label for="title">Tytuł (max. 64 znaki):
                <input maxlength="64" class="text_input" type="text" name="title" />
            </label><br>

            <label for="content">Treść (max. 2000 znaków) :<br>
                <textarea class="text_input" name="content" ></textarea>
            </label><br>

            <label for="tag1">Tag 1:
                <input type="text" name="tag1" />
            </label>

            <label for="tag2">Tag 2:
                <input type="text" name="tag2" />
            </label>

            <label for="tag3">Tag 3:
                <input type="text" name="tag3" />
            </label><br>

            <label for="source">Źródło:
                <select type="text" id="source" name="source" value="">
                    <option value=""></option>
                    <option value="link">link</option>
                    <option value="paper">wydawnictwo papierowe</option>
                </select>
            </label>

            <label for="expires">Wygasa:
                <input type="date" name="expires" />
            </label><br>

            <div id="source_options"></div>

            <input type="submit" id="post_submit" value="Zapisz" name="save" />
        </form>
    </div>
</div>
<?php
} else {
    if(
        (!isset($_POST['title'], $_POST['content'], $_POST['tag1'], $_POST['tag2'], $_POST['tag3'], $_POST['source'], $_POST['expires']))
            && ((!isset($_POST['link'])) || (!isset($_POST['issue'], $_POST['paper_title'])))) {
        $error = true;
        echo "<div id='error_div'><p>Nie wypełniłeś wymaganych pól.</p></div>";
    }
    
    if(!$error) {
        $title = $_POST['title'];
        $content = esc_attr($_POST['content']);
        $tag1 = $_POST['tag1'];
        $tag2 = $_POST['tag2'];
        $tag3 = $_POST['tag3'];
        $source = $_POST['source'];
        $expires = $_POST['expires'];
        if(isset($_POST['link'])) $link = $_POST['link'];
        if(isset($_POST['paper_title'])) $paper_title = $_POST['paper_title'];
        if(isset($_POST['issue'])) $issue = $_POST['issue'];
    }
    
    if(!$error) {
        $my_post = array(
            'post_title'    => $title,
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_category' => array(8,39),
            'tags_input' => array($tag1, $tag2, $tag3),
          );
        $post_id = wp_insert_post($my_post);
        if(is_wp_error($post_id)) {
            echo "Nie udało się dodać postu.";
        }
        else {
            add_post_meta($post_id, 'source', $source);
            add_post_meta($post_id, '_expiration-date', $expires);
            if($source == "link") {
                add_post_meta($post_id, "link", $link);
            }
            if($source == "paper") {
                add_post_meta($post_id, "issue", $issue);
                add_post_meta($post_id, "paper_title", $paper_title);
            }
        }
        echo "Pomyślnie dodano artykuł.";
    }
}

get_footer();

?>