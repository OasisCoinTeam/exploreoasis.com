<?php

if (!class_exists('CoolTimelineShortcode')) {

    class CoolTimelineShortcode {

        /**
         * The Constructor
         */
        public function __construct() {
           
            // registering cool timeline shortcode
			 add_action('init', array($this, 'cooltimeline_register_shortcode'));
			//adding required assets
			 add_action('wp_enqueue_scripts', array($this, 'ctl_load_scripts_styles'));
			 add_action( 'plugins_loaded', array($this,'load_ctl_for_elementor'));
			// Call actions and filters in after_setup_theme hook
		 	add_action( 'after_setup_theme',array($this, 'ctl_crm'),999 );
			// custom excerpt length filter for story content
			add_filter('excerpt_length', array($this, 'ctl_f_custom_excerpt_length'), 999);
	
        }
	
		function ctl_crm() {
		   // add more link to excerpt
		   function ctl_f_custom_excerpt_length($more) {
			  global $post;
			   $ctl_options_arr =get_option('cool_timeline_options');
			   $ctl_display_readmore = isset($ctl_options_arr['display_readmore'])?$ctl_options_arr['display_readmore']:'yes';

				if ($post->post_type == 'cool_timeline' && !is_single() ){
					 if($ctl_display_readmore=='yes'){
							$read_more_txt = apply_filters('cool_timeline_read_more_text',__('Read More', 'cool-timeline'));
							 return '..<a class="read_more ctl_read_more" href="'. get_permalink($post->ID) . '">'.$read_more_txt .'</a>';
					   }  
				 }else{
				  	return $more;
				 }
			}
			add_filter('excerpt_more', 'ctl_f_custom_excerpt_length', 999);
		}

		function load_ctl_for_elementor(){

		if (did_action( 'elementor/loaded' ) ) {
			add_shortcode('cool-timeline', array($this,'cooltimeline_view'));
			}
			
		}
		// story content length filter callback
		function ctl_f_custom_excerpt_length( $length ) {
			global $post;
			$ctl_options_arr = get_option('cool_timeline_options');
			$ctl_content_length = isset($ctl_options_arr['content_length'])?$ctl_options_arr['content_length']:100;
			if ($post->post_type == 'cool_timeline' && !is_single() ){
				return $ctl_content_length;
				}
			return $length;
		}

		/*
		 Adding cool-timeline shortcode 
		*/

        function cooltimeline_register_shortcode() {
        	 add_shortcode('cool-timeline', array($this,'cooltimeline_view'));
		 }

		 // shortcode callback
	    function cooltimeline_view($atts, $content = null) {
			$attribute = shortcode_atts(array(
               'post_per_page' => 10,
				'layout'=>'',
				'animation'=>'',
				'date-format'=>'',
				'icons'=>'',
				'show-posts'=>'',
				'skin'=>'default'
                    ), $atts);
			$skin=$attribute['skin'];
			$ctl_options_arr = get_option('cool_timeline_options');
			$layout=$attribute['layout'];
			// loading timeline assets on shortcode specific page
			$this->ctl_load_assets($layout);

		
		 $ctl_title_text =isset($ctl_options_arr['title_text'])?$ctl_options_arr['title_text']:'';
         $ctl_title_tag = $ctl_options_arr['title_tag'];

		 if(isset($ctl_options_arr['user_avatar']['id'])){
				$user_avatar =wp_get_attachment_image_src($ctl_options_arr['user_avatar']['id'],'ctl_avatar');
				}
		   $ctl_post_per_page = $ctl_options_arr['post_per_page'];
			$story_desc_type = $ctl_options_arr['desc_type'];
			$ctl_no_posts= isset($ctl_options_arr['no_posts'])?$ctl_options_arr['no_posts']:"No timeline post found";
			$ctl_content_length =  isset($ctl_options_arr['content_length'])?$ctl_options_arr['content_length']:100;
			$ctl_posts_orders = $ctl_options_arr['posts_orders']?$ctl_options_arr['posts_orders']:"DESC";
			$disable_months =isset($ctl_options_arr['disable_months'])?$ctl_options_arr['disable_months']:"no";
			$title_alignment = $ctl_options_arr['title_alignment']?$ctl_options_arr['title_alignment']:"center";
		 $display_readmore= isset($ctl_options_arr['display_readmore'])?$ctl_options_arr['display_readmore']:"yes";

            $ctl_post_per_page=$ctl_post_per_page ? $ctl_post_per_page : 10;
            $ctl_title_text = $ctl_title_text ? $ctl_title_text : 'Timeline';
            $ctl_title_tag = $ctl_title_tag ? $ctl_title_tag : 'H2';
         
			$wrp_cls = 'white-timeline';
			$post_skin_cls = 'light-grey-post';
			$wrapper_cls = 'white-timeline-wrapper';$output='';$ctl_html='';$ctl_avtar_html='';
			
			$display_year = '';	$wrp_cls='';$ctl_format_html='';$ctl_html_no_cont='';$ctl_animation='';$st_cls=''; $post_content="";
			 $horizontal_html="";
			$format =__('d/M/Y','cool-timeline');
		    $year_position = 2;
			$i = 0;

			/* checking timeline layout and creating classes */

		
			if ($attribute['layout'] == "one-side") {
		    $layout_cls = 'one-sided';
		    $layout_wrp = 'one-sided-wrapper';
				}elseif ($attribute['layout'] == "compact"){
			 $layout_cls = 'compact';
		    $layout_wrp = 'compact-wrapper';
			}  else {
			    $layout_cls = '';
			    $layout_wrp = 'both-sided-wrapper';
			}
	
		if($attribute['layout']){
			$wrp_cls=$attribute['layout'];
			}else{
			 $wrp_cls='default-layout';
			}
			if($attribute['icons']=="YES"){
			$clt_icons="icons_yes";
			}else{
			 $clt_icons="icons_no";
			}
			if (isset($attribute['animation'])) {
                    $ctl_animation=$attribute['animation'];
            }else{
              $ctl_animation ='bounceInUp';
                 }

           if($layout !="simple"){
				$st_cls='simple-layout';
			}else{
				$st_cls='default-layout';
			}
      // date format for timeline stories
            $p_format=$this->ctl_date_formats($attribute['date-format'],$ctl_options_arr);     
		
		// timeline stories custom loop
			$args = array(
		   'post_type' => 'cool_timeline', 
		   'posts_per_page' => $ctl_post_per_page,
		   'post_status' => array( 'publish', 'future' ),
		   'orderby' => 'date',
		   'order' =>$ctl_posts_orders
		   );
		   
		   	// paged for pagination 
			$args['paged']= (get_query_var('paged')) ? get_query_var('paged') : 1;
			$paged=$args['paged'];
		
		   if ($attribute['show-posts']) {
			$args['posts_per_page'] = $attribute['show-posts'];
			if($attribute['layout']=="horizontal"){
				$args['posts_per_page'] =-1;
			}
			} else {
				$args['posts_per_page'] = $ctl_post_per_page;
			}

			$ctl_loop = new WP_Query(apply_filters( 'ctl_stories_query',$args));
			$total_stories= $ctl_loop->found_posts;
            if ($ctl_loop->have_posts()){		
                while ($ctl_loop->have_posts()) : $ctl_loop->the_post();
				$p_id=get_the_ID();
              	global $post;
				  $img_cont_size = get_post_meta($post->ID, 'image_container_type', true);
				  $container_cls=isset($img_cont_size)?$img_cont_size:"Full";	
				  $container_cls=strtolower($container_cls);
				// grabing stories posted date for later use
				 $posted_date=get_the_date(__(apply_filters( 'cool_timeline_story_date',$p_format),'cool-timeline'));
				// grabing stories content according to the  dynamic settings 
				 if($story_desc_type=='full'){
					$post_content =apply_filters( 'the_content', get_the_content() );
					$post_content = apply_filters('cool_timeline_story_content',$post_content);
				}else{
					$post_content =apply_filters( 'cool_timeline_story_content',get_the_excerpt());
					}
				// adding clasess for alernate styles.
				 if ($i % 2 == 0) {
					$even_odd = "even";
					} else {
					$even_odd = "odd";
					}
				// Generating Stories Hightlighted Year only for default and one sided timeline layouts
                $post_date = explode('/', get_the_date($format));
        if(in_array($layout,array("simple","compact"),TRUE)!=true){
                    $post_year = $post_date[$year_position];
                    if ($post_year != $display_year) {
                     $display_year = $post_year;
                     $year_cls=$this->ctl_story_cls($post_year);
						$ctle_year_lbl = sprintf('<span class="ctl-timeline-date">%s</span>', $post_year);
						$ctl_html .= '<div  class="timeline-year scrollable-section"
						data-section-title="' . $post_year . '" id="clt-' . $post_year . '">
						<div class="icon-placeholder">' . $ctle_year_lbl . '</div>
						<div class="timeline-bar"></div>
						</div>';
						}
				}
			
				// timeline stories all classes
				$compt_cls=$layout=="compact"?"timeline-mansory":'';
				$p_cls=array();
		        $p_cls[]="timeline-post";
		        $p_cls[]=esc_attr($even_odd);
		        $p_cls[]=esc_attr($post_skin_cls);
		        $p_cls[]=esc_attr($clt_icons);
		        $p_cls[]=$layout=="compact"?"timeline-mansory":'';
		        $p_cls[]= esc_attr($skin).'-skin';
		        $p_cls=apply_filters('ctl_story_clasess',$p_cls);
		        		
				$ctl_html .='<!-- .timeline-post-start-->';
				$ctl_html .='<div class="'.implode(" ",$p_cls).'"  id="story-'.esc_attr($p_id).'">';
				if($layout!="compact"){
				$ctl_html .='<div class="timeline-meta">';
				if($disable_months=="no"){
					$ctl_html .= '<div class="meta-details">' . $posted_date . '</div>';
				} 
				$ctl_html .= '</div>';
				}
				// grabing stories icon
				if(function_exists('get_fa')){
		        $post_icon=get_fa(true);
				}
		        if(isset($post_icon)){
		            $icon=$post_icon;
		        }else{
		           $icon = '<i class="fa fa-clock-o" aria-hidden="true"></i>';
		         }
		 
  			if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
			$ctl_html .='<div class="timeline-icon icon-larger iconbg-turqoise icon-color-white">
                    	<div class="icon-placeholder">'.$icon.'</div>
                        <div class="timeline-bar"></div>
                    </div>';
			}else {
			$ctl_html .= '<div class="timeline-icon icon-dot-full"><div class="timeline-bar"></div></div>';
			}

	 $ctl_html .= '<div class="timeline-content clearfix">';
// story date for compact layout
	 if($layout =="compact"){
	 if($disable_months=="no"){
		$ctl_html .= '<h2 class="content-title">' . $posted_date . '</h2>';
			} 
		}else{
		     $ctl_html .= '<h2 class="content-title">' . get_the_title($p_id) . '</h2>';
 		}	
    $ctl_html .= '<div class="ctl_info event-description ' . $container_cls . '">';
    $ctl_html .=$this->clt_story_featured_img($p_id);
    $ctl_html .= '<div class="content-details">';

	 if($layout =="compact"){
	 $ctl_html .= '<h3 class="content-title-cmt">'.get_the_title($p_id).'</h3>';
		}
	 $ctl_html .=$post_content;
	 $ctl_html .= '</div></div></div><!-- timeline content --></div><!-- .timeline-post-end -->';
	
	$ctl_format_html = '';
	
// creating Horizontal layout HTML
if($layout =="horizontal"){
	$h_story_content='';

$horizontal_html.='<li class="year-'.$post_year.' '.$even_odd.' '.$year_cls.'">';
	// grabing Highlighted Year
	if($attribute['date-format']==""||$attribute['date-format']=="Y"){
		$story_main_date=get_the_date(__('Y','cool-timeline'));
	}else{
		$story_main_date=$posted_date;
	}
			if( $display_readmore=="yes"){
				$horizontal_html.='<a ref="prettyPhoto" href="#ctl-story-'.$p_id.'">';
			}
			$horizontal_html.='<div class="ctl-story-year"><span class="rm_year">'.$story_main_date.'</span></div>';
			$horizontal_html.='<div class="ctl-story-title"><p class="story_title">';
			$horizontal_html.=get_the_title();
			$horizontal_html.='</p></div>';
			if( $display_readmore=="yes"){
				$horizontal_html.='</a>';
			}
			
		$horizontal_html.='<div id="ctl-story-'.$p_id.'" class="ctl_hide"><div class="ctl-popup-content">
			<h2>'.get_the_title().'</h2>';
			$story_posted_date=get_the_date(__(apply_filters( 'cool_timeline_story_date','F j, Y'),'cool-timeline'));
			$horizontal_html.='<div class="story-posted-date">'.$story_posted_date.'</div>';
		
			if ( has_post_thumbnail($p_id) ) {
				$horizontal_html .= '<div class="full-width">';
				$horizontal_html .=$this->clt_story_featured_img($p_id);
				$horizontal_html .= '</div>';
			}
		$horizontal_html.='<div class="story-content">'.$post_content.'</div>';
		$horizontal_html.='</div></div>';
	   $horizontal_html.='</li>';
	}
	$post_content = '';
	$i++;		
	endwhile;
    wp_reset_postdata();
	} else {
		$ctl_html_no_cont .= '<div class="no-content"><h4>';
		//$ctl_html_no_cont.=$ctl_no_posts;
		$ctl_html_no_cont .= __('Sorry,You have not added any story yet', 'cool-timeline');
		$ctl_html_no_cont .= '</h4></div>';
	}
	
	/*
		Timeline Main Container Wrapper
	*/
	
		$timeline_id="ctl-free-one";	
		$output .='<! ========= Cool Timeline Free '. COOL_TIMELINE_CURRENT_VERSION.' =========>';
	   $main_wrp_cls=array();

// Generating Wrapper for Vertical timeline
if($layout!="horizontal"){  
		// creating classes
        $main_wrp_cls[]="cool_timeline";
        $main_wrp_cls[]="cool-timeline-wrapper";
        $main_wrp_cls[]=$layout_wrp;
        $main_wrp_cls[]=$wrapper_cls;
        $main_wrp_cls[]=$skin.'-skin-tm';
        $main_wrp_cls=apply_filters('ctl_wrapper_clasess',$main_wrp_cls);     

		$output .= '<div class="'.implode(" ",$main_wrp_cls).'">';
		if (isset($user_avatar[0]) && !empty($user_avatar[0])) {
					$ctl_avtar_html .= '<div class="avatar_container row"><span title="' . $ctl_title_text . '"><img  class="center-block img-responsive img-circle" alt="' . $ctl_title_text . '" src="' . $user_avatar[0] . '"></span></div> ';
				}
			  //  if ($title_visibilty == "yes") {
                $output .= sprintf(__('<%s class="timeline-main-title center-block">%s</%s>', 'cool-timeline'), $ctl_title_tag, $ctl_title_text, $ctl_title_tag);
            //}	
				$output .= $ctl_avtar_html;
			$output .= '<div class="cool-timeline white-timeline ultimate-style ' . $layout_wrp . ' ' . $wrp_cls.
			' ' .$layout_cls.'">';
			$output .= '<div data-animations="'.$ctl_animation.'"  id="' . $timeline_id . '" class="cooltimeline_cont  clearfix '.$clt_icons.'">';
			if($layout=="compact"){
				$output .='<div class="center-line">
            </div>';
			}
			$output .= $ctl_html;
            $output .= $ctl_html_no_cont;
            $output .= '</div>';

		$output .= '<div class="clearfix"></div></div>';
		//if ($enable_pagination == "yes") {
		$output .=ctl_pagination($ctl_loop->max_num_pages, "", $paged);
		//}
		$output .=' </div><!-- end
 		================================================== -->';

 		}else{
			$slidetoshow=3;
			
		if($attribute['show-posts']>$total_stories){
			$slidetoshow=$total_stories;
		}else{
			$slidetoshow=$attribute['show-posts'];
		}

	// Horizontal timeline Wrapper		
 		   $output .= '<div class="cool_timeline_horizontal"><ul data-slide-to-show="'.$slidetoshow.'" class="ctl_road_map_wrp">';
 			$output .=$horizontal_html;
 			$output .='</ul></div>';
 		}
            return $output ;
		}


	/*
        Date format settings for stories
     */

	function ctl_date_formats($date_format,$ctl_options_arr){
		$date_formats='';
   	 if(!empty($date_format)){
              if($date_format=="default"){
                  $date_formats = $ctl_options_arr['ctl_date_formats'] ? $ctl_options_arr['ctl_date_formats'] : "F j";
                }else{
                     $df=$date_format;
                     $date_formats =__("$df",'cool-timeline');     
                     }  
       }else{
          	$date_formats =__('F j','cool-timeline');
            }

            return $date_formats;
	 }

	 /*
	 Get story featured image  
	 */

	 function clt_story_featured_img($post_id){
 		$img_cont_size = get_post_meta($post_id, 'image_container_type', true);
		 $img_html='';
		$imgAlt = get_post_meta(get_post_thumbnail_id($post_id),'_wp_attachment_image_alt', true); 
		$alt_text=$imgAlt?$imgAlt:get_the_title($post_id);
		 $img_f_url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
		 $story_img_link = '<a title="' . esc_attr(get_the_title($post_id)). '"  href="' . $img_f_url . '" class="ctl_prettyPhoto">';
			
			if ($img_cont_size == "Small") {
		    
		    if ( has_post_thumbnail($post_id) ) {
		         $img_html .= '<div class="pull-left">';
		        $img_html.=$story_img_link;
		        $img_html.=get_the_post_thumbnail( $post_id,apply_filters('cool_timeline_story_img_size','thumbnail'), array( 'class' => 'story-img left_small','alt'=>$alt_text) );
		         $img_html.='</a></div>';
		         }
		      } else {
		         if ( has_post_thumbnail($post_id) ) {
		        $img_html .= '<div class="full-width">';
		        $img_html.=$story_img_link;
		        $img_html.=get_the_post_thumbnail( $post_id,apply_filters('cool_timeline_story_img_size','large'), array( 'class' => 'story-img','alt'=>$alt_text) );
		         $img_html.='</a></div>';
		         }
		      
		     }      
		     
		      return  $img_html;
		}


		/*
		* Registered All assets 
		*/
		
     
        function ctl_load_scripts_styles() {
			/*
			 * google fonts
			 */
			
			$ctl_options_arr = get_option('cool_timeline_options');
		
			$post_content_face=$ctl_options_arr['post_content_typo']['face'];
			$post_title=$ctl_options_arr['post_title_typo']['face'];
			$main_title=$ctl_options_arr['main_title_typo']['face'];
			$selected_fonts = array($post_content_face,$post_title,$main_title);
		   /*
            * google fonts
            */
            // Remove any duplicates in the list
            $selected_fonts = array_unique($selected_fonts);
            // If it is a Google font, go ahead and call the function to enqueue it
            $gfont_arr=array();

        if(is_array($selected_fonts)){

            foreach ($selected_fonts as $font) {
                if ($font && $font != 'inherit') {
                    if ($font == 'Raleway')
                        $font = 'Raleway:100';
                    $font = str_replace(" ", "+", $font);
                     $gfont_arr[]=$font;
                }
            }
           if(is_array($gfont_arr)){
             $allfonts=implode("|",$gfont_arr);
	             if($allfonts){
	             wp_register_style("ctl-gfonts", "https://fonts.googleapis.com/css?family=$allfonts", false, null, 'all');
	       		  }
              }
           
          }
            wp_register_style("ctl-default-fonts", "https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800", false, null, 'all');
	
			wp_register_style('ctl-styles', COOL_TIMELINE_PLUGIN_URL . 'css/ctl_styles.min.css',null, null,'all' );	
			wp_register_style('ctl-animate', COOL_TIMELINE_PLUGIN_URL . 'css/animate.min.css', null, null, 'all');
			wp_register_style('clt-font-awesome', COOL_TIMELINE_PLUGIN_URL . 'fa-icons/css/font-awesome/css/font-awesome.min.css', null, null, 'all');
			wp_register_script('ctl-viewportchecker', COOL_TIMELINE_PLUGIN_URL . 'js/jquery.viewportchecker.js', array('jquery'), null, true);   
		    wp_register_style('ctl-prettyPhoto', COOL_TIMELINE_PLUGIN_URL . 'css/prettyPhoto.css', null, null, 'all');
			wp_register_script('ctl-prettyPhoto', COOL_TIMELINE_PLUGIN_URL . 'js/jquery.prettyPhoto.js', array('jquery'), null, true);  
			
			wp_register_script('ctl-slick-js','https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
			wp_register_style("ctl-slick-css", "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css");
			
			wp_register_script('ctl-scripts', COOL_TIMELINE_PLUGIN_URL . 'js/ctl_scripts.min.js', array('jquery'), null, false);
			wp_register_script('ctl-horizontal-tm-js', COOL_TIMELINE_PLUGIN_URL . 'js/ctl_hori_scripts.min.js', array('jquery'), null, false);
			
			wp_register_script('ctl-masonry', COOL_TIMELINE_PLUGIN_URL . 'js/masonry.pkgd.min.js', array('jquery'), false, false);
			wp_register_script('ctl-compact-js', COOL_TIMELINE_PLUGIN_URL . 'js/ctl_compact_scripts.min.js', array('jquery','ctl-masonry'), false, false);
	
			 }
		// loading js and css according to the layout type in shortcode	 
		function ctl_load_assets($layout){
			// all common assets
			wp_enqueue_style('clt-font-awesome');
			wp_enqueue_style('ctl-default-fonts');
			wp_enqueue_style('ctl-gfonts');
			wp_enqueue_style('ctl-prettyPhoto');
			wp_enqueue_script('ctl-prettyPhoto');	
			wp_enqueue_style('ctl-styles');
			// vertical layout only assets.
			if($layout!="horizontal"){
				wp_enqueue_script('ctl-viewportchecker');
				wp_enqueue_style('ctl-animate');
				wp_enqueue_script('ctl-scripts');
			}
		// compact layout dynamic Js
		if($layout == "compact"){
			wp_enqueue_script('ctl-masonry');
			wp_enqueue_script( 'ctl-compact-js');
			
			}else if($layout== "horizontal"){
				 // Horizontal Timeline Assets.
				wp_enqueue_style('ctl-slick-css');
				wp_enqueue_script('ctl-slick-js');
				wp_enqueue_script('ctl-horizontal-tm-js');
			}	
		
		}	 
	
		// dyamic class according to the year
		function ctl_story_cls($year){
			$now = new DateTime();
			$yNow = $now->format('Y');

			if($year<$yNow){
				return "past-year";
			}else if($year>$yNow){
				return "future-year";
			}else{
			return "current-year";	
			}
		}

    }

} // end class


