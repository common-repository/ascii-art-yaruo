<?php

/**
 * @package           aayaruo
 *
 * Plugin Name:       Ascii Art Yaruo
 * Plugin URI:        https://tgk.zkzk.org/wordpress-aayaruo/
 * Description:       Short code for display Yaruo 2ch character
 * Version:           1.0.6
 * Author:            tgk
 * Author URI:        https://tgk.zkzk.org/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aayaruo
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

add_shortcode( 'aa_mode',  'aa_mode_shortcode_handler' );
add_shortcode( 'aa',       'aa_shortcode_handler' );
add_shortcode( 'aa_panel', 'aa_panel_shortcode_handler' );

global $aa_txt_version;
$aa_txt_version = 1;

function aa_mode_shortcode_handler( $attrs, $content = null ) {
	extract( shortcode_atts( array (
	   'version'  => '1'
	 ), $attrs ) );
	$GLOBALS['aa_txt_version'] = $version;

	return '<div class="aa_contents">' . do_shortcode( $content ) . '</div>';
}

function aa_shortcode_handler( $attrs ) {
	extract( shortcode_atts( array (
	   'name'    => 'yaruo_01',
	   'id'      => '1',
	   'class'   => 'aa_words', //  'aa_words' or 'words_aa'
	   'padding' => ''
	 ), $attrs ) );

	$aa = aa_loader( $name, $id );

	$pad = '';
	if ( $padding != '' ) {
		$pad = "<div class='padding$padding'></div>";
	}

    $figure = <<<EOD
<figure class="aa_panel">
$pad
<div class="aa $class">
$aa
</div>
</figure>
EOD;

    return $figure;
}

function aa_panel_shortcode_handler( $attrs, $content = null ) {
	extract( shortcode_atts( array (
	   'name'    => 'yaruo_01',
	   'id'      => '1',
	   'class'   => 'aa_words', //  'aa_words' or 'words_aa'
	   'padding' => ''
	 ), $attrs ) );

	$aa = aa_loader( $name, $id );

	$pad = '';
	if ( $padding != '' ) {
		$pad = "<div class='padding$padding'></div>";
	}

	$words_header = '';
	$words_footer = '';
	if ( ! is_null( $content ) || $content == '') {
		if ( strpos($class, 'words_aa') === false ) {
			$words_footer = '<div class="words">' . aa_remove_first_br( $content ). '</div>';
		} else {
			$words_header = '<div class="words">' . aa_remove_first_br( $content ). '</div>';
		}
	}

    $figure = <<<EOD
<figure class="aa_panel">
$pad
$words_header
<div class="aa $class">
$aa
</div>
$words_footer
</figure>
EOD;

    return $figure;
}


function aa_remove_first_br ( $content ) {
	$content = preg_replace('/^<br \/>/', '', $content);
	return $content;
}
function aa_loader( $name, $id ) {
	$file_path = __DIR__ .'/txt_' . $GLOBALS['aa_txt_version'] . '/'. $name . '/' . $id .  '.txt';

	if ( validate_file( $file_path ) && is_readable( $file_path ) === false ) {
		return "<strong class='aa_error'>AA data not found. [name:$name][id:$id]</strong><br />";
	}

	$aa_text = file_get_contents( $file_path );
	return nl2br( $aa_text );
}


add_action( 'wp_enqueue_scripts', 'aayaruo_plugin_styles' );
function aayaruo_plugin_styles() {
	wp_register_style( 'aayaruo', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_style( 'aayaruo' );
}
