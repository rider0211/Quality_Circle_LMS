<?php

// die('WooCommerce');

// die(__DIR__ . '/autoload.php');

require __DIR__ . '/autoload.php';

use Automattic\WooCommerce\Client;

use Automattic\WooCommerce\HttpClient\HttpClientException;

$woocommerce = new Client(
    'https://shop.gosmartacademy.com/', 
    'ck_b6411a22ed11f224a13d68bc2bb642a4227b69c3', 
    'cs_ae6ff61f63bed83c2d2e1880b1634449f30a2c04',
    [
        'version' => 'wc/v3',
    ]
);


try {
    // Array of response results.
    $results = $woocommerce->get('products');
    // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...
    echo '<pre><code>' . print_r( $results, true ) . '</code><pre>'; // JSON output.

    // Last request data.
    $lastRequest = $woocommerce->http->getRequest();
    echo '<pre><code>' . print_r( $lastRequest->getUrl(), true ) . '</code><pre>'; // Requested URL (string).
    echo '<pre><code>' . print_r( $lastRequest->getMethod(), true ) . '</code><pre>'; // Request method (string).
    echo '<pre><code>' . print_r( $lastRequest->getParameters(), true ) . '</code><pre>'; // Request parameters (array).
    echo '<pre><code>' . print_r( $lastRequest->getHeaders(), true ) . '</code><pre>'; // Request headers (array).
    echo '<pre><code>' . print_r( $lastRequest->getBody(), true ) . '</code><pre>'; // Request body (JSON).

    // Last response data.
    $lastResponse = $woocommerce->http->getResponse();
    echo '<pre><code>' . print_r( $lastResponse->getCode(), true ) . '</code><pre>'; // Response code (int).
    echo '<pre><code>' . print_r( $lastResponse->getHeaders(), true ) . '</code><pre>'; // Response headers (array).
    echo '<pre><code>' . print_r( $lastResponse->getBody(), true ) . '</code><pre>'; // Response body (JSON).

} catch (HttpClientException $e) {
    echo '<pre><code>' . print_r( $e->getMessage(), true ) . '</code><pre>'; // Error message.
    echo '<pre><code>' . print_r( $e->getRequest(), true ) . '</code><pre>'; // Last request data.
    echo '<pre><code>' . print_r( $e->getResponse(), true ) . '</code><pre>'; // Last response data.
}




?>