<?php
/** 
Template Name: Contact Template
 */

get_header(); ?>

	<!--contact_bar-->
	<div class="contact_bar">
    	<div class="centering">
        
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; endif;?>

				

        </div>    
    </div>
	<!--about_bar-->

<?php get_footer(); ?>