<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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

    //make alias of the category
    
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
        $catCount = Category::where('alias',$str)->count();
        if($catCount>0){
            $str = $str."-".($catCount+1);
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
        
        return view('categories', compact(['categories','categoryCount']));
    }
    /**
     * Load add lesson page
     */

    public function addEditCatPage(Request $request)
    {
        $action = "add";
        if($request->id){
            $action = "edit";
            $category= Category::where("id",$request->id)->first();
            
            return view('add-edit-category',compact(['category', 'action']));
        }
        return view('add-edit-category',compact('action'));
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
        $cat_id = $request->cat_id;
        $name = $request->category_name;
        $alias = $this->makeAlias($name);
        $desc = $request->cat_description;

        //get a category record
        $catRow = Category::where('id',$cat_id)->first();
        $catCount = Category::where('name',$name)->count();

        //check to make sure the category name won't duplicate
        if($cat_id==0 && $catCount>0){
            return "exist";
        }
        if($cat_id>0){
            if($name==$catRow->name && $catCount>1){
                return "exist";
            }
            if($name!=$catRow->name && $catCount>0){
                return "exist";
            }
        }
        
        $image_file = $request->category_image;
        $fileName = "";
        
        $file_path = public_path('/storage/uploads/images/categories/');
        if($image_file){
            $dateTime = date('Y-m-d-H-i-s')."-".uniqid();
            $extn = $image_file->getClientOriginalExtension();
            $fileName = $dateTime.".".$extn;
            //store image file

            $file = $request->file('category_image');
            
            $file->move($file_path, $fileName);

            if($cat_id>0){
                $catRow = Category::where('id',$cat_id)->first();
                if($catRow->image!=""){
                    if(\File::exists($file_path.$catRow->image)){
                        \File::delete($file_path.$catRow->image);
                    }else{
                        //dd('File does not exists.');
                    }
                    
                }
            }
        }

        if($cat_id==0){
            $cat = new Category();
            $cat->name = $name;
            $cat->alias = $alias;
            $cat->description = $desc;
            $cat->image = $fileName;
            $cat->save();
        }
        if($cat_id>0){
            if($request->edit_image=='' && !$image_file){
                $catRow = Category::where('id',$cat_id)->first();
                if($catRow->image!=""){
                    if(\File::exists($file_path.$catRow->image)){
                        \File::delete($file_path.$catRow->image);
                    }else{
                    //dd('File does not exists.');
                    }
                    
                }
                $fileName= '';
            }
            if($request->edit_image!=''){
                $fileName= $request->edit_image;
            }
            Category::where('id', $cat_id)->update([
                'name' => $name,
                'alias' => $alias,
                'description' => $desc,
                'image' => $fileName
            ]);
            
        }
        
        
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $catId = $request->id;
        //return "music id = ".$musicId;

        //delete all the courses and course files
        $catRow = Category::where('id',$catId)->first();

        $file_path = public_path('/storage/uploads/images/categories/');
        $image = $catRow->image;
        if($image!=""){

            if(\File::exists($file_path.$image)){
                \File::delete($file_path.$image);
            }else{
            //dd('File does not exists.');
            }
            
        }
        Category::where('id',$catId)->delete();
    }
}
