<?php

namespace screenWidth\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class screenWidthController extends Controller
{
    static public function getscreenWidth(Request $request)
    {
        return view('screenWidth::screenWidth.getScreenWidth');
    }
    public function setscreenWidth(Request $request)
    {
        $data = [];
        $width = $request->screenWidth;
        Cookie::queue(Cookie::make('screenWidth', $width, 1440));
        $intend = Cookie::get('screenWidthIntend') ? Cookie::get('screenWidthIntend') : '/';
        return redirect($intend);
    }
    public function checkscreenWidth(Request $request)
    {
        $screenWidth = Cookie::get('screenWidth');
        echo $screenWidth;
    }
    public function reportWindowSize(Request $request)
    {
        $data = [];
        $width = $request->width;
        $newwidth = Cookie::queue(Cookie::make('screenWidth', $width, 1440));
        return response()->json([
            'width' => $width
        ]);
    }
}
