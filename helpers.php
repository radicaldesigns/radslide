<?php

function radslide_helper_include_bespin() {
	$bespin_base = get_option('siteurl').'/wp-content/plugins/radslide/vendor/bespin';
	$css_url = get_option('siteurl').'/wp-content/plugins/radslide/vendor/bespin/BespinEmbedded.css';
	$js_url = get_option('siteurl').'/wp-content/plugins/radslide/vendor/bespin/BespinEmbedded.js';
	echo '<link id="bespin_base" href="'.$bespin_base.'">';
	echo '<link rel="stylesheet" type="text/css" href="'.$css_url.'">';
	echo '<script type="text/javascript" src="'.$js_url.'"></script>';
}

function radslide_helper_ajax_loader($id) {
  $image_url = get_option('siteurl').'/wp-content/plugins/radslide/images/ajax-loader.gif';
  echo '<img src="'.$image_url.'" id="'.$id.'" style="display:none" />';
}

function radslide_helper_db_slideshow() {
	global $wpdb;
  return $wpdb->prefix.'radslide_slideshow';
}

function radslide_helper_db_slide() {
	global $wpdb;
  return $wpdb->prefix.'radslide_slide';
}

// add jquery to head, if needed
function radslide_head() {
	global $wpdb;
	?><script type="text/javascript">jQuery(function(){<?php
	$table_name = radslide_helper_db_slideshow();
	$slideshow_rows = $wpdb->get_results("SELECT * FROM $table_name");
	foreach($slideshow_rows as $slideshow_row) {
		?>jQuery("#radslide-<?php echo($slideshow_row->id) ?>").cycle(<?php echo(stripslashes($slideshow_row->cycle_options)); ?>); <?php
	}
	?>});</script>	<?php
}

// media api scripts and styles
function radslide_media_api_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', WP_PLUGIN_URL.'/radslide/image_selector.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
function radslide_media_api_styles() {
	wp_enqueue_style('thickbox');
}

function radslide_rd_credit() {
	?><div style="text-align:center;margin:50px 0;"><a href="http://www.radicaldesigns.org/"><img src="<?php echo(get_option('siteurl')); ?>/wp-content/plugins/radslide/images/radical_designs.png" title="Radical Designs" alt="Radical Designs" style="vertical-align:middle" /></a></div><?php
}

?>
