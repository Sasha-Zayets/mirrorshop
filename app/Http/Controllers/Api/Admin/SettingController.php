<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\SettingRequest;
use App\Setting;
use App\Http\Services\SettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Admin\PhonesCollection as PhonesCollection;
use App\Http\Resources\Admin\SocialsCollection as SocialsCollection;

class SettingController extends Controller
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
    public function store(SettingRequest $request)
    {
        $action = new SettingService($request);
        $action->update();

        if ($action->is_save) {
            Cache::forget('phones');
            Cache::forget('email');
            Cache::forget('socials');
            Cache::forget('location');
            Cache::forget('schedule');

            return response()->json('ok', 200);
        }

        return response()->json('ok', 200)->withErrors('Помилка створення! <br>'
            . implode(';<br> ', $action->errors));
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
