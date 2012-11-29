<?php


/**
 * This function file is loaded after the parent theme's function file. It's a great way to override functions, e.g. add_image_size sizes.
 *
 *
 */


add_action( 'widgets_init', create_function( '', 'return register_widget("GroupBuying_Custom_RelatedDeals");' ) );

/**
 * GBS Related Deals Widget
 *
 * @package GBS
 * @subpackage Theme
 */
class GroupBuying_Custom_RelatedDeals extends WP_Widget {
	/**
	 * Constructor
	 *
	 * @return void
	 * @author Dan Cameron
	 */
	function GroupBuying_Custom_RelatedDeals() {
		$widget_ops = array( 'description' => gb__( 'Creates an attractive display of related deals on a single deal page. Relationships are based on all locations.' ) );
		parent::WP_Widget( false, $name = gb__( 'GBS :: Custom Related Deals' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		do_action( 'pre_related_deals', $args, $instance );
		global $post;
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$buynow = empty( $instance['buynow'] ) ? gb__('Buy Now') : $instance['buynow'];
		$qty = $instance['deals'];
		
		$related_ids = wp_cache_set( 'related_deals_id_'.$post->ID );

		if ( !is_array( $related_ids ) ) {
			$related_ids = array();
			$associated_terms = get_the_terms( $post->ID, gb_get_deal_location_tax() );
			if ( is_array( $associated_terms ) ) {
				$related_ids[] = $post->ID;
				foreach ( $associated_terms as $term ) {
					$args = array(
						'post_type' => gb_get_deal_post_type(),
						'post_status' => 'publish',
						gb_get_deal_location_tax() => $term->slug,
						'meta_query' => array(
							array(
								'key' => '_expiration_date',
								'value' => array( 0, current_time( 'timestamp' ) ),
								'compare' => 'NOT BETWEEN'
							) ),
						'posts_per_page' => $qty,
						'post__not_in' => $related_ids,
						'fields' => 'ids'
					);
					$post_ids = get_posts( $args );
					$related_ids = array_merge( $post_ids, $related_ids );
				}
			}
			wp_cache_set( 'related_deals_id_'.$post->ID, $related_ids, 'custom_gb_widget', 300 ); // cache for 5 minutes
		}
		
		if ( !empty($related_ids) ) {
			$args = array(
				'post_type' => gb_get_deal_post_type(),
				'post_status' => 'publish',
				'post__in' => $related_ids
			);
			$related_deal_query = new WP_Query( apply_filters( 'gb_related_deals_widget_args', $args) );
			if ( $related_deal_query->have_posts() ) {
				echo $before_widget;
				echo $before_title . $title . $after_title;
					while ( $related_deal_query->have_posts() ) : $related_deal_query->the_post();

						Group_Buying_Controller::load_view( 'widgets/related-deals.php', array( 'buynow'=>$buynow ) );

					endwhile;
				echo $after_widget;
			}
			wp_reset_query();
			do_action( 'post_related_deals', $args, $instance );
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['buynow'] = strip_tags( $new_instance['buynow'] );
		$instance['deals'] = strip_tags( $new_instance['deals'] );
		return $instance;
	}

	function form( $instance ) {
		$title = esc_attr( $instance['title'] );
		$buynow = esc_attr( $instance['buynow'] );
		$deals = esc_attr( $instance['deals'] );
?>
            <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id( 'buynow' ); ?>"><?php _e( 'Buy now link text:' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'buynow' ); ?>" name="<?php echo $this->get_field_name( 'buynow' ); ?>" type="text" value="<?php echo $buynow; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id( 'deals' ); ?>"><?php _e( 'Number of deals to display per associated location:' ); ?>
            	<select id="<?php echo $this->get_field_id( 'deals' ); ?>" name="<?php echo $this->get_field_name( 'deals' ); ?>">
					<option value="1">1</option>
					<option value="2"<?php if ( $deals=="2" ) {echo ' selected="selected"';} ?>>2</option>
					<option value="3"<?php if ( $deals=="3" ) {echo ' selected="selected"';} ?>>3</option>
					<option value="4"<?php if ( $deals=="4" ) {echo ' selected="selected"';} ?>>4</option>
					<option value="5"<?php if ( $deals=="5" ) {echo ' selected="selected"';} ?>>5</option>
					<option value="10"<?php if ( $deals=="10" ) {echo ' selected="selected"';} ?>>10</option>
					<option value="15"<?php if ( $deals=="15" ) {echo ' selected="selected"';} ?>>15</option>
					<option value="-1"<?php if ( $deals=="-1" ) {echo ' selected="selected"';} ?>>All</option>
				 </select>
            </label></p>
        <?php
	}

}