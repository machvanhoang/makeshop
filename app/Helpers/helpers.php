<?php
if (!function_exists('sendResponse')) {
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'result'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
if (!function_exists('sendError')) {
    /**
     * Return error response.
     *
     * @return \Illuminate\Http\Response
     */
    function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['validate'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
