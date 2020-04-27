<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormSubmitRequest;
use App\Mail\FormSubmitMail;
use App\Setting;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function submit(FormSubmitRequest $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');

        $to = $this->getEmail();
        $when = now()->addSeconds(5);

        try {
            Mail::to($to)->later($when, new FormSubmitMail($name, $phone));
        } catch (\Exception $e) {
            report($e);

            return response()->json('false', 500);
        }


        return response()->json('ok', 200);
    }

    public function getEmail()
    {
        $to = Setting::DEFAULT_EMAIL;

        $settings = Setting::where('type', Setting::TYPE_EMAIL)->first();
        if (!empty($settings)) {
            $to = $settings->email;
        }

        return $to;
    }
}
