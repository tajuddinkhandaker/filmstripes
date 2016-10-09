<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use PDOException;
use Illuminate\Session\TokenMismatchException;
use Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof PDOException) {
            $errorMessage = 'Access denied! Something went wrong while connecting database. Please contact your server administrator.';
            // Shows user presentable message.
            flash()->error($errorMessage);
            
            switch($e->getCode())
            {
                case 1045:
                {
                    // Logs developer presentable message.
                    Log::critical('[filmstripes][' . $e->getMessage() . "] db connection problem.");
                    break;
                }
                default:                
                    // Logs developer presentable message.
                    Log::critical('[filmstripes][' . $e->getMessage() . "] db unknown problem.");
                    break;

            }
            return redirect()->back();
        }
        if ($e instanceof TokenMismatchException) {
            $errorMessage = 'Session expired! Security token mismatch found. Please contact your security administrator.';
            // Shows user presentable message.
            flash()->error($errorMessage);
            
            switch($e->getCode())
            {
                default:                
                    // Logs developer presentable message.
                    Log::critical('[filmstripes][' . $e->getMessage() . "] security unknown problem.");
                    break;

            }
            return redirect()->back();
        }
        return parent::render($request, $e);
    }
}
