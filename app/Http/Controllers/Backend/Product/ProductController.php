<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\Brand;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $products=Product::paginate(15);
     return view('backend.product.index')->with('products',$products);

 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $categories=Category::all();
     $brands=Brand::all();
     return view('backend.product.create')->with('categories',$categories)->with('brands',$brands);
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name_en' =>'required|max:255|unique:products,name_en',
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:products,slug',

            ]);

        $product = new Product;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->name_en=$request->name_en;
        $product->name_ar=$request->name_ar;
        $product->slug=$request->slug;
        $product->desc_en=$request->desc_en;
        $product->desc_ar=$request->desc_ar;
        $product->specs_en=$request->specs_en;
        $product->specs_ar=$request->specs_ar;
        $product->featured=(isset($request->featured)) ? 1 : 0;
        $product->sort_order=$request->sort_order;

        $product->meta_title_en=$request->meta_title_en;
        $product->meta_title_ar=$request->meta_title_ar;
        $product->meta_description_en=$request->meta_description_en;
        $product->meta_description_ar=$request->meta_description_ar;


        $product->save();
        return redirect(route('products.show',$product->id))->with('success','Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $product=Product::find($id);
     return view('backend.product.show')->with('product',$product);
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $categories=Category::all();
     $brands=Brand::all();
     $product=Product::find($id);
     return view('backend.product.edit')->with('product',$product)->with('categories',$categories)->with('brands',$brands);
 }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' =>'required|max:255|unique:products,name_en,'.$id,
            'name_ar' =>'required|max:255|unique:products,name_ar,'.$id,
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:products,slug,'.$id,

            ]);

        $product = Product::find($id);
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->name_en=$request->name_en;
        $product->name_ar=$request->name_ar;
        $product->slug=$request->slug;
        $product->desc_en=$request->desc_en;
        $product->desc_ar=$request->desc_ar;
        $product->specs_en=$request->specs_en;
        $product->specs_ar=$request->specs_ar;
        $product->featured=(isset($request->featured)) ? 1 : 0;
        $product->sort_order=$request->sort_order;

        $product->meta_title_en=$request->meta_title_en;
        $product->meta_title_ar=$request->meta_title_ar;
        $product->meta_description_en=$request->meta_description_en;
        $product->meta_description_ar=$request->meta_description_ar;
        
        $product->save();
        return redirect(route('products.edit',$id))->with('success','Record saved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function discontinue($id)
    {
        $product = Product::find($id);

        $product->discontinued = !$product->discontinued;;
        $product->save();
        return redirect(route('products.show',$id))->with('success','Record saved successfully!');
    }

    public function featured($id)
    {
        $product = Product::find($id);

        $product->featured = !$product->featured;;
        $product->save();
        return redirect(route('products.show',$id))->with('success','Record saved successfully!');
        
    }

    public function productSearch(Request $request){
       
        $term = $request->term;
        $results = array();
        $products = Product::where('name_en','like','%'.$term.'%')->orWhere('name_ar','like','%'.$term.'%')->get();

       foreach ($products as $product)
        {
            $results[] = [ 'id' => $product->id, 'value' => $product->name_en];
        }
        return response()->json($results);
    }
}
