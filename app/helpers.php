<?php

if (! function_exists('push_all')) {

    /**
     * @param null $title
     * @param null $text
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    function push_all($title = null, $text = null)
    {
        if (is_null($title) || is_null($text)) {
            return app(\App\Services\PushAll::class);
        }
        return app(\App\Services\PushAll::class)->send($title, $text);
    }
}
