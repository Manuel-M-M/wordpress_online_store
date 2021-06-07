<?php

remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);
add_action('woocommerce_review_before', 'game_store_action_avatar', 10);

function game_store_action_avatar() {
    echo "<i class='fas fa-user-astronaut'></i>";
}