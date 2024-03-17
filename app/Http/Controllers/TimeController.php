<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hid = Auth::user()->hid;
        // dd($hid);

        $times = DB::table('times')->where('hid',$hid)->get();
        // dd($times);


        return view('time.index',compact('times'));
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

        //ログインユーザーの取得
        $hid = Auth::user()->hid;
        // dd($hid);
        DB::table('times')->insert([
            'hid' => $hid,
            'frame_name' => $request->framename,
            'frame_activefrom_1' => $request->from1,
            'frame_activeto_1' => $request->to1,
            'frame_activefrom_2' => $request->from2,
            'frame_activeto_2' => $request->to2,
            'frame_activefrom_3' => $request->from3,
            'frame_activeto_3' => $request->to3,
            'frame_limit' => $request->framelimit,
            'frame_max_per_set' => $request->maxlimit,
            'frame_deadtime' => $request->deadtime,
            'frame_cancellimit' => $request->cancellimit,
            'frame_timeunit' => $request->timeunit
        ]);

        return redirect()->route('time');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show(Time $time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $time = DB::table('times')->where('id',$id)->first();

        // dd($time->hid);

        return view('time.edit',compact('time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        DB::table('times')->where('id',$id)->update([
            'frame_name' => $request->framename,
            'frame_activefrom_1' => $request->from1,
            'frame_activeto_1' => $request->to1,
            'frame_activefrom_2' => $request->from2,
            'frame_activeto_2' => $request->to2,
            'frame_activefrom_3' => $request->from3,
            'frame_activeto_3' => $request->to3,
            'frame_limit' => $request->framelimit,
            'frame_max_per_set' => $request->maxlimit,
            'frame_deadtime' => $request->deadtime,
            'frame_cancellimit' => $request->cancellimit,
            'frame_timeunit' => $request->timeunit
        ]);

        return redirect()->route('time');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $id = DB::table('times')->where('id',$id)->delete();

        return redirect()->back();
    }
}
