<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return products::orderBy('id','desc')->get();
        //
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
        $products = new products;
        $send = $request->all();
        if($request->hasFile('file')){
            $filename = $request->file->getClientOriginalName();
            $path = $request->file->store('storage/uploads','public');
            $send['img'] = $path;
        }
        
          
        //var_dump($request->all());

        $products->create($send);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        return $products;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $products = new products;
        $send = $request->all();
        if($request->hasFile('file')){
            $filename = $request->file->getClientOriginalName();
            $path = $request->file->store('storage/uploads','public');
            $send['img'] = $path;
        }
        

        
        $p = $products::find($id);
        $p->update($send);
         
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($products)
    {
         
        //$products->delete();
        
        $p = products::find($products);
        $p->delete();
    }
}
