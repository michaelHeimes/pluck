<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

	<!--banner-bar-->
	<div class="banner_bar" style="background-image:url('<?php the_post_thumbnail_url('full')?>')">
		<div class="internal">
        
        	<div class="flex-row v-center">
                <div class="text">
    
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
    
                </div>
                
				<div class="navigation">
                	<?php if(have_rows('banner_links_list')) : ?>
						<ul>
						<?php while(have_rows('banner_links_list')) : the_row(); 
						//vars
						$title = get_sub_field('title');
						?>
                        	<li>
                            	<a href="<?php echo $title['url']?>" target="<?php echo $signup_button['target']; ?>"><?php echo $title['title']?></a>
                            </li>
						<?php endwhile; ?>
                        </ul>
					<?php endif; ?>
                </div>                
            </div>

        </div>
	</div>
	<!--banner-bar-->

	<!--welcome_bar-->
	<div class="welcome_bar">
    	<div class="internal">
        
			<div class="flex-row v-center">
            	<div class="image">
                	<figure>
                    	<img src="<?php the_field('welcome_image')?>" alt="" />
                    </figure>
                </div>
                
                <div class="text"><?php the_field('welcome_content')?></div>
            </div>
        
        </div>
    </div>
	<!--welcome_bar-->

	<!--services_bar-->
	<div class="services_bar">
    	<div class="centering">

			<?php if(have_rows('services_list')) : ?>
                <div class="flex-row">
                <?php while(have_rows('services_list')) : the_row(); 
                //vars
                $service = get_sub_field('service');
                ?>
                    <div class="service">
                        <?php echo $service; ?>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>

        
        </div>
    </div>
	<!--services_bar-->
    
    <?php if( !empty( get_field('testimonials_heading') ) || !empty( get_field('testimonials') ) ):?>
    <div class="testimonials">
        <div class="centering">
            <?php if( !empty( get_field('testimonials_heading') ) ):?>
            <h2 class="h1 home-testimonial-header"><?php the_field('testimonials_heading');?></h2>
            <?php endif;?>
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

	<!--recent solutions-->
	<div class="recent_solutions">
    	<div class="centering">

			<div class="solution_slider">
				<?php query_posts( array( 'post_type' => 'solutions' ) );
                    if ( have_posts() ) : $i=1; while ( have_posts() ) : the_post();
                ?>
                            
                <div class="slides">
                    <span class="subtitle"><?php the_field('subhead'); ?></span>
                    
                    <h3><?php the_title(); ?></h3>
                    
                    <?php if(get_field('read_more_pdf')) {?>
                        <a target="_blank" href="<?php the_field('read_more_pdf')?>" class="more light"><?php the_field('read_more_title')?></a>
                    <?php } else {?>
                        <a target="_blank" href="<?php the_field('read_more_external_link')?>" class="more light"><?php the_field('read_more_title')?></a>
                    <?php }?>
                    
                    
                </div>                                    
            
				<?php $i++; endwhile; endif; wp_reset_query(); ?>
            </div>
        
        </div>
    </div>
	<!--recent solutions-->

	<!--recent news-->
	<div class="recent_news">
    	<div class="centering">

			<?php echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="3" scroll="false" button_label="Read more news"]');?>
			
			<?php 
			$link = get_field('news_link');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<div class="morelink"><a class="more" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
			<?php endif; ?>
        
        </div>
    </div>
	<!--recent news-->

	<!--cta_bar-->
	<div class="flex-row v-center cta_bar" style="background-image: url('<?php the_field('cta_banner','option')?>')">
    	<div class="centering">
			
            <?php the_field('cta_content','option'); ?>
            <?php $cta_button = get_field('cta_banner_button','option'); ?>
            <a href="<?php echo $cta_button['url']?>" class="btn">Button</a>
        
        </div>
    </div>
	<!--cta_bar-->
    
<?php get_footer(); ?>