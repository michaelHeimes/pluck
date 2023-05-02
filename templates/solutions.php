<?php
/** 
Template Name: Solutions Template
 */

get_header(); ?>


	<?php if(get_the_post_thumbnail_url()) {?>
        <div class="inner_banner_bar" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
            <div class="centering">
                <h1><?php if(get_field('banner_heading_icon')) {?><img src="<?php the_field('banner_heading_icon')?>" alt="" /><?php }?><span><?php the_title(); ?></span></h1>
            </div>
        </div>
    <?php } elseif(get_field('banner_background_color')) {?>
        <div class="inner_banner_bar bg_color" style="background-color:<?php the_field('banner_background_color')?>;">
            <div class="centering">
                <h1><?php if(get_field('banner_heading_icon')) {?><img src="<?php the_field('banner_heading_icon')?>" alt="" /><?php }?><span><?php the_title(); ?></span></h1>
            </div>
        </div>
    <?php } else {?>
        <div class="inner_banner_bar default" style="background-image:url(<?php the_field('default_banner','option'); ?>);">
            <div class="centering">
                <h1><?php if(get_field('banner_heading_icon')) {?><img src="<?php the_field('banner_heading_icon')?>" alt="" /><?php }?><span><?php the_title(); ?></span></h1>
            </div>
        </div>
    <?php }?>


	<!--solution_bar-->
	<div class="solution_bar">
    	<div class="internal">
        
        	<div  id="horizontalTab">
                <div class="flex-row">
                    <ul class="left_side resp-tabs-list">
                
                        <?php //start by fetching the terms for the animal_cat taxonomy
                        $terms = get_terms( 'solutions-categories', array(
                            'orderby'    => 'count',
                            'hide_empty' => 0
                        ) );
                        ?>
                
                
                        <?php
                        // now run a query for each animal family
                         $k = 1;
						foreach( $terms as $term ) {
                            // Define the query
                            $args = array(
                                'post_type' => 'solutions',
                                'solutions-categories' => $term->slug
                            );
                            $query = new WP_Query( $args );
                
                            // output the term name in a heading tag                
                            echo'<li class="cat' . $k . '">' . $term->name . '</li>';
                
                            // use reset postdata to restore orginal query
                            wp_reset_postdata();
                
                        $k++; } ?>
                
                
                    </ul>
                
                    <div class="right_side resp-tabs-container">
                
                        <?php //start by fetching the terms for the animal_cat taxonomy
						$args = array( 'taxonomy' => 'solutions-categories' );
						$count = count($terms); 
                        $terms = get_terms( 'solutions-categories', array(
                            'orderby'    => 'count',
                            'hide_empty' => 0
                        ) );


											


                        ?>

                
                






                        <?php
                        // now run a query for each animal family
                        $j = 1;
                        foreach( $terms as $term ) {
                
                            // Define the query
                            $args = array(
                                'post_type' => 'solutions',
                                'solutions-categories' => $term->slug,
								'orderby' => 'date',
            					'order'   => 'DESC',
                            );
                            $query = new WP_Query( $args );
                    
                            // output the post titles in a list
                            echo '<div class="content'.$j.'">';
                            
                            echo '<div class="cat_desc">';
								echo'<h2 class="cat' . $j . '">' . $term->name . '</h2>';
									if ($count > 0) {
										echo '<p>';
										echo $term->description;
										echo '</p>';
									}
                            echo '</div>';
    
                                // Start the Loop
                                while ( $query->have_posts() ) : $query->the_post(); ?>
    
                                <div class="post_wrap" id="post-<?php the_ID(); ?>">
                                    
                                    <span class="subtitle"><?php the_field('subhead'); ?></span>
                        
                                    <h3><?php the_title(); ?></h3>
                                    
                                    <?php the_content(); ?>
                                    
                                    <?php if(get_field('read_more_pdf')) {?>
                                        <a target="_blank" href="<?php the_field('read_more_pdf')?>" class="more small"><?php the_field('read_more_title')?></a>
                                    <?php } else {?>
                                        <a target="_blank" href="<?php the_field('read_more_external_link')?>" class="more small"><?php the_field('read_more_title')?></a>
                                    <?php }?>
                        
                                </div>
                
                                <?php endwhile;
                
                            echo '</div>';
                
                            // use reset postdata to restore orginal query
                            wp_reset_postdata();
                
                        $j++; } ?>
                
                
                    </div>
                </div>
            </div>
            
        </div>    
    </div>
	<!--solution_bar-->

<script type="text/javascript">
	jQuery(document).ready(function () {
	jQuery('#horizontalTab').easyResponsiveTabs({
	type: 'default', //Types: default, vertical, accordion           
	width: 'auto', //auto or any width like 600px
	fit: true,   // 100% fit in a container
	closed: 'accordion', // Start closed if in accordion view
	activate: function(event) { // Callback function if tab is switched
	var $tab = jQuery(this);
	var $info = jQuery('#tabInfo');
	var $name = jQuery('span', $info);
	$name.text($tab.text());
	$info.show();
	}
	});
	});
</script>

<?php get_footer(); ?>