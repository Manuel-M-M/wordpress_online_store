<?php

remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);
add_action('woocommerce_review_before', 'game_store_action_avatar', 10);

function game_store_action_avatar() {
    echo "<i class='fas fa-user-astronaut'></i>";
}

add_filter('woocommerce_checkout_fields', 'game_store_filter_fields', 20);

function game_store_filter_fields($fields) {
    
    // Remove field phone from form
    unset($fields['billing']['billing_phone']);

    // Add new field to form
    $fields['billing']['new_field'] = [
        'type' => 'text',
        'label' => 'Campo nuevo',
        'placeholder' => 'introduce tu campo nuevo',
        'required' => true
    ];

    // Add survey field to form
    $fields['order']['encuesta'] = [
        'type' => 'select', 
        'label' => '¿Como nos conociste?',
        'placeholder' => 'Selecciona una opción',
        'options' => [
            'default' => 'Seleciona...',
            'amigo' => 'a través de un amigo',
            'internet' => 'a través de internet'
        ]
    ];

    return $fields;
}

add_action('woocommerce_checkout_update_order_meta', 'game_store_action_save_custom_fields');

// Save the new fields in database
function game_store_action_save_custom_fields($order_id) {
    if(!empty ($_POST['encuesta'])) {
        // Save a new survey field in the WP database in the order of the order_id 
        // that I receive with the value that I receive from the checkout form.
        update_post_meta($order_id, 'encuesta', sanitize_text_field($_POST['encuesta']));
    }

    if(!empty($_POST['campo_nuevo'])) {
        // Save in db the value of the new field that I have added to the checkout form.
        update_post_meta(order_id, 'campo_nuevo', sanitize_text_field($_POST['campo_nuevo']));
    }
}