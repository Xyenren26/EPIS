<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="../css/ticketing/taskstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar minimized">
            <div class="sidebar-header">
                <button class="minimize-btn" onclick="toggleSidebar()"></button> <!-- Hamburger icon for minimize button -->
            </div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search..." />
                <button class="search-btn" onclick="toggleSearchPopup()">🔍</button> <!-- Search button -->
            </div>
            <div class="nav-links">
                <div class="nav-item">
                    <a href="/home" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-home nav-logo"></i> <!-- Home icon -->
                            <span class="nav-label">HOME</span> <!-- Home label -->
                        </div>
                        <span class="nav-text">HOME</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/in-inventory" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-boxes nav-logo"></i> <!-- Inventory icon -->
                            <span class="nav-label">INVENTORY</span> <!-- Inventory label -->
                        </div>
                        <span class="nav-text">INVENTORY</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/profile" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-user nav-logo"></i> <!-- Profile icon -->
                            <span class="nav-label">PROFILE</span> <!-- Profile label -->
                        </div>
                        <span class="nav-text">PROFILE</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/contact" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-envelope nav-logo"></i> <!-- Contact icon -->
                            <span class="nav-label">CONTACT</span> <!-- Contact label -->
                        </div>
                        <span class="nav-text">CONTACT</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/admin" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-cog nav-logo"></i> <!-- Admin icon -->
                            <span class="nav-label">ADMIN</span> <!-- Admin label -->
                        </div>
                        <span class="nav-text">ADMIN</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <div class="header">
                <button class="back-btn" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i> 
                </button> <!-- Back button -->
                <h1>TASK MANAGEMENT</h1>
                <div class="menu-logo-container">
                    <button class="menu-btn" onclick="toggleMenu()">⋮</button>
                    <img src="{{ asset('images/LoginImages/pasiglogo.png') }}" alt="Pasig Logo" class="pasig-logo">
                </div>
            </div>

            <!-- Functional Button Section -->
            <div class="functional-button-section">
                <div class="button-container">
                    <a href="/report_and_monitoring">
                        <button class="action-btn">
                            <i class="fas fa-chart-bar"></i>
                            <span>REPORT AND MONITORING</span>
                        </button>
                    </a>
                    <a href="/ticketing/ticketing">
                        <button class="action-btn">
                            <i class="fas fa-ticket-alt"></i>
                            <span>TICKETING</span>
                        </button>
                    </a>
                    <a href="/ticketing/task">
                        <button class="action-btn">
                            <i class="fas fa-bell"></i>
                            <span>TASK</span>
                        </button>
                    </a>
                </div>
            </div>

            <!-- Task Details Section -->
            <div class="task-details">
                @forelse ($tickets as $ticket)
                    <div class="task-card">
                        <h3>#{{ $ticket->control_no }}</h3>
                        <div class="task-info">
                            <p><strong>Time In:</strong> {{ $ticket->TimeIn }}</p>
                            <p><strong>Catergory:</strong> {{ $ticket->Category }}</p>
                            <p><strong>Department:</strong> {{ $ticket->Department }}</p>
                            <p><strong>Issued By:</strong> {{ $ticket->fname }} {{ $ticket->lname }}</p>
                        </div>

                        <!-- Action Buttons - Positioned on the Right but Aligned with Content -->
                        
                        <!-- Chat Button -->
                        <div class="action-buttons">
                            <button class="followup-btn" onclick="showFollowUpPopup('{{ $ticket->fname }} {{ $ticket->lname }}', '{{ $ticket->EmployeeID }}', '{{ $ticket->Department }}')">
                                <i class="fa fa-bell"></i> Follow-Up
                            </button>
                            <button class="chat-btn" onclick="openChatBox('{{ $ticket->fname }} {{ $ticket->lname }}')">
                                <i class="fa fa-comments"></i> Chat
                            </button>
                            <button class="remarks-btn" onclick="showRemarksPopup('{{ $ticket->control_no }}', '{{ $ticket->Concern }}')">
                                <i class="fa fa-pencil-alt"></i> Remarks
                            </button>
                        </div>
                    </div>
                @empty
                <p class="empty-message">No tasks assigned to you at this time.</p>
                @endforelse
            </div>
            
            <!-- Chatbox -->
            <div id="chatbox" class="chatbox hidden">
                <div class="chatbox-header">
                    <h3 id="chatbox-employee-name">Chat</h3>
                    <button class="close-btn" onclick="closeChatBox()">×</button>
                </div>
                <div class="chatbox-body" id="chatbox-messages">
                    <!-- Chat messages will appear here -->
                    <p class="message user">Hello! How can I help you?</p>
                    <p class="message agent">I need assistance with my account.</p>
                </div>
                <div class="chatbox-footer">
                    <input type="text" id="chat-input" placeholder="Type a message..." />
                    <button id="send-btn">Send</button>
                </div>
            </div>

            <!-- Follow-Up and Remarks Pop-Up -->
            <div id="remarksPopup" class="popup hidden">
                <div class="popup-header">
                    <h3>REMARKS</h3>
                    <button class="popup-close" onclick="closeRemarksPopup()">×</button> <!-- Close button -->
                </div>
                <div class="popup-body">
                    <p><strong>Control No.:</strong> <span id="controlNo" class="control-no"></span></p>
                    <div class="concern-box">
                        <p><strong>Concern:</strong></p>
                        <div class="concern-content">Data for concern will be shown here.</div>
                    </div>
                    <div class="remarks-box">
                        <p><strong>Remarks:</strong></p>
                        <textarea class="remarks-input" placeholder="Enter your remarks here..."></textarea>
                    </div>
                    <div class="popup-footer">
                        <button class="mark-done-btn">Mark as Done</button>
                    </div>
                </div>
            </div>

            <!-- Follow-Up Pop-Up -->
            <div id="followUpPopup" class="popup hidden">
                <div class="popup-header">
                    <h3>FOLLOW-UP</h3>
                    <button class="popup-close" onclick="closeFollowUpPopup()">×</button> <!-- Close button -->
                </div>
                <div class="popup-body">
                    <div class="employee-details">
                        <p><strong>Employee Name:</strong></p>
                        <div class="input-box">
                            <span id="employeeName">[Employee Name]</span>
                        </div>
                        <p><strong>Employee ID:</strong></p>
                        <div class="input-box">
                            <span id="employeeID">[Employee ID]</span>
                        </div>
                        <p><strong>Department:</strong></p>
                        <div class="input-box">
                            <span id="employeeDepartment">[Department]</span>
                        </div>
                    </div>

                    <div class="follow-up-section">
                        <p><strong>Follow-Up:</strong></p>
                        <textarea id="followUpInput" class="input-box" placeholder="Enter your follow-up details here..."></textarea>
                    </div>

                    <div class="popup-footer">
                        <button class="submit-btn" onclick="submitFollowUp()">Submit</button>
                    </div>
                </div>
            </div>

            <!-- Search Pop-Up (hidden by default) -->
            <div class="search-popup" id="searchPopup">
                <div class="search-popup-header">
                    SEARCH
                    <button class="search-popup-close" onclick="closeSearchPopup()">×</button> <!-- Close Button -->
                </div>
                <input type="text" class="search-popup-input" placeholder="Enter your query here...">
                <button class="search-popup-submit">Search</button>
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
    <script src="../js/ticketing/taskjavascript.js"></script>
</body>
</html>
