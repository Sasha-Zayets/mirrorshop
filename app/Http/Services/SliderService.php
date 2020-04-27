<?php

namespace App\Http\Services;

use App\Exceptions\ServiceErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use finfo;

class SliderService
{
    protected $item;
    protected $exception;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function update()
    {
        DB::beginTransaction();

        try
        {
            $this->setModelData();
            $this->setImages();

        } catch(\Exception $exception) {

            DB::rollBack();

            $this->exception = $exception;
            report($exception);

            return false;
        }

        DB::commit();

        return true;
    }

    public function destroy()
    {
        DB::beginTransaction();

        try
        {
            $this->item->delete();

        } catch (\Exception $exception) {

            DB::rollBack();

            $this->exception = $exception;
            report($exception);

            return false;
        }

        DB::commit();

        return true;
    }

    public function getErrorMessage()
    {
        if ($this->exception instanceof ServiceErrorException) {
            return $this->exception->getMessage();
        }
        if ($this->exception instanceof QueryException) {
            return 'Помилка бази даних';
        }
        if ($this->exception instanceof \Exception) {
            return 'Серверна помилка';
        }

        return null;
    }

    /**
     * @throws \Exception
     */
    private function setModelData()
    {
        $fields = request()->only($this->item->getFillable());
        $this->item->fill($fields);
        if (!$this->item->save()) {
            throw new ServiceErrorException('Помилка збереження');
        }
    }

    /**
     * @throws \Exception
     */
    private function setImages()
    {
        $newImages = request()->new;


        $images_model = $this->item->images()->getRelated();
        $images_foreign_key = $this->item->images()->getForeignKeyName();

        $modelInput = [];

        foreach ($newImages as $type => $imageName) {
            $tempFilePath = config('image.temp')  . '/' . $imageName;

            if(Storage::disk('img')->exists($tempFilePath) && array_key_exists($type, $images_model::FIELD_NAMES)) {
                $fieldName = array_get($images_model::FIELD_NAMES, $type);

                $uploadedFile = $this->getUploadedFileObject(Storage::disk('img')->path($tempFilePath));

                $storedFileName = create_img_with_webp(
                    $uploadedFile,
                    $uploadedFile->getClientOriginalName(),
                    class_basename($images_model),
                    1920,
                    75
                );

                if ($storedFileName === false) {
                    throw new ServiceErrorException('Помилка при збережені файла зображення');
                }

                $modelInput[$fieldName] = $storedFileName;

            } else {
                throw new ServiceErrorException('Тимчасового зображення не знайдено, або поле ');
            }
        }


        $item_image = $images_model::updateOrCreate(
            [
                $images_foreign_key => $this->item->id
            ],
            $modelInput
        );

        if (!$item_image) {
            throw new ServiceErrorException('Помилка збереження зображення');
        }
    }

    /*
     *  Метод створює об'єкт UploadedFile
     *  для подальшої його обробки засобами Imagecache
     */

    private function getUploadedFileObject($path)
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        $uploadedFile =  new UploadedFile(
            $path,
            pathinfo($path, PATHINFO_FILENAME),
            $finfo->file($path),
            filesize($path),
            0,
            false
        );

        return $uploadedFile;
    }
}
