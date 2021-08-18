<?php

namespace App\Services;

use GuzzleHttp\Client;

class PushAll
{

    private $id;
    private $apiKey;

    protected $url = 'https://pushall.ru/api.php';

    /**
     * @param $apiKey
     * @param $id
     */
    public function __construct($apiKey, $id)
    {
        $this->apiKey = $apiKey;
        $this->id = $id;
    }

    /**
     * @param $title
     * @param $text
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($title, $text)
    {
        $data = [
            'type' => 'self',
            'id' => $this->id,
            'key' => $this->apiKey,
            'text' => $title,
            'title' => $text
        ];

        $client = new Client(['base_uri' => $this->url]);
        return $client->post('', ['form_params' => $data]);
    }
}
