<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CompressResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response instanceof BinaryFileResponse || $response instanceof StreamedResponse) {
            return $response;
        }

        $encodings = $request->header('Accept-Encoding', '');

        if (str_contains($encodings, 'gzip') && function_exists('gzencode')) {
            $content = $response->getContent();

            if ($content && strlen($content) > 1024) {
                $compressed = gzencode($content, 6);
                $response->setContent($compressed);
                $response->headers->set('Content-Encoding', 'gzip');
                $response->headers->set('Content-Length', strlen($compressed));
                $response->headers->remove('Content-Length');
            }
        }

        return $response;
    }
}
