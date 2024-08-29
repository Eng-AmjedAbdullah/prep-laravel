<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
    <title>PrepPal-Login</title>
</head>
<body>
    <div class="container" >

        <div class="forms-container">

            <div class="signin-signup">
                <!-- Sign In Form -->
                  <!-- Display success or error messages -->
        @if(Session::has('success'))
        <div class="alert alert-success float-right ">
            {{ Session::get('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger float-right">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

                <form action="{{ route('login') }}" method="POST" class="sign-in-form">
                    @csrf
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <!-- Aligning Remember Me and Forgot Password -->
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember" />
                            <label for="remember">Remember Me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                    <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="{{ url('login/facebook') }}" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ url('login/google') }}" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="{{ url('login/apple') }}" class="social-icon">
                            <i class="fab fa-apple"></i>
                        </a>
                    </div>
                </form>

                <!-- Sign Up Form -->
                <form action="{{ route('register') }}" method="POST" class="sign-up-form">
                    @csrf
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="number" name="age" id="age" placeholder="Age" required  min="4" max="100" />
                    </div>
                    <div class="input-field" id="parent-email-field" style="display: none;">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="parent_email" placeholder="Parent's Email" />
                    </div>
                    <input type="submit" class="btn" value="Sign up" />
                    <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="{{ url('login/facebook') }}" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ url('login/google') }}" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="{{ url('login/apple') }}" class="social-icon">
                            <i class="fab fa-apple"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here?</h3>
                    <p>Ready to empower yourself and your loved ones with knowledge?
                        Sign up now and start learning how to stay safe in any emergency.</p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="logo.png" class="image" alt="Sign up"   />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Already part of the PrePal family?</h3>
                    <p> Welcome back! Sign in to continue your journey towards becoming a preparedness pro.
                        Your safety adventure awaits!</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="logo.png" class="image" alt="Sign in" />
            </div>
        </div>
    </div>
    <script src="app.js"></script>
    <script>
        // JavaScript to handle the toggling of forms and age input field
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");
        const ageInput = document.getElementById('age');
        const parentEmailField = document.getElementById('parent-email-field');

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

        ageInput.addEventListener('input', function() {
            if (this.value < 13) {
                parentEmailField.style.display = 'block';
            } else {
                parentEmailField.style.display = 'none';
            }
        });
    </script>
</body>
</html>
