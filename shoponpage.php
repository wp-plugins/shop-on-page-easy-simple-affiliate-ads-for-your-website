<?php
/**
 * @package ShopOnPage
 * @version 1.0.3
 */
/*
Plugin Name: Shop On Page: Easy, simple affiliate ads for your website. 
Plugin URI: http://www.shoponpage.com/plugins/wordpress/shoponpage.zip
Description: Make money on your website. Adds a "Shop" button to your page. Make money on purchases. Free to sign up, easy to use.
Author: TrulyShare
Version: 1.0.3
Author URI: http://www.shoponpage.com
*/

function show_widget() {
	$publisher_id = get_option('trulyshare_publisher_id');
	if ($publisher_id <= 0) {
		$publisher_id = 1;
	} 

	echo "<script type = \"text/javascript\" src = \"http://www.trulyshare.com/publishers/$publisher_id/widget.js\"> </script>";
}

function show_admin_panel() {
	if($_POST['oscimp_hidden'] == 'Y') {
		//Form data sent
		$publisher_id = $_POST['trulyshare_publisher_id'];
		update_option('trulyshare_publisher_id', $publisher_id);
		?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
		<?php
	}
	$pub_id = get_option('trulyshare_publisher_id');
?>
	<div class="wrap">
	<?php    echo "<h2>ShopOnPage Plugin Configuration</h2>"; ?>
	<h3>If you do not have a publisher ID, <a href="http://www.trulyshare.com/publishers/new?src=wp">sign up</a> now. It's free and easy!</h3>
	<form name="trulyshare_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="oscimp_hidden" value="Y"> 
		<p>Publisher ID:<input type="number" name="trulyshare_publisher_id" value="<?php echo $pub_id; ?>" size="20"></p>
		<hr />
		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
		</p>
	</form>

	<?php if ($pub_id > 0) { ?>
		<a href = "http://www.trulyshare.com/publishers/<?php echo $pub_id; ?>">
			<h3>Check your publisher dashboard</h3>
		</a>
	<?php } ?>

</div>
<?php	
}

function show_config_options() {
	add_menu_page("ShopOnPage", "ShopOnPage", 'manage_options', "config", "show_admin_panel");
}

add_action( 'wp_footer', 'show_widget' );
add_action('admin_menu', 'show_config_options');
?>
