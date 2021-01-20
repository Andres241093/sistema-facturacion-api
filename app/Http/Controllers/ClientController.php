<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientModel as Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{    
	protected $created = 'Cliente creado exitosamente';
    protected $updated = 'Cliente modificado exitosamente';
    protected $deleted = 'Cliente eliminado exitosamente';
    protected $not_found = 'El cliente solicitado no existe';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $clients = DB::table('clients');
       $filters = ['name','dni'];
       return $this->response($clients,$filters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = new Client([
            'name'     => $request->name,
            'dni'     => $request->dni,
            'address'     => $request->address,
            'phone'     => $request->phone
        ]);
        $client->save();

        return response()->json([
            'message' => $this->created
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
        $client = Client::where('id',$id)->first();
        return $this->checkIfExist(
            $client,
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
        $client = Client::where('id',$id)
        ->update([
            'name'     => $request->name,
            'dni'     => $request->dni,
            'address'     => $request->address,
            'phone'     => $request->phone
        ]);

        return $this->checkIfExistOrUpdate(
            $client,
            $this->not_found,
            $this->updated
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
        $client = Client::where('id',$id)->first();

         return $this->checkIfExistOrDelete(
            $client,
            $this->not_found,
            $this->deleted
        );
    }
}
