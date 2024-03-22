<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FacilityController extends Controller
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

        $groups = DB::table('groups')->select('id','group_ja')->where('hid',$hid)->get();
        $times = DB::table('times')->select('id','frame_name')->where('hid',$hid)->get();
        $facilities = DB::table('facilities')->where('hid',$hid)->orderBy('facility_sort','desc')->get();

        // dd($facilities);
        return view('facility.index',compact('groups','times','facilities'));
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
        // dd($request);
        $img = null;
        if($request->facility_images){
        //画像ファイル名を重複を避けるためタイムスタンプ＋ファイル名で作成
        $carbon = new Carbon();
        $filedate = $carbon->timestamp;
        $fileName = $request->facility_images->getClientOriginalName();
        $imgStore = $request->facility_images->storeAs('public/facilityImages',$filedate.$fileName);
        $img = $filedate.$fileName;
        }

        //グループ名取得
        $GId = $request->group_id;
        $Gname = DB::table('groups')->select('group_ja')->where('id',$GId)->first();

        //予約枠取得
        $FId = $request->category_id;
        $Fname = DB::table('times')->select('frame_name')->where('id',$FId)->first();
        $frameName = $Fname->frame_name;


        $hid = Auth::user()->hid;


        DB::table('facilities')->insert([
            'hid' => $hid,
            'facility_id' => 1,
            'group_id' => $Gname->group_ja,
            'facility_name_jp' => $request->facility_name_jp,
            'facility_name_en' => $request->facility_name_en,
            'facility_sort' => $request->facility_sort,
            'facility_visible' => $request->facility_visible,
            'facility_images' => $img,
            'facility_introduction' => $request->facility_introduction,
            'facility_open_hours' => $request->facility_open_hours,
            'facility_close_hours' => $request->facility_close_hours,
            'facility_place_jp' => $request->facility_place_jp,
            'facility_place_en' => $request->facility_place_en,
            'frame_id' => $frameName,
        ]);

        return redirect()->route('facility');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //ログインユーザーの取得
        $hid = Auth::user()->hid;

        //編集する施設IDを取得
        $facility = DB::table('facilities')->where('id',$id)->first();

        //グループ選択のためのグループIDを取得
        $groups = DB::table('groups')->select('id','group_ja')->where('hid',$hid)->get();

        //フレーム選択のためのフレーム名の取得
        $times = DB::table('times')->select('id','frame_name')->where('hid',$hid)->get();


        $facilitySelected = $facility->id;
        $timeSelected = $facility->frame_id;

        $img = 'storage/facilityImages/' . $facility->facility_images;
        // dd($img);
        // dd($facility->facility_images);

        return view('facility.edit',compact('facility','groups','times','facilitySelected','timeSelected','img'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //画像ファイル名を重複を避けるためタイムスタンプ＋ファイル名で作成
        $img = null;

        if(! $request->facility_images== null){
            $carbon = new Carbon();
            $filedate = $carbon->timestamp;
            $fileName = $request->facility_images->getClientOriginalName();
            $imgStore = $request->facility_images->storeAs('public/facilityImages',$filedate.$fileName);
            $img = $filedate.$fileName;    
        }else{
            $image = DB::table('facilities')->select('facility_images')->where('id',$request->facility_id)->first();
            $img = $image->facility_images;
        }


        //グループ名取得
        $GId = $request->group_id;
        $Gname = DB::table('groups')->select('group_ja')->where('id',$GId)->first();

        //予約枠取得
        $FId = $request->category_id;
        $Fname = DB::table('times')->select('frame_name')->where('id',$FId)->first();
        $frameName = $Fname->frame_name;


        $hid = Auth::user()->hid;

        DB::table('facilities')
        ->where('id',$request->facility_id)
        ->update([
            'hid' => $hid,
            'facility_id' => 1,
            'group_id' => $Gname->group_ja,
            'facility_name_jp' => $request->facility_name_jp,
            'facility_name_en' => $request->facility_name_en,
            'facility_sort' => $request->facility_sort,
            'facility_visible' => $request->facility_visible,
            'facility_images' => $img,
            'facility_introduction' => $request->facility_introduction,
            'facility_open_hours' => $request->facility_open_hours,
            'facility_close_hours' => $request->facility_close_hours,
            'facility_place_jp' => $request->facility_place_jp,
            'facility_place_en' => $request->facility_place_en,
            'frame_id' => $frameName,
        ]);

        return redirect()->route('facility');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = DB::table('facilities')->where('id',$id)->delete();

        return redirect()->back();
    }
}
