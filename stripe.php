<?php
require 'vendor/autoload.php';

// Set your secret key. Keep this secure and use environment variables in production.
\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

header('Content-Type: application/json');

try {
    // Read JSON input from the frontend
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate and retrieve the price_total
    if (!isset($input['price_total']) || !is_numeric($input['price_total']) || $input['price_total'] <= 0) {
        throw new Exception('Invalid price total.');
    }

    $price_total = round($input['price_total'], 2); // Round to two decimal places
    $price_total_cents = intval($price_total * 100); // Convert to cents

    // Create a Stripe Checkout Session
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Total Products',
                ],
                'unit_amount' => $price_total_cents,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/success.php',
        'cancel_url' => 'http://localhost/cancel.php',
    ]);

    // Return the session ID as JSON
    echo json_encode(['id' => $checkout_session->id]);
} catch (Exception $e) {
    // Handle exceptions and send error response
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
