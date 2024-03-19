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
        $facilities = DB::table('facilities')->where('hid',$hid)->get();

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
        //画像ファイル名の作成
        $carbon = new Carbon();
        $filedate = $carbon->timestamp;
        $fileName = $request->facility_images->getClientOriginalName();
        $img = $request->facility_images->storeAs('facilityImages',$filedate.$fileName);

        //グループ名取得
        $GId = $request->group_id;
        $Gname = DB::table('groups')->select('group_ja')->where('id',$GId)->first();
        // dd($Gname->group_ja);

        //予約枠取得
        $FId = $request->category_id;
        // dd(gettype($FId));
        $Fname = DB::table('times')->select('frame_name')->where('id',$FId)->first();
        $frameName = $Fname->frame_name;

        // dd(gettype($frameName));

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
            'facility_busines_hours' => $request->facility_busines_hours1,
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
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        //
    }
}
