<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepPal-Reset Password</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <style>
        /* CSS for Reset Password Page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        input {
            font-family: "Poppins", sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .input-field {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-field i {
            position: absolute;
            top: 12px;
            left: 10px;
            color: #999;
        }

        .input-field input {
            width: 100%;
            padding: 10px 10px 10px 30px;
            border-radius: 4px;
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-field input:focus {
            border-color: #5995fd;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #5995fd;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #4d84e2;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="title">Reset Password</h2>
            <form method="POST" action="{{ route('password.update') }}" class="reset-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" name="email" placeholder="E-Mail Address"
                        value="{{ old('email') }}" required autofocus
                        class="@error('email') is-invalid @enderror">
                    @error('email')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" name="password" placeholder="New Password" required
                        class="@error('password') is-invalid @enderror">
                    @error('password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password-confirm" type="password" name="password_confirmation"
                        placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn">Reset Password</button>
            </form>
        </div>
    </div>
</body>

</html>
