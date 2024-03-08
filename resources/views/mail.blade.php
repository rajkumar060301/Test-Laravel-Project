<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }   
    </style>

</head>
<body>
<div class="container">
        <h2>Order Confirmation</h2>
        <p>Dear Customer,</p>
        <p>Thank you for placing an order on our website. Your order details are as follows:</p>
        <div style="padding: 20px; border-radius: 10px; ">
        <i class="bi bi-geo-alt-fill" style="font-size: 4rem; color: #3498db;"></i> 
            <h3 style="color: #333; margin-bottom: 10px;">Shipping Address</h3>
            @if(session()->has('order_id'))
                @php
                    $orders = \App\Models\Orders::find(session('order_id'));
                @endphp

                <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $orders->shipping_address_1 }},</p>
                <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $orders->shipping_address_2 }},</p>
                <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $orders->shipping_address_3 }},</p>
                <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $orders->country_code }},</p>
                <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $orders->zip_postal_code }}</p>
            @else
                <p>No order details found.</p>
            @endif

        </div>
 
        <strong>Order ID:</strong> #{{ session('order_id') }}

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
            @if(Session::has('product_ids'))
            @foreach(Session::get('product_ids') as $productId)
                @php
                    $product = \App\Models\Product::find($productId);
                    $quantity = Session::get('quantity_' . $productId, 1);
                @endphp


                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $quantity }}</td>
                        <td>
                            <img src="{{ $product->image_url }}" style="height: 60px; width: 70px;">
                        </td>

                    </tr>
                
    
                @endforeach
            @endif
                <!-- Add more rows for additional products -->
            </tbody>
        </table>  
        <p>Your items are now being processed, and we will notify you once your order has been shipped.</p>

        <p>If you have any questions or concerns, please feel free to contact our customer support. Thank you for choosing us!</p>

        <p>Best regards,<br> Testing Laravel Company</p>
    </div>    
</body>
</html>
