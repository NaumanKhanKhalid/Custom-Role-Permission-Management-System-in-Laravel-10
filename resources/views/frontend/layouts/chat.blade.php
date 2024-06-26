
<style>
    /* Example chat button style */
    .chat-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 25px;
        /* Rounded corners */
        font-size: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 999;
        /* Ensure it's above other content */
    }

    .chat-button:hover {
        background-color: #0056b3;
    }

    /* Chat container style */
    .chat-container {
        position: fixed;
        bottom: 80px;
        right: 20px;
        width: 300px;
        max-height: 80%;
        /* Adjust max height as needed */
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        display: none;
        /* Initially hidden */
        z-index: 1000;
        /* Ensure it's above other content */
    }

    .chat-header {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-weight: bold;
        position: relative;
        /* Ensure relative positioning for child elements */
    }

    .chat-header .close-chat {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        color: #ccc;
        font-size: 18px;
    }

    .chat-body {
        padding: 20px;
        max-height: calc(100% - 120px);
        /* Adjust based on header and footer size */
        overflow-y: auto;
        /* Enable scrolling if content exceeds height */
    }

    .chat-footer {
        padding: 10px;
        border-top: 1px solid #ccc;
        display: flex;
        align-items: center;
    }

    .chat-footer input[type="text"] {
        flex: 1;
        /* Take remaining space */
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        margin-right: 10px;
    }

    .chat-footer button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 14px;
    }

    .chat-footer button:hover {
        background-color: #0056b3;
    }

    @media (max-width: 600px) {
        .chat-container {
            width: 100%;
            max-width: 100%;
            bottom: 0;
            left: 0;
            border-radius: 0;
        }
    }
</style>


<button class="chat-button" onclick="toggleChat()">Chat with us</button>

<!-- Chat container -->
<div id="chatContainer" class="chat-container">
    <div class="chat-header">
        Chat with Support
        <span class="close-chat" onclick="toggleChat()">×</span>
    </div>
    <div class="chat-body">
        <!-- Example chat messages -->
        <p>Welcome! How can we assist you today?</p>
        <p>Feel free to ask any questions.</p>
    </div>
    <div class="chat-footer">
        <!-- Chat input area and send button -->
        <input type="text" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
    </div>
</div>
@push('scripts')
    <script>
        function toggleChat() {
            var chatContainer = document.getElementById('chatContainer');
            chatContainer.style.display = chatContainer.style.display === 'none' ? 'block' : 'none';
        }

        function sendMessage() {
            // Replace with your chat message sending logic
            var messageInput = document.querySelector('.chat-footer input[type="text"]');
            var message = messageInput.value.trim();
            if (message !== '') {
                // Example: Append message to chat body
                var chatBody = document.querySelector('.chat-body');
                var newMessage = document.createElement('p');
                newMessage.textContent = message;
                chatBody.appendChild(newMessage);
                messageInput.value = ''; // Clear input field
                messageInput.focus(); // Focus back on input field
            }
        }
    </script>
@endpush
