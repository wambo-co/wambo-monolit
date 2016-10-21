<?php
namespace Wambo\Developer\Whoops;

use Exception;
use HttpException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Whoops\Run;

class ErrorHandler
{
    private $whoops;

    public function __construct(Run $whoops) {
        $this->whoops = $whoops;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Exception $exception) {
        $handler = Run::EXCEPTION_HANDLER;

        ob_start();

        $this->whoops->$handler($exception);

        $content = ob_get_clean();
        $code    = $exception instanceof HttpException ? $exception->getStatusCode() : 500;

        return $response
            ->withStatus($code)
            ->withHeader('Content-type', 'text/html')
            ->write($content);
    }

}