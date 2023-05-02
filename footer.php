<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */
?>

		</div>
		
        <footer id="footer-part">
           <div class="centering">
           		
                <div class="footer_top">
                	<div class="flex-row">
                    	<div class="left">
                        	 <a href="<?php echo home_url(); ?>" class="logo"><img src="<?php the_field('logo','option'); ?>" alt=""></a>
                        </div>
                        
                        <div class="right">
                        	<span class="email">
                            	<a href="mailto:<?php the_field('email_id','option')?>"><?php the_field('email_id','option')?></a>
                            </span>

                            <div class="footer_nav">
                                <?php wp_nav_menu( array( 'menu' => 'footer-menu') ); ?>
                            </div>

                            <?php if(have_rows('social_list','option')) : ?>
                                <ul class="social_list">
                                <?php while(have_rows('social_list','option')) : the_row(); 
                                //vars
                                $icon = get_sub_field('icon');
                                $link = get_sub_field('link');
                                ?>
                                    <li>
                                        <a href="<?php echo $link; ?>" target="_blank"><?php echo $icon; ?></a>
                                    </li>
                                <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                
                <div class="copyright">
                	<div class="left">
                    	<p><?php the_field('copyright','option'); ?></p>
                    </div>

                	<div class="right">
                    	<?php the_field('design_by','option'); ?>
                    </div>
                </div>
                
           </div>
           
            <a href="#" id="back-to-top">TOP</a>
		</footer>
        
	</section>

	<?php wp_footer(); ?>
</body>
</html>