<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //make alias of the product
    
    public function makeAlias($str){
        $str=strtolower($str);
        $str=str_replace(".","",$str);
		$str=str_replace(" ","-",$str);
		$str=str_replace("--","-",$str);
		$str=str_replace("--","-",$str);
		$str=str_replace("--","-",$str);
		$str=str_replace("&","and",$str);
		$str=str_replace("(","",$str);
		$str=str_replace(")","",$str);
        $str=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s','',$str);
        
		return $this->ignoreDuplication($str);
    }
    
    public function ignoreDuplication($str){
        $productCount = Product::where('alias',$str)->count();
        if($productCount>0){
            $str = $str."-".($productCount+1);
        }
        return $str;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        $categoryCount = Category::count();
        
        return view('product-category', compact(['categories','categoryCount']));
    }

    //dispaly products page

    public function productsByCategory(Request $request){
        $cat_id = $request->id;
        $catRow = Category::where('id',$cat_id)->first();
        $products = Product::where('cat_id',$cat_id)->latest()->get();
        $productCount = Product::where('cat_id',$cat_id)->count();

        return view('products', compact(['products','productCount', 'catRow']));

    }

    //display add or edit product page
    public function addEditProductPage(Request $request)
    {
        $action = "add";
        $cat_id = $request->catId;
        $categories = Category::latest()->get();
        //return $product_id;
        if($request->id){
            $action = "edit";
            $product= Product::where("id",$request->id)->first();
            
            return view('add-edit-product',compact(['product', 'action', 'categories']));
        }
        return view('add-edit-product',compact(['action', 'cat_id', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->product_id;
        $name = $request->product_name;
        $category = $request->product_category;
        $desc = $request->product_description;
        $limit = $request->order_limit;
        $mPrice = $request->mark_price;
        $price = $request->product_price;

        $alias = $this->makeAlias($name);
        //dd($alias);
        //return $alias;

        //return(dump($request->all()));

        //get a category record
        $productRow = Product::where('id',$product_id)->first();
        $proCount = Product::where('name',$name)->count();

        //check to make sure the product name won't duplicate
        if($product_id==0 && $proCount>0){
            return "exist";
        }
        if($product_id>0){
            if($name==$productRow->name && $proCount>1){
                return "exist";
            }
            if($name!=$productRow->name && $proCount>0){
                return "exist";
            }
        }
        
        $image_file = $request->product_image;
        $fileName = "";
        $file_path = public_path('/storage/uploads/images/products/');
    
        if($image_file){
            $dateTime = date('Y-m-d-H-i-s')."-".uniqid();
            $extn = $image_file->getClientOriginalExtension();
            $fileName = $dateTime.".".$extn;
            //store image file
            $file = $request->file('product_image');
            $file->move($file_path, $fileName);
            //Storage::putFileAs('uploads/images/products', new File($image_file), $fileName);

            if($product_id>0){
                $productRow = Product::where('id',$product_id)->first();
                if($productRow->image!=""){
                    if(\File::exists($file_path.$productRow->image)){
                        \File::delete($file_path.$productRow->image);
                    }else{
                        //dd('File does not exists.');
                    }
                }
            }
        }

        if($product_id==0){
            $pro = new Product();
            $pro->name = $name;
            $pro->alias = $alias;
            $pro->cat_id = $category;
            $pro->description = $desc;
            $pro->image = $fileName;
            $pro->mark_price = $mPrice;
            $pro->actual_price = $price;
            $pro->max_order_qnt = $limit;
            $pro->save();
        }
        if($product_id>0){
            if($request->edit_image=='' && !$image_file){
                $productRow = Product::where('id',$product_id)->first();
                if($productRow->image!=""){
                    if(\File::exists($file_path.$productRow->image)){
                        \File::delete($file_path.$productRow->image);
                    }else{
                        //dd('File does not exists.');
                    }
                }
                $fileName= '';
            }
            if($request->edit_image!=''){
                $fileName= $request->edit_image;
            }
            Product::where('id', $product_id)->update([
                'name' => $name,
                'alias' => $alias,
                'cat_id' => $category,
                'description' => $desc,
                'image' => $fileName,
                'mark_price' => $mPrice,
                'actual_price' => $price,
                'max_order_qnt' => $limit

            ]);
            
        }
        
        
        return $this->index();
    }

    public function publish(Request $request)
    {
        //Change the publish status of instrument
        //return "publish function";
        Product::where('id', $request->id)->update([
            'publish' => request()->is_publish
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $proId = $request->id;
        //return "music id = ".$musicId;
        $file_path = public_path('/storage/uploads/images/products/');

        //delete all the courses and course files
        $proRow = Product::where('id',$proId)->first();
        $image = $proRow->image;
        if($image!=""){
            if(\File::exists($file_path.$image)){
                \File::delete($file_path.$image);
            }else{
                //dd('File does not exists.');
            }
        }
        Product::where('id',$proId)->delete();
    }
}
