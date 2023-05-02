<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */
?>

<div class="postLoop">
	<?php if(has_post_thumbnail()) { ?>
        <div class="image"> <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('postthumbnail'); ?>
        </a> </div>
    <?php } ?>

        <h2><a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
    </a></h2>

    <ul class="dateBar">
        <li><strong>Posted on</strong>
        <?php the_time('M j, Y'); ?>
        </li>
    </ul>

    <p><?php echo get_the_excerpt();  ?>... <a href="<?php the_permalink(); ?>" class="read-more">Read More</a></p>
</div>