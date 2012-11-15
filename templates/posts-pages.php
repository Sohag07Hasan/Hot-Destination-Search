<?php get_template_part('globals.php');?>
<?php 
 $NUMER_OF_POST_COLUMNS = 1;
?>

<?php 
	wp_reset_query();
	
	$wp_query = hot_wp_search::get_serach_posts_or_page();			
	
?>

<?php if ( have_posts() ) { ?>

			
					<h2 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', "hot_destinations" ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', "hot_destinations" ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', "hot_destinations" ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', "hot_destinations" ); ?>
						<?php endif; ?>
					</h2>
			
<?php if ( $wp_query->max_num_pages > 1 ) { ?>
    <div class="clr"></div>
	<div id="nav-above" class="navigation">
		<div class="nav-previous" style="float:left;"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', "hot_destinations" ) ); ?></div>
		<div class="nav-next" style="float:right;"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', "hot_destinations" ) ); ?></div>
	</div>
	<div class="clr"></div>
<?php } ?>

				<?php
					if(have_posts()){
					?>
					<div class="blog">
					<?php
					global $hpost_class; 
					$loop = 0;
						while ( have_posts() ) { 
						 the_post();
						 $loop++;
						 $hpost_class = 'column-'. ((($loop - 1) % $NUMER_OF_POST_COLUMNS) + 1);
						 if(($loop - 1) % $NUMER_OF_POST_COLUMNS == 0){?>
								<div class="items-row cols-<?php echo $NUMER_OF_POST_COLUMNS;?> row-<?php echo floor($loop/$NUMER_OF_POST_COLUMNS);?>">
						<?php }
						
					       get_template_part( 'content', get_post_format() );
						 
						 if(($loop - 1) % $NUMER_OF_POST_COLUMNS == $NUMER_OF_POST_COLUMNS - 1){?>
						        </div> 
								<span class="article_separator">&nbsp;</span>	
						 <?php }
						 
					    } ?>
					</div>
				<?php } ?>
				
				
				

<?php if ( $wp_query->max_num_pages > 1 ) { ?>
    <div class="clr"></div>
	<div id="nav-below" class="navigation">
		<div class="nav-previous" style="float:left;"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', "hot_destinations" ) ); ?></div>
		<div class="nav-next" style="float:right;"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', "hot_destinations" ) ); ?></div>
	</div>
	<div class="clr"></div>
<?php } ?>

<?php } else { ?>

				<?php get_template_part( 'main-notfound' ); ?>

<?php } ?>


