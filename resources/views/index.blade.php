<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Project</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link  rel="stylesheet" href="css/index.css">

</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Company Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>             
                <!-- Add more navigation items as needed -->
            </ul>
            
        </div>
    </div>
</nav>
    <!-- Product Card with Description -->
    <div style="margin:2%">
    <a href="{{ route('order.shipping') }}"><button class="btn btn-info float-right" style="margin-bottom:10px;margin-left:90%">Order Now</button></a>
        <div class="row row-cols-1 row-cols-md-5">
        @foreach ($product as $product)
            <div class="col mb-4">
                <div class="card">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="Product Image" style="height:200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                    </div>

                    <div class="product-details">
                        <form action="{{ route('product.addToCart', ['product' => $product->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-{{ in_array($product->id, session('product_ids') ?? []) ? 'success' : 'primary' }}">
                                {{ in_array($product->id, session('product_ids') ?? []) ? 'Selected' : 'Select Product' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
