<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel as Product;
use App\Models\CategoryModel as Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{    
	protected $created = 'Producto creado exitosamente';
	protected $updated = 'Producto modificado exitosamente';
	protected $deleted = 'Producto eliminado exitosamente';
	protected $not_found = 'El producto solicitado no existe';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::with(['category']);
    	$filters = ['description','price','id_category'];
    	return $this->response($products,$filters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
    	$category = Category::where('id',$request->id_category)->first();

    	if($category != NULL)
    	{

    		$product = new Product([
    			'description'     => $request->description,
    			'price'    => $request->price,
    			'id_category' => $request->id_category
    		]);

    		$product->save();

    		return response()->json([
    			'message' => $this->created
    		],201);

    	}else{
    		return response()->json([
    			'message' => 'La categoria solicitada no existe'
    		],404);
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$product = Product::with(['category'])
    	->where('id',$id)
    	->first();
    	return $this->checkIfExist(
    		$product,
    		$this->not_found
    	);
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
    	$category = Category::where('id',$request->id_category)->first();

    	if($category != NULL)
    	{
    		$product = Product::where('id',$id)
    		->update([
    			'description'     => $request->description,
    			'price'    => $request->price,
    			'id_category' => $request->id_category
    		]);

    		return $this->checkIfExistOrUpdate(
    			$product,
    			$this->not_found,
    			$this->updated
    		);

    	}else{
    		return response()->json([
    			'message' => 'La categoria solicitada no existe'
    		],404);
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$product = Product::find($id);

    	return $this->checkIfExistOrDelete(
    		$product,
    		$this->not_found,
    		$this->deleted
    	);
    }
}
