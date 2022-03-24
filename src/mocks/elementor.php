<?php
namespace Eunit\Mocks;

use Mockery;

/**
 * Class Elementor
 */
class Elementor {
	/**
	 * widget_base
	 * mock \Elementor\Widget_Base
	 */
	public static function widget_base( $test_instance = null ) {
		if ( class_exists('Elementor\Widget_Base' ) ) {
			return;
		}

		if ( $test_instance ) {
			$stub = $test_instance->getMockBuilder( 'Elementor\Widget_Base' )->getMock();
			return;
		}

		// Stub Elementor\Widget_Base
		$elementor_widget = new class {};
		$class_name = get_class( $elementor_widget );
		Mockery::namedMock( 'Elementor\Widget_Base', $class_name );
	}

	/**
	 * controls_manager
	 * mock \Elementor\Controls_Manager
	 */
	public static function controls_manager() {
		if ( class_exists('Elementor\Controls_Manager' ) ) {
			return;
		}
		$controls_manager = new class {
			const TAB_CONTENT = 'content';
			const TAB_STYLE = 'style';
			const TAB_ADVANCED = 'advanced';
			const TAB_RESPONSIVE = 'responsive';
			const TAB_LAYOUT = 'layout';
			const TAB_SETTINGS = 'settings';
			const TEXT = 'text';
			const NUMBER = 'number';
			const TEXTAREA = 'textarea';
			const SELECT = 'select';
			const SWITCHER = 'switcher';
			const BUTTON = 'button';
			const HIDDEN = 'hidden';
			const HEADING = 'heading';
			const RAW_HTML = 'raw_html';
			const DEPRECATED_NOTICE = 'deprecated_notice';
			const POPOVER_TOGGLE = 'popover_toggle';
			const SECTION = 'section';
			const TAB = 'tab';
			const TABS = 'tabs';
			const DIVIDER = 'divider';
			const COLOR = 'color';
			const MEDIA = 'media';
			const SLIDER = 'slider';
			const DIMENSIONS = 'dimensions';
			const CHOOSE = 'choose';
			const WYSIWYG = 'wysiwyg';
			const CODE = 'code';
			const FONT = 'font';
			const IMAGE_DIMENSIONS = 'image_dimensions';
			const WP_WIDGET = 'wp_widget';
			const URL = 'url';
			const REPEATER = 'repeater';
			const ICON = 'icon';
			const ICONS = 'icons';
			const GALLERY = 'gallery';
			const STRUCTURE = 'structure';
			const SELECT2 = 'select2';
			const DATE_TIME = 'date_time';
			const BOX_SHADOW = 'box_shadow';
			const TEXT_SHADOW = 'text_shadow';
			const ANIMATION = 'animation';
			const HOVER_ANIMATION = 'hover_animation';
			const EXIT_ANIMATION = 'exit_animation';
		};
		$class_name = get_class( $controls_manager );
		Mockery::namedMock( 'Elementor\Controls_Manager', $class_name );
	}

	/**
	 * group_control_typography
	 * mock \Elementor\Group_Control_Typography
	 */
	public static function group_control_typography() {
		if ( class_exists('Elementor\Group_Control_Typography' ) ) {
			return;
		}
		$group_control_typography = \Mockery::mock( 'overload:Elementor\Group_Control_Typography' );
		$group_control_typography->shouldReceive( 'get_type' )->andReturn( 'typography' );
	}

	/**
	 * group_control_text_shadow
	 * mock \Elementor\Group_Control_Text_Shadow
	 */
	public static function group_control_text_shadow() {
		if ( class_exists('Elementor\Group_Control_Text_Shadow' ) ) {
			return;
		}
		$group_control_typography = \Mockery::mock( 'overload:Elementor\Group_Control_Text_Shadow' );
		$group_control_typography->shouldReceive( 'get_type' )->andReturn( 'text-shadow' );
	}

	/**
	 * dynamic_tags_module
	 * mock \Elementor\Modules\DynamicTags\Module
	 */
	public static function dynamic_tags_module() {
		if ( class_exists('Elementor\Modules\DynamicTags\Module') ) {
			return;
		}
		$dynamic_tags_module = new class {
			const BASE_GROUP = 'base';
			const TEXT_CATEGORY = 'text';
			const URL_CATEGORY = 'url';
			const IMAGE_CATEGORY = 'image';
			const MEDIA_CATEGORY = 'media';
			const POST_META_CATEGORY = 'post_meta';
			const GALLERY_CATEGORY = 'gallery';
			const NUMBER_CATEGORY = 'number';
			const COLOR_CATEGORY = 'color';
		};
		$class_name = get_class( $dynamic_tags_module );
		Mockery::namedMock( 'Elementor\Modules\DynamicTags\Module', $class_name );
	}

	/**
	 * pro_dynamic_tags_module
	 * mock \ElementorPro\Modules\DynamicTags\Module
	 */
	public static function pro_dynamic_tags_module() {
		if ( class_exists('ElementorPro\Modules\DynamicTags\Module') ) {
			return;
		}
		$dynamic_tags_module = new class {

			const AUTHOR_GROUP = 'author';
			const POST_GROUP = 'post';
			const COMMENTS_GROUP = 'comments';
			const SITE_GROUP = 'site';
			const ARCHIVE_GROUP = 'archive';
			const MEDIA_GROUP = 'media';
			const ACTION_GROUP = 'action';
		};
		$class_name = get_class( $dynamic_tags_module );
		Mockery::namedMock( 'ElementorPro\Modules\DynamicTags\Module', $class_name );
	}

	/**
	 * global_colors
	 * mock \Elementor\Core\Kits\Documents\Tabs\Global_Colors
	 */
	public static function global_colors() {
		if ( class_exists( 'Elementor\Core\Kits\Documents\Tabs\Global_Colors' ) ) {
			return;
		}
		$global_colors = new class {
			const COLOR_PRIMARY = 'globals/colors?id=primary';
			const COLOR_SECONDARY = 'globals/colors?id=secondary';
			const COLOR_TEXT = 'globals/colors?id=text';
			const COLOR_ACCENT = 'globals/colors?id=accent';
		};
		$class_name = get_class( $global_colors );
		Mockery::namedMock( 'Elementor\Core\Kits\Documents\Tabs\Global_Colors', $class_name );
	}

	/**
	 * global_typography
	 * mock Elementor\Core\Kits\Documents\Tabs\Global_Typography
	 */
	public static function global_typography() {
		if ( class_exists( 'Elementor\Core\Kits\Documents\Tabs\Global_Typography' ) ) {
			return;
		}
		$global_typography = new class {
			const TYPOGRAPHY_PRIMARY = 'globals/typography?id=primary';
			const TYPOGRAPHY_SECONDARY = 'globals/typography?id=secondary';
			const TYPOGRAPHY_TEXT = 'globals/typography?id=text';
			const TYPOGRAPHY_ACCENT = 'globals/typography?id=accent';
			const TYPOGRAPHY_NAME = 'typography';
		};
		$class_name = get_class( $global_typography );
		Mockery::namedMock( 'Elementor\Core\Kits\Documents\Tabs\Global_Typography', $class_name );
	}

	/**
	 * pro_form_widget
	 * mock \ElementorPro\Modules\Forms\Widgets\Form
	 */
	public static function pro_form_widget() {
		if ( class_exists('ElementorPro\Modules\Forms\Widgets\Form') ) {
			return;
		}
		$form_widget = new class {
		};
		$class_name = get_class( $form_widget );
		Mockery::namedMock( 'ElementorPro\Modules\Forms\Widgets\Form', $class_name );
	}
}
