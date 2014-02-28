<?php

/*

 * Template Name: Testimonial Page

 * 
 *

 */



get_header(); ?>
<div class="inner_homecnt">
<div class="inner_contant">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			<h1>Testimonials</h1>
				<?php
                query_posts(array('post_type' => 'testimonial'));
                if(have_posts()) :
                    while(have_posts()) : the_post();
                ?>
				<div class="testi">
                <?php 
				$image_id = get_post_thumbnail_id($post->ID);
				$image_url = wp_get_attachment_image_src($image_id,'large', true); ?>
				<img src="<?php echo  $image_url[0];  ?>" alt="<?php echo $key_1_value = get_post_meta( $post->ID, 'Alt', true );?>" title="<?php echo $key_1_value = get_post_meta( $post->ID, 'Title', true );?>" />				
				<div class="testi1">
				<?php 
				the_content(); ?>
				</div>
				<div class="testititle">
				<?php the_title();?>
				</div>
				</div>
                  
                <?php
                    endwhile;
                endif;
                wp_reset_query();
                ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
       

<?php get_sidebar(); ?>
 </div>
 </div>
 <?php get_sidebar(); ?>
<?php get_footer(); ?>