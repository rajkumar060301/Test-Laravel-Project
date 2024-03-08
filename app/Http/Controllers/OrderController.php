<?php
// OrderController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class OrderController extends Controller
{


    // Show the product on shipping page if selected product
    public function showOrderDetails(Request $request, $id)
    {
        
        // Retrieve the product details based on the id parameter
        $product = Product::find($id);

        // Pass the product details to the shipping form view
        return view('shipping', compact('product'));
    }
    // End


    // If shipping form submit then get value of form.
    public function order(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email|unique:orders,email',
            'shipping_address_1' => 'required|string',
            'shipping_address_2' => 'required|string',
            'shipping_address_3' => 'required|string',
            'country_code' => 'required|min:2|string',
            'zip_postal_code' => 'required|max:6|string',
        ]);
        
        if ($validatedData->fails()) {
            return redirect('/order')->withErrors($validatedData)->withInput();
        }

        $order = new Orders();
        $order->email = $request->input('email');
        $order->shipping_address_1 = $request->input('shipping_address_1');
        $order->shipping_address_2 = $request->input('shipping_address_2');
        $order->shipping_address_3 = $request->input('shipping_address_3');
        $order->country_code = $request->input('country_code');
        $order->zip_postal_code = $request->input('zip_postal_code');
        $getorder = $order->save();
        $order_id = $order->id;
        session(['order_id' => $order_id]);

      return redirect()->route('order.completed1', ['order_id' => $order_id]);
    }
    // End 


    //Function for, if order is created then save product data
    public function orderCompleted($order_id)
    {
        $products = [];
                
        if (Session::has('product_ids')) {
            foreach (Session::get('product_ids') as $productId) {
                $quantity = Session::get("quantity_$productId", 1);
                $product = Product::find($productId);
        
                if ($product) {
                    $products[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image_url' => $product->image_url,
                        'quantity' => $quantity,
                    ];

                    $orderItem = new OrderItems();
                    $orderItem->order_id = $order_id;
                    $orderItem->product_id = $product->id;
                    $orderItem->quantity = $quantity;
                    $orderItem->save();                    
                }
            }
        }
        
        $orders = Orders::find($order_id);
        $shipping_email = $orders['email'];
        $products = $products;

        $data = ['name'=> 'Test Email', 'data'=>'Laravel Testing'];

        // Sending email to according to shipping email
        $user['to'] = $shipping_email;
        Mail::send('mail',$data,function($message) use ($user){
            $message->to( $user['to']);
            $message->subject('Order confirmations');
        });
        // End

        // Sending email to client 
        $user_email['to'] = "testingemail032024@gmail.com";
        Mail::send('clientConfirmationEmail',$data,function($message) use ($user_email){
            $message->to( $user_email['to']);
            $message->subject('Order booked');
        });

        // if completed order and save product in databse then distory session
        Session::flush();

        return view('orderCompleted', compact('orders'),compact('products'));
    }
    // End

}
