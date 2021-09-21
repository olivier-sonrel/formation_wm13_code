<?php

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

add_action('wp_enqueue_scripts', 'mystyle_enqueue');

function mystyle_enqueue() {
    wp_enqueue_style('style', get_template_directory_uri() . '/css/styles.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array('jquery'), '', true );    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery'), '', true );
}