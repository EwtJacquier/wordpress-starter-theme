<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Padrao
 */

get_header();

$var = $_POST['abc'];


echo $var;

if (have_posts()): while (have_posts()): the_post(); ?>

<?php

endwhile; endif;

get_footer();
