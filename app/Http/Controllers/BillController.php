<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillModel as Bill;
use App\Models\BillProductModel as BillProduct;
use App\Models\ProductModel as Product;
use App\Models\User;
use App\Http\Requests\BillRequest;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{    
	protected $created = 'Factura creada exitosamente';
	protected $updated = 'Factura modificada exitosamente';
	protected $deleted = 'Factura eliminada exitosamente';
	protected $not_found = 'La factura solicitada no existe';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$bills = Bill::with(['user','client','billProduct']);
    	$filters = ['description','price','id_category'];
    	return $this->response($bills,$filters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
    	$user = User::where('id',$request->id_user)->first();
        $client = User::where('id',$request->id_client)->first();
    	$null_products = [];
    	foreach ($request->products as $key => $value) {
    		$product = Product::where('id',$value['id'])->first();
    		if($product === NULL)
    		{
    			array_push($null_products, $value['id']);
    		}
    	}

    	if($user != NULL && $client !=NULL)
    	{
    		if(!count($null_products)>0)
    		{
    			$bill = new Bill([
                    'date'     => $request->date,
                    'total'    => $request->total,
                    'id_user' => $request->id_user,
                    'id_client' => $request->id_client
                ]);

             $bill->save();

             foreach ($request->products as $key => $value) {

                $bill_product = new BillProduct([
                   'id_bill'             => $bill->id,
                   'product_description' => $value['description'],
                   'product_category'    => $value['category'],
                   'product_price'       => $value['price'],
                   'quantity'            => $value['quantity'],
                   'total'               => $value['total']
               ]);
                $bill_product->save();
            }

            return response()->json([
                'message' => $this->created
            ],201);

        }else{
         return response()->json([
            'message' => 'Los productos con id '.implode(',',$null_products).' no existen'
        ],404);
     }

 }else{
  return response()->json([
     'message' => 'El usuario o cliente solicitado no existe'
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
    	$bill = Bill::with(['user','billProduct'])
    	->where('id',$id)
    	->first();
    	return $this->checkIfExist(
    		$bill,
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
        $bill = Bill::where('id',$id)->first();

        if($bill === NULL)
        {
            return response()->json([
                'message' => $this->not_found
            ],404);

        }else{

            $delete_products = BillProduct::where('id_bill',$id);
            $delete_products->delete();

            $user = User::where('id',$request->id_user)->first();
            $client = User::where('id',$request->id_client)->first();
            $null_products = [];
            foreach ($request->products as $key => $value) {
                var_dump($value['id']);
                $product = Product::where('id',$value['id'])->first();
                if($product === NULL)
                {
                 array_push($null_products, $value['id']);
             }
         }

        if($user != NULL && $client != NULL)
        {
            if(!count($null_products)>0)
            {
                 $bill = Bill::where('id',$id)
                 ->update([
                    'date'     => $request->date,
                    'total'    => $request->total,
                    'id_user' => $request->id_user,
                    'id_client' => $request->id_client
                ]);


                 foreach ($request->products as $key => $value) {
                   $bill_product = new BillProduct([
                       'id_bill'             => $id,
                       'product_description' => $value['description'],
                       'product_category'    => $value['category'],
                       'product_price'       => $value['price'],
                       'quantity'            => $value['quantity'],
                       'total'               => $value['total']
                   ]);
                   $bill_product->save();
               }

               return response()->json([
                'message' => $this->updated
                ],201);

            }else{
                return response()->json([
                    'message' => 'Los productos con id '.implode(',',$null_products).' no existen'
                ],404);
            }

        }else{
          return response()->json([
             'message' => 'El usuario o cliente solicitado no existe'
         ],404);
        }

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
    	$bill = Bill::find($id);

    	return $this->checkIfExistOrDelete(
    		$bill,
    		$this->not_found,
    		$this->deleted
    	);
    }
}

