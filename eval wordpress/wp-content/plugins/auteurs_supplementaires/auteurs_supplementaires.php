<?php
/*
Plugin Name:  Auteurs-Supplementaires
Version:      1.0


Description:  Permet d'ajouter et affiche les auteurs supplementaires d'un article
Requires at least: 5.2
Requires PHP:      7.2
Author:       Olivier Sonrel
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:       my-basics-plugin
Domain Path:       /languages
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
add_action('init', 'authors_init_shortcode');

if(is_admin()){
    // champ de saisie
    add_action('add_meta_boxes', 'add_meta_boxes_fct');
    add_action('save_post', 'save_form', 10, 1);
}

function authors_init_shortcode(){
    add_shortcode('auteurs', 'authors_do_shortcode');
}

function authors_do_shortcode($attrs){
    $output = 'Auteurs: ';
    if(!isset($attrs['post']) or empty($attrs['post'])){
        $authors = get_post_meta(get_the_ID(), 'this-authors', true);
    }else{
        $authors = get_post_meta($attrs['post'], 'this-authors', true);
    }
    return $output .= $authors;
}

function add_meta_boxes_fct(){
    add_meta_box('seo-meta-box', __('Mes auteurs'), 'display_form', 'page', 'normal');
    add_meta_box('seo-meta-box', __('Mes auteurs'), 'display_form', 'post', 'normal');
}

function display_form($post){

    $authors = get_post_meta($post->ID, 'this-authors', true);
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row"><label for="this-authors">Auteurs</label></th>
            <td><input type="text" id="this-authors" name="this-authors" value="<?php echo $authors ?>" class="regular-text">
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

function save_form($post_id){
    if (!isset($_POST['this-authors'])) {
        return;
    }
    update_post_meta($post_id, 'this-authors', sanitize_text_field($_POST['this-authors']));

}