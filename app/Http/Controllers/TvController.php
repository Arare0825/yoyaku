<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        // ->select('id','facility_name_jp','facility_name_en')
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


        //初期表示画像のパスを変数に格納
        $topImg = 'storage/facilityImages/' . $topFacility->facility_images;


        // dd( $topFacility);
        return view('tv.facility',compact('facilities','topFacility','topImg','Gid','hid'));
    }


    public function reservation($id)
    {

        //施設に紐づいている予約枠を取得
        $frameName = DB::table('facilities')->select('frame_id')->where('id',$id)->first();
        $frame = $frameName->frame_id;

        $time = DB::table('times')->where('frame_name',$frame)->first();

        //予約可能時間1のスタート時間と予約終了時間(1~3のNULLではない時間)を取得
        $startTime = $time->frame_activefrom_1;
        $endtime = null;
        $activeTime = $time->frame_timeunit;

        if(! is_null($time->frame_activeto_3)){
            $endTime = $time->frame_activeto_3;
        }elseif(! is_null($time->frame_activeto_2)){
            $endTime = $time->frame_activeto_2;
        }else{
            $endTime = $time->frame_activeto_1;
        }

        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);
        $activeTime = $activeTime * 60;
        $reservationTime = $startTime + $activeTime;

        // dd($startTime,$endTime,$activeTime,$reservationTime);
        return view('tv.reservation',compact('startTime','endTime','activeTime','reservationTime'));

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
