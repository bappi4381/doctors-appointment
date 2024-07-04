<?php

namespace App\Traits;

trait ResponseFormatter
{
    public function format($data, $messag = null, $response_code = null)
    {

        $codes = array(
            100 => ['message' => 'Continue', 'status' => false],
            101 => ['message' => 'Switching Protocols', 'status' => false],
            102 => ['message' => 'Processing', 'status' => false],
            103 => ['message' => 'Checkpoint', 'status' => false],
            200 => ['message' => 'OK', 'status' => true],
            201 => ['message' => 'Created', 'status' => true],
            202 => ['message' => 'Accepted', 'status' => false],
            203 => ['message' => 'Non-Authoritative Information', 'status' => false],
            204 => ['message' => 'No Content', 'status' => false],
            205 => ['message' => 'Reset Content', 'status' => false],
            206 => ['message' => 'Partial Content', 'status' => false],
            207 => ['message' => 'Multi-Status', 'status' => false],
            300 => ['message' => 'Multiple Choices', 'status' => false],
            301 => ['message' => 'Moved Permanently', 'status' => false],
            302 => ['message' => 'Found', 'status' => false],
            303 => ['message' => 'See Other', 'status' => false],
            304 => ['message' => 'Not Modified', 'status' => false],
            305 => ['message' => 'Use Proxy', 'status' => false],
            306 => ['message' => 'Switch Proxy', 'status' => false],
            307 => ['message' => 'Temporary Redirect', 'status' => false],
            400 => ['message' => 'Bad Request', 'status' => false],
            401 => ['message' => 'Unauthorized', 'status' => false],
            402 => ['message' => 'Payment Required', 'status' => false],
            403 => ['message' => 'Forbidden', 'status' => false],
            404 => ['message' => 'Not Found', 'status' => false],
            405 => ['message' => 'Method Not Allowed', 'status' => false],
            406 => ['message' => 'Not Acceptable', 'status' => false],
            407 => ['message' => 'Proxy Authentication Required', 'status' => false],
            408 => ['message' => 'Request Timeout', 'status' => false],
            409 => ['message' => 'Conflict', 'status' => false],
            410 => ['message' => 'Gone', 'status' => false],
            411 => ['message' => 'Length Required', 'status' => false],
            412 => ['message' => 'Precondition Failed', 'status' => false],
            413 => ['message' => 'Request Entity Too Large', 'status' => false],
            414 => ['message' => 'Request-URI Too Long', 'status' => false],
            415 => ['message' => 'Unsupported Media Type', 'status' => false],
            416 => ['message' => 'Requested Range Not Satisfiable', 'status' => false],
            417 => ['message' => 'Expectation Failed', 'status' => false],
            418 => ['message' => 'I\'m a teapot', 'status' => false],
            422 => ['message' => 'Unprocessable Entity', 'status' => false],
            423 => ['message' => 'Locked', 'status' => false],
            424 => ['message' => 'Failed Dependency', 'status' => false],
            425 => ['message' => 'Unordered Collection', 'status' => false],
            426 => ['message' => 'Upgrade Required', 'status' => false],
            449 => ['message' => 'Retry With', 'status' => false],
            450 => ['message' => 'Blocked by Windows Parental Controls', 'status' => false],
            500 => ['message' => 'Internal Server Error', 'status' => false],
            501 => ['message' => 'Not Implemented', 'status' => false],
            502 => ['message' => 'Bad Gateway', 'status' => false],
            503 => ['message' => 'Service Unavailable', 'status' => false],
            504 => ['message' => 'Gateway Timeout', 'status' => false],
            505 => ['message' => 'HTTP Version Not Supported', 'status' => false],
            506 => ['message' => 'Variant Also Negotiates', 'status' => false],
            507 => ['message' => 'Insufficient Storage', 'status' => false],
            509 => ['message' => 'Bandwidth Limit Exceeded', 'status' => false],
            510 => ['message' => 'Not Extended', 'status' => false],
            429 => ['message' => 'Too Many Requests', 'status' => false],
        );


        return [
            'success' => is_bool($response_code) ? $response_code : ($codes[$response_code]['status'] ?? false),
            'message' => $messag ?? $codes[$response_code]['message'] ?? null,
            'data' => $data,
        ];
    }
}
