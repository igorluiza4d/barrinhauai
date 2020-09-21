<?php
/**
* Plugin Name: Colocar a barrinha do Uai nos Blogs
* Plugin URI: http://www.uai.com.br/
* Version: 1.2.1
* Author: A4D
* Author URI: http://www.uai.com.br/
* Description: Inserir a Barra do Uai por meio de plugin
* License: GPL2
* Text Domain: insert-headers-and-footers
* Domain Path: languages
*/

/*  Copyright 2019 A4D

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Insert Headers and Footers Class
*/
require_once( 'BFIGitHubPluginUploader.php' );
if ( is_admin() ) {
    new BFIGitHubPluginUpdater( __FILE__, 'igorluiza4d', "barrinhauai", "" );
}

class InserirBarrinhaUAI {
	/**
	* Constructor
	*/
	public function __construct() {

		// Plugin Details
        $this->plugin               = new stdClass;
        $this->plugin->name         = 'wp-b-uai'; // Plugin Folder
        $this->plugin->displayName  = 'InserirBarrinhaUAI'; // Plugin Name
        $this->plugin->version      = '1.2.1';
        $this->plugin->folder       = plugin_dir_path( __FILE__ );
        $this->plugin->url          = plugin_dir_url( __FILE__ );
        $this->plugin->db_welcome_dismissed_key = $this->plugin->name . '_welcome_dismissed_key';
        $this->body_open_supported	= function_exists( 'wp_body_open' ) && version_compare( get_bloginfo( 'version' ), '5.2' , '>=' );

		// Hooks
		add_action( 'admin_init', array( &$this, 'registerSettings' ) );

        // Frontend Hooks
		if ( $this->body_open_supported ) {
			add_action( 'wp_body_open', array( &$this, 'frontendBody' ), 1 );
		}
	}

	/**
	* Register Settings
	*/
	function registerSettings() {
		register_setting( $this->plugin->name, 'barrinha_insert_body', 'trim' );
	}
	function frontendBody() {
		$this->output( 'barrinha_insert_body_tools' );
	}

	/**
	* Outputs the given setting, if conditions are met
	*
	* @param string $setting Setting Name
	* @return output
	*/
	function output( $setting ) {
		// Ignore admin, feed, robots or trackbacks
		if ( is_admin() || is_feed() || is_robots() || is_trackback() ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - both headers and footers via filters
		if ( apply_filters( 'disable_ihaf', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - footer only via filters
		if ( 'ihaf_insert_footer' == $setting && apply_filters( 'disable_ihaf_footer', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - header only via filters
		if ( 'ihaf_insert_header' == $setting && apply_filters( 'disable_ihaf_header', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - below opening body only via filters
		if ( 'ihaf_insert_body' == $setting && apply_filters( 'disable_ihaf_body', false ) ) {
			return;
		}
		if($setting=='barrinha_insert_body_tools'){
			$filename = dirname(__FILE__)."/barrinha-uai.html";
			#echo $filename;
			#exit;
			$handle = fopen ($filename, "r");
			$conteudo = fread ($handle, filesize ($filename));
			fclose ($handle);

			$meta=$conteudo;
			// var_dump($meta);
			// #$meta='Jornal estado de minas';
			// // Output
			echo wp_unslash( $meta );

		}
		
		// // Get meta
		// $meta = get_option( $setting );
		// if ( empty( $meta ) ) {
		// 	return;
		// }
		// if ( trim( $meta ) == '' ) {
		// 	return;
		// }
	}
}

$d = new InserirBarrinhaUAI();
