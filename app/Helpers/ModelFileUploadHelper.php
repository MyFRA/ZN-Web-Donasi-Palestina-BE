<?php

namespace App\Helpers;

use App\Helpers\StringHelper as HelpersStringHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Factory;

class ModelFileUploadHelper
{

    /**
     * Handle model file update
     * 
     * @param Illuminate\Database\Eloquent\Model $model
     * @param Illuminate\Http\UploadedFile $file
     * @param string $visibility (app, public) default public
     * 
     * @return string|null
     * 
     */
    public static function modelFileUpdate($model, string $name, ?UploadedFile $uploadedFile, string $visibility = 'public'): string|null
    {
        /**
         * When not uploaded file
         * 
         */
        if (!$uploadedFile) {
            return $model->$name;
        }

        /**
         * $base directory
         * 
         */
        $baseDirectory = $visibility . '/' . str_replace('_', '-', $model->getTable()) . '/' . str_replace('_', '-', $name);

        /**
         * Checking if file exists in database then delete it
         * 
         */
        if (Storage::exists($baseDirectory . '/' .  $model->$name)) {
            Storage::delete($baseDirectory . '/' . $model->$name);
        }

        /**
         * Generate file name for uploaded file
         * 
         */
        $faker = Factory::create('id_ID');
        $filename = str_replace('_', '-', $name) . '-' . join('', $faker->randomElements(HelpersStringHelper::getArrAllAlphabet(), 4)) . '-' . $faker->randomNumber(6) . '.' . $uploadedFile->extension();

        /**
         * Save the uploaded file to disk
         * 
         */
        Storage::putFileAs($baseDirectory, $uploadedFile, $filename);

        return $filename;
    }

    /**
     * Handle model file store
     * 
     * @param string prefix
     * @param string name 
     * @param Illuminate\Http\UploadedFile $file
     * @param string $visibility (app, public) default public
     * 
     * @return string|null
     * 
     */
    public static function modelFileStore(string $prefix, string $name, ?UploadedFile $uploadedFile, string $visibility = 'public'): string|null
    {
        /**
         * When not uploaded file
         * 
         */
        if (!$uploadedFile) {
            return null;
        }

        /**
         * $base directory
         * 
         */
        $baseDirectory = $visibility . '/' . str_replace('_', '-', $prefix) . '/' . str_replace('_', '-', $name);

        /**
         * Generate file name for uploaded file
         * 
         */
        $faker = Factory::create('id_ID');
        $filename = str_replace('_', '-', $name) . '-' . join('', $faker->randomElements(HelpersStringHelper::getArrAllAlphabet(), 4)) . '-' . $faker->randomNumber(6) . '.' . $uploadedFile->extension();

        /**
         * Save the uploaded file to disk
         * 
         */
        Storage::putFileAs($baseDirectory, $uploadedFile, $filename);

        return $filename;
    }

    /**
     * Deleting File
     * 
     */
    public static function modelFileDelete($model, string $name, string $visibility = 'public'): void
    {
        /**
         * $base directory
         * 
         */
        $baseDirectory = $visibility . '/' . str_replace('_', '-', $model->getTable()) . '/' . str_replace('_', '-', $name);

        /**
         * Checking if file exists in database then delete it
         * 
         */
        if (Storage::exists($baseDirectory . '/' .  $model->$name)) {
            Storage::delete($baseDirectory . '/' . $model->$name);
        }
    }

    /**
     * Generate filename for uploaded file
     * 
     * @param Illuminate\Http\UploadedFile $file
     * @param string $prefixColumnName [nullable]
     * 
     * @return string (filename generated)
     */
    public static function generateFileName(UploadedFile $uploadedFile, ?string $prefixColumnName): string
    {
        $faker = Factory::create('id_ID');
        $filename = '';

        if ($prefixColumnName) {
            $filename .= str_replace(' ', '-', $prefixColumnName) . '-';
        }

        $filename .= join('', $faker->randomElements(HelpersStringHelper::getArrAllAlphabet(), 4)) . '-' . $faker->randomNumber(6) . '.' . $uploadedFile->extension();

        return $filename;
    }

    /**
     * Just do upload file
     * 
     * @param Illuminate\Http\UploadedFile $file
     * @param string $filename
     * @param string $visibility (app, public) default public
     * @param string $moduleName
     * @param string $tableName
     * @param string $prefixColumnName
     * 
     * @return string (path)
     */
    public static function upload(UploadedFile $uploadedFile, string $filename, string $visibility, string $moduleName, string $tableName, string $prefixColumnName): string
    {
        $baseDirectory = $visibility . '/' . str_replace(' ', '-', $moduleName) . '/' . str_replace(' ', '-', $tableName) . '/' . str_replace(' ', '-', $prefixColumnName);

        return Storage::putFileAs($baseDirectory, $uploadedFile, $filename);
    }
}
