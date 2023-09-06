<?php
function add_elementor_widget_categories( $elements_manager ) {

    $elements_manager->add_category(
        'Innovare',
        [
            'title' => __( 'Innovare', 'boilerplate-elementor-extension' ),
            'icon' => 'fas fa-th-large',
        ]
    );

}

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );