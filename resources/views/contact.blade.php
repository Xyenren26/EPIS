<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="css/contactstyle.css">
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
                <button class="search-btn">🔍</button> <!-- Search button -->
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
                </button>
                <h1>CONTACT > OFFICIALS</h1>
                <button class="menu-btn" onclick="toggleMenu()">⋮</button>
            </div>

            <!-- Officials Box -->
            <div class="officials-box">
                <h2>Mayor</h2>
                <div class="official">
                    <img src="{{ asset('images/officials/vico_sotto.jpg') }}" alt="Vico Sotto">
                    <p>Vico Sotto</p>
                </div>

                <h2>Vice Mayor</h2>
                <div class="official">
                    <img src="{{ asset('images/officials/robert_jaworski_jr.jpg') }}" alt="Robert Jaworski Jr.">
                    <p>Robert Jaworski Jr.</p>
                </div>

                <h2>Sangguniang Panlungsod</h2>

                <h3>First District</h3>
                <div class="district">
                    <div class="official">
                        <img src="{{ asset('images/officials/kiko_rustia.jpg') }}" alt="Kiko Rustia">
                        <p>Kiko Rustia (NPC)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/simon_romulo_tantoco.jpg') }}" alt="Simon Romulo Tantoco">
                        <p>Simon Romulo Tantoco (NPC)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/pao_santiago.jpg') }}" alt="Pao Santiago">
                        <p>Pao Santiago (NPC)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/volta_delos_santos.jpg') }}" alt="Volta Delos Santos">
                        <p>Volta Delos Santos (NPC)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/eric_gonzales.jpg') }}" alt="Eric Gonzales">
                        <p>Eric Gonzales (NPC)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/reggie_balderrama.jpg') }}" alt="Reggie Balderrama">
                        <p>Reggie Balderrama (PDDS)</p>
                    </div>
                </div>

                <h3>Second District</h3>
                <div class="district">
                    <div class="official">
                        <img src="{{ asset('images/officials/angelu_de_leon.jpg') }}" alt="Angelu De Leon">
                        <p>Angelu De Leon (Aksyon)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/corie_raymundo.jpg') }}" alt="Corie Raymundo">
                        <p>Corie Raymundo (NPC)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/syvel_asilo.jpg') }}" alt="Syvel Asilo">
                        <p>Syvel Asilo (NP)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/buboy_agustin.jpg') }}" alt="Buboy Agustin">
                        <p>Buboy Agustin (Aksyon)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/quin_cruz.jpg') }}" alt="Quin Cruz">
                        <p>Quin Cruz (Aksyon)</p>
                    </div>
                    <div class="official">
                        <img src="{{ asset('images/officials/maro_martires.jpg') }}" alt="Maro Martires">
                        <p>Maro Martires (NPC)</p>
                    </div>
                </div>

                <h2>Ex-Officio Members</h2>
                <div class="official">
                    <img src="{{ asset('images/officials/marl_oscar_de_guzman.jpg') }}" alt="Marl Oscar de Guzman">
                    <p>Marl Oscar de Guzman – President, Liga ng mga Barangay (LNB)</p>
                </div>
                <div class="official">
                    <img src="{{ asset('images/officials/georgia_lynne_clemente.jpg') }}" alt="Georgia Lynne Clemente">
                    <p>Georgia Lynne P. Clemente – President, Sangguniang Kabataan Federation</p>
                </div>

                <h2>Congressman (Lone District)</h2>
                <div class="official">
                    <img src="{{ asset('images/officials/roman_romulo.jpg') }}" alt="Roman Romulo">
                    <p>Roman Romulo</p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/contactjavascript.js"></script>
</body>
</html>