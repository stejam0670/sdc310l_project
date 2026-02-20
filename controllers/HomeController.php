<?php

function get_home_data()
{
    return array(
        'checkout_success' => isset($_GET['checkout']) && $_GET['checkout'] === 'success'
    );
}
