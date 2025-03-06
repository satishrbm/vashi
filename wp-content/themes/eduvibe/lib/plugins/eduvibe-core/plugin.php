<?php
namespace EduVibeCore;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) :
			self::$_instance = new self();
		endif;
		return self::$_instance;
	}

	/**
	 * registered_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function registered_scripts() {

		// FancyBox CSS
		wp_register_style( 'jquery-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), EDUVIBE_THEME_VERSION );

		// Odometer CSS
		wp_register_style( 'jquery-odometer', plugins_url( '/assets/css/odometer.min.css', __FILE__ ), '', EDUVIBE_THEME_VERSION );

		// Slick Slider CSS
		wp_register_style( 'eduvibe-slick', get_template_directory_uri() . '/assets/css/slick.min.css', array(), EDUVIBE_THEME_VERSION );

		// Odometer JS
		wp_register_script( 'jquery-odometer', plugins_url( '/assets/js/odometer.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

		// ViewPort JS
		wp_register_script( 'jquery-viewport', plugins_url( '/assets/js/isInViewport.jquery.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

		// SAL JS
		wp_register_script( 'sal-js', plugins_url( '/assets/js/sal.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

		// Lottie JS
		wp_register_script( 'lottie-js', plugins_url( '/assets/js/lottie.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

		// Slick Slider JS
		wp_register_script( 'eduvibe-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

		// EduVibe animation
		wp_register_script( 'eduvibe-animation', plugins_url( '/assets/js/eduvibe-animation.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

		// Conterup JS
		wp_register_script( 'jquery-counterup', plugins_url( '/assets/js/jquery.counterup.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

        // Waypoints JS
        wp_register_script( 'jquery-waypoints', plugins_url( '/assets/js/jquery.waypoints.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

        // CountDown JS
        wp_register_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

        // Tilt JS
        wp_register_script( 'jquery-tilt', get_template_directory_uri() . '/assets/js/tilt.jquery.min.js', array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

        // imagesLoaded JS
        wp_register_script( 'jquery-imagesloaded', plugins_url( '/assets/js/imagesloaded.pkgd.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

        // Isotope JS
        wp_register_script( 'jquery-isotope', plugins_url( '/assets/js/isotope.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

        // FancyBox JS
        wp_register_script( 'jquery-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array( 'jquery' ), EDUVIBE_THEME_VERSION, true );

        // Animated Text JS
        wp_register_script( 'typed-js', plugins_url( '/assets/js/typed.min.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );
	}

	/**
	 * enqueued_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueued_scripts() {
		wp_enqueue_style( 'eduvibe-core-main-css', plugins_url( '/assets/css/eduvibe-core-main.css', __FILE__ ), '', EDUVIBE_THEME_VERSION );

		wp_enqueue_script( 'eduvibe-core-init-js', plugins_url( '/assets/js/eduvibe-core-init.js', __FILE__ ), array( 'jquery' ), EDUVIBE_THEME_VERSION, true );
		
		wp_localize_script( 'eduvibe-core-init-js', 'eduvibe_frontend_ajax_object',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' )
            ) 
        );
	}

	/**
	 * editor_enqueued_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function editor_enqueued_scripts() {
		wp_enqueue_style( 'eduvibe-elementor-editor', get_template_directory_uri() . '/assets/css/eduvibe-elementor-editor.css', '', EDUVIBE_THEME_VERSION );
	}

	private function plugin_active( $plugin ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( $plugin ) ) :
			return true;
		endif;

		return false;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {
		// include_once( __DIR__ . '/widgets/test.php' );
		include_once( __DIR__ . '/widgets/accordion.php' );
		include_once( __DIR__ . '/widgets/animation.php' );
		include_once( __DIR__ . '/widgets/animated-image.php' );
		include_once( __DIR__ . '/widgets/button.php' );
		include_once( __DIR__ . '/widgets/course-category.php' );
		include_once( __DIR__ . '/widgets/contact-form-7.php' );
		include_once( __DIR__ . '/widgets/contact-info.php' );
		include_once( __DIR__ . '/widgets/copyright.php' );
		// include_once( __DIR__ . '/widgets/content-switcher.php' );
		include_once( __DIR__ . '/widgets/countdown.php' );
		include_once( __DIR__ . '/widgets/counterup.php' );
		include_once( __DIR__ . '/widgets/courses.php' );
		include_once( __DIR__ . '/widgets/event-1.php' );
		include_once( __DIR__ . '/widgets/event-2.php' );
		include_once( __DIR__ . '/widgets/feature-1.php' );
		include_once( __DIR__ . '/widgets/footer-menu.php' );
		include_once( __DIR__ . '/widgets/gallery-filter.php' );
		include_once( __DIR__ . '/widgets/image-icon-box.php' );
		include_once( __DIR__ . '/widgets/image-change-on-hover.php' );
		include_once( __DIR__ . '/widgets/mailchimp.php' );
		include_once( __DIR__ . '/widgets/nav-menu.php' );
		include_once( __DIR__ . '/widgets/post-1.php' );
		include_once( __DIR__ . '/widgets/post-2.php' );
		include_once( __DIR__ . '/widgets/section-title.php' );
		include_once( __DIR__ . '/widgets/service-1.php' );
		include_once( __DIR__ . '/widgets/service-2.php' );
		include_once( __DIR__ . '/widgets/site-logo.php' );
		include_once( __DIR__ . '/widgets/social-icons.php' );
		include_once( __DIR__ . '/widgets/svg-scroll-animation.php' );
		include_once( __DIR__ . '/widgets/tabs.php' );
		include_once( __DIR__ . '/widgets/team-1.php' );
		include_once( __DIR__ . '/widgets/team-2.php' );
		include_once( __DIR__ . '/widgets/team-3.php' );
		include_once( __DIR__ . '/widgets/testimonial-1.php' );
		include_once( __DIR__ . '/widgets/testimonial-2.php' );
		include_once( __DIR__ . '/widgets/testimonial-3.php' );
		include_once( __DIR__ . '/widgets/testimonial-4.php' );
		include_once( __DIR__ . '/widgets/video-popup.php' );
		if ( class_exists( 'LearnPress' ) ) :
			include_once( __DIR__ . '/widgets/lp-courses.php' );
			include_once( __DIR__ . '/widgets/lp-team-1.php' );
			include_once( __DIR__ . '/widgets/lp-team-2.php' );
			include_once( __DIR__ . '/widgets/lp-team-3.php' );
			include_once( __DIR__ . '/widgets/lp-course-category.php' );
			include_once( __DIR__ . '/widgets/lp-wishlist.php' );
		endif;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		$enable_team_post_type = apply_filters( 'eduvibe_team_post_type_enable', false );
		// \Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Test() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Animation() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Animated_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Contact_Form_Seven() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Contact_Info() );
		if ( class_exists( 'LearnPress' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Courses() );
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Course_Category() );
		endif;
		// \Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Content_Switcher() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\CountDown() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Counter_Up() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Events_One() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Events_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Feature_One() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Gallery_Filter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Image_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Image_Change_On_Hover() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\MailChimp() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Post_One() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Post_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Section_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Service_One() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Service_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\SVG_Scroll_Animation() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonial_One() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonial_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonial_Three() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonial_Four() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Video_PopUp() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Copyright() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Footer_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Nav_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Site_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Social_Icons() );
		if ( class_exists( 'LearnPress' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Team_One() );
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Team_Two() );
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Team_Three() );
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Wishlist() );
		endif;
	}

	/**
     * 
     * Includes all Files
     * @since 1.0.0
     * @access public
     */
	public function includes() {
		require_once( __DIR__ . '/inc/copyright-shortcode.php' );
		require_once( __DIR__ . '/inc/eduvibe-helper-class.php' );
		require_once( __DIR__ . '/inc/eduvibe-icons.php' );
		require_once( __DIR__ . '/inc/eduvibe-mailchimp-api.php' );
		require_once( __DIR__ . '/inc/eduvibe-shortcodes.php' );
		require_once( __DIR__ . '/inc/eduvibe-widget-functions.php' );
	}

	/**
     * 
     * Includes all Traits
     * @since 1.0.0
     * @access public
     */
	public function traits() {
		require_once( __DIR__ . '/inc/Traits/Button.php' );
		require_once( __DIR__ . '/inc/Traits/Grid.php' );
		require_once( __DIR__ . '/inc/Traits/Posts.php' );
		require_once( __DIR__ . '/inc/Traits/Slider.php' );
		require_once( __DIR__ . '/inc/Traits/Slider_Arrows.php' );
		require_once( __DIR__ . '/inc/Traits/Slider_Dots.php' );
		require_once( __DIR__ . '/inc/Traits/Taxonomy.php' );
		require_once( __DIR__ . '/inc/Traits/Users.php' );
	}

	/**
     * 
     * Includes all Post Types
     * @since 1.0.0
     * @access public
     */
	public function post_types() {
		require_once( __DIR__ . '/inc/post-types/event.php' );
		require_once( __DIR__ . '/inc/post-types/header.php' );
		require_once( __DIR__ . '/inc/post-types/footer.php' );
		$enable_team_post_type = apply_filters( 'eduvibe_team_post_type_enable', false );
		if ( ( true === $enable_team_post_type ) || class_exists( 'SFWD_LMS' ) ) :
			require_once( __DIR__ . '/inc/post-types/team.php' );
		endif;
	}

	/**
     * 
     * Includes all Widgets
     * @since 1.0.0
     * @access public
     */
	public function widgets() {
		require_once( __DIR__ . '/inc/widgets/posts.php' );
		if ( class_exists( 'LearnPress' ) ) :
			require_once( __DIR__ . '/inc/widgets/courses-lp.php' );
			require_once( __DIR__ . '/inc/widgets/categories-lp.php' );
		endif;
		if ( class_exists( 'SFWD_LMS' ) ) :
			require_once( __DIR__ . '/inc/widgets/courses-ld.php' );
			require_once( __DIR__ . '/inc/widgets/categories-ld.php' );
		endif;
		if ( function_exists( 'tutor' ) ) :
			require_once( __DIR__ . '/inc/widgets/courses-tl.php' );
			require_once( __DIR__ . '/inc/widgets/categories-tl.php' );
		endif;
	}

	/**
     * 
     * extra entrance animation
     * @since 1.0.0
     * @access public
     */
	public function extra_entrance_animations( $animations = array() ) {
		$entrance_animations = array(
			'EduVibe Extra Animations' => [
				'scale'       => __('Scale', 'eduvibe'),
				'fancy'       => __('Fancy', 'eduvibe'),
				'slide-up'    => __('Slide Up', 'eduvibe'),
				'slide-left'  => __('Slide Left', 'eduvibe'),
				'slide-right' => __('Slide Right', 'eduvibe'),
				'slide-down'  => __('Slide Down', 'eduvibe')
			]
		);
		return array_merge( $animations, $entrance_animations );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'registered_scripts' ] );
		
		// Enqueued widget scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueued_scripts' ] );

		// Elementor Editor Styles
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_enqueued_scripts' ] );
		
		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Additional Entrance Animations
		add_filter( 'elementor/controls/animations/additional_animations', [ $this, 'extra_entrance_animations' ], 10 );


		// Load Files
		$this->includes();

		// Load Traits
		$this->traits();

		// Load Post Types
		$this->post_types();

		// Load Widgets
		$this->widgets();
	}
}

// Instantiate Plugin Class
$theme = wp_get_theme();
if ( 'EduVibe' === $theme->name || 'EduVibe' === $theme->parent_theme ) :
	Plugin::instance();
endif;