<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <title>Management Information System Office Website</title>
    <link rel="stylesheet" href="css/loginstyle.css">
</head>
<body>
    
    <h1 class="main-heading">WELCOME TO MANAGMENT INFORMATION SYSTEM OFFICE <br>
                            TECHNICAL SUPPORT DIVISION</h1>
    <div class="header">
        <h1 class="subheading">
            <span class="epis">E</span><span>IMS</span>: <span>E</span>lectronic <span>I</span>nventory <span>M</span>anagement <span>S</span>ystem
        </h1>
        <img src="images/LoginImages/pasiglogo.png" alt="Pasig Logo" class="logo">
    </div>

    <div class="container">
        <div class="image-container">
            <img src="images/LoginImages/bpasig-city.jpg" alt="Image Description">
        </div>

        <div class="login-container" data-aos="fade-up">
            <h2>Login</h2>

            @if ($errors->has('login'))
                <div class="error-message">{{ $errors->first('login') }}</div>
            @endif
            
            <form action="{{ url('/login') }}" method="post">
                @csrf
                <div class="input-group" data-aos="fade-up">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                </div>
                <div class="input-group" data-aos="fade-up">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="remember-me" data-aos="fade-up">
                    <input type="checkbox" name="remember" id="remember" checked>
                    <label for="remember">Remember Me</label>

                    <a href="/forgotpassword" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" class="login-btn" data-aos="fade-up">Login</button>
            </form>
            
            <div class="links">
                <p>Don't have an account? <a href="/signup" class="sign-up">Sign Up</a></p>
            </div>
        </div>
    </div>

    <div class="about-container" data-aos="fade-up">
        <h2>MIS - Technical Support Division</h2>
        <p>
            The Technical Support Division under the <strong>Management Information System Office (MISO)</strong> offers comprehensive IT support services to all departments of the Pasig City government. Our team ensures that all technical systems, hardware, and software are fully functional, providing immediate assistance for troubleshooting, system maintenance, and technical guidance.
        </p>
        <p>
            We are committed to resolving technical issues promptly to ensure the smooth operation of all digital platforms and services used by the city government, contributing to efficient public service delivery.
        </p>
    </div>

    <script src="js/loginjavascript.js"></script>
    <script> AOS.init(); </script>
</body>
</html>
