<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param $result
     * @param $message
     *
     * @return Response
     */
    public function sendResponse($result, $message) {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];
        return response()->json($response, 200);
    }

    /**
     * success response method for post with pagination.
     *
     * @param $total_page
     * @param $page
     * @param $per_page_data
     * @param $result
     * @param $message
     *
     * @return Response
     */
    public function sendResponseWithPaginate($total_page,$page,$per_page_data,$result,$message) {
        $response = [
            'success' => true,
            'message' => $message,
            'total_page' => $total_page,
            'current_page' => $page,
            'per_page_data' => $per_page_data,
            'data' => $result,
        ];
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     *
     * @return Response
     */
    public function sendError($error, $errorMessages = [], $code = 404) {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
