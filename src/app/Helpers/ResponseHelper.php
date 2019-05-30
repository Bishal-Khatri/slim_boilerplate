<?php
namespace App\Helpers;

class ResponseHelper
{
    public static function setResponse($type, $message, $responseData, $responseMetaData = [])
    {
        $error = '';
        if ($type === 'success') {
            $error = false;
        }

        if ($type === 'error') {
            $error = true;
        }

        return json_encode([
            'error' => $error,
            'message' => $message,
            'data' => $responseData,
            'metaData' => $responseMetaData
        ]);
    }
}