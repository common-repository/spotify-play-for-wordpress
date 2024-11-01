<?php
/*
Plugin Name:  Spotify Play Button for WordPress
Plugin URI:   http://bloggingdojo.com/wordpress-plugins/spotify-play-button-for-wordpress/
Description:  Easily embed Spotify Tracks & Playlists using the Spotify Play Button into your Wordpress Blog.
Version:      0.2.1
Author:       Rhys Wynne
Author URI:   http://bloggingdojo.com/
*/

register_activation_hook(__FILE__,'spotify_play_button_for_wordpress_install');
add_action( 'admin_init', 'spotify_play_button_for_wordpress_add_admin_stylesheet' );

define("PLUGIN_NAME","Spotify Play Button for WordPress");
define("PLUGIN_TAGLINE","Easily embed Spotify Tracks & Playlists using the Spotify Play Button into your Wordpress Blog.");
define("PLUGIN_URL","http://bloggingdojo.com/wordpress-plugins/spotify-play-button-for-wordpress/");
define("EXTEND_URL","http://wordpress.org/extend/plugins/spotify-play-for-wordpress/");
define("AUTHOR_TWITTER","rhyswynne");
define("DONATE_LINK","https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XQ7JBZ8W3C8WE");

function spotify_play_button_for_wordpress_add_admin_stylesheet() {
        wp_register_style( 'spotify-play-for-wordpress-style', plugins_url('spotify-play-for-wordpress-admin.css', __FILE__) );
        wp_enqueue_style( 'spotify-play-for-wordpress-style' );
}

function spotify_play_button_for_wordpress($track = "", $size="") {
$link = get_option("spotify-play-button-for-wordpress-link");

if ($track == "")
{
$track = get_option('spotify-play-button-for-wordpress-default');
}

if ($size == "")
{
$size = get_option('spotify-play-button-for-wordpress-size');
}

if ($size != "large" || $size != "compact")
{
	$size = get_option('spotify-play-button-for-wordpress-size');
}
if ($size == "large")
{
	echo '<iframe src="https://embed.spotify.com/?uri='.$track.'" width="300" height="380" frameborder="0" allowtransparency="true"></iframe>';
}
if ($size == "compact")
{
	echo '<iframe src="https://embed.spotify.com/?uri='.$track.'" width="300" height="80" frameborder="0" allowtransparency="true"></iframe>';	
}

if ($link == 1)
{
	echo "<br/><a href='http://bloggingdojo.com/wordpress-plugins/spotify-play-button-for-wordpress/'>Spotify Play Button Plugin for WordPress</a> by <a href='http://www.bloggingdojo.com'>The Blogging Dojo</a><br/><br/>";
}
}

if ( is_admin() ){ // admin actions

  add_action('admin_menu', 'spotify_play_button_for_wordpress_menus');
  add_action( 'admin_init', 'spotify_play_button_wordpress_options_process' );
  
}

function spotify_play_button_for_wordpress_menus() {

  add_options_page('Spotify Play Button Options', 'Spotify Play Button For Wordpress', 8, 'spotifyplaybuttonforwordpressoptions', 'spotify_play_button_for_wordpress_options');

}

function spotify_play_button_for_wordpress_options() {
?>
<div class="pea_admin_wrap">
        <div class="pea_admin_top">
            <h1><?php echo PLUGIN_NAME?> <small> - <?php echo PLUGIN_TAGLINE?></small></h1>
        </div>

        <div class="pea_admin_main_wrap">
            <div class="pea_admin_main_left">
                <div class="pea_admin_signup">
                    Want to know about updates to this plugin without having to log into your site every time? Want to know about other cool plugins we've made? Add your email and we'll add you to our very rare mail outs.

                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                    <form action="http://peadig.us5.list-manage2.com/subscribe/post?u=e16b7a214b2d8a69e134e5b70&amp;id=eb50326bdf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Address
                    </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL"><button type="submit" name="subscribe" id="mc-embedded-subscribe" class="pea_admin_green">Sign Up!</button>
                    </div>
                        <div id="mce-responses" class="clear">
                            <div class="response" id="mce-error-response" style="display:none"></div>
                            <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>	<div class="clear"></div>
                    </form>
                    </div>

                    <!--End mc_embed_signup-->
                </div>
  
 <form method="post" action="options.php">

  <?php wp_nonce_field('update-options'); ?>

  <?php settings_fields( 'spotify-play-button-for-wordpress-group' ); ?>
  
  <table class="form-table">

  <tbody>

<tr valign="top">

  <th scope="row" style="width:400px">Default Spotify Track:</th>

  <td><input type="text" name="spotify-play-button-for-wordpress-default" class="regular-text code" value="<?php echo get_option('spotify-play-button-for-wordpress-default'); ?>" /></td>

</tr>

<tr valign="top">

  <th scope="row" style="width:400px">Default Size To Show:</th>

  <td><input type="radio" name="spotify-play-button-for-wordpress-size" value="large" <?php if (get_option('spotify-play-button-for-wordpress-size') == "large") { echo "checked"; } ?> /> Large<br />
<input type="radio" name="spotify-play-button-for-wordpress-size" value="compact" <?php if (get_option('spotify-play-button-for-wordpress-size') == "compact") { echo "checked"; } ?> /> Compact</td>

</tr>

<tr valign="top">

<th scope="row" style="width:400px"><label>Link to us (optional, but appreciated)</label></th>

<td><input type="checkbox" name="spotify-play-button-for-wordpress-link" value="1"

<?php 

if (get_option('spotify-play-button-for-wordpress-link') == 1) { echo "checked"; } ?>

></td>

</tr>


  </tbody>

</table>



<input type="hidden" name="action" value="update" />

<input type="hidden" name="page_options" value="spotify-play-button-for-wordpress-default" />

<p class="submit">

<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />

</p>

</form>
</div>

</div>
            <div class="pea_admin_main_right">
 <div class="pea_admin_box">
                    <h2>Like this Plugin?</h2>
<a href="<?php echo EXTEND_URL; ?>" target="_blank"><button type="submit" class="pea_admin_green">Rate this plugin	&#9733;	&#9733;	&#9733;	&#9733;	&#9733;</button></a><br><br>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=181590835206577";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like" data-href="<?php echo PLUGIN_URL; ?>" data-send="true" data-layout="button_count" data-width="250" data-show-faces="true"></div>
                    <br>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo PLUGIN_URL; ?>" data-text="Just been using <?php echo PLUGIN_NAME; ?> #WordPress plugin" data-via="<?php echo AUTHOR_TWITTER; ?>" data-related="WPBrewers">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    <br>
<a href="http://bufferapp.com/add" class="buffer-add-button" data-text="Just been using <?php echo PLUGIN_NAME; ?> #WordPress plugin" data-url="<?php echo PLUGIN_URL; ?>" data-count="horizontal" data-via="<?php echo AUTHOR_TWITTER; ?>">Buffer</a><script type="text/javascript" src="http://static.bufferapp.com/js/button.js"></script>
<br>
                    <div class="g-plusone" data-size="medium" data-href="<?php echo PLUGIN_URL; ?>"></div>
                    <script type="text/javascript">
                      window.___gcfg = {lang: 'en-GB'};

                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                    <br>
                    <su:badge layout="3" location="<?php echo PLUGIN_URL?>"></su:badge>
                    <script type="text/javascript">
                      (function() {
                        var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
                        li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
                      })();
                    </script>
                </div>

<center><a href="<?php echo DONATE_LINK; ?>" target="_blank"><img class="paypal" src="<?php echo plugins_url( 'paypal.gif' , __FILE__ ); ?>" width="147" height="47" title="Please Donate - it helps support this plugin!"></a></center>

                <div class="pea_admin_box">
                    <h2>About the Author</h2>

                    <?php
                    $default = "http://reviews.evanscycles.com/static/0924-en_gb/noAvatar.gif";
                    $size = 70;
                    $rhys_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( "rhys@rhyswynne.co.uk" ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                    ?>

                    <p class="pea_admin_clear"><img class="pea_admin_fl" src="<?php echo $rhys_url; ?>" alt="Rhys Wynne" /> <h3>Rhys Wynne</h3><br><a href="https://twitter.com/rhyswynne" class="twitter-follow-button" data-show-count="false">Follow @rhyswynne</a>
<div class="fb-subscribe" data-href="https://www.facebook.com/rhysywynne" data-layout="button_count" data-show-faces="false" data-width="220"></div>
</p>
                    <p class="pea_admin_clear">Rhys Wynne is a Digital Marketing Consultant currently at 3 Door Digital and a freelance WordPress developer and blogger. His plugins have had a total of 100,000 downloads, and his premium plugins have generated four figure sums in terms of sales. Rhys likes rubbish football (supporting Colwyn Bay FC) and Professional Wrestling.</p>
</div>


            
        </div>
    </div>
	

  
  <?php 

}


function spotify_play_button_wordpress_options_process() { // whitelist options

  register_setting( 'spotify-play-button-for-wordpress-group', 'spotify-play-button-for-wordpress-default' );
  register_setting( 'spotify-play-button-for-wordpress-group', 'spotify-play-button-for-wordpress-size' );
  register_setting( 'spotify-play-button-for-wordpress-group', 'spotify-play-button-for-wordpress-link' );

}


	// Check to see required Widget API functions are defined...

	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )

		return; // ...and if not, exit gracefully from the script.




	// This function prints the sidebar widget--the cool stuff!
class spotify_play_button_for_wordpress_Widget_class extends WP_Widget {
	
	function spotify_play_button_for_wordpress_Widget_class() {
		parent::WP_Widget('spotify_play_button_for_wordpress_widget', 'Spotify Play Button For Wordpress', array('description' => 'Embed a Spotify playlist or track into your Wordpress Blog'));	
	}

	
	function widget($args, $instance) {



		// $args is an array of strings which help your widget
		// conform to the active theme: before_widget, before_title,
		// after_widget, and after_title are the array keys.

		extract($args);
		extract($args, EXTR_SKIP);

		$title = empty($instance['widget_title']) ? 'Spotify Playlist' : apply_filters('widget_title', $instance['widget_title']);
		$text = empty($instance['widget_text']) ? 'Check Out My Spotify Playlist!' : $instance['widget_text'];
		if (empty($instance['widget_size']) && !is_numeric($instance['widget_size']))
		{
			$size = "large";
		}
		else
		{
		 $size = $instance['widget_size'];
		}
		$track = empty($instance['widget_track']) ? get_option('spotify-play-button-for-wordpress-default') : $instance['widget_track'];
		
		echo $before_widget;

		echo $before_title . $title . $after_title;

		echo $text;

		spotify_play_button_for_wordpress($track, $size);

		echo $after_widget;


	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['widget_title'] = strip_tags($new_instance['widget_title']);
		$instance['widget_text'] = strip_tags($new_instance['widget_text']);
		$instance['widget_size'] = strip_tags($new_instance['widget_size']);
		$instance['widget_track'] = strip_tags($new_instance['widget_track']);
		return $instance;
	}
 
	/**
	 *	admin control form
	 */	 	
	function form($instance) {
		$default = 	array( 'title' => __('Spotify Playlist') );
		$instance = wp_parse_args( (array) $instance, $default );
 
		$title_id = $this->get_field_id('widget_title');
		$title_name = $this->get_field_name('widget_title');
		$text_id = $this->get_field_id('widget_text');
		$text_name = $this->get_field_name('widget_text');
		$size_id = $this->get_field_id('widget_size');
		$size_name = $this->get_field_name('widget_size');
		$track_id = $this->get_field_id('widget_track');
		$track_name = $this->get_field_name('widget_track');
		echo "\r\n".'<p><label for="'.$title_id.'">'.__('Title').': <input type="text" class="widefat" id="'.$title_id.'" name="'.$title_name.'" value="'.attribute_escape( $instance['widget_title'] ).'" /><label></p>';
		echo "\r\n".'<p><label for="'.$text_id.'">'.__('Text').': <input type="text" class="widefat" id="'.$text_id.'" name="'.$text_name .'" value="'.attribute_escape( $instance['widget_text'] ).'" /><label></p>';
		
		echo "\r\n".'<p><label for="'.$size_id.'">'.__('Widget Size').': <input type="radio" name="'.$size_name .'" value="large"';
		if (attribute_escape($instance['widget_size']) == "large" ) { echo "checked"; };
		echo "/>Large<br />";
		
		echo '<input type="radio" name="'.$size_name .'" value="compact"';
		if (attribute_escape( $instance['widget_size']) == "compact") { echo "checked"; };
		echo "/>Compact<br />";
		
		echo "\r\n".'<p><label for="'.$track_id.'">'.__('Spotify URI for Track or Playlist').': <input type="text" class="widefat" id="'.$track_id.'" name="'.$track_name .'" value="'.attribute_escape( $instance['widget_track'] ).'" /><label></p>';
	}

}

add_action('widgets_init', spotify_play_button_for_wordpress_Widget);

function spotify_play_button_for_wordpress_Widget(){
	// curl need to be installed
	register_widget('spotify_play_button_for_wordpress_Widget_class');
}

// Delays plugin execution until Dynamic Sidebar has loaded first.



function spotify_play_button_for_wordpress_addbuttons() {
 // Don't bother doing this stuff if the current user lacks permissions
   if ( !current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_spotify_play_button_for_wordpress_tinymce_plugin");
     add_filter('mce_buttons', 'spotify_play_button_for_wordpress_button');
   }
}

function spotify_play_button_for_wordpress_button($buttons) {
   array_push($buttons, "separator", "spbfwplugin");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_spotify_play_button_for_wordpress_tinymce_plugin($plugin_array) {
	$url = trim(get_bloginfo('url'), "/")."/wp-content/plugins/spotify-play-for-wordpress/editor_plugin.js";
   $plugin_array['spbfwplugin'] = $url;
   return $plugin_array;
}
 
// init process for button control
add_action('init', 'spotify_play_button_for_wordpress_addbuttons'); 

add_shortcode( 'spotify', 'spotify_play_button_for_wordpress_shortcode' );

function spotify_play_button_for_wordpress_shortcode( $atts ) {
	$track = get_option('spotify-play-button-for-wordpress-default');
	$size = get_option('spotify-play-button-for-wordpress-size');
   extract( shortcode_atts( array(
      'track' => $url, 'size' => $num
      ), $atts ) );
 
 	$feeddisplay = spotify_play_button_for_wordpress_notecho(esc_attr($track),esc_attr($size));
 
   return $feeddisplay;
}

function spotify_play_button_for_wordpress_notecho($disptrack = "", $dispsize = "") {
$link = get_option("spotify-play-button-for-wordpress-link");

if ($dispsize == "" || $dispsize == "null")
{
$size = get_option('spotify-play-button-for-wordpress-size');
}
if ($dispsize != "large" || $dispsize != "compact")
{
$size = get_option('spotify-play-button-for-wordpress-size');
}
if ($disptrack == "" || $disptrack == "null")
{
	$disptrack = get_option('spotify-play-button-for-wordpress-default');
}
$display = "";
if ($size == "large")
{
	$display .= '<iframe src="https://embed.spotify.com/?uri='.$disptrack.'" width="300" height="380" frameborder="0" allowtransparency="true"></iframe>';
}
if ($size == "compact")
{
	$display .= '<iframe src="https://embed.spotify.com/?uri='.$disptrack.'" width="300" height="80" frameborder="0" allowtransparency="true"></iframe>';	
}

if ($link == 1)
{
	$display .= "<br/><a href='http://bloggingdojo.com/wordpress-plugins/spotify-play-button-for-wordpress/'>Spotify Play Button Plugin for WordPress</a> by <a href='http://www.bloggingdojo.com'>The Blogging Dojo</a><br/><br/>";
}

return $display;

}

function spotify_play_button_for_wordpress_install() {
		add_option('spotify-play-button-for-wordpress-default', 'spotify:user:rhyswynne:playlist:1IT5BeKUj2vwK4RQCkkWh6');
		add_option('spotify-play-button-for-wordpress-size', 'large');
		add_option('spotify-play-button-for-wordpress-link', 0);
}

?>