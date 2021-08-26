<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . session('token')['accessToken']])->get('http://bt_training.example.com/api/user');
       //dd($response['user']['data'][0]);
        return view('admin.user.listUser', ['users' => $response['user']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . session('token')['accessToken']])->get('http://bt_training.example.com/api/user/create');
        if($response['status']){
            return view('admin.user.addUser');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . session('token')['accessToken']])->post('http://bt_training.example.com/api/user', [
            'name' => $request->name,
            'email' => $request->email,
            'password'=>$request->password,
        ]);
        if($response['status']){
            return redirect()->route('users.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . session('token')['accessToken']])->get('http://bt_training.example.com/api/user/'.$id.'/edit');
        if($response['status']){
             return view('admin.user.editUser',['user'=>$response['user']]);
        }
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
        $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . session('token')['accessToken']])->put('http://bt_training.example.com/api/user/'.$id, [
            'name' => $request->name,
            'email' => $request->email,
            'password'=>$request->password,
        ]);
        if($response['status']){
            return redirect()->route('users.index');
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
        $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . session('token')['accessToken']])->delete('http://bt_training.example.com/api/user/'.$id);
        if($response['status']){
            return redirect()->route('users.index');
        }
    }
}