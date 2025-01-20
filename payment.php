<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Charity Trust</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Donate to Charity Trust</h2>
        <p>Your donation helps our cause. Please enter your card details below to make a donation.</p>

        <form action="process_payment.php" method="POST" id="payment-form">
            <div class="form-group">
                <label for="amount">Donation Amount ($):</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="card-element">Card details:</label>
                <div id="card-element"></div>
            </div>

            <button type="submit" class="btn btn-primary">Donate</button>
        </form>
    </div>

    <script>
        var stripe = Stripe('your-publishable-key-here');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Display error.message
                    alert(result.error.message);
                } else {
                    // Send the token to the server
                    var token = result.token.id;
                    var amount = document.getElementById('amount').value;

                    // Append the token to the form
                    var tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = 'stripeToken';
                    tokenInput.value = token;
                    form.appendChild(tokenInput);

                    // Append the amount to the form
                    var amountInput = document.createElement('input');
                    amountInput.type = 'hidden';
                    amountInput.name = 'amount';
                    amountInput.value = amount;
                    form.appendChild(amountInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
