<style>
    /* Chat button style */
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
        font-size: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 999;
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
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        display: none;
        z-index: 1000;
    }

    .chat-header {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-weight: bold;
        position: relative;
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
        max-height: 400px;
        overflow-y: auto;
        padding: 20px;
    }

    .message {
        margin-bottom: 10px;
        padding: 8px 12px;
        border-radius: 5px;
        max-width: 80%;
    }

    .sender-message {
        background-color: #007bff;
        color: #fff;
        align-self: flex-end;
    }

    .receiver-message {
        background-color: #f0f0f0;
        color: #333;
    }

    .chat-footer {
        padding: 10px;
        border-top: 1px solid #ccc;
        display: flex;
        align-items: center;
    }

    .chat-footer input[type="text"] {
        flex: 1;
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

<div id="chatContainer" class="chat-container">
    <div class="chat-header">
        Chat with Support
        <span class="close-chat" onclick="toggleChat()">×</span>
    </div>
    <div class="chat-body" id="chatBody">
        <!-- Messages will be appended dynamically here -->
    </div>
    <div class="chat-footer">
        <!-- Chat input area and send button -->
        <input type="text" id="chatMessage" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
    </div>
</div>

@push('scripts')
    <script>
        // Function to generate a unique guest identifier (timestamp-based)
        function generateGuestId() {
            return new Date().getTime();
        }

        // Function to store guest identifier in local storage
        function storeGuestId(guestId) {
            localStorage.setItem('guestId', guestId);
        }

        // Function to retrieve guest identifier from local storage
        function getGuestId() {
            return localStorage.getItem('guestId');
        }

        // Function to check if guest identifier exists in local storage
        function hasGuestId() {
            return localStorage.getItem('guestId') !== null;
        }

        // Function to toggle chat visibility
        function toggleChat() {
            var chatContainer = $('#chatContainer');
            chatContainer.slideToggle(function() {
                if (chatContainer.is(':visible')) {
                    fetchMessages(); // Fetch messages when chat is opened
                }
            });
        }

        // Function to fetch messages from the server
        function fetchMessages() {
            var guestId = getGuestId();

            $.ajax({
                url: '{{ route('chat.index') }}', // Replace with your Laravel route for fetching messages
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    guest_id: guestId
                },
                success: function(response) {
                    var messages = response.messages;
                    console.log(messages);
                    var chatBody = $('#chatBody');
                    chatBody.empty(); // Clear existing messages
                    messages.forEach(function(message) {
                        var messageClass = message.message_type === 'sent' ? 'sender-message' :
                            'receiver-message';
                        var newMessage = '<div class="message ' + messageClass + '">' + message
                            .message + '</div>';
                        chatBody.append(newMessage);
                    });
                    scrollToBottom(chatBody); // Scroll to bottom
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching messages:', error);
                }
            });
        }

        // Function to scroll to the bottom of chat body
        function scrollToBottom(element) {
            element.scrollTop(element[0].scrollHeight);
        }

        // Function to send a message to the server
        function sendMessage() {
            var messageInput = $('#chatMessage');
            var message = messageInput.val().trim();

            if (message !== '') {
                var guestId = getGuestId();
                if (!guestId) {
                    guestId = generateGuestId();
                    storeGuestId(guestId);
                }

                $.ajax({
                    url: '{{ route('chat.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        guest_id: guestId,
                        message: message
                    },
                    success: function(response) {
                        var chatBody = $('#chatBody');
                        var messageClass = 'sender-message'; // Assuming sender is always the current user
                        var newMessage = '<div class="message ' + messageClass + '">' + message + '</div>';
                        chatBody.append(newMessage);
                        messageInput.val(''); // Clear input field
                        scrollToBottom(chatBody); // Scroll to bottom
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending message:', error);
                    }
                });
            }
        }

        $(document).ready(function() {
            if (!hasGuestId()) {
                var guestId = generateGuestId();
                storeGuestId(guestId);
            }
        });
    </script>
@endpush
