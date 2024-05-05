<div>
    @if ($selectedConversation)
        <form wire:submit.prevent="sendMessage" action="">
            <div class="chat_box_footer">
                <div class="custom_form_group">
                    <input wire:model="body" type="text" class="control" placeholder="Write message">
                    <button type="submit" class="submit">Send</button>
                </div>
            </div>
        </form>
    @endif
</div>
