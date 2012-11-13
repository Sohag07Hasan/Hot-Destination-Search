<?php get_template_part('globals.php');?>
	
	<div class="header">
    	<div class="logo">
        	<div class="logo_pad">
   	    		<?php dynamic_sidebar('Logo'); ?>
            </div>
        </div>
        <div class="search_box">
        	<?php dynamic_sidebar('User 4'); ?>
        </div>
    </div>
    
    <div id="topmenu">
        <div id="topmenu_pad">
           <?php if (is_active_sidebar('user3')) { ?>
        	<?php dynamic_sidebar('User 3'); ?>
	       <?php } ?> 		
			<?php wp_nav_menu( array( 'menu' => 'nav','menu_id' => 'nav', 'menu_class' => 'menu' ) ); ?>
        </div>
    </div>
    
	<?php if (is_active_sidebar('user1')) { ?>
    <div class="hotgallery">
       <?php dynamic_sidebar('User 1'); ?>
    </div>
    <div class="clr"></div>
	<?php } ?>
    <?php if (is_active_sidebar('scroller')) { ?>
    <div class="scroller_module">
       <?php dynamic_sidebar('Scroller'); ?>
    </div>
    <div class="clr"></div>
	<?php } ?>
    <?php if (is_active_sidebar('carousel')) { ?>
    <div class="carousel_module">
        <?php dynamic_sidebar('Carousel'); ?>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
	<?php } ?>
    <?php 
	$uppermodules = is_active_sidebar('advert1') || is_active_sidebar('advert2') || is_active_sidebar('advert3') || is_active_sidebar('advert4');
	if ($uppermodules) { ?>
    <div class="upper">
        <?php if(is_active_sidebar('advert1')) { ?>
        <div class="module_padding <?php if (!is_active_sidebar('advert2') && !is_active_sidebar('advert3') && !is_active_sidebar('advert4')) { echo "last"; } ?>">
            <div id="c5">
                <?php dynamic_sidebar('Advert 1'); ?>
            </div>
            <div class="clr"></div>
        </div>
        <?php } if(is_active_sidebar('advert2')) { ?>
        <div class="module_padding <?php if (!is_active_sidebar('advert3') && !is_active_sidebar('advert4')) { echo "last"; } ?>">
            <div id="c6">
                <?php dynamic_sidebar('Advert 2'); ?>
            </div>
            <div class="clr"></div>
        </div>
        <?php } if(is_active_sidebar('advert3')) { ?>
        <div class="module_padding <?php if (!is_active_sidebar('advert4')) { echo "last"; } ?>">
            <div id="c7">
                <?php dynamic_sidebar('Advert 3'); ?>
            </div>
            <div class="clr"></div>
        </div>
        <?php } if(is_active_sidebar('advert4')) { ?>
        <div class="module_padding last">
            <div id="c8" class="last">
                <?php dynamic_sidebar('Advert 4'); ?>
            </div>
            <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
    </div>
    <?php } ?>