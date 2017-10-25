<?php

namespace RecycleArt\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        $mess = $this->buildMessage($exception);
        Mail::raw($mess, function ($message) {
            $server = isset($_SERVER['SERVER_NAME']) ?: '';
            $message->to(config('mail.webmaster'));
            $message->subject(config('app.name') . ' Was an error ' . $server);
        });
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * @param Exception $exception
     *
     * @return string
     */
    private function buildMessage(Exception $exception): string
    {
        $mess = 'Was an error: ' . $exception->getMessage() . PHP_EOL;
        $mess .= 'File: ' . $exception->getFile() . ' Line: ' . $exception->getLine() . ' Code: ' . $exception->getCode() . PHP_EOL . PHP_EOL;
        $mess .= 'Full trace: ' . PHP_EOL . $exception->getTraceAsString() . PHP_EOL . PHP_EOL;
        $mess .= 'Server: ' . print_r($_SERVER, true) . PHP_EOL;
        return $mess;
    }
}
