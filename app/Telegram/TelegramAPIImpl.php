<?php

namespace App\Telegram;

class TelegramApiImpl implements TelegramAPI{
    const ENDPOINT = "https://api.telegram.org/bot";
    private int $offset;
    private string $token;

    public function __consruct(string $token)
    {
        $this->token=$token;
    }

    
    public function getMessages(int $offset): array{
        $url=self::ENDPOUNT . $this->token . '/sendMessage';

        $result= [];

        $ch = curl_init($url);
        $jsonData = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, true); //POST запрос
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); //Прикрепляет данные
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type :application/json'));	// Устанавливает application/json
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);

        return [
            "offset"=>$offset,
            "result"=>$result
        ];

    }


    public function sendMessage(string $chatId, string $text)
    {
        $url=self::ENDPOUNT . $this->token . '/sendMessage';

        $Data= [
            'chat_id' => $chatId,
            'text' => $text,

        ];

        $ch = curl_init($url);
        $jsonData = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, true); //POST запрос
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); //Прикрепляет данные
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type :application/json'));	// Устанавливает application/json
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);

    }


}