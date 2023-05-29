<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Padrao
 */

get_header();
if (have_posts()): while (have_posts()): the_post();
    ?>

<?php
endwhile; endif;
get_footer();
