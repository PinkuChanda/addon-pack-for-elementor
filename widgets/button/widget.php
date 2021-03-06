<?php
namespace AddonPack\Elementor\Widget;

use Elementor\Widget_Base;
use AddonPack\Includes;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Button extends Widget_Base {

	protected $templateInstance;

    public function getPostsInstance(){
        return $this->templateInstance = Includes\AddonPack_Helper::getInstance();
    }

	public function get_name() {
		return 'ap-button';
	}

	public function get_title() {
		return __( 'Button', 'addon-pack' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return array('addon-pack');
	}
	
	protected function _register_controls() {
		$this->register_general_controls();
		$this->register_heading_style_controls();
	}
	
	protected function register_general_controls(){
		$this->start_controls_section(
			'ap_button_settings',
			[
				'label' => __( 'Button Settings', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_text',
			[
				'label' => __( 'Text', 'addon-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('With Addon Pack', 'addon-pack'),
				'placeholder' => __( 'Enter Your Text', 'addon-pack' ),
				'label_block'   => true,
			]
		);

		$this->add_control('ap_button_link_selection', 
			[
				'label'         => __('Link Type', 'addon-pack'),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'custom_url'   => __('URL', 'addon-pack'),
					'existing_url'  => __('Existing Page', 'addon-pack'),
				],
				'default'       => 'custom_url',
				'label_block'   => true,
			]
		);

		$this->add_control('ap_button_url',
			[
				'label'         => __('Link', 'addon-pack'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url'   => '#',
				],
				'label_block'   => true,
				'condition'     => [
					'ap_button_link_selection' => 'custom_url'
				]
			]
		);

		$this->add_control('ap_button_existing_url',
			[
				'label'         => __('Existing Page', 'addon-pack'),
				'type'          => Controls_Manager::SELECT2,
				'options'       => $this->getPostsInstance()->get_all_posts(),
				'condition'     => [
					'ap_button_link_selection'  => 'existing_url',
				],
				'multiple'      => false,
				'label_block'   => true,
			]
		);

		$this->add_control(
			'ap_button_existing_url_target_blank',
            [
                'label'         => __('Open a new Tab', 'addon-pack'),
                'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable or disable open with tab','addon-pack'),
				'condition'     => [
					'ap_button_link_selection'  => 'existing_url',
				],
            ]
        );

		$this->add_control(
			'ap_button_size',
			[
				'label'   => __( 'Button Size', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'xs' => __( 'Extra Small', 'addon-pack' ),
					'sm' => __( 'Small', 'addon-pack' ),
					'md' => __( 'Medium', 'addon-pack' ),
					'lg' => __( 'Large', 'addon-pack' ),
					'xl' => __( 'Extra Large', 'addon-pack' ),
				],
			]
		);

		$this->add_control(
			'ap_button_icon',
			[
				'label'       => __( 'Icon', 'addon-pack' ),
				'type'        => Controls_Manager::ICON,
				'default' => 'fa fa-heart',
				'separator'   => 'before',
				'label_block' => true,
			]
		);

		$this->add_control(
			'ap_button_icon_align',
			[
				'label'   => __( 'Icon Alignment', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'   => __( 'Left', 'addon-pack' ),
					'right'  => __( 'Right', 'addon-pack' ),
					'none'   => __( 'None', 'addon-pack' ),
				],
				'condition' => [
					'ap_button_icon!' => '',
				],
			]
		);

		$this->add_control(
			'ap_button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'addon-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 5,
				],
				'condition' => [
					'ap_button_icon!' => '',
					'ap_button_icon_align!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .ap-button .ap-button-icon-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ap-button .ap-button-icon-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ap_button_align',
			[
				'label' => __( 'Alignment', 'addon-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'addon-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'addon-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'addon-pack' ),
						'icon' => 'fa fa-align-right',
					]
				],
				'default'       => 'center',
				'selectors' => [
					'{{WRAPPER}} .ap-button-wrapper' => 'justify-content: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
	}

	
	protected function register_heading_style_controls(){
		
		$this->start_controls_section(
			'ap_button_style',
			[
				'label' => __( 'Button', 'addon-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'ap_tab_button_normal',
			[
				'label' => __( 'Normal', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_text_color',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button .ap-button-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_button_icon_color',
			[
				'label'     => __( 'Icon Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ap_button_icon!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_button_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-button',
			]
		);
		

		$this->add_control(
			'ap_button_border_style',
			[
				'label'   => __( 'Border Style', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'addon-pack' ),
					'solid'  => __( 'Solid', 'addon-pack' ),
					'dotted' => __( 'Dotted', 'addon-pack' ),
					'dashed' => __( 'Dashed', 'addon-pack' ),
					'groove' => __( 'Groove', 'addon-pack' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-button' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ap_button_border_size',
			[
				'label' => __( 'Border Size', 'addon-pack' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ap_button_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'ap_button_border_color',
			[
				'label'     => __( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ap_button_border_style!' => 'none'
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'ap_button_radius',
			[
				'label'      => __( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_shadow',
				'selector' => '{{WRAPPER}} .ap-button',
			]
		);

		$this->add_responsive_control(
			'ap_button_padding',
			[
				'label'      => __( 'Padding', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ap_button_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .ap-button .ap-button-text',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ap_tab_button_hover',
			[
				'label' => __( 'Hover', 'addon-pack' ),
			]
		);

		$this->add_control(
			'ap_button_hover_text_color',
			[
				'label'     => __( 'Text Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button:hover .ap-button-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ap_button_icon_hover_color',
			[
				'label'     => __( 'Icon Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ap_button_icon!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ap_button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ap-button:hover',
			]
		);

		$this->add_control(
			'ap_button_hover_border_style',
			[
				'label'   => __( 'Border Style', 'addon-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'addon-pack' ),
					'solid'  => __( 'Solid', 'addon-pack' ),
					'dotted' => __( 'Dotted', 'addon-pack' ),
					'dashed' => __( 'Dashed', 'addon-pack' ),
					'groove' => __( 'Groove', 'addon-pack' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .ap-button:hover' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ap_button_hover_border_size',
			[
				'label' => __( 'Border Size', 'addon-pack' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_hover_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'ap_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'addon-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ap-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_hover_border_style!' => 'none'
				]
			]
		);

		$this->add_responsive_control(
			'ap_button_hover_radius',
			[
				'label'      => __( 'Border Radius', 'addon-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ap-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ap_button_hover_shadow',
				'selector' => '{{WRAPPER}} .ap-button:hover',
			]
		);

		$this->add_control(
			'ap_hover_animation',
			[
				'label' => __( 'Hover Animation', 'addon-pack' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}
	
	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$button_icon_alignment = $settings['ap_button_icon_align'];

		$button_link = '';
        if($settings['ap_button_link_selection'] == 'existing_url' ) {
            $button_link = get_permalink( $settings['ap_button_existing_url'] );
        } elseif($settings['ap_button_link_selection'] == 'custom_url' ) {
            $button_link = $settings['ap_button_url']['url'];
        }

		$this->add_render_attribute( 'ap_button', 'class', 'ap-button');
		$this->add_render_attribute( 'ap_button', 'class', esc_attr($settings['ap_button_text'] ));
		$this->add_render_attribute( 'ap_button', 'class', 'ap-button-' . esc_attr($settings['ap_button_size']) );
		$this->add_render_attribute( 'ap_button_existing_url_target_blank', 'target', '_blank' );

		if ( $settings['ap_hover_animation'] ) {
			$this->add_render_attribute( 'ap_button', 'class', 'elementor-animation-' . $settings['ap_hover_animation'] );
		}

		?>

		<div class="ap-button-wrapper">

			<?php if( ! empty( $button_link ) ) : ?>
				<a href="<?php echo esc_attr( $button_link ); ?>" <?php echo $this->get_render_attribute_string( 'ap_button_existing_url_target_blank' ); ?> <?php if( ! empty( $settings['ap_button_url']['is_external'] ) ) : ?> target="_blank" <?php endif; ?><?php if( ! empty( $settings['ap_button_url']['nofollow'] ) ) : ?> rel="nofollow" <?php endif; ?>>
			<?php endif; ?>

				<div <?php echo $this->get_render_attribute_string( 'ap_button' ); ?>>

					<?php if($button_icon_alignment == 'left'): ?>
						<i class="<?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-button-icon-left" aria-hidden="true"></i> 
						<span class="ap-button-text"><?php echo $settings['ap_button_text']; ?></span>
					<?php elseif($button_icon_alignment == 'right'): ?>
						<span class="ap-button-text"><?php echo $settings['ap_button_text']; ?></span>
						<i class="<?php echo esc_attr($settings['ap_button_icon'] ); ?> ap-button-icon-right" aria-hidden="true"></i> 
					<?php else: ?>	
						<span class="ap-button-text"><?php echo $settings['ap_button_text']; ?></span>
					<?php endif; ?>

				</div>
			<?php if( ! empty( $button_link ) ) : ?>
				</a>
			<?php endif; ?>

		</div>

<?php
	}
	protected function _content_template() {

		
	}
	
}