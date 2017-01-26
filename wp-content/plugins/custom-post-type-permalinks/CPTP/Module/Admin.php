<?php


/**
 *
 * Admin Page View.
 *
 * @package Custom_Post_Type_Permalinks
 * @since 0.9.4
 * */
class CPTP_Module_Admin extends CPTP_Module {

	public function add_hook() {
		add_action( 'admin_init', array( $this, 'settings_api_init' ), 30 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_css_js' ) );
	}


	/**
	 *
	 * Setting Init
	 *
	 * @since 0.7
	 */
	public function settings_api_init() {
		add_settings_section( 'cptp_setting_section',
			__( 'Permalink Settings for Custom Post Types', 'custom-post-type-permalinks' ),
			array( $this, 'setting_section_callback_function' ),
			'permalink'
		);

		$post_types = CPTP_Util::get_post_types();

		foreach ( $post_types as $post_type ) {

			add_settings_field(
				$post_type . '_structure',
				$post_type,
				array( $this, 'setting_structure_callback_function' ),
				'permalink',
				'cptp_setting_section',
				array( 'label_for' => $post_type . '_structure', 'post_type' => $post_type )
			);
			register_setting( 'permalink', $post_type . '_structure' );
		}

		add_settings_field(
			'no_taxonomy_structure',
			__( 'Use custom permalink of custom taxonomy archive.', 'custom-post-type-permalinks' ),
			array( $this, 'setting_no_tax_structure_callback_function' ),
			'permalink',
			'cptp_setting_section',
			array( 'label_for' => 'no_taxonomy_structure' )
		);

		register_setting( 'permalink', 'no_taxonomy_structure' );

		add_settings_field(
			'add_post_type_for_tax',
			__( 'Add <code>post_type</code> query for custom taxonomy archive.', 'custom-post-type-permalinks' ),
			array( $this, 'add_post_type_for_tax_callback_function' ),
			'permalink',
			'cptp_setting_section',
			array( 'label_for' => 'add_post_type_for_tax' )
		);

		register_setting( 'permalink', 'no_taxonomy_structure' );

	}

	public function setting_section_callback_function() {
		?>
		<p><?php echo wp_kses( __( 'The tags you can use are WordPress Structure Tags and <code>%"custom_taxonomy_slug"%</code> (e.g. <code>%actors%</code> or <code>%movie_actors%</code>).', 'custom-post-type-permalinks' ), array( 'code' => array() ) ); ?>
			<?php echo wp_kses( __( '<code>%"custom_taxonomy_slug"%</code> is replaced by the term of taxonomy.', 'custom-post-type-permalinks' ), array( 'code' => array() ) ); ?></p>

		<p><?php esc_html_e( "Presence of the trailing '/' is unified into a standard permalink structure setting.", 'custom-post-type-permalinks' ); ?>
		<p><?php echo wp_kses( __( 'If <code>has_archive</code> is true, add permalinks for custom post type archive.', 'custom-post-type-permalinks' ), array( 'code' => array() ) ); ?></p>
		<?php
	}

	public function setting_structure_callback_function( $option ) {

		$post_type  = $option['post_type'];
		$name       = $option['label_for'];
		$pt_object  = get_post_type_object( $post_type );
		$slug       = $pt_object->rewrite['slug'];
		$with_front = $pt_object->rewrite['with_front'];

		$value = CPTP_Util::get_permalink_structure( $post_type );

		$disabled = false;
		if ( isset( $pt_object->cptp_permalink_structure ) and $pt_object->cptp_permalink_structure ) {
			$disabled = true;
		}

		if ( ! $value ) {
			$value = CPTP_DEFAULT_PERMALINK;
		}

		global $wp_rewrite;
		$front = substr( $wp_rewrite->front, 1 );
		if ( $front and $with_front ) {
			$slug = $front . $slug;
		}
		?>
		<p>
			<code><?php echo esc_html( home_url() . ( $slug ? '/' : '' ) . $slug ); ?></code>
			<input name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" type="text"
			       class="regular-text code "
			       value="<?php echo esc_attr( $value ); ?>" <?php disabled( $disabled, true, true ); ?> />
		</p>
		<p>has_archive: <code><?php echo esc_html( $pt_object->has_archive ? 'true' : 'false' ); ?></code> / with_front:
			<code><?php echo esc_html( $pt_object->rewrite['with_front'] ? 'true' : 'false' ); ?></code></p>
		<?php
	}


	public function setting_no_tax_structure_callback_function() {
		$no_taxonomy_structure = CPTP_Util::get_no_taxonomy_structure();
		echo '<input name="no_taxonomy_structure" id="no_taxonomy_structure" type="checkbox" value="1" class="code" ' . checked( false, $no_taxonomy_structure, false ) . ' /> ';
		$txt = __( "If you check this, the custom taxonomy's permalinks will be <code>%s/post_type/taxonomy/term</code>.", 'custom-post-type-permalinks' );
		echo sprintf( wp_kses( $txt, array( 'code' => array() ) ), esc_html( home_url() ) );
	}


	public function add_post_type_for_tax_callback_function() {
		echo '<input name="add_post_type_for_tax" id="add_post_type_for_tax" type="checkbox" value="1" class="code" ' . checked( true, get_option( 'add_post_type_for_tax' ), false ) . ' /> ';
		esc_html_e( 'Custom taxonomy archive also works as post type archive. ', 'custom-post-type-permalinks' );
		esc_html_e( 'There are cases when the template to be loaded is changed.', 'custom-post-type-permalinks' );
	}


	/**
	 *
	 * enqueue CSS and JS
	 *
	 * @since 0.8.5
	 */
	public function enqueue_css_js() {
		$pointer_name = 'custom-post-type-permalinks-settings';
		if ( ! is_network_admin() ) {
			$dismissed = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
			if ( false === array_search( $pointer_name, $dismissed ) ) {
				$content = '';
				$content .= '<h3>' . __( 'Custom Post Type Permalinks', 'custom-post-type-permalinks' ) . '</h3>';
				$content .= '<p>' . __( 'You can setting permalink for post type in <a href="options-permalink.php">Permalinks</a>.', 'custom-post-type-permalinks' ) . '</p>';

				wp_enqueue_style( 'wp-pointer' );
				wp_enqueue_script( 'wp-pointer' );
				wp_enqueue_script( 'custom-post-type-permalinks-pointer', plugins_url( 'assets/settings-pointer.js', CPTP_PLUGIN_FILE ), array( 'wp-pointer' ), CPTP_VERSION );

				wp_localize_script( 'custom-post-type-permalinks-pointer', 'CPTP_Settings_Pointer', array(
					'content' => $content,
					'name'    => $pointer_name,
				) );
			}
		}
	}
}
