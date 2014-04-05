<?php ob_start(); include 'functions.php';
/*
Plugin Name: Alfieliate Wordpress plugin
Plugin URI: http://www.alfieliate.nl
Description: This plugin allows you to create quick high quality affiliate websites like twenga,beslist etc.
Author: Alfieliate
Version: 1.0
Author URI: http://www.alfieliate.nl/
*/

// configuration
define('HOST_DOMAIN','twngtool.nl');
define('HOTELS',12);
define('HOST_URL',"http://www.twngtool.nl/");


// Plugin Activation
register_activation_hook( __FILE__, 'myplugin_activate' );
function myplugin_activate()
{
	global $wpdb;
	$sql="
	CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."alfieliate_products` (
	  `product_id` int(11) NOT NULL AUTO_INCREMENT,
	  `identifier` varchar(100) NOT NULL,
	  `feed_id` int(11) NOT NULL,
	  `s_id` int(11) NOT NULL,
	  `prim_id` varchar(255) NOT NULL,
	  `product_name` varchar(255) NOT NULL,
	  `price` decimal(6,2) NOT NULL,
	  `description` text NOT NULL,
	  `imageurl` varchar(255) NOT NULL,
	  `producturl` varchar(255) NOT NULL,
	  `ean` varchar(25) NOT NULL,
	  `webshop_name` varchar(255) NOT NULL,
	  `webshop_logo` varchar(255) NOT NULL,
	  `label_id` int(11) NOT NULL,
	  `internal_id` varchar(255) NOT NULL,
	  `pricerange` int(11) NOT NULL,
	  `cat_id` int(11) NOT NULL DEFAULT '0',
	  `sub_id` int(11) NOT NULL DEFAULT '0',
	  `allow_update` tinyint(4) NOT NULL DEFAULT '1',
	  `visible` tinyint(4) NOT NULL DEFAULT '1',
	  `viewcount` int(11) NOT NULL,
	  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`product_id`),
	  KEY `product_name` (`product_name`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1;";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `wp_alfieliate_settings` (
		  `setting_id` int(11) NOT NULL DEFAULT '1',
		  `website_id` int(11) NOT NULL,
		  `api_key` varchar(255) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=latin1;
		
		--
		-- Gegevens worden uitgevoerd voor tabel `wp_alfieliate_settings`
		--
		
		INSERT INTO `wp_alfieliate_settings` (`setting_id`, `website_id`, `api_key`) VALUES
		(1, 1, 'APIKEY');";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);


}

register_deactivation_hook( __FILE__, 'myplugin_deactivate' );
function myplugin_deactivate()
{
	global $wpdb;
	$wpdb->query("DROP TABLE ".$wpdb->prefix ."alfieliate_products");
	
}
// add menu
function alfie_plugin_menu()
{
	add_menu_page('Alfieliate','Alfieliate install filters', 'manage_options', 'alfie-feed-plugin', 'alfie_option_page');
	add_submenu_page('alfie-feed-plugin', 'Alfieliate Matchings', 'Alfieliate Matching', 'manage_options', 'manage-matching', 'manage_matching');
	add_submenu_page('alfie-feed-plugin', 'Configuration', 'Configuration', 'manage_options', 'alfie-config', 'alfie_config');
	add_action('admin_menu', 'alfie-config');
}

add_action('admin_menu', 'alfie_plugin_menu');

wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
// Include pages
include 'include/puck.php';
$puck = new puck(HOST_DOMAIN,1);
include 'include/alfie-option.php';
include 'include/alfie-config.php';
include 'include/ajax.php';
include 'include/manage_matching.php';
add_action( 'wp_ajax_nopriv_docall', 'docall' ); 

 

/*******************************************************SHORTCODE MATCHFEED ***********************************************************/
function alfie_match_feed_func( $atts ) {
	global $wpdb;
	global $puck;
	$css = WP_PLUGIN_URL.'/alfieliate/css/';
	$js = WP_PLUGIN_URL.'/alfieliate/js/';
	$img = WP_PLUGIN_URL.'/alfieliate/img/';
	$images = WP_PLUGIN_URL.'/alfieliate/images/';
	extract( shortcode_atts( array(
		'id' => 'something',
	), $atts ) );
	$row = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."alfieliate_products  WHERE s_id = '".(int)$id."'", ARRAY_A);
	$feed_id =  $row['feed_id'];
	$s_id =  $row['s_id'];
	$i = $row['identifier'];
	$website_id = 1;
	if(isset($_GET['product'])) {
		include 'include/productdetail.php';
	} else {
		include 'include/filterscript.php';
		include 'include/overview.php';
	}
	
	
	?>
	
      
	
<?php }
add_shortcode( 'displayproducts', 'alfie_match_feed_func' ); ?>