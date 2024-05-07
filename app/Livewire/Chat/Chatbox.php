<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chatbox extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $messages;
    public $messages_count;
    public $paginateVar = 10;
    public $height;

    protected $listeners = ['loadConversation', 'pushMessage', 'loadmore', 'updateHeight'];

    public function loadConversation(Conversation $conversation, User $receiverInstance): void
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance =  $receiverInstance;

        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)
            ->count();

        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)
            ->get();

        $this->dispatch('chatSelected');
    }

    public function pushMessage($messageId): void
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

        $this->dispatch('rowChatToBottom');
    }

    public function loadmore(): void
    {
        $this->paginateVar = $this->paginateVar + 10;

        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)
            ->get();

        $this->dispatch('updatedHeight', ['height' => $this->height]);
    }

    public function updateHeight($height): void
    {
        $this->height = $height;
    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
