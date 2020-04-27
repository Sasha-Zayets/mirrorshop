<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhonesCollection as PhonesCollection;
use App\Http\Resources\SocialsCollection as SocialsCollection;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Setting::get();

        $phones = $items->where('type', Setting::TYPE_PHONE)->sortBy('id')->values();
        $socials = $items->where('type', Setting::TYPE_SOCIAL_LINK)->sortBy('type')->values();

        $data = [
            'phones' => new PhonesCollection($phones),
            'email' => $item = $items->where('type', Setting::TYPE_EMAIL)->first(),
            'location' => $items->where('type', Setting::TYPE_LOCATION)->first(),
            'socials' => new SocialsCollection($socials),
            'schedule' => $items->where('type', Setting::TYPE_SCHEDULE)->first(),
        ];


        return response()->json($data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
