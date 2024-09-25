<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Carbon\Carbon;
use Exception;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Exception $exception) {

            if (get_class($exception) == "Illuminate\\Http\\Exceptions\\ThrottleRequestsException") {
                return response()->json([

                    "responseCode" => 500,
                    "transactionId" => Carbon::now(),
                    "timestamp" => Carbon::now(),
                    "errorDetails" => [
                        'type' => get_class($exception),
                        'message' => "Throttle Limit has been reached wait for a while to request again"
                    ]



                ], 429);
            } elseif (get_class($exception) == "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException") {
                return response()->json([
                    "responseCode" => 404,
                    "transactionId" => Carbon::now(),
                    "timestamp" => Carbon::now(),
                    "errorDetails" => [
                        'type' => get_class($exception),
                        'message' => "Resource not found"
                    ]
                ], 404);
            } else {

                return response()->json([
                    "responseCode" => 500,
                    "transactionId" => Carbon::now(),
                    "timestamp" => Carbon::now(),
                    "errorDetails" => [
                        'type' => get_class($exception),
                        'message' => $exception->getMessage()
                    ]

                ], 500);
            }


            //! Error Type Getter
            // return response()->json([
            //     'type' => get_class($exception),
            //     'message' => $exception->getMessage()
            // ]);
            //
        });
    }
}
