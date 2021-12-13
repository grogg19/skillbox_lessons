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

if (! function_exists('getRange')) {

    /**
     * @param array $numbers
     * @return string
     */
    function getRange(array $numbers): string
    {
        sort($numbers, SORT_NUMERIC);

        $beginRange = '';
        $resultArray = [];

        foreach ($numbers as $key => $number) {

            if (empty($numbers[$key + 1]) || ($number + 1) !== $numbers[$key + 1]) {
                $resultArray[] = $beginRange . $number;
                $beginRange = '';
            } else {
                $beginRange = (empty($beginRange)) ? $number . '-' : $beginRange;
                continue;
            }

        }
        return implode( ', ', $resultArray);
    }
}
