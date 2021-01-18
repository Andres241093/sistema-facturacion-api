<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
//Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationMail;
//To generate activation_token
use Illuminate\Support\Str;

class EmployeeController extends Controller
{    
	protected $created = 'Empleado creado exitosamente';
    protected $updated = 'Empleado modificado exitosamente';
    protected $deleted = 'Empleado eliminado exitosamente';
    protected $not_found = 'El empleado solicitado no existe';
    protected $visible_attributes = ['id','name','email','type','active','activation_token','email_verified_at','created_at','updated_at'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = DB::table('users')
       ->select($this->visible_attributes)
       ->where('type', '=', 2);
       $filters = ['name','email','active'];
       return $this->response($users,$filters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'type'     => 2,
            'activation_token'  => Str::random(60)
        ]);
        $user->save();
        Mail::to($request->email)->send(new ConfirmationMail($user));

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
        $user = User::where('id',$id)->where('type', 2)->first();

        return $this->checkIfExist(
            $user,
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
        $user = User::where('id',$id)
        ->where('type', 2)
        ->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->checkIfExistOrUpdate(
            $user,
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
        $user = User::where('id',$id)
        ->where('type', 2)->first();

         return $this->checkIfExistOrDelete(
            $user,
            $this->not_found,
            $this->deleted
        );
    }
}
