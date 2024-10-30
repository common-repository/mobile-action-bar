<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       dangngocbinh.com
 * @since      1.0.0
 *
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/admin
 * @author     Dang Ngoc Binh <dangngocbinh.dnb@gmail.com>
 */
class Mobi_Actionbar_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		new Mobi_ActionBar_OptionPage();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mobi_Actionbar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mobi_Actionbar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mobi-actionbar-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mobi_Actionbar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mobi_Actionbar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mobi-actionbar-admin.js', array( 'jquery' ), $this->version, false );

	}

}


class Mobi_ActionBar_OptionPage {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_footer', array($this,'media_selector_print_scripts' ));
	}

	function admin_menu() {
		add_options_page(
			'Mobile Action Bar - Setup',
			'Mobile Action Bar',
			'manage_options',
			'mobile-action-bar',
			array(
				$this,
				'settings_page'
			)
		);
	}

	function  settings_page() {
		wp_enqueue_media();

		if(isset($_POST['logo'])){
			update_option( 'mobi_actionbar_global_logo', trim($_POST['logo']) );
		}
		if(isset($_POST['button_text'])){
			update_option( 'mobi_actionbar_global_button_text', trim($_POST['button_text']) );
		}
		if(isset($_POST['action_link'])){
			update_option( 'mobi_actionbar_global_action_link', trim($_POST['action_link']) );
		}

		$logo = get_option( 'mobi_actionbar_global_logo', false );
		$button_text = get_option( 'mobi_actionbar_global_button_text', false );
		$action_link = get_option( 'mobi_actionbar_global_action_link', false );

		if(!$logo) {
			$logo = '0';
			$logo_link = plugin_dir_url( __FILE__ ) . 'images/demo-logo.png';
		}else{
			$logo_link = wp_get_attachment_url( get_option( 'mobi_actionbar_global_logo' ) );
		}

		if(!$button_text) {
			$button_text = 'Buy Now';
		}

		if(!$action_link) {
			$action_link = '#buynow';
		}

		?>
		<style type="text/css">
			.thik-form input[type="submit"]{
				min-width: 200px;
				margin-top: 30px;
			}

			.thik-form input{
				min-width: 200px;
			}

		</style>
		<h1 class="wp-heading-inline">Mobile Action Bar - Setup</h1>
		<p></p>
		<hr>
		<form action="" class="thik-form" method="POST">
			<label>Logo/ Image</label>
			<div class='image-preview-wrapper'>
				<img id='image-preview' src='<?php echo  $logo_link; ?>' height='100'>
			</div>
			<button id="choose_image">Choose Image</button>

			<br>
			<input type="hidden" name="logo" id="logopicker" value="<?php echo $logo; ?>">
			
			<label>Button Text</label>
			<input type="text" name="button_text" value="<?php echo $button_text; ?>">
			<br>
			<label>Action Link</label>
			<input type="text" name="action_link" value="<?php echo $action_link; ?>">
			<br>
			<input type="submit" name="capnhat" value="Update">
		</form>
		<hr>
		<p>Credit by: <a href="http://thikshare.com">ThikShare.com</a></p>
		<?php
	}


	
	public function media_selector_print_scripts() {
		$my_saved_attachment_post_id = get_option( 'mobi_actionbar_global_logo', 0 );
		?><script type='text/javascript'>
			jQuery( document ).ready( function( $ ) {
				// Uploading files
				var file_frame;
				var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
				var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
				jQuery('#choose_image').on('click', function( event ){
					event.preventDefault();
					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						// Set the post ID to what we want
						file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
						// Open frame
						file_frame.open();
						return;
					} else {
						// Set the wp.media post id so the uploader grabs the ID we want when initialised
						wp.media.model.settings.post.id = set_to_post_id;
					}
					// Create the media frame.
					file_frame = wp.media.frames.file_frame = wp.media({
						title: 'Select a image to upload',
						button: {
							text: 'Use this image',
						},
						multiple: false	// Set to true to allow multiple files to be selected
					});
					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						// We set multiple to false so only get one image from the uploader
						attachment = file_frame.state().get('selection').first().toJSON();
						// Do something with attachment.id and/or attachment.url here
						$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
						$( '#logopicker' ).val( attachment.id );
						// Restore the main post ID
						wp.media.model.settings.post.id = wp_media_post_id;
					});
						// Finally, open the modal
						file_frame.open();
				});
				// Restore the main ID when the add media button is pressed
				jQuery( 'a.add_media' ).on( 'click', function() {
					wp.media.model.settings.post.id = wp_media_post_id;
				});
			});
		</script><?php
	}
}