<div>
    <div class="chat_container">

        <div class="chat_list_container">
            @livewire('chat.chat-list')
        </div>
        <div class="chat_box_container">
            @livewire('chat.chatbox')

            @livewire('chat.send-message')
        </div>
    </div>

    <script>
        window.addEventListener('chatSelected', event => {
            if(window.innerWidth < 768){
                document.querySelectorAll('.chat_list_container').forEach(element => {
                    element.style.display = 'none';
                });
                document.querySelectorAll('.chat_box_container').forEach(element => {
                    element.style.display = 'block';
                });
            }

            requestAnimationFrame(() => {
                const chatBoxBody = document.querySelector('.chat_box_body');
                    chatBoxBody.scrollTop = chatBoxBody.scrollHeight;
            });
        });

        window.addEventListener('resize', function(){
            if(window.innerWidth > 768){
                document.querySelectorAll('.chat_list_container').forEach(element => {
                    element.style.display = 'block';
                });
                document.querySelectorAll('.chat_box_container').forEach(element => {
                    element.style.display = 'block';
                });
            }
        });


        document.addEventListener('click', function(event) {
            if (event.target.closest('.return')) {
                document.querySelectorAll('.chat_list_container').forEach(element => {
                    element.style.display = 'block';
                });
                document.querySelectorAll('.chat_box_container').forEach(element => {
                    element.style.display = 'none';
                });
            }
        });


    </script>

</div>
