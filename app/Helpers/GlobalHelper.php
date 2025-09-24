<?php

use App\Models\Setting;

if (!function_exists('formatDate')) {
    /**
     * Format a date consistently across the application
     *
     * @param mixed $date
     * @param string $format
     * @return string
     */
    function formatDate($date, $format = 'Y-m-d H:i:s')
    {
        if (!$date) {
            return '';
        }
        
        if (is_string($date)) {
            $date = new \DateTime($date);
        }
        
        return $date->format($format);
    }
}

if (!function_exists('uploadFile')) {
    /**
     * Upload a file to the storage disk
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string|false
     */
    function uploadFile($file, $path = 'uploads')
    {
        if (!$file || !$file->isValid()) {
            return false;
        }
        
        return $file->store($path, 'public');
    }
}

if (!function_exists('generateApiResponse')) {
    /**
     * Generate a standardized API response
     *
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return array
     */
    function generateApiResponse($success, $message = '', $data = null, $statusCode = 200)
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'status_code' => $statusCode
        ];
    }
}

if (!function_exists('getSetting')) {
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function getSetting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}