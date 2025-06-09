<?php
/**
 * Template name: Home Template
 */

get_header(); 

$fields = get_fields();

$welcome_image = $fields['welcome_image'] ?? null;
$welcome_content = $fields['welcome_content'] ?? null;

$team_title = $fields['team_title'] ?? null;
$team_get_to_know_us_link = $fields['team_get_to_know_us_link'] ?? null;
$team_members = $fields['team_members'] ?? null;

$how_we_help_title = $fields['how_we_help_title'] ?? null;
$how_we_help_image = $fields['how_we_help_image'] ?? null;
$how_we_help_rows = $fields['how_we_help_rows'] ?? null;

?>

    <!--banner-bar-->
    <div class="banner_bar" style="background-image:url('<?php the_post_thumbnail_url('full')?>')">
        <div class="internal">
        
            <div class="flex-row v-center">
                <div class="text">
    
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
    
                </div>              
            </div>

        </div>
    </div>
    <!--banner-bar-->

    <!--welcome_bar-->
    <?php if( $welcome_image || $welcome_content ):?>
        <div class="welcome_bar">
            <div class="internal">
            
                <div class="flex-row v-center">
                    <?php if( $welcome_image ):?>
                        <div class="image">
                            <figure>
                                <?=wp_get_attachment_image( $welcome_image['id'], 'full' );?>
                            </figure>
                        </div>
                    <?php endif;?>
                    
                    <div class="text"><?php the_field('welcome_content')?></div>
                </div>
            
            </div>
        </div>
    <?php endif;?>
    <!--welcome_bar-->
    
    <!--team-->
    <?php if( $team_title || $team_get_to_know_us_link || $team_members ):?>
        <div class="team">
            <div class="centering">
                <?php if( $team_title || $team_get_to_know_us_link ):?>
                    <div class="team-header flex-row v-center space-between">
                    <?php if( $team_title ):?>
                        <h2><?=wp_kses_post($team_title );?></h2>
                    <?php endif; ?>
                    <?php if( $team_get_to_know_us_link ):
                        $link_url = $team_get_to_know_us_link['url'];
                        $link_title = $team_get_to_know_us_link['title'];
                        $link_target = $team_get_to_know_us_link['target'] ? $team_get_to_know_us_link['target'] : '_self';    
                    ?>
                        <div>
                            <a class="more" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        </div>
                    <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <?php
                if( $team_members ): ?>
                    <div class="flex-row tm-row">
                    <?php foreach( $team_members as $post ):   
                        $photo = get_field('photo') ?? null;
                        $name = get_the_title() ?? null;
                        $job_title = get_field('job_title') ?? null;              
                        setup_postdata($post); ?>
                        <div class="tm-member">
                            <a class="permalink" href="<?php the_permalink();?>">
                                <?php if($photo):?>
                                    <div class="photo-wrap">
                                        <?=wp_get_attachment_image( $photo['id'], 'full' );?>
                                    </div>
                                <?php endif;?>
                                <div class="text-wrap">
                                    <h3>
                                        <?=wp_kses_post($name);?>
                                    </h3>
                                    <?php if( !empty( $job_title ) ):?>
                                    <p class="person-info">
                                        <?=wp_kses_post($job_title);?>
                                    </p>    
                                    <?php endif;?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?php 
                    wp_reset_postdata(); ?>
                <?php endif; ?>
                            
            </div>
        </div>
    <?php endif;?>
    <!--team-->
    
    <!--how we help-->
    <?php if( $how_we_help_title || $how_we_help_image || $how_we_help_rows ):?>
        <div class="how-we-help">
            <div class="internal">
                <div class="flex-row">
                    <?php if( $how_we_help_title || $how_we_help_rows ):?>
                        <div class="title-rows">
                            <?php if( $how_we_help_title ):?>
                                <h2>
                                    <?=wp_kses_post($how_we_help_title);?>
                                </h2>    
                            <?php endif;?>
                            <?php if( $how_we_help_rows ):?>
                                <ul class="rows">
                                    <?php foreach($how_we_help_rows as $row):
                                        $title = $row['title'] ?? null;  
                                        $description = $row['description'] ?? null;    
                                    ?>
                                        <li class="flex-row">
                                            <div>
                                                <?php if( $title ):?>
                                                    <h3><b><?=wp_kses_post($title );?></b></h3>
                                                <?php endif;?>
                                                <?php if(  $description ):?>
                                                    <p><?=wp_kses_post( $description );?></p>
                                                <?php endif;?>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        </div>
                    <?php endif;?>
                    <?php if( $how_we_help_image ):?>
                        <div class="image">
                            <figure>
                                <?=wp_get_attachment_image( $how_we_help_image['id'], 'full' );?>
                            </figure>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endif;?>
    <!--how we help-->
    
<?php get_footer(); ?>