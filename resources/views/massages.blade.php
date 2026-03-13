@extends('layouts.app')
@section('content')
    <div class="content-massage">
        <div class="msg-layout">
            <div class="topbar-massage">
                <div class="topbar-massage-title">Messages</div>
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search conversations…">
                </div>
                <div style="width:34px;height:34px;border:1px solid var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--muted);">
                    <i class="bi bi-sliders"></i>
                </div>
            </div>

            <div class="msg-body">
                <div class="conv-list">
                    <div class="conv-list-head">
                        Conversations
                        <span class="unread-total">{{ $unreadCount }}</span>
                    </div>

                    @forelse($conversations as $index => $conversation)
                        <div class="conv-item {{ isset($user) && $user->id == $conversation['user']->id ? 'active' : '' }} {{ $conversation['unread_count'] > 0 ? 'unread' : '' }}" onclick="window.location='{{ route('massages.show', $conversation['user']->id) }}'">
                            <div class="conv-av" style="background:linear-gradient(135deg,#5C85D4,#3A5AB0);color:#fff;">
                                {{ strtoupper(substr($conversation['user']->name, 0, 1)) }}
                            </div>
                            <div class="conv-info">
                                <div class="conv-name">{{ $conversation['user']->name }}</div>
                                <div class="conv-vehicle">{{ $conversation['user']->email }}</div>
                                <div class="conv-preview">{{ Str::limit($conversation['latest_message']->message, 40) }}</div>
                            </div>
                            <div class="conv-meta">
                                <span class="conv-time">{{ $conversation['latest_message']->timestamp->format('g:i A') }}</span>
                                @if ($conversation['unread_count'] > 0)
                                    <span class="conv-badge">{{ $conversation['unread_count'] }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div style="padding:40px 20px;text-align:center;color:var(--muted);">
                            <i class="bi bi-inbox" style="font-size:32px;display:block;margin-bottom:8px;"></i>
                            <p style="margin:0;font-size:13px;">No conversations yet</p>
                        </div>
                    @endforelse
                </div>

                @if(isset($user) && isset($messages))
                <div class="chat-window">
                    <div class="chat-header">
                        <div class="chat-hav" style="background:linear-gradient(135deg,#5C85D4,#3A5AB0);color:#fff;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}<div class="online-dot"></div>
                        </div>
                        <div class="chat-hname">{{ $user->name }}</div>
                        <div class="chat-hsub">
                            <i class="bi bi-circle-fill" style="font-size:7px;color:green;"></i>
                            Online
                        </div>
                        <div class="chat-header-actions">
                            <div class="ch-btn"><i class="bi bi-telephone"></i></div>
                            <div class="ch-btn"><i class="bi bi-camera-video"></i></div>
                            <div class="ch-btn"><i class="bi bi-info-circle"></i></div>
                            <div class="ch-btn"><i class="bi bi-three-dots"></i></div>
                        </div>
                    </div>

                    <div class="messages-area" id="messagesArea">
                        @foreach ($messages as $msg)
                            @if ($msg->sender_id == auth()->id())
                                <div class="msg-row me">
                                    <div class="msg-av-sm dealer">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div class="bubble-wrap">
                                        <div class="bubble me">{{ $msg->message }}</div>
                                        <div class="bubble-time" style="text-align:right;">
                                            {{ $msg->timestamp->format('g:i A') }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="msg-row">
                                    <div class="msg-av-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="bubble-wrap">
                                        <div class="bubble them">{{ $msg->message }}</div>
                                        <div class="bubble-time">{{ $msg->timestamp->format('g:i A') }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="composer">
                        <form id="messageForm">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle?->id }}">
                            <div class="composer-inner">
                                <div class="composer-actions">
                                    <button type="button" class="comp-btn"><i class="bi bi-paperclip"></i></button>
                                    <button type="button" class="comp-btn"><i class="bi bi-image"></i></button>
                                    <button type="button" class="comp-btn"><i class="bi bi-emoji-smile"></i></button>
                                </div>
                                <textarea name="message" class="composer-input" id="messageInput" placeholder="Type your message…" rows="1"></textarea>
                                <button type="submit" class="send-btn"><i class="bi bi-send-fill"></i></button>
                            </div>
                            <div class="composer-hint">Press Enter to send · Shift+Enter for new line</div>
                        </form>
                    </div>
                </div>

                <div class="right-panel">
                    @if($vehicle)
                    <div class="rp-section">
                        <div class="rp-label">Vehicle</div>
                        <a href="{{ route('singelCar', $vehicle->slug) }}" class="rp-vehicle">
                            <img src="{{ $vehicle->images->first() ? asset('storage/' . $vehicle->images->first()->image_path) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400&q=70' }}" alt="{{ $vehicle->title }}">
                            <div class="rp-vehicle-body">
                                <div class="rp-vbrand">{{ $vehicle->brand }}</div>
                                <div class="rp-vtitle">{{ $vehicle->title }}</div>
                                <div class="rp-vprice">${{ number_format($vehicle->price) }}</div>
                                <div class="rp-vstatus"><i class="bi bi-check-circle-fill"></i> {{ ucfirst($vehicle->condition) }}</div>
                            </div>
                        </a>
                    </div>
                    @endif

                    <div class="rp-section">
                        <div class="rp-label">Customer</div>
                        <div class="rp-user-row">
                            <div class="rp-uav" style="background:linear-gradient(135deg,#5C85D4,#3A5AB0);color:#fff;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="rp-uname">{{ $user->name }}</div>
                                <div class="rp-uinfo"><i class="bi bi-envelope"></i> {{ $user->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="rp-section">
                        <div class="rp-label">Conversation Info</div>
                        <div style="background:var(--s2);border:1px solid var(--border);border-radius:9px;padding:12px;display:flex;flex-direction:column;gap:9px;">
                            <div style="display:flex;justify-content:space-between;font-size:12px;">
                                <span style="color:var(--muted);">Messages</span>
                                <span>{{ $messages->count() }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;font-size:12px;">
                                <span style="color:var(--muted);">Status</span>
                                <span style="color:var(--green);">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="chat-window" style="display:flex;align-items:center;justify-content:center;color:var(--muted);">
                    <div style="text-align:center;">
                        <i class="bi bi-chat-dots" style="font-size:48px;display:block;margin-bottom:16px;"></i>
                        <p>Select a conversation to start messaging</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messagesArea = document.getElementById('messagesArea');
            const messageForm = document.getElementById('messageForm');
            const messageInput = document.getElementById('messageInput');

            if (messagesArea) {
                messagesArea.scrollTop = messagesArea.scrollHeight;
            }

            if (messageForm) {
                messageForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const message = messageInput.value.trim();
                    if (!message) return;

                    const receiverId = document.querySelector('input[name="receiver_id"]').value;
                    const vehicleId = document.querySelector('input[name="vehicle_id"]')?.value;
                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    const payload = {
                        receiver_id: receiverId,
                        message: message
                    };
                    if (vehicleId) payload.vehicle_id = vehicleId;

                    fetch('{{ route("massages.send") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const msgRow = document.createElement('div');
                            msgRow.className = 'msg-row me';
                            msgRow.innerHTML = `
                                <div class="msg-av-sm dealer">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="bubble-wrap">
                                    <div class="bubble me">${escapeHtml(data.message)}</div>
                                    <div class="bubble-time" style="text-align:right;">${data.timestamp}</div>
                                </div>
                            `;
                            messagesArea.appendChild(msgRow);
                            messagesArea.scrollTop = messagesArea.scrollHeight;
                            messageInput.value = '';
                            messageInput.style.height = 'auto';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to send message: ' + (error.message || 'Unknown error'));
                    });
                });

                messageInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        messageForm.dispatchEvent(new Event('submit'));
                    }
                });
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
        });
    </script>
@endsection
