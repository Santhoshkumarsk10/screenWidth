<?php

use Illuminate\Support\Facades\Cookie;

if (! function_exists('screenWidth_get')) {
    function screenWidth_get()
    {
        $screenWidth = Cookie::get('screenWidth');
        return $screenWidth;
    }
}
if (! function_exists('screenWidth_device')) {
    function screenWidth_device($details = null)
    {
        $screenWidth = Cookie::get('screenWidth');
        $device = null;
        $key_name = 'screenWidth.devices';
        $devices = config($key_name);
        foreach ($devices as $key => $limits) {
            if ($screenWidth >= $limits['min'] && $screenWidth <= $limits['max']) {
                $device = $key;
                break;
            }
        }
        if ($details) {
            return [
                'result' => $device,
                'current_width' => $screenWidth,
            ];
        }
        return $device;
    }
}
if (! function_exists('screenWidth_is')) {
    function screenWidth_is($device, $details = null)
    {
        $screenWidth = Cookie::get('screenWidth');
        $result = false;
        $key_name = 'screenWidth.devices.' . $device;
        $device_limit = config($key_name);
        if ($screenWidth >= $device_limit['min'] && $screenWidth <= $device_limit['max']) {
            $result = true;
        }
        if ($details) {
            return [
                'result' => $result,
                'current_width' => $screenWidth,
                'limits' => $device_limit
            ];
        }
        return $result;
    }
}
