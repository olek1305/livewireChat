<?php

namespace App\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class SendMessage extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $createdMessage;

    protected $listeners = ['updateSendMessage', 'dispatchMessageSent'];

    public function updateSendMessage(Conversation $conversation, User $receiverInstance): void
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance =  $receiverInstance;

    }

    public function sendMessage(): void
    {
        if ($this->body == null) {
            return;
        }

        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
        ]);

        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();

        $this->dispatch('pushMessage', $this->createdMessage->id)->to('chat.chatbox');

        //refresh conversation list
        $this->dispatch('refresh')->to('chat.chat-list');

        $this->reset('body');

        $this->dispatch('dispatchMessageSent')->self();
    }

    public function dispatchMessageSent()
    {
        broadcast(new MessageSent(Auth()->user(), $this->createdMessage, $this->selectedConversation, $this->receiverInstance));
    }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
