<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Render rest of the page
        return view('user.users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('user.show',[
            'user' => $id
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $data = [];
        $users = User::latest()->get();
        foreach($users as $user) {
            $data[] = [
                'id' => $user->id,
                'nom' => $user->nom,
                'email' => $user->email,
                'role' => $user->role,
                'statut' => $user->statut,
            ];
        }
        return $data;
    }
}
