<?php
/** 
Template Name: About Template
 */

get_header(); ?>


	<?php if(get_the_post_thumbnail_url()) {?>
        <div class="inner_banner_bar" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
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

	<!--about_bar-->
	<div class="content about-content">
    	<div class="centering">
        	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<?php the_content();?>
            <?php endwhile; endif;?>
        </div>    
    </div>
	<!--about_bar-->
    
    <?php			
    $args = array(  
        'post_type' => 'team_member',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    
    $loop = new WP_Query( $args ); 
    
    if ( $loop->have_posts() ) :?>
        <div class="team-members about-content">
            <div class="centering">
                <h2>The Team</h2>
                
                <?php
                while ( $loop->have_posts() ) : $loop->the_post();?>
                <div class="flex-row v-center tm-row">
                    <?php if( !empty( get_field('photo') ) ) {
                        $imgID = get_field('photo')['ID'];
                        $img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
                        $img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
                        echo '<div class="photo-wrap">';
                        echo $img;
                        echo '</div>';
                        
                    }?>
                    <?php if( !empty( get_field('job_title') ) || !empty( get_field('excerpt_for_about_page') ) ):?>
                    <div class="text-wrap">
                        <h3><?php the_title();?></h3>
                        <?php if( !empty( get_field('job_title') ) ):?>
                        <p class="person-info">
                            <b><?php the_field('job_title');?></b>
                        </p>    
                        <?php endif;?>
                        <?php if( !empty( get_field('excerpt_for_about_page') ) ):?>
                        <p class="excerpt"><?php the_field('excerpt_for_about_page');?></p>
                        <?php endif;?>
                        <a class="permalink" href="<?php the_permalink();?>">
                            <b><span>Read More</span>...</b>
                        </a>
                    </div>
                    <?php endif;?>
                </div>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    <?php
    endif;
    wp_reset_postdata(); 
    ?>
    
    <?php if( !empty( get_field('testimonials') ) ):?>
    <div class="testimonials">
        <div class="centering">
            <?php if( !empty( get_field('testimonials') ) ):
                $testimonials = get_field('testimonials');?>
            <div class="testimonial-rows">
                <?php foreach($testimonials as $testimonial):
                    $quote_text = $testimonial['quote_text']; 
                    $author_name = $testimonial['author_name']; 
                    $author_info = $testimonial['author_info'];    
                ?>
                <div class="t-row">
                    <div class="mark">
                        <b>“</b>
                    </div>
                    <div>
                        <?php if( !empty($quote_text) ):?>
                        <div class="quote-text"><?php echo $quote_text;?></div>
                        <?php endif;?>
                        <?php if( !empty( $author_name) || !empty( $author_info) ):?>
                        <p class="person-info">
                            <b>
                            <?php echo $author_name;?>
                            <?php if( !empty( $author_info) ) {
                            echo '<br>';
                            echo $author_info;
                            };?>
                            </b>
                        </p>
                        <?php endif;?>
                    </div>
                </div>  
                <?php endforeach;?>
            </div>
            <?php endif;?>
        
        </div>
    </div>
    <?php endif;?>

<?php get_footer(); ?>