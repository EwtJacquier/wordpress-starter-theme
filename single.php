<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Padrao
 */

get_header();

if (have_posts()): while (have_posts()): the_post(); ?>

<?php

endwhile; endif;

get_footer();
