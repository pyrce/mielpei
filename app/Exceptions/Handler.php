<?php

namespace App\Exceptions;


use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

/**

* Render an exception into an HTTP response.

*

* @param \Illuminate\Http\Request $request

* @param \Exception $e

* @return \Illuminate\Http\Response

*/
    public function register(){
        $this->reportable(function (Throwable $e) {
            //
            //dd($e);
            //return response()->view('errors.'.$e->getCode(), [], $e->getCode());
        });
    }
}
