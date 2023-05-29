<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Padrao
 */

get_header();

if (have_posts()): while (have_posts()): the_post(); ?>

<?php

endwhile; endif;

get_footer();

