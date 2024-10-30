<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       dangngocbinh.com
 * @since      1.0.0
 *
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/public
 * @author     Dang Ngoc Binh <dangngocbinh.dnb@gmail.com>
 */
class Mobi_Actionbar_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('wp_head', array($this,'show_action_bar_on_mobile'));

	}

	public function embed_css(){
		?>
		<style type="text/css">
			.menufix {
			    position: fixed;
			    top: -70px;
			    left: 0;
			    width: 100%;
			    background-color: #1C4982;
			    border-bottom: solid 1px #ccc;
			    z-index: 999999;
			    box-shadow: 0 0 5px rgba(0,0,0,0.1);
			    padding: 10px 0 10px 0;
			    
			}

			.menufix.showfromtop{
				animation-name: show_action_bar;
			    animation-duration: 0.75s;
			    top: 0;
			}

			a.logo-action-bar {
			    display: block;
			    float: left;
			    width: 30%;
			    padding: 0 10px;
			}

			.logo-action-bar img {
			    max-height: 50px;
			    width: auto;
			}

			
			.menufix .btnDangky {
			    float: right;
			    display: block;
			    background-color: #50FF00;
			    border-radius: 4px;
			    height: 45px;
			    padding: 0 20px;
			    margin: 0 20px;
			    color: #1C4982;
			    font-weight: bold;
			    font-size: 16px;
			    line-height: 43px;
			    transition: all 0.18s;
			    text-align: center;
			}

			@keyframes show_action_bar {
			    from {top: -70px;}
			    to {top:0 ;}
			}
			
		</style>
		<?php 
	}

	public function embed_js(){
		?>
		<script type="text/javascript">
	    	jQuery(function(){
			  jQuery(window).scroll(function(){
			    var aTop = 200;
			    if(jQuery(this).scrollTop() >= aTop){
			    	if(!jQuery('#action_bar_mobile').hasClass('showfromtop')){
			    		jQuery('#action_bar_mobile').addClass('showfromtop');	
			    	}		        
			    }

			  });

			  jQuery('a[href*="#"]:not([href="#"])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = jQuery(this.hash);
			      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        jQuery('html, body').animate({
			          scrollTop: target.offset().top
			        }, 1000);
			        return false;
			      }
			    }
			  });
			});
	    </script>
		<?php
	}

	public function  show_action_bar_on_mobile(){
		if(!wp_is_mobile()) return;

		$this->embed_css();
		$this->embed_js();

		
		$button_text = get_option( 'mobi_actionbar_global_button_text', false );
		$action_link = get_option( 'mobi_actionbar_global_action_link', false );
		$logo_id = get_option( 'mobi_actionbar_global_logo', false );
		if($logo_id){
			$logo_link = wp_get_attachment_url( $logo_id );	
		}else{
			$logo_link = plugin_dir_url( __FILE__ ) . '../admin/images/demo-logo.png';
		}
		
		?>
		

		<div class="menufix mobile" id="action_bar_mobile">
	        <a href="<?php echo $action_link; ?>" class="logo-action-bar" >
	            <img src="<?php echo $logo_link; ?>" width="90px" height="auto" alt="">
	        </a>
	        <a href="<?php echo $action_link; ?>" class="btnDangky btnButtonColor"><?php echo $button_text; ?> ➔</a>
	        <div style="clear:both;"></div>
	    </div>
	    
    	<?php 

	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mobi-actionbar-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mobi-actionbar-public.js', array( 'jquery' ), $this->version, false );

	}

}
