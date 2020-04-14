<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Cart;
use App\BillingShipping;
use App\Newsletter;
use App\Pages;

use Illuminate\Http\Request;
//use Session;

class FrontendController extends Controller
{
    
    //front end index page
    public function frontIndexPage()
    {
        $productRows = Product::where('publish','1')->latest()->get();
        //dd($productRows);
        return view('front.index', compact(['productRows']));
    }

    //if product with same session data exist or not
    public function getProductCountBySessionId($id){
        $sessionId = session()->getId();
        $productRow = Cart::where('session_id',$sessionId)
                                ->where('product_id',$id)->first();
                              
        return $productRow;
    }
    //Get cart items by session id
    public function getCartCountBySessionId(){
        $sessionId = session()->getId();
        $cartCount = Cart::where('session_id',$sessionId)->count();                      
        return $cartCount;
    }
    

    //product detail page
    public function productDetailPage($alias){
        $catRows = Category::latest()->get();
        $product = Product::where('alias',$alias)
                                ->where('publish','1')
                                ->first();

        $sessionId = session()->getId();
        $cartProduct = Cart::where('session_id',$sessionId)
                                ->where('product_id',$product->id)
                                ->first();
        //dd($cartProduct);
        return view('front.product_detail', compact(['product','catRows', 'cartProduct']));
    }

    //add product to cart
    public function addToCart(Request $request){
        //return dd(request()->all());
        $qnt = $request->quantity;
        $product_id = $request->product_id;

        //return $product_id;

        $productRow = Product::where('id',$product_id)->where('publish','1')->first();
        //return "Prouct Id = ".$product_id;
        //dd($productRow);
        //return var_dump($productRow);
        $sellingPrice = $productRow->actual_price;

        $markPrice = $productRow->mark_price;
        $totalPrice = $sellingPrice*$qnt;

        $sessionId = session()->getId();
        $cartProduct = $this->getProductCountBySessionId($product_id);
        if($cartProduct){
            $cartId = $cartProduct->id;
            Cart::where('id', $cartId)->update([
                'cart_quantity' => $qnt,
                'total_price' => $totalPrice
            ]);
        }else{
            $cart = new Cart();
            $cart->product_id = $product_id;
            $cart->session_id = $sessionId;
            $cart->mark_price = $markPrice;
            $cart->selling_price = $sellingPrice;
            $cart->cart_quantity = $qnt;
            $cart->total_price = $totalPrice;
            $cart->save();
        }
        
    }

    //cart page
    public function cartPage()
    {
        $cartCount = $this->getCartCountBySessionId();
        $cartRows = Cart::where('session_id',session()->getId())->get();
        return view('front.cart', compact(['cartRows', 'cartCount']));
    }

    //contact page
    public function contactPage()
    {
        return view('front.contact');
    }

    //About page
    public function aboutPage()
    {
        $page =  Pages::where('id',1)->first();
        return view('front.about',compact('page'));
    }

    //Newsletter page
    public function newsletterSubscribe(Request $request)
    {
        $email = $request->nl_email;
        $newsletterCount = Newsletter::where('email',$email)->count();
        if($newsletterCount){
            return "exist";
        }
        $newsLetter = new Newsletter;
        $newsLetter->email = $email;
        $newsLetter->save();
        //return "success";
    }
    

    //cart update function
    public function cartUpdate(Request $request)
    {
        $qnt = $request->quantity;
        $id = $request->cart_id;
        //return "Id => ".$id."---- Qnty => ".$qnt;
        $cartRow = Cart::findOrFail($id);
        $sellPrice = $cartRow->selling_price;
        $totalPrice = $sellPrice*$qnt;

        Cart::where('id', $id)->update([
            'cart_quantity' => $qnt,
            'total_price' => $totalPrice
        ]);
    }
    //cart update function
    public function cartDelete(Request $request)
    {
        $id = $request->cart_id;
        $cartCount = $this->getCartCountBySessionId();
        //return "Id => ".$id;
        Cart::where('id',$id)->delete();
        if($cartCount<=1){
            return "empty";
        }
        


    }
    //front category page
    public function frontCategoryPage()
    {
        $catRows = Category::latest()->get();
        return view('front.category', compact(['catRows']));
    }
    
    //products by category
    public function productByCategoryPage($alias)
    {
        $catRow = Category::where('alias',$alias)->first();
        //dd($catRow);
        $catId = $catRow->id;
        $productRows = Product::where('cat_id',$catId)
                                ->where('publish','1')
                                ->latest()
                                ->get();
        return view('front.category-product', compact(['catRow', 'productRows']));
    }
    //all products by category
    public function allProductsPage()
    {
        $productRows = Product::where('publish','1')
                                ->latest()
                                ->get();
        return view('front.products-all', compact(['productRows']));
    }

    public function correspondencePage()
    {
        $detailRow = BillingShipping::where('session_id',session()->getId())->first(); 
        //dd($detailRow);
        return view('front.correspondence-detail', compact('detailRow'));
    }

    public function correspondenceSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'billing_first_name' => 'required',
            'billing_last_name' => 'required',
            'billing_address_1' => 'required',
            'billing_town' => 'required',
            'billing_state' => 'required',
            'billing_postcode' => 'required',
            'billing_country' => 'required',
            'billing_email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            
            'shipping_first_name' => 'required',
            'shipping_last_name' => 'required',
            'shipping_address_1' => 'required',
            'shipping_town' => 'required',
            'shipping_state' => 'required',
            'shipping_postcode' => 'required',
            'shipping_country' => 'required',
            'shipping_email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'agree_term' => 'required'
            
            
        ]);
        //return redirect('articles')->withInput();
        
        $sessionId = session()->getId();
        $same_billing_shipping = ($request->same_billing_shipping=='on') ? 1:0;
        $detailCount = BillingShipping::where('session_id',$sessionId)->count(); 
        if(!$detailCount){
            $detail = new BillingShipping();
            $detail->session_id = $sessionId;
            $detail->billing_first_name = $request->billing_first_name;
            $detail->billing_last_name = $request->billing_last_name;
            $detail->billing_address_1 = $request->billing_address_1;
            $detail->billing_address_2 = $request->billing_address_2;
            $detail->billing_town = $request->billing_town;
            $detail->billing_state = $request->billing_state;
            $detail->billing_postcode = $request->billing_postcode;
            $detail->billing_country = $request->billing_country;
            $detail->billing_email = $request->billing_email;
            $detail->billing_phone = $request->billing_phone;
            $detail->same_as_billing = $same_billing_shipping;
            
            $detail->shipping_first_name = $request->shipping_first_name;
            $detail->shipping_last_name = $request->shipping_last_name;
            $detail->shipping_address_1 = $request->shipping_address_1;
            $detail->shipping_address_2 = $request->shipping_address_2;
            $detail->shipping_town = $request->shipping_town;
            $detail->shipping_state = $request->shipping_state;
            $detail->shipping_postcode = $request->shipping_postcode;
            $detail->shipping_country = $request->shipping_country;
            $detail->shipping_email = $request->shipping_email;
            $detail->shipping_phone = $request->shipping_phone;
            $detail->save();
        }else{
            BillingShipping::where('session_id', $sessionId)->update([
                'billing_first_name' => $request->billing_first_name,
                'billing_last_name' => $request->billing_last_name,
                'billing_address_1' => $request->billing_address_1,
                'billing_address_2' => $request->billing_address_2,
                'billing_town' => $request->billing_town,
                'billing_state' => $request->billing_state,
                'billing_postcode' => $request->billing_postcode,
                'billing_country' => $request->billing_country,
                'billing_email' => $request->billing_email,
                'billing_phone' => $request->billing_phone,
                'same_as_billing' => $same_billing_shipping,
                
                'shipping_first_name' => $request->shipping_first_name,
                'shipping_last_name' => $request->shipping_last_name,
                'shipping_address_1' => $request->shipping_address_1,
                'shipping_address_2' => $request->shipping_address_2,
                'shipping_town' => $request->shipping_town,
                'shipping_state' => $request->shipping_state,
                'shipping_postcode' => $request->shipping_postcode,
                'shipping_country' => $request->shipping_country,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone
            ]);
        }

        //dd(request()->all());
        //$this->cartSummaryPage();
        $cartCount = $this->getCartCountBySessionId();
        $cartRows = Cart::where('session_id',session()->getId())->get();
        return view('front.cart-summary', compact(['cartRows', 'cartCount']));
        
    }

    public function orderSummaryPage()
    {
        $cartCount = $this->getCartCountBySessionId();
        $cartRows = Cart::where('session_id',session()->getId())->get();
        return view('front.cart-summary', compact(['cartRows', 'cartCount']));
    }


    public function correspondenceDetailConfirmation()
    {
        $detailRow = BillingShipping::where('session_id',session()->getId())->first(); 
        //dd($detailRow);
        return view('front.correspondence-confirmation', compact('detailRow'));
    }


}
