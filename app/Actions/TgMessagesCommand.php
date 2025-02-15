<?php namespace 

App\Actions;

use App\Cache\Redis;
use App\Dictionaries\TgEventAnswers;
use App\Exceptions\WrongCronString;
use App\Models\EventDto;
use App\Telegram\TelegramApi;

class TgEvents
    {
    public function handle(): void
    {
        $messages = $this->receiveNewMessages();
        foreach ($messages as $userld => $userMessages) {
        $answerMessage = $this-»handleMessagesAndReturnAnswer($userMessages);
        $this-> eventSender-> sendMessage($userId, $answerMessage);
        }
    }

    private function receiveNewMessages(): array
 
    {
        $offset = $this->redis->get('tg_messages:offset', 0);
        $result = $this->telegramApi->getMessages($offset);
        $this->redis->set('tg_messages:offset', $result[ 'offset' ] ?? 0); 
        $oldMessages = json_decode($this->redis->get('tg_messages:old_messages')); 
        $messages = [];
        foreach ($result[' result' ] ?? [] as $chatld => $newMessage) { 
            if (isset($oldMessages[$chatId])) {
            $oldMessages[$chatId] = [ ... $oldMessages[$chatId], ... $newMessage]; } else {
            $oldMessages[$chatId] = $newMessage;
            }
            $messages[$chatld] = $oldMessages[$chatId];
        }
        $this->redis->set('tg_messages:old_messages', json_encode($oldMessages)); 
        return $messages;
    }
}