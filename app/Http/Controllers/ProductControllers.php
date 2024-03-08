<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductControllers extends Controller
{

    // Function for show index page
    public function index(){
        $product = Product::all();
        return view('index', compact('product'));
    }
    // End 


    // Function for add product id in session, if selected product.
    public function addToCart($productId)
    {
        // Retrieve the product from the database based on the $productId
        $product = Product::find($productId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
            
        }
    
        $productIds = Session::get('product_ids', []);
    
        // Check if the product is already in the cart
        if (!in_array($productId, $productIds)) {
            $productIds[] = $productId;
            Session::put('product_ids', $productIds);
        }
    
        return redirect()->back()->with('success', 'Product added to cart successfully.');

    }
    // End


    // Function for if click on Order now show shipping page with product selected
    public function shipping(){
        return view('shipping');
    }
    // End 


    // Function for update quantity and store in session 
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('productId');
        $newQuantity = $request->input('quantity');

        // Update quantity in the session
        Session::put('quantity_' . $productId, $newQuantity);

        return response()->json(['success' => true]);
    }
    // End 

}
