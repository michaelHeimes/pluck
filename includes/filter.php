<?php
 
 /* Example For include JS/CSS*/
 add_action('wp_enqueue_scripts','custom_scripts');
 function custom_scripts(){
	 
	//wp_enqueue_script('jquery.fancybox', get_template_directory_uri() . "/includes/fancybox/jquery.fancybox.js", '', '', false);
	
	
	//wp_enqueue_script('jquery.fancybox-media', get_template_directory_uri() . "/includes/fancybox/helpers/jquery.fancybox-media.js", '', '', false);
	
	
	//wp_enqueue_style('jquery.fancybox-css', get_template_directory_uri() . "/includes/fancybox/jquery.fancybox.css");
 
 
	//wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	//wp_enqueue_script('handle-unique-name',get_template_directory_uri()."js path here ",'','',false);
	 
	 //wp_enqueue_style( $handle, $src, $deps, $ver, $media ); 
	  //wp_enqueue_style('css-handler-name',get_template_directory_uri()."Css file path here");
 	
	
	 //wp_enqueue_script('Cycle2', get_template_directory_uri() . "/js/cycle2/Cycle2.js", array('jquery') , '1.10.0', true);


  //wp_enqueue_script('cycle2carousel', get_template_directory_uri() . "/js/cycle2/cycle2carousel.js", array('jquery') , '1.10.0', true);
  }
 
 
 
 
 
 /* =========================================
 	Comment Form Validation
    ========================================== */
	add_action('wp_enqueue_scripts', 'wp_comments_scripts');
	function wp_comments_scripts() {
    wp_enqueue_script('jquery');
    
	wp_register_script('validation_js',get_template_directory_uri()."/js/jquery-validation/jquery.validate.min.js", array("jquery"));
    wp_enqueue_script('validation_js');
	
	
	wp_register_style('validation_css',get_template_directory_uri()."/js/jquery-validation/jquery.validate.css");
    wp_enqueue_style('validation_css');
	
	
	}
    add_action('wp_footer', 'comment_form_validation'); 
	function comment_form_validation(){
		 ?>
		 <script type="text/javascript">
		/* <![CDATA[ */
            jQuery(function(){
					
				jQuery('#commentform').validate({
			
			rules:{


	 		author:{
	 required: true,
			 },
		 email:{





 required: true,





		 email: true










					 },
		 comment:{





						 required: true,


					 }




				},
			messages:{
					author:{
required: '',
			 },
		 email:{





required: '',





		 email: true










					 },
		 comment:{




required: '',
						


					 }
				}	








		
		
			   			
						
            }) 
			});
			
            /* ]]> */
        </script>
		 <?php
		}  
?>