<?php
/**
 * Updating New Widgets
 */
class My_Poca_Categories extends WP_Widget {

		/**
		 * Sets up a new Categories widget instance.
		 *
		 * @since 2.8.0
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'                   => 'widget_categories',
				'description'                 => __( 'A list or dropdown of categories.' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'poca_categories', __( 'Poca Categories' ), $widget_ops );
		}
	
		/**
		 * Outputs the content for the current Categories widget instance.
		 *
		 * @since 2.8.0
		 * @since 4.2.0 Creates a unique HTML ID for the `<select>` element
		 *              if more than one instance is displayed on the page.
		 *
		 * @staticvar bool $first_dropdown
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current Categories widget instance.
		 */
		public function widget( $args, $instance ) {
			static $first_dropdown = true;
			$current_taxonomy      = $this->_get_current_taxonomy( $instance );

		// $post_type = get_post_type( get_the_ID() );

			if ( ! empty( $instance['title'] ) ) {
				$title = $instance['title'];
			} else {
				if ( 'categories' === $current_taxonomy ) {
					$title = __( 'Categories' );
				} else {
					$tax   = get_taxonomy( $current_taxonomy );
					$title = $tax->labels->name;
				}
			}
	
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Poca Categories' );
	
			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
	
			$count        = ! empty( $instance['count'] ) ? '1' : '0';
			$hierarchical = ! empty( $instance['hierarchical'] ) ? '1' : '0';
			$dropdown     = ! empty( $instance['dropdown'] ) ? '1' : '0';
	
			echo $args['before_widget'];
	
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
	
			$cat_args = array(
				'orderby'      => 'name',
				'show_count'   => $count,
				'hierarchical' => $hierarchical,
				'taxonomy'     => $current_taxonomy,
		//        'post_type'    => $post_type,
			);
	
			if ( $dropdown ) {
				echo sprintf( '<form action="%s" method="get">', esc_url( home_url() ) );
				$dropdown_id    = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
				$first_dropdown = false;
	
				echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';
	
				$cat_args['show_option_none'] = __( 'Select Category' );
				$cat_args['id']               = $dropdown_id;
	
				/**
				 * Filters the arguments for the Categories widget drop-down.
				 *
				 * @since 2.8.0
				 * @since 4.9.0 Added the `$instance` parameter.
				 *
				 * @see wp_dropdown_categories()
				 *
				 * @param array $cat_args An array of Categories widget drop-down arguments.
				 * @param array $instance Array of settings for the current widget.
				 */
				wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args, $instance ) );
	
				echo '</form>';
	
				$type_attr = current_theme_supports( 'html5', 'script' ) ? '' : ' type="text/javascript"';
				?>
	
	<script<?php echo $type_attr; ?>>
	/* <![CDATA[ */
	(function() {
		var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
		function onCatChange() {
			if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
				dropdown.parentNode.submit();
			}
		}
		dropdown.onchange = onCatChange;
	})();
	/* ]]> */
	</script>
	
				<?php
			} else {
				?>
			<div class="single-widget-area catagories-widget mb-80">
				<ul class="catagories-list">
					<?php
					$cat_args['title_li'] = '';
		
					/**
					 * Filters the arguments for the Categories widget.
					 *
					 * @since 2.8.0
					 * @since 4.9.0 Added the `$instance` parameter.
					 *
					 * @param array $cat_args An array of Categories widget options.
					 * @param array $instance Array of settings for the current widget.
					 */
					wp_list_categories( apply_filters( 'widget_categories_args', $cat_args, $instance ) );
					?>
				</ul>
			</div>
				<?php
			}
	
			echo $args['after_widget'];
		}
	
		/**
		 * Handles updating settings for the current Categories widget instance.
		 *
		 * @since 2.8.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            WP_Widget::form().
		 * @param array $old_instance Old settings for this instance.
		 * @return array Updated settings to save.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                 = $old_instance;
			$instance['title']        = sanitize_text_field( $new_instance['title'] );
			$instance['count']        = ! empty( $new_instance['count'] ) ? 1 : 0;
			$instance['hierarchical'] = ! empty( $new_instance['hierarchical'] ) ? 1 : 0;
			$instance['dropdown']     = ! empty( $new_instance['dropdown'] ) ? 1 : 0;
			$instance['taxonomy']     = stripslashes( $new_instance['taxonomy'] );
	
			return $instance;
		}
	
		/**
		 * Outputs the settings form for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {
			// Defaults.
			$instance     = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$current_taxonomy  = $this->_get_current_taxonomy( $instance );
	//      $title_id          = $this->get_field_id( 'title' );
	//      $instance['title'] = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$count        = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
			$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
			$dropdown     = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
			?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
	
			<!-- <p><label for="<?php //echo $title_id ?>"><?php //__( 'Title:' ) ?></label>
			<input type="text" class="widefat" id="<?php //echo $title_id ?>" name="<?php //echo $this->get_field_name( 'title' ) ?>" value="<?php //echo $instance['title'] ?>" />
			</p> -->
			<?php
				$taxonomies = get_taxonomies( array( 'show_ui' => true ), 'object' );
				$id         = $this->get_field_id( 'taxonomy' );
				$name       = $this->get_field_name( 'taxonomy' );
				$input      = '<input type="hidden" id="' . $id . '" name="' . $name . '" value="%s" />';

				switch ( count( $taxonomies ) ) {

					// No tag cloud supporting taxonomies found, display error message.
					case 0:
						echo '<p>' . __( 'The tag cloud will not be displayed since there are no taxonomies that support the tag cloud widget.' ) . '</p>';
						printf( $input, '' );
						break;
		
					// Just a single tag cloud supporting taxonomy found, no need to display a select.
					case 1:
						$keys     = array_keys( $taxonomies );
						$taxonomy = reset( $keys );
						printf( $input, esc_attr( $taxonomy ) );
						break;
		
					// More than one tag cloud supporting taxonomy found, display a select.
					default:
						printf(
							'<p><label for="%1$s">%2$s</label>' .
							'<select class="widefat" id="%1$s" name="%3$s">',
							$id,
							__( 'Taxonomy:' ),
							$name
						);
		
						foreach ( $taxonomies as $taxonomy => $tax ) {
							printf(
								'<option value="%s"%s>%s</option>',
								esc_attr( $taxonomy ),
								selected( $taxonomy, $current_taxonomy, false ),
								$tax->labels->name
							);
						}
		
						echo '</select></p>';
				}
			 ?>

			<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'dropdown' ); ?>" name="<?php echo $this->get_field_name( 'dropdown' ); ?>"<?php checked( $dropdown ); ?> />
			<label for="<?php echo $this->get_field_id( 'dropdown' ); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />
	
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>"<?php checked( $count ); ?> />
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show post counts' ); ?></label><br />
	
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'hierarchical' ); ?>" name="<?php echo $this->get_field_name( 'hierarchical' ); ?>"<?php checked( $hierarchical ); ?> />
			<label for="<?php echo $this->get_field_id( 'hierarchical' ); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
			<?php
		}
	/**
	 * Retrieves the taxonomy for the current Poca Category widget instance.
	 *
	 * @since 4.4.0
	 *
	 * @param array $instance Current settings.
	 * @return string Name of the current taxonomy if set, otherwise 'post_tag'.
	 */
	public function _get_current_taxonomy( $instance ) {
		if ( ! empty( $instance['taxonomy'] ) && taxonomy_exists( $instance['taxonomy'] ) ) {
			return $instance['taxonomy'];
		}

		return 'categories';
	}
}
add_action(
	'widgets_init',
	function() {
		register_widget( 'My_Poca_Categories' );
	}
);
