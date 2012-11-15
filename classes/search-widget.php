<?php
/*
 * original widget
 ***/

class widget_hot_search extends WP_Widget{
	
	function __construct(){
		$widget_ops = array('classname' => 'widget_hot_search', 'description' => __( 'Creates an Advanced Search Table') );
		parent::__construct('hotsearch', __('Hot Wordpress Search'), $widget_ops);
	}
	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$post_type = esc_attr( $instance['post-type'] );
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('post-type'); ?>"><?php _e( 'Post Type To Search:' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('post-type'); ?>" name="<?php echo $this->get_field_name('post-type'); ?>">
				<option <?php selected('1', $post_type); ?> value="1" >Page</option>
				<option <?php selected('2', $post_type); ?> value="2" >Post</option>
				<option <?php selected('3', $post_type); ?> value="3" >Both</option>
			</select>
		</p>
		
<?php 
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post-type'] = strip_tags($new_instance['post-type']);
		return $instance;
	}
	
	
	function widget( $args, $instance ){
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search' ) : $instance['title'], $instance, $this->id_base);
		$post_type = $instance['post-type'];
				
		echo $before_widget;
		echo $before_title . $title . $after_title;
		$action = get_option('siteurl') . '/query-results';
?>
		<form action="<?php echo $action; ?>" method="get">
			<input type="hidden" name="pt" value="<?php echo $post_type; ?>" />
			<table>	
			
				<?php 
					foreach(hot_wp_search::$taxonomies as $slug => $taxonomy){
						$terms = get_terms($slug, array('orderby' => 'name'));
						?>
							<tr>
								<td>
									<select name="<?php echo $slug; ?>">
										<option value=''> - Select <?php echo $taxonomy['s']; ?> - </option>
										<?php 
											if($terms){
												foreach($terms as $term){
												?>
													<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>	
												<?php 
												}
											}
										?>
									</select>
								</td>
							</tr>
						<?php 
					}
				?>
				
				<tr>
					<td>
						<input class="button submit-button" type="submit" value="Search" />
					</td>
				</tr>
				
			</table>
		</form>
<?php 
		echo $after_widget;
	}
	
}