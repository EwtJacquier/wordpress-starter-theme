<?php 

function transform_title( $title ){
    return wp_kses(str_replace('[', '<strong>', str_replace(']', '</strong>', $title )), array('strong' => true, 'br' => true));
}