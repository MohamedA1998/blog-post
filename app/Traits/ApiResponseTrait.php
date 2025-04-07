<?php
namespace App\Traits;

trait ApiResponseTrait
{
    protected function apiResponse($data, $statusCode = 200, $message = null, $errors = [])
    {
        $data = ['data' => (object)$data];
        $data['errors'] = (object)$errors;

        switch ($statusCode) {
            case 200:
                $data['message'] = $message ?? '';
                $data['success'] = true;
                break;
            case 201:
                $data['message'] = $message ?? 'Created';
                $data['success'] = true;
                break;
            case 400:
                $data['message'] = $message ?? 'Bad Request';
                $data['success'] = false;
                break;
            case 401:
                $data['message'] = $message ?? 'Unauthorized';
                $data['success'] = false;
                break;
            case 403:
                $data['message'] = $message ?? 'Forbidden';
                $data['success'] = false;
                break;
            case 404:
                $data['message'] = $message ?? 'Not Found';
                $data['success'] = false;
                break;
            case 405:
                $data['message'] = $message ?? 'Method Not Allowed';
                $data['success'] = false;
                break;
            case 422:
                $data['message'] = $message ?? 'The given data was invalid.';
                $data['success'] = false;
                break;
            default:
                $data['message'] = $message ?? 'Whoops, looks like something went wrong';
                $data['success'] = false;
                break;
        }

        return response()->json($data, $statusCode);
    }

}
