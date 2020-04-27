<?php


namespace App\Http\Services;

use App\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    protected $request;
    public $is_save = 0;
    public $errors = [];
    public $last_exception = null;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function update()
    {

        DB::beginTransaction();

        $is_save = (
            $this->saveEmail()
            && $this->savePhone()
            && $this->saveLocation()
            && $this->saveSocial()
            && $this->saveSchedule()
        );

        if ($is_save) {
            DB::commit();
            $this->is_save = 1;
        } else {
            DB::rollBack();
            $this->is_save = 0;
        }
    }

    private function saveItem($item, $msg = '')
    {
        try
        {
            $is_save = $item->save();
            if (!$is_save)
                $this->errors[] = "Помилка при збережені $msg";
        }catch(QueryException $e){
            $is_save = 0;
            $this->errors[] = "Помилка при збережені $msg (exc)";
            $this->last_exception = $e;
        }

        return $is_save;
    }

    private function savePhone()
    {
        $is_save = 1;

        // видаляємо старі телефони
        Setting::where('type', Setting::TYPE_PHONE)->delete();

        $phones = $this->request->get('phones', []);

        foreach ($phones as $key => $phone) {
            $item = new Setting();
            $item->type = Setting::TYPE_PHONE;

            $data['number'] = array_get($phone, 'number');
            $data['messenger'] = [
                'viber' => array_get($phone, 'is_viber') ? 1 : 0,
                'telegram' => array_get($phone, 'is_telegram') ? 1 : 0,
            ];
            $data['telegram-nick'] = array_get($phone, 'telegram_name') ?: null;


            $item->data = $data;

            $is_save = $this->saveItem($item, 'номера телефону');

            if(!$is_save)
                break;
        }

        return $is_save;
    }

    private function saveEmail()
    {
        $item = Setting::where('type', Setting::TYPE_EMAIL)->first();
        if (empty($item)){
            $item = new Setting();
            $item->type = Setting::TYPE_EMAIL;
        }
        $item->data = [ $this->request->email ];

        $is_save = $this->saveItem($item, 'email');

        return $is_save;
    }

    private function saveLocation()
    {
        $locations = $this->request->get('location', []);

        $item = Setting::where('type', Setting::TYPE_LOCATION)->first();
        if (empty($item)) {
            $item       = new Setting();
            $item->type = Setting::TYPE_LOCATION;
        }
        foreach ($locations as $lang => $location) {

            $data[$lang] = $location;
        }

        $item->data = $data;

        return $this->saveItem($item, 'локації');
    }

    private function saveSchedule()
    {
        $item = Setting::where('type', Setting::TYPE_SCHEDULE)->first();

        if (empty($item)) {
            $item       = new Setting();
            $item->type = Setting::TYPE_SCHEDULE;
        }

        $schedule = $this->request->schedule;

        foreach ($schedule as $day => $dayData) {
            $data[$day]['from'] = array_get($dayData, 'from');
            $data[$day]['to'] = array_get($dayData, 'to');
            $data[$day]['holiday'] = array_get($dayData, 'holiday', false);
        }

        $item->data = $data;

        return $this->saveItem($item, 'графік роботи');
    }

    public function saveSocial()
    {
        $is_save = 1;

        // видаляємо старі соціалки
        Setting::where('type', Setting::TYPE_SOCIAL_LINK)->delete();

        $socials = $this->request->get('socials', []);

        foreach ($socials as $socialItem) {
            if(array_get($socialItem, 'link')) {
                $item = new Setting();
                $item->type = Setting::TYPE_SOCIAL_LINK;

                $item->data = [
                    'name' => array_get($socialItem, 'name'),
                    'link' => array_get($socialItem, 'link'),
                ];

                $is_save = $this->saveItem($item, 'соц. мережа ' . array_get($socialItem, 'name'));

                if (!$is_save) {
                    return $is_save;
                }
            }
        }

        return $is_save;
    }
}
