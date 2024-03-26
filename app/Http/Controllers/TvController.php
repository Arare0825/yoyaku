<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hid)
    {

        //表示するグループを取得
        $groups = DB::table('groups')
        ->where('hid',$hid)->where('visible',1)
        ->get();
        // dd($groups);
        return view('tv.index',compact('groups','hid'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function facility($hid,$Gid)
    {
        //グループテーブルからグループ名の取得
        $groupName = DB::table('groups')
        ->select('group_ja')
        ->where('id',$Gid)
        ->first();
        
        //項目選択のためのfacilitiesテーブルからhidとグループ名が一致するgroupIDを取得
        $facilities = DB::table('facilities')
        ->select('id','facility_name_jp','facility_name_en')
        ->where('hid',$hid)
        ->where('facility_visible',1)
        ->where('group_id',$groupName->group_ja)
        ->orderBy('facility_sort','desc')
        ->get();

        //初期表示用データの取得
        $topFacility = DB::table('facilities')
        ->where('hid',$hid)
        ->where('facility_visible',1)
        ->where('group_id',$groupName->group_ja)
        ->orderBy('facility_sort','desc')
        ->first();


        $img = 'storage/facilityImages/' . $topFacility->facility_images;

        // dd( $topFacility);
        return view('tv.facility',compact('facilities','topFacility','img','Gid','hid'));
    }


    public function show($Hid,$Gid,$Fid)
    {
        dd($Hid,$Gid,$Fid);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function edit(Tv $tv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tv $tv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tv $tv)
    {
        //
    }
}
