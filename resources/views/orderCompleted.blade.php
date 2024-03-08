
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link  rel="stylesheet" href="{{asset('css/orderCompleted.css')}}">

</head>
<body>

<div class="container">
    <div class="card">
        <i class="bi bi-check-circle-fill text-center"></i>
        <h3 class="text-center">Your Order is Confirmed!</h3>
        <p class="text-center">We'll send a shopping confirmation email <br> as soon as your order slips.</p>
        <p class="text-center">Order ID: {{ $orders->id }}</p>

        <!-- Add more order details or call-to-action buttons as needed -->

        <div class="text-center">
            <a href="/" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
</div>
</body>
</html>
