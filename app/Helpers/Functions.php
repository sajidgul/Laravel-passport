<?php
   /**
    * Success response method
    *
    * @param $result
    * @param $message
    * @return \Illuminate\Http\JsonResponse
    */
   function sendResponse($data)
   {
       $response = [
           'success' => true,
           'error'   => null,
           'body'    => $data,
       ];

       return response()->json($response);
   }

   /**
    * Return error response
    *
    * @param       $error
    * @param array $errorMessages
    * @param int   $code
    * @return \Illuminate\Http\JsonResponse
    */
   function sendError($error)
   {
       $response = [
           'success' => false,
           'error'   => $error,
           'body'    => null,

       ];

       return response()->json($response);
   }