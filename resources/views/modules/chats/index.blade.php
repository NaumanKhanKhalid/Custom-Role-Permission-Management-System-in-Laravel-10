@extends('dashboard.layouts.app')

@section('content')
<div class="app-content main-content">
    <div class="side-app">
        @include('dashboard.layouts.header')

        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <h4 class="page-title"><span class="font-weight-normal text-muted ms-2">Admin Chat</span></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card overflow-hidden">
                    <div class="tile tile-alt mb-0 border-0" id="messages-main">
                        <div class="ms-menu">
                            <ul class="list-group lg-alt chat-contact-list rounded-0" id="ChatList">
                                <!-- List of guests -->
                                @foreach($messages->unique('guest_id') as $message)
                                    <li class="list-group-item media p-3 rounded-0 mt-0">
                                        <a href="javascript:void(0);" onclick="loadChat('{{ $message->guest_id }}')">
                                            <div class="float-start pe-2">
                                                <img src="{{ asset('dashboard-assets/assets/images/users/16.jpg') }}" alt="" class="avatar avatar-md rounded-circle">
                                            </div>
                                            <div class="media-body d-table-cell">
                                                <div class="list-group-item-heading text-default fw-semibold">Guest {{ $message->guest_id }}</div>
                                                <small class="list-group-item-text text-muted">{{ Str::limit($message->message, 30) }}</small>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="ms-body">
                           <div class="action-header d-flex flex-wrap">
                                <div class="float-start hidden-xs d-flex ms-6 chat-user mb-2 mb-sm-0">
                                    <img src="{{ asset('dashboard-assets/assets/images/users/16.jpg') }}" alt="" class="avatar avatar-md rounded-circle me-2">
                                    <div class="align-items-center">
                                        <div class="fw-semibold" id="guest-id">Guest</div>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="chat-body-style" id="ChatBody">
                                <!-- Chat messages will be loaded here via JavaScript -->
                            </div>

                            <div class="msb-reply">
                                <form id="sendMessageForm">
                                    @csrf
                                    <textarea name="message" id="messageInput" placeholder="What's on your mind..."></textarea>
                                    <input type="hidden" name="guest_id" id="guestIdInput">
                                    <button type="submit"><span class="fe fe-send"></span></button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function loadChat(guestId) {
    document.getElementById('guest-id').textContent = 'Guest ' + guestId;
    document.getElementById('guestIdInput').value = guestId;
    fetch(`/chats?guest_id=${guestId}`)
        .then(response => response.json())
        .then(data => {
            const chatBody = document.getElementById('ChatBody');
            chatBody.innerHTML = '';
            data.messages.forEach(message => {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message-feed', message.message_type === 'sent' ? 'right' : 'media');
                messageDiv.innerHTML = `
                    <div class="${message.message_type === 'sent' ? 'float-end' : 'float-start'} ps-2">
                        <img src="{{ asset('dashboard-assets/assets/images/users/16.jpg') }}" alt="" class="avatar avatar-md rounded-circle">
                    </div>
                    <div class="media-body">
                        <div class="mf-content">${message.message}</div>
                        <small class="mf-date"><i class="fa-regular fa-clock"></i> ${new Date(message.created_at).toLocaleString()}</small>
                    </div>
                `;
                chatBody.appendChild(messageDiv);
            });
        });
}

document.getElementById('sendMessageForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch('/admin/chat', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Message sent successfully') {
            loadChat(document.getElementById('guestIdInput').value);
            document.getElementById('messageInput').value = '';
        }
    });
});
</script>
@endsection
