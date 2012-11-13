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
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
<?php 
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	
	function widget( $args, $instance ){
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search' ) : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget;
		echo $before_title . $title . $after_title;
?>
		<form action='' method="get">
			
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