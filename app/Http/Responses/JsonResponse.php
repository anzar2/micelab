<?php

namespace App\Http\Responses;

/**
 * The JsonResponse class provides static methods for generating JSON responses
 * with specific HTTP status codes and messages. It includes methods for 
 * standard responses such as OK (200), Bad Request (400), Unauthorized (401),
 * Forbidden (403), and Not Found (404), each with customizable message 
 * and details.
 * 
 * Is intented to be used as a 'shortcut' to send responses to the client.
 * If the output is more complex or needs more control, should be handled by the controller.
 * 
 * Feel free to add more methods as needed.
 */

class JsonResponse {
    public static function ok($message, $details=null) {
        return response()->json([
            "code" => 200,
            "message" => $message,
            "details" => $details,
        ], 200);
    }

    
    public static function badRequest($message, $details=null) {
        return response()->json([
            "code" => 400,
            "error" => "Bad Request",
            "message" => $message,
            "details" => $details,
        ], 400);
    }

    public static function notFound($message, $details=null) {
        return response()->json([
            "code" => 404,
            "error" => "Not Found",
            "message" => $message,
            "details" => $details,
        ], 404);
    }

    public static function unauthorized($message, $details=null) {
        return response()->json([
            "code" => 401,
            "error" => "Unauthorized",
            "message" => $message,
            "details" => $details,
        ], 401);
    }

    public static function forbidden($message, $details=null) {
        return response()->json([
            "code" => 403,
            "error" => "Forbidden",
            "message" => $message,
            "details" => $details,
        ], 403);
    }

    // .............
}