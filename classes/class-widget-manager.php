<?php
namespace AddonPack\Elementor\Manager;
use Elementor\Plugin as Elementor;
use AddonPack\Elementor\Widget\Dual_Heading;
use AddonPack\Elementor\Widget\Button;
use AddonPack\Elementor\Widget\Advanced_Accordion;
use AddonPack\Elementor\Widget\Call_to_Action;
use AddonPack\Elementor\Widget\Testimonial;
use AddonPack\Elementor\Widget\Infobox;
use AddonPack\Elementor\Widget\Card;
use AddonPack\Elementor\Widget\Member;
use AddonPack\Elementor\Widget\Contact_form_7;
use AddonPack\Elementor\Widget\Fluent_form;
use AddonPack\Elementor\Widget\Pricing_table;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists( 'Widget_Manager' ) ){
	class Widget_Manager{
		
		public function __construct(){
			$this->add_widgets();
		}
	
		public function add_widgets(){
		
			$widgets_manager = Elementor::instance()->widgets_manager;
			
			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/dual-heading/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/dual-heading/widget.php';
				$widgets_manager->register_widget_type( new Dual_Heading() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/button/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/button/widget.php';
				$widgets_manager->register_widget_type( new Button() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/advanced-accordion/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/advanced-accordion/widget.php';
				$widgets_manager->register_widget_type( new Advanced_Accordion() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/call-to-action/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/call-to-action/widget.php';
				$widgets_manager->register_widget_type( new Call_to_Action() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/testimonial/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/testimonial/widget.php';
				$widgets_manager->register_widget_type( new Testimonial() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/infobox/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/infobox/widget.php';
				$widgets_manager->register_widget_type( new Infobox() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/card/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/card/widget.php';
				$widgets_manager->register_widget_type( new Card() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/member/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/member/widget.php';
				$widgets_manager->register_widget_type( new Member() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/contact-form-7/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/contact-form-7/widget.php';
				$widgets_manager->register_widget_type( new Contact_form_7() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/fluent-form/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/fluent-form/widget.php';
				$widgets_manager->register_widget_type( new Fluent_form() );
			}

			if ( file_exists( ADDON_PACK_DIR_PATH.'widgets/pricing-table/widget.php' ) ) {
				require_once ADDON_PACK_DIR_PATH.'widgets/pricing-table/widget.php';
				$widgets_manager->register_widget_type( new Pricing_table() );
			}
		}

	}

	new Widget_Manager();
}