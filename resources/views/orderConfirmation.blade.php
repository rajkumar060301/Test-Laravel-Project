<div class="container1">
    <h2>Order Confirmation</h2>
    <p>Dear Customer,</p>
    <p>Thank you for placing an order on our website. Your order details are as follows:</p>

    <!-- Shipping Address Section -->
    <div style="text-align: center; padding: 20px; border-radius: 10px;">
        <i class="bi bi-geo-alt-fill" style="font-size: 4rem; color: #3498db;"></i>
        <h3 style="color: #333; margin-bottom: 10px;">Shipping Address</h3>
        <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $data['orders']->shipping_address_1 }}</p>
        <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $data['orders']->shipping_address_2 }}</p>
        <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $data['orders']->shipping_address_3 }}</p>
        <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $data['orders']->country_code }}</p>
        <p style="font-size: 16px; margin: 5px 0; color: #555;">{{ $data['orders']->zip_postal_code }}</p>
    </div>

    <strong>Order ID:</strong> #{{ $data['orders']->id }}

    <!-- Ordered Products Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['products'] as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <img src="{{ $product->image_url }}" style="height: 60px; width: 70px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Order Confirmation Message -->
    <p>Your items are now being processed, and we will notify you once your order has been shipped.</p>

    <p>If you have any questions or concerns, please feel free to contact our customer support. Thank you for choosing us!</p>

    <p>Best regards,<br> Testing Laravel Company</p>
</div>
