<?php

namespace App\Libraries;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class TelegramErrorReport
{
    public $chatId;
    private $errorObj;
    private $fileName;
    private $caption;
    private $errorsToIgnore;
    private $defaultCacheName;

    public function __construct(Exception $errorObj, $chatId = null)
    {
        $this->errorObj = $errorObj;
        $this->chatId = $chatId ?: config('telegram.chat_to_report', null);
        $this->fileName = config('app.name').'-'.date('d-m').'.txt';
        $this->caption = $this->generateCaption();
        $this->errorsToIgnore = $this->exeptionsToIgnore();
        $this->defaultCacheName = 'error-log'.'-'.date('d-m');
        $this->handle();
    }


    public function handle()
    {
        $errorTrace = $this->errorObj->getTraceAsString();

        if(!$this->shouldReport()) {
            return;
        }

        Storage::disk('public')->put($this->fileName, $errorTrace);

        try {
            app('telegram')->sendDocument([
                'chat_id' => $this->chatId,
                'caption' => $this->caption,
                'document' => Storage::disk('public')->readStream($this->fileName),
            ]);
        } catch (Exception $e) {

        }

        Storage::disk('public')->delete($this->fileName);
    }


    private function generateCaption()
    {
        $error = $this->errorObj;

        $caption = '#'.preg_replace('/[-.,]/', '_', config('app.name'))
            .' #error An error '. get_class($error)
            . ' occurred '. $error->getMessage()
            .' @ '.$error->getFile(). ' on line: '. $error->getLine()
            .'. Code: '.$error->getCode();

        return $caption;
    }

    /*
     * список перевірок, при яких не буде відбуватись сповіщення
     */


    private function shouldReport()
    {
        if ($this->shouldntReport() || !$this->reportStatus() || !$this->isErrorUniqueForToday()) {
            return false;
        }


        return true;
    }


    private function shouldntReport()
    {
        return ! is_null(Arr::first($this->errorsToIgnore, function ($type) {
            return $this->errorObj instanceof $type;
        }));
    }

    private function reportStatus()
    {
        return config('telegram.telegram_report');
    }


    /*
     * Масив помилок, про які телеграм не буде сповіщати
     * приклад \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */

    private function exeptionsToIgnore()
    {
        $arr = [

        ];

        return $arr;
    }


    /*
     * перевіряє, чи помилка унікальна для сьогодні.
     * Якщо ні - повертає false. Якщо так - записуємо хеш помилку в кеш і повертаємо true
     */
    private function isErrorUniqueForToday()
    {
        $hash = hash('ripemd160', $this->errorObj->getTraceAsString());

        $errorsHashArr =  Cache::get($this->defaultCacheName, []);

        if (in_array($hash, $errorsHashArr)) {
            return false;
        }

        $errorsHashArr[] = $hash;
        Cache::put($this->defaultCacheName, $errorsHashArr, now()->addHours(24));

        return true;
    }
}
