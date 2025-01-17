<?php
class Hello_World_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'innovare_box';
    }

    public function get_title() {
        return __( 'Innovare Box', 'boilerplate-elementor-extension' );
    }

    public function get_icon() {
        return 'fas fa-th-large';
    }

    public function get_categories() {
        return [ 'Innovare' ];
    }

    public function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'boilerplate-elementor-extension' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'box_icon',
            [
                'label' => __( 'Choose Image', 'boilerplate-elementor-extension' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'box_title',
            [
                'label' => __( 'Box Title', 'boilerplate-elementor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Box Title', 'boilerplate-elementor-extension' ),
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'box_description',
            [
                'label' => __( 'Box Description', 'boilerplate-elementor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Default description', 'boilerplate-elementor-extension' ),
                'placeholder' => __( 'Type your description here', 'boilerplate-elementor-extension' ),
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'box_link',
            [
                'label' => __( 'Link', 'boilerplate-elementor-extension' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'boilerplate-elementor-extension' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'box_color',
            [
                'label' => __( 'Box Background Colour', 'boilerplate-elementor-extension' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .innovare-box-widget .hover-content' => 'background-color: {{VALUE}}',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'label' => __( 'Background', 'boilerplate-elementor-extension' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .innovare-box-widget a',
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_responsive_control(
            'box_height',
            [
                'label' => __( 'Box Height', 'boilerplate-elementor-extension' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 1000 ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [ 'size' => 400, 'unit' => 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .innovare-box-widget a' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $target = $settings['box_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['box_link']['nofollow'] ? ' rel="nofollow"' : '';

        echo '<div class="innovare-box-widget">';
        echo '<a href="'.$settings['box_link']['url'].'" '. $target . $nofollow .'>';
        if(empty($settings['box_icon']['url'])) {
            echo '<div class="content"><div class="content-inner"><h2 class="title--xs">'.$settings['box_title'].' <i class="fas fa-chevron-right"></i></h2></div></div>';
            echo '<div class="hover-content"><h2 class="title--xs">'.$settings['box_title'].' <i class="fas fa-chevron-right"></i></h2><hr><p>'.$settings['box_description'].'</p><span>Read More <i class="fas fa-chevron-right"></i></span></div>';
        } else {
            echo '<div class="content"><div class="content-inner"><h2 class="title--xs"><img src="' . $settings['box_icon']['url'] . '" alt="'.$settings['box_title'].'">'.$settings['box_title'].' <i class="fas fa-chevron-right"></i></h2></div></div>';
            echo '<div class="hover-content"><h2 class="title--xs"><img src="' . $settings['box_icon']['url'] . '" alt="'.$settings['box_title'].'">'.$settings['box_title'].' <i class="fas fa-chevron-right"></i></h2><hr><p>'.$settings['box_description'].'</p><span>Read More <i class="fas fa-chevron-right"></i></span></div>';
        }
        echo '</a>';
        echo '</div>';
    }
}
