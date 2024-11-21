<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="{{ asset('css/Employee/ticketing/noticestyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar minimized">
            <div class="sidebar-header">
                <button class="minimize-btn" onclick="toggleSidebar()"></button>
            </div>
            <div class="nav-links">
                <div class="nav-item">
                    <a href="/employee/home" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-home nav-logo"></i>
                            <span class="nav-label">HOME</span>
                        </div>
                        <span class="nav-text">HOME</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/employee/profile" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-user nav-logo"></i>
                            <span class="nav-label">PROFILE</span>
                        </div>
                        <span class="nav-text">PROFILE</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/employee/contact" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-envelope nav-logo"></i>
                            <span class="nav-label">CONTACT</span>
                        </div>
                        <span class="nav-text">CONTACT</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <div class="header">
                <button class="back-btn" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i> 
                </button>
                <h1>TICKETING SYSTEM</h1>
                <button class="menu-btn" onclick="toggleMenu()">⋮</button>
            </div>

            <!-- Functional Button Section -->
            <div class="functional-button-section">
                <div class="button-container">
                    <button class="action-btn" onclick="window.location.href='Report and Monitoring.html';">
                        <i class="fas fa-chart-bar"></i>
                        <span>REPORT AND MONITORING</span>
                    </button>
                    <a href="/employee/ticketing/ticketing">
                        <button class="action-btn">
                            <i class="fas fa-ticket-alt"></i>
                            <span>TICKETING</span>
                        </button>
                    </a>
                    <a href="/employee/ticketing/notice">
                        <button class="action-btn">
                            <i class="fas fa-bell"></i>
                            <span>NOTICE</span>
                        </button>
                    </a>
                </div>
            </div>

            <!-- Notice Details Section -->
            <div class="notice-details">
                @forelse ($tickets as $ticket)
                    <div class="notice-card">
                        <h3>#{{ $ticket->control_no }}</h3>
                        <div class="notice-info">
                            <p><strong>Time In:</strong> {{ $ticket->TimeIn }}</p>
                            <p><strong>Department:</strong> {{ $ticket->Department }}</p>
                            <p><strong>Technical Supported by:</strong> 
                                @if($ticket->technicalSupport)
                                    {{ $ticket->technicalSupport->FirstName }} {{ $ticket->technicalSupport->LastName }}
                                @else
                                    No technical support assigned
                                @endif
                            </p>
                        </div>

                        <!-- Action Buttons - Positioned on the Right but Aligned with Content -->
                        <div class="action-buttons">
                            <button class="chat-btn" onclick="openChatBox('{{ $ticket->technicalSupport->FirstName }} {{ $ticket->technicalSupport->LastName }}')">
                                <i class="fa fa-comments"></i> Chat
                            </button>
                            <button class="remarks-btn">
                                <i class="fa fa-pencil-alt"></i> Feedback
                            </button>
                        </div>
                    </div>
                @empty
                <p class="empty-message">You didn't submit a Ticket</p>
                @endforelse
            </div>

            <!-- Chatbox for Technical Support -->
            <div id="chatbox" class="chatbox hidden">
                <div class="chatbox-header">
                    <h3 id="chatbox-employee-name">Technical Support Chat</h3>
                    <button class="close-btn" onclick="closeChatBox()">×</button>
                </div>
                <div class="chatbox-body">
                    <!-- Chat messages will go here -->
                </div>
                <div class="chatbox-footer">
                    <input type="text" id="chat-input" placeholder="Type a message..." />
                    <button id="send-btn">Send</button>
                </div>
            </div>

            <!-- Menu (hidden by default) -->
            <div class="menu" id="menu" style="display: none;">
                <ul>
                    <li><a href="/profile">Profile</a></li>
                    <li><a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
                </ul>
            </div>

            <!-- Hidden Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <script src="{{ asset('js/employee/ticketing/noticejavascript.js') }}"></script>
</body>
</html>
