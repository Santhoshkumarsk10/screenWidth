<?php

namespace screenWidth\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Jaybizzle\CrawlerDetect\CrawlerDetect;


class screenWidth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
dd('ad');
        $CrawlerDetect = new CrawlerDetect;
        if ($CrawlerDetect->isCrawler() == true) {
            return $next($request);
        }

        $exceptPathArray = config('screenWidth.exceptUrls');
        if (in_array($request->getPathInfo(), $exceptPathArray)) {
            return $next($request);
        }

        if (Cookie::get('screenWidth')) {
            return $next($request);
        }

        $intend = url()->full();
        $route = route('getscreenWidth');

        Cookie::queue(Cookie::make('screenWidthIntend', $intend, 1440));

        return redirect($route);
    }
}
