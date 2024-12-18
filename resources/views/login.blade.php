<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>

    <title>Management Information System Office Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
	
	<h1 class="main-heading">Welcome to MIS - Technical Support Division</h1>
	<h1 class="subheading">E-PIS: Enhance Pasig Inventory System</h1>
	
    <img src="C:\Users\rogelio\OneDrive\Documents\Homepage\picture\pasiglogo.png" alt="Logo" class="logo">
    
    <div class="login-container" data-aos="fade-up">
        <h2>Login</h2>
        <form action="#" method="post">
            <div class="input-group"data-aos="fade-up">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group"data-aos="fade-up">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
	<div class="links">
			<a href="forgot-password.html" class="forgot-password"data-aos="fade-up">Forgot Password?</a>
        </div>
            <button type="submit" class="login-btn"data-aos="fade-up">Login</button>
        </form>
        <div class="links">
            <p>Don't have an account? <a href="signup.html" class="sign-up">Sign Up</a></p>
        </div>
    </div>
	    <div class="about-container " data-aos="fade-up">
        <h2>MIS - Technical Support Division</h2>
        <p>
            The Technical Support Division under the <strong>Management Information System Office (MISO)</strong> offers comprehensive IT support services to all departments of the Pasig City government. Our team ensures that all technical systems, hardware, and software are fully functional, providing immediate assistance for troubleshooting, system maintenance, and technical guidance.
        </p>
        <p>
            We are committed to resolving technical issues promptly to ensure the smooth operation of all digital platforms and services used by the city government, contributing to efficient public service delivery.
        </p>
    </div>

<script src="script.js"></script>
<script> AOS.init(); </script>

</body>
</html>
