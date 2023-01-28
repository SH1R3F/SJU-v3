<?php

if (!function_exists('translations')) {
    function translations($json)
    {
        if (!file_exists($json)) {
            return [];
        }
        return json_decode(file_get_contents($json), true);
    }
}

/**
 * Upload base64 images
 */
if (!function_exists('upload_base64_image')) {
    function upload_base64_image($img, $path)
    {
        // Upload base64 image
        $base64_image  = explode(";base64,", $img);
        $explode_image = explode("image/", $base64_image[0]);
        $image_type    = $explode_image[1];
        $image_base64  = base64_decode($base64_image[1]);
        $image_name    = uniqid() . '.' . $image_type;
        Storage::put($path = "$path/$image_name", $image_base64);
        return $path;
    }
}
