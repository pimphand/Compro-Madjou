<?php

namespace App\Services\Telegram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class Log
{
    private $botApi;
    private $botChat;

    public function __construct()
    {
        $this->botApi = "5586428562:AAFXeDEjAeNdcHpTvD2uYbhfgrUmeiWrKro";
        $this->botChat = "825020897";
    }

    public function send($message)
    {
        $client = new Client([
            'base_uri' => "https://api.telegram.org",
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        try {
            $client->post('/bot' . $this->botApi . '/sendMessage', [
                'query' => [
                    'chat_id' => $this->botChat,
                    'text' => "adf",
                ]
            ]);

            return true;
        } catch (ServerException $error) {
            $this->result($error->getResponse());
            return false;
        }
    }
}
