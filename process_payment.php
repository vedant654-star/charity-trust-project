<?php
require_once('vendor/autoload.php'); // Stripe PHP SDK

// Set your secret key (don't use this in client-side code)
\Stripe\Stripe::setApiKey('your-secret-key-here');

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['stripeToken'];
    $amount = $_POST['amount']; // Amount in dollars

    try {
        // Create the charge
        $charge = \Stripe\Charge::create([
            'amount' => $amount * 100,  // Stripe expects the amount in cents
            'currency' => 'usd',        // Change currency as needed
            'description' => 'Charity Donation',
            'source' => $token,
        ]);

        // If charge is successful, show a success message
        echo '<h2>Thank you for your donation!</h2>';
        echo '<p>Your payment of $' . $amount . ' has been successfully processed.</p>';
        // You can also log this transaction in your database if needed.
    } catch (\Stripe\Exception\CardException $e) {
        echo 'Payment failed: ' . $e->getError()->message;
    }
}
?>
