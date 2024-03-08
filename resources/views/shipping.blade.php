
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Template</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-3">

<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-header">
                <h6>Shipping address</h6>
            </div>
            <div class="card-body">
                <form action="{{route('order.create')}}" method="post">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email')}}">
                        @if($errors->any())
                        <span style="color:red">{{$errors->first('email')}}</span>
                        @endif
                    </div>

                    <!-- Shipping Address 1 -->
                    <div class="mb-3">
                        <label for="shipping_address_1" class="form-label">Shipping Address 1</label>
                        <input type="text" class="form-control" id="shipping_address_1" name="shipping_address_1" value="{{ old('shipping_address_1')}}">
                        @if($errors->any())
                        <span style="color:red">{{$errors->first('shipping_address_1')}}</span>
                        @endif                        
                    </div>

                    <!-- Shipping Address 2 -->
                    <div class="mb-3">
                        <label for="shipping_address_2" class="form-label">Shipping Address 2</label>
                        <input type="text" class="form-control" id="shipping_address_2" name="shipping_address_2" value="{{ old('shipping_address_2')}}">
                        @if($errors->any())
                        <span style="color:red">{{$errors->first('shipping_address_2')}}</span>
                        @endif                    
                    </div>

                    <!-- Shipping Address 3 -->
                    <div class="mb-3">
                        <label for="shipping_address_3" class="form-label">Shipping Address 3</label>
                        <input type="text" class="form-control" id="shipping_address_3" name="shipping_address_3" value="{{ old('shipping_address_3')}}">
                        @if($errors->any())
                        <span style="color:red">{{$errors->first('shipping_address_3')}}</span>
                        @endif                    
                    </div>

                    <!-- Country Code -->
                    <div class="mb-3">                        
                        <label for="country_code" class="form-label">Country Code</label>
                        <input type="text" class="form-control" id="country_code" name="country_code" maxlength="2" value="{{ old('country_code')}}">
                        @if($errors->any())
                        <span style="color:red">{{$errors->first('country_code')}}</span>
                        @endif                    
                    </div>

                    <!-- Zip/Postal Code -->
                    <div class="mb-3">
                        <label for="zip_postal_code" class="form-label">Zip/Postal Code</label>
                        <input type="text" class="form-control" id="zip_postal_code" name="zip_postal_code" value="{{ old('zip_postal_code')}}">
                        @if($errors->any())
                        <span style="color:red">{{$errors->first('zip_postal_code')}}</span>
                        @endif                    
                    </div>
                    <!-- Submit Button -->
                    @if(session()->has('product_ids'))
                        <button type="submit" class="btn btn-primary text-center">Submit</button>
                    @else
                        <button type="button" class="btn btn-secondary text-center"  onclick="alert('Please before select the product')">Submit</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-3">

<!-- Your Blade Template -->
    @if(Session::has('product_ids'))
        @foreach(Session::get('product_ids') as $productId)
            @php
                $product = \App\Models\Product::find($productId);
                $quantity = Session::get('quantity_' . $productId, 1);
            @endphp

            <div class="card mb-3">
                <div class="card-body">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="Product Image" style="height:150px;">
                    <h5 class="card-title">{{ $product->name }}</h5>

                    <label for="quantity" class="form-label">Quantity</label>
                    <div class="input-group">
                        <button class="btn" onclick="updateQuantity('{{ $productId }}' , -1)">-</button>
                        <input type="text" id="quantity{{ $productId }}" class="form-control text-center" value="{{ $quantity }}" readonly>
                        <button class="btn" onclick="updateQuantity('{{ $productId }}' , 1)">+</button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p style="color: red;">Please select at least one product.</p>
    @endif

    <script>
    // Your JavaScript code

    function updateQuantity(productId, change) {
        var quantityInput = document.getElementById('quantity' + productId);
        var currentQuantity = parseInt(quantityInput.value);
        
        // Ensure quantity is not negative
        var newQuantity = Math.max(1, currentQuantity + change);
        
        // Update quantity in the input field
        quantityInput.value = newQuantity;

        // Update quantity in the session using fetch
        fetch('{{ route("update-quantity") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token
            },
            body: JSON.stringify({
                productId: productId,
                quantity: newQuantity,
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Quantity updated successfully');
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
        });
    }

    </script>

        
        </div>
    </div>
</div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
