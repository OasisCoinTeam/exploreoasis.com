<?php
/*
  Plugin Name:Cool Timeline 
  Plugin URI:https://www.cooltimeline.com
  Description:Cool Timeline is a responsive WordPress timeline plugin that allows you to create beautiful vertical storyline. You simply create posts, set images and date then Cool Timeline will automatically populate these posts in chronological order, based on the year and date
  Version:1.6.3
  Author:Cool Plugins
  Author URI:https://coolplugins.net/our-cool-plugins-list/
  License:GPLv2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages
  Text Domain:cool-timeline
 */

/** Configuration * */
if (!defined('COOL_TIMELINE_CURRENT_VERSION')){
    define('COOL_TIMELINE_CURRENT_VERSION', '1.6.3');
}
// define constants for further use
define('COOL_TIMELINE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    define('COOL_TIMELINE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
 	define( 'FA_DIR', COOL_TIMELINE_PLUGIN_DIR.'/fa-icons/' );
	define( 'FA_URL', COOL_TIMELINE_PLUGIN_URL.'/fa-icons/'  );

//if (!class_exists('CoolTimeline')) {

    class CoolTimeline {

        /**
         * Construct the plugin object
         */
        public function __construct() {
          
            $this->plugin_path = COOL_TIMELINE_PLUGIN_DIR;
          /*
            Including required files
          */
          add_action('plugins_loaded', array($this, 'clt_include_files'));
        // $this->clt_include_files();

        //gutenberg block integartion
        require COOL_TIMELINE_PLUGIN_DIR . 'includes/gutenberg-block/ctl-block.php';

         // Cool Timeline all hooks integrations
         if(is_admin()){
            $plugin = plugin_basename(__FILE__);
            // plugin settings links hook
            add_filter("plugin_action_links_$plugin", array($this, 'plugin_settings_link'));

            // integrated shortcode generator on text editor
          	add_action( 'after_setup_theme', array($this , 'ctl_add_tinymce' ) );
            // loading date picker assets
            add_action( 'admin_enqueue_scripts',array($this , 'load_ctdp_admin_style_script'));
           
           // admin notificaiton for review
            add_action( 'admin_notices',array($this,'cool_admin_messages'));
            add_action( 'wp_ajax_hideRating',array($this,'cool_HideRating' ));
            }
            
            //loading plugin translation files
            add_action('plugins_loaded', array($this, 'clt_load_plugin_textdomain'));
		        //Fixed bridge theme confliction using this action hook
            add_action( 'wp_print_scripts', array($this,'ctl_deregister_javascript'), 100 );
          
            add_image_size( 'ctl_avatar', 250, 250,true );
         }
		
        /*
          Including required files
        */
      public function clt_include_files(){

           // cooltimeline post type
            add_action( 'init', array($this, 'include_files' ) );
            require COOL_TIMELINE_PLUGIN_DIR . 'includes/cool-timeline-posttype.php';
            $cool_timeline_posttype = new CoolTimelinePosttype();

            /*
             *  Frontend files
             */
             // contains helper funciton for timeline
            include_once COOL_TIMELINE_PLUGIN_DIR . 'includes/ctl-helper-functions.php';

            //Cool Timeline Main shortcode
            require COOL_TIMELINE_PLUGIN_DIR . 'includes/cool-timeline-shortcode.php';
            
            new CoolTimelineShortcode();
            add_action('wp_enqueue_scripts','ctl_custom_style');

            /*
              Loaded Backend files only 
            */
            if(is_admin()){
            //metaboxes for cooltimeline post type
            include_once COOL_TIMELINE_PLUGIN_DIR . 'includes/metaboxes.php';
            
            /*
             Plugin Settings panel 
            */
            require_once(plugin_dir_path(__FILE__) ."admin-page-class/admin-page-class.php");
           
            require COOL_TIMELINE_PLUGIN_DIR.'includes/cool-timeline-settings.php';
            // Initialize Settings
            ctl_option_panel();

            // icon picker for post type
            require COOL_TIMELINE_PLUGIN_DIR.'fa-icons/fa-icons-class.php';
            new Ctl_Fa_Icons();
            }
      }
      // loading language files
       function clt_load_plugin_textdomain() {
              $rs = load_plugin_textdomain('cool-timeline', FALSE, basename(dirname(__FILE__)) . '/languages/');
          }

        // Add the settings link to the plugins page
        function plugin_settings_link($links) {
            $settings_link = '<a href="options-general.php?page=cool_timeline_page">Settings</a>';
            array_unshift($links, $settings_link);
            return $links;
        }
        
        // loading date time picker for timeline stories
      function load_ctdp_admin_style_script($hook) {
   
			if( 'post.php' != $hook && 'post-new.php' != $hook)
				return;

      if(get_cpt()=="cool_timeline"){

    			if( apply_filters( 'add_ctdp_timepicker_js', true ) ){
    				wp_enqueue_script( 'timepicker-js', COOL_TIMELINE_PLUGIN_URL . 'js/jquery-ui-timepicker-addon.js', array( 'jquery-ui-datepicker' ) );
    			}
    			if( apply_filters( 'add_ctdp_js', true ) ){
    				wp_enqueue_script( 'ctdp-js', COOL_TIMELINE_PLUGIN_URL . 'js/ctdp.js', array( 'timepicker-js' ) );
    			}
    			if( apply_filters( 'add_ctdp_css', true ) ){
    				wp_enqueue_style( 'ctdp-css', COOL_TIMELINE_PLUGIN_URL . 'css/ctdp.css' );
    			}
      }
		}
       /*
        * Fixed Bridge theme confliction
        */
        function ctl_deregister_javascript() {

            if(is_admin()) {
                $screen = get_current_screen();
                if ($screen->base == "toplevel_page_cool_timeline_page") {
                    wp_deregister_script('default');
                }
            }
        }
        
		  public function include_files() {
        //flush rewrite rules after activation
        if ( get_option( 'ctl_flush_rewrite_rules_flag' ) ) {
            flush_rewrite_rules();
           delete_option( 'ctl_flush_rewrite_rules_flag' );
        }

            // Files specific for the front-end
            if ( ! is_admin() ) {
                // Load template tags (always last)
                include COOL_TIMELINE_PLUGIN_DIR .'fa-icons/includes/template-tags.php';
            }
        }

    // integrated shortcode generator button in text editor
		public function ctl_add_tinymce() {
         global $typenow;
         if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
              return;
        }
    
        if(get_cpt()=="cool_timeline"){
          return ;
        }
       if ( get_user_option('rich_editing') == 'true' ) {
            add_filter('mce_external_plugins', array($this, 'ctl_add_tinymce_plugin'));
            add_filter('mce_buttons', array($this, 'ctl_add_tinymce_button'));
          }    

        }

        //loading tinymce plugin  js
			public function ctl_add_tinymce_plugin( $plugin_array ) {
            $plugin_array['cool_timeline'] =COOL_TIMELINE_PLUGIN_URL.'/includes/js/tinymce-custom-btn.js';
			     return $plugin_array;
			}
      //added shortcode button in array
		function ctl_add_tinymce_button( $buttons ) {
            array_push( $buttons, 'cool_timeline_btn' );
			return $buttons;
			}
          
            
       	/**
         * Activating plugin and adding some info
         */
        public static function activate() {
              update_option("cool-timelne-v",COOL_TIMELINE_CURRENT_VERSION);
              update_option("cool-timelne-type","FREE");
              update_option("cool-timelne-installDate",date('Y-m-d h:i:s') );
              update_option("cool-timelne-ratingDiv","no");
              update_option("ctl_flush_rewrite_rules_flag",true);
        }

		// END public static function activate

        /**
         * Deactivate the plugin
         */
        public static function deactivate() {
            // Do nothing
        } 
      
      // Admin notificaiton for review  
   public function cool_admin_messages() {
  
     if( !current_user_can( 'update_plugins' ) ){
        return;
     }
    $install_date = get_option( 'cool-timelne-installDate' );
    $ratingDiv =get_option( 'cool-timelne-ratingDiv' )!=false?get_option( 'cool-timelne-ratingDiv'):"no";

    $dynamic_msz='<div class="cool_fivestar update-nag" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);">
   <div style="float:left" class="ctl_review_left">
   <a target="_blank" href="https://wordpress.org/support/plugin/cool-timeline/reviews/?filter=5#new-post">
   <img style="height: 80px; width: auto; margin-right: 10px;" src="'.COOL_TIMELINE_PLUGIN_URL.'/images/cool-timeline-logo.png">
   </a>
   </div>
   <div class="ctl_review_right">
    You have been using <b>Cool Timeline</b> for a while. We hope you liked it ! Please give us a quick rating, it works as a boost for us to keep working on the plugin !
    <ul>
        <li style="display:inline-block;"><a href="https://wordpress.org/support/plugin/cool-timeline/reviews/?filter=5#new-post" class="thankyou button button-primary" target="_new" title="I Like Cool Timeline">'.__('Submit Review ★★★★★').'</a></li>
        <li style="display:inline-block;"><a href="javascript:void(0);" class="coolHideRating button" title="I already did" style="">'.__('I already rated it').'</a></li>
        <li style="display:inline-block;float:right;"><a href="javascript:void(0);" class="coolHideRating button button-small" title="No, not good enough" style="">'.__('No, not good enough, i do not like to rate it!').'</a></li>
    </ul>
    </div>
    </div>
    <script>
    jQuery( document ).ready(function( $ ) {

    jQuery(\'.coolHideRating\').click(function(){
        var data={\'action\':\'hideRating\'}
             jQuery.ajax({
        
        url: "' . admin_url( 'admin-ajax.php' ) . '",
        type: "post",
        data: data,
        dataType: "json",
        async: !0,
        success: function(e) {
            if (e=="success") {
               jQuery(\'.cool_fivestar\').slideUp(\'fast\');
         
            }
        }
         });
        })
    
    });
    </script>';

     if(get_option( 'cool-timelne-installDate' )==false && $ratingDiv== "no" )
       {
       echo $dynamic_msz;
       }else{
            $display_date = date( 'Y-m-d h:i:s' );
            $install_date= new DateTime( $install_date );
            $current_date = new DateTime( $display_date );
            $difference = $install_date->diff($current_date);
          $diff_days= $difference->days;
        if (isset($diff_days) && $diff_days>=4 && $ratingDiv == "no" ) {
          echo $dynamic_msz;
          }
      }      

  }   
  
  // ajax handler for feedback callback
  public function cool_HideRating() {
    update_option( 'cool-timelne-ratingDiv','yes' );
    echo json_encode( array("success") );
    exit;
    }
  

        } //end class

    //}

   // get current page post type
    function get_cpt() {
        global $post, $typenow, $current_screen;
       if ( $post && $post->post_type )
            return $post->post_type;
       elseif( $typenow )
            return $typenow;
       elseif( $current_screen && $current_screen->post_type )
            return $current_screen->post_type;
        elseif( isset( $_REQUEST['post_type'] ) )
            return sanitize_key( $_REQUEST['post_type'] );
       return null;
      }


    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('CoolTimeline', 'activate'));
    register_deactivation_hook(__FILE__, array('CoolTimeline', 'deactivate'));

    // instantiate the plugin class
    $cool_timeline = new CoolTimeline();
