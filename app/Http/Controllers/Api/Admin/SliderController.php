<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\SliderRequest;
use App\Http\Services\SliderService;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SlidersCollection as SlidersCollection;
use Illuminate\Support\Facades\Cache;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::with('images')->has('images')->orderBy('sort')->get();

        $data = [
            'sliders' => new SlidersCollection($sliders),
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
    public function store(SliderRequest $request)
    {
        $slider = new Slider();
        $slider->sort = 100;

        $action = new SliderService($slider);

        if ($action->update()) {
            return response()->json('ok', 200);
        }

        return response()->json([
            'message' => $action->getErrorMessage()
        ], 500);
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
    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $action = new SliderService($slider);

        if ($action->update()) {
            return response()->json('ok', 200);
        }

        return response()->json([
            'message' => $action->getErrorMessage()
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        $action = new SliderService($slider);

        if ($action->destroy()) {
            return response()->json('ok', 200);
        }

        return response()->json([
            'message' => $action->getErrorMessage()
        ], 500);
    }


    /**
     * Sort resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        $status = false;
        if (!empty($request->sliders)) {
            foreach ($request->sliders as $key => $sliderArray) {
                if($slider = Slider::find(array_get($sliderArray, 'id'))) {
                    $slider->sort = $key;
                    $slider->save();
                }
            }
            $status = true;

            \Cache::forget('sliders');
        }

        return response()->json(['status' => $status]);
    }
}
