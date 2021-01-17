<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel as Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories = DB::table('categories');
       $filters = ['name','surname'];
       return $this->response($categories,$filters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category([
            'name'     => $request->name
        ]);

        $category->save();

        return response()->json([
            'message' => 'Categoria creada exitosamente'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('id',$id)->first();
        return $this->checkIfExist(
            $category,
            'La categoría solicitada no existe'
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
        $category = Category::where('id',$id)
        ->update([
            'name' => $request->name
        ]);

        return $this->checkIfExistOrUpdate(
            $category,
            'La categoría solicitada no existe',
            'Categoría modificada exitosamente'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

         return $this->checkIfExistOrDelete(
            $category,
            'La categoría solicitada no existe',
            'Categoría eliminada exitosamente'
        );
    }
}
