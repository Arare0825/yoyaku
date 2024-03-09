<?php

namespace App\Http\Controllers;

use App\Models\MUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class MUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
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
        // dd($request->password);

        $user_info = $request->validate([
            'hid' => ['required'],
            'user_id' => ['required'],
            // 'password' => ['required'],
        ]);
        // ログインに成功したとき
        if (Auth::attempt([
            'hid' => $request->hid,
            'user_id' => $request->user_id,
            'password' => $request->user_pass,

            // dd($request->user_pass)
            
        ]))
         {
            // return redirect()->route('/');

            $request->session()->regenerate();
            return redirect()->route('group');
        };

        // if([]){
            return redirect()->back();

        }

        // 上記のif文でログインに成功した人以外(=ログインに失敗した人)がここに来る



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MUser  $mUser
     * @return \Illuminate\Http\Response
     */
    // public function show(MUser $mUser)
    public function show()

    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MUser  $mUser
     * @return \Illuminate\Http\Response
     */
    public function edit(MUser $mUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MUser  $mUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MUser $mUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MUser  $mUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(MUser $mUser)
    {
        //
    }
}
