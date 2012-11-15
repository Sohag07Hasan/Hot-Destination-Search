<?php get_template_part('globals.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" <?php language_attributes(); ?>>
<?php get_header(); ?>
<body>
<?php get_template_part('part_top');?>
<div class="wrapper1">
    <?php get_template_part('part_upper');?>
    <div class="main_area">
      	<?php if($columnLayout == "lrm" || $columnLayout == "lmr" ) get_template_part( 'col_left' );?> 
        <?php if($columnLayout == "lrm" ) get_template_part( 'col_right' );?> 	
		
		<div id="content_wrap">
            <div class="content_pad">
 <?php include dirname(__FILE__) . '/posts-pages.php'; ?>
		    </div>
        </div>
		
		<?php if($columnLayout == "mlr")  get_template_part( 'col_left' );?> 
        <?php if($columnLayout == "mlr" || $columnLayout == "lmr")  get_template_part( 'col_right' );?>
        <div class="clr"></div>
    </div>
	<?php get_template_part('part_below');?>
</div>
<?php get_template_part('part_bottom');?>
</body>
</html>