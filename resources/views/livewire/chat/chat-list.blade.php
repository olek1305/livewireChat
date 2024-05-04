<div>
    <div class="chat_list_header">
        <div class="title">
            Chat
        </div>

        <div class="img_container">
            <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}" alt="dog">
        </div>
    </div>

    <div class="chat_list_body">

        @if (count($conversations) > 0)
            @foreach ($conversations as $conversation)
                <div class="chat_list_item" wire:click="chatUserSelected({{ $conversation }}, {{ $this->getChatUserInstance($conversation, 'id') }})">
                    <div class="chat_list_img_container">
                        <img src="https://ui-avatars.com/api/?name={{ $this->getChatUserInstance($conversation, $name = 'name') }}" alt="">
                    </div>

                    <div class="chat_list_info">
                        <div class="top_row">
                            <div class="list_username">{{ $this->getChatUserInstance($conversation, $name = 'name') }}</div>
                            <span class="date">{{ $conversation->messages->last()?->created_at->shortAbsoluteDiffForHumans() }}</span>
                        </div>

                        <div class="bottom_row">
                            <div class="message_body truncate">
                                {{ $conversation->messages->last()?->body }}
                            </div>

                            <div class="unread_count">
                                56
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            You haven't conversations
        @endif

    </div>
</div>
