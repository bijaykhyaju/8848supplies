<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $pageCount = Pages::where('alias',$str)->count();
        if($pageCount>0){
            $str = $str."-".($pageCount+1);
        }
        return $str;
    }

    public function aboutPage()
    {
        $page =  Pages::where('id',1)->first();
        return view('about-us',compact('page'));
    }

    public function aboutUpdate(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'page_description' => 'required'
        ]);
        $page_id = $request->page_id;
        $name = $request->page_name;
        $alias = $this->makeAlias($name);
        $desc = $request->page_description;

        
        //$pageCount= Pages::where('name', $name);
        if($page_id){
            //dd("update");
            Pages::where('id', $page_id)->update([
                'name' => $name,
                'alias' => $alias,
                'description'=> $desc
            ]);
            
        }else{
            $page = new Pages;
            $page->name = $name;
            $page->alias = $alias;
            $page->description = $desc;
            $page->save();
        }
        $page =  Pages::where('id',1)->first();
        return view('about-us',compact('page'))->withSuccess('Updated successfully.');
        //return view('about-us')->withSuccess('Everything went great');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pages $pages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pages $pages)
    {
        //
    }
}
