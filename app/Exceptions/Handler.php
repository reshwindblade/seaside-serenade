<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Handle 404 errors
        if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException) {
            return response()->view('errors.404', ['exception' => $exception], 404);
        }
        
        // Handle 403 errors
        if ($exception instanceof AccessDeniedHttpException) {
            return response()->view('errors.403', ['exception' => $exception], 403);
        }
        
        // Handle Token Mismatch (CSRF) errors as 419 page expired
        if ($exception instanceof TokenMismatchException) {
            return response()->view('errors.419', ['exception' => $exception], 419);
        }
        
        // Handle other HTTP exceptions with their proper status code
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            
            // Check if we have a specific error view for this status code
            if (view()->exists("errors.{$statusCode}")) {
                return response()->view("errors.{$statusCode}", [
                    'exception' => $exception,
                    'statusCode' => $statusCode,
                    'title' => $this->getTitleForStatusCode($statusCode),
                    'message' => $exception->getMessage() ?: $this->getMessageForStatusCode($statusCode)
                ], $statusCode);
            }
            
            // Use our generic error template with the proper status code
            return response()->view('errors.error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'title' => $this->getTitleForStatusCode($statusCode),
                'message' => $exception->getMessage() ?: $this->getMessageForStatusCode($statusCode)
            ], $statusCode);
        }
        
        // If in production, show custom 500 error page for all other exceptions
        if (!config('app.debug')) {
            return response()->view('errors.500', ['exception' => $exception], 500);
        }
        
        // Let the parent handler take care of it (will show detailed exception in debug mode)
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    /**
     * Get the title for a HTTP status code.
     *
     * @param  int  $statusCode
     * @return string
     */
    protected function getTitleForStatusCode($statusCode)
    {
        return match ($statusCode) {
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Access Denied',
            404 => 'Page Not Found',
            405 => 'Method Not Allowed',
            408 => 'Request Timeout',
            409 => 'Conflict Error',
            419 => 'Page Expired',
            422 => 'Validation Error',
            429 => 'Too Many Requests',
            500 => 'Server Error',
            503 => 'Service Unavailable',
            default => 'Error',
        };
    }

    /**
     * Get a friendly message for a HTTP status code.
     *
     * @param  int  $statusCode
     * @return string
     */
    protected function getMessageForStatusCode($statusCode)
    {
        return match ($statusCode) {
            400 => 'The server could not understand your request.',
            401 => 'You need to be authenticated to access this resource.',
            403 => 'You do not have permission to access this resource.',
            404 => 'The page you are looking for could not be found.',
            405 => 'The method specified is not allowed for this resource.',
            408 => 'The server timed out waiting for the request.',
            409 => 'The request could not be completed due to a conflict with the current state of the resource.',
            419 => 'Your session has expired. Please refresh and try again.',
            422 => 'The submitted data was not valid.',
            429 => 'You have made too many requests recently. Please wait and try again later.',
            500 => 'An unexpected error occurred on our servers.',
            503 => 'The service is temporarily unavailable. Please try again later.',
            default => 'An unexpected error occurred. Please try again later.',
        };
    }
}