<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $groups = DB::table('groups')
                        ->select('id','group_ja','group_en','sort','visible')
                        ->orderBy('sort','desc')
                        ->get();
// dd($groups);

        return view('group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'group_ja' => 'required',
            'group_en' => 'required',
            'sort' => 'required',
        ]);

        
        $hid = Auth::user()->hid;
        $group_ja = $request->group_ja;
        $group_en = $request->group_en;
        $sort= $request->sort;
        $visible= $request->visible;
        // dd($visible);


        DB::table('groups')->insert([
            'hid'=> $hid,
            'group_ja' => $group_ja,
            'group_en' => $group_en,
            'sort' => $sort,
            'visible' => $visible,
        ]);


        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);

        // $groups = DB::table('groups')
        //                 ->select('id','group_ja','group_en','sort','visible')
        //                 ->orderBy('sort','desc')
        //                 ->get();

        $group = DB::table('groups')->where('id',$id)->first();

        // dd($group->group_ja);

        return view('group.edit',compact('group'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = DB::table('groups')->where('id',$id)->first();

        // dd($group->id);
        return view('group.edit',compact('group'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($id,$request);
        $id = $request->id;
        $group_ja = $request->group_ja;
        $group_en = $request->group_en;
        $sort = $request->sort;
        $visible = $request->visible;

        $group = DB::table('groups')
        ->where('id',$id)
        ->update([
            'group_ja' => $group_ja,
            'group_en' => $group_en,
            'sort' => $sort,
            'visible' => $visible,
        ]);

        return redirect()->route('group');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $deleted = DB::table('groups')->where('id',$id)->delete();

        return redirect()->back();
    }
}
