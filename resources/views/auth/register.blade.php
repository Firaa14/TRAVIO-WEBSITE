<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Travio') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 450px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(103, 126, 234, 0.1), transparent);
            animation: rotate 6s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .logo p {
            color: #64748b;
            font-size: 14px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .form-control.error {
            border-color: #ef4444;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            20%,
            40%,
            60%,
            80% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
            z-index: 1;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 15px;
            color: #64748b;
            font-size: 14px;
            position: relative;
            z-index: 2;
        }

        .auth-links {
            text-align: center;
        }

        .auth-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 5px;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            width: 0%;
        }

        .strength-weak {
            background: #ef4444;
            width: 25%;
        }

        .strength-fair {
            background: #f59e0b;
            width: 50%;
        }

        .strength-good {
            background: #3b82f6;
            width: 75%;
        }

        .strength-strong {
            background: #10b981;
            width: 100%;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .logo h1 {
                font-size: 28px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .btn-primary.loading .loading {
            display: inline-block;
        }

        .terms {
            font-size: 12px;
            color: #64748b;
            margin: 15px 0;
            text-align: center;
            line-height: 1.4;
        }

        .terms a {
            color: #667eea;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="logo">
            <h1>Join Travio</h1>
            <p>Create your account to get started</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" id="registerForm">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') error @enderror"
                    value="{{ old('name') }}" placeholder="Enter your full name" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') error @enderror"
                        value="{{ old('email') }}" placeholder="Enter your email" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone (Optional)</label>
                    <input type="text" id="phone" name="phone" class="form-control @error('phone') error @enderror"
                        value="{{ old('phone') }}" placeholder="08123456789">
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') error @enderror" placeholder="Create a strong password"
                    required>
                <div class="password-strength">
                    <span id="strength-text">Password strength</span>
                    <div class="strength-bar">
                        <div class="strength-fill" id="strength-fill"></div>
                    </div>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-control @error('password_confirmation') error @enderror"
                    placeholder="Confirm your password" required>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="terms">
                By creating an account, you agree to our
                <a href="#" target="_blank">Terms of Service</a> and
                <a href="#" target="_blank">Privacy Policy</a>
            </div>

            <button type="submit" class="btn-primary" id="submitBtn">
                <span class="loading"></span>
                Create Account
            </button>
        </form>

        <div class="divider">
            <span>Already have an account?</span>
        </div>

        <div class="auth-links">
            <a href="{{ route('login') }}">Sign in to your account</a>
        </div>
    </div>

    <script>
        // Form submission loading state
        document.getElementById('registerForm').addEventListener('submit', function () {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthText = document.getElementById('strength-text');
        const strengthFill = document.getElementById('strength-fill');

        passwordInput.addEventListener('input', function () {
            const password = this.value;
            const strength = checkPasswordStrength(password);

            strengthFill.className = 'strength-fill';

            if (password.length === 0) {
                strengthText.textContent = 'Password strength';
                return;
            }

            switch (strength.level) {
                case 1:
                    strengthFill.classList.add('strength-weak');
                    strengthText.textContent = 'Weak password';
                    break;
                case 2:
                    strengthFill.classList.add('strength-fair');
                    strengthText.textContent = 'Fair password';
                    break;
                case 3:
                    strengthFill.classList.add('strength-good');
                    strengthText.textContent = 'Good password';
                    break;
                case 4:
                    strengthFill.classList.add('strength-strong');
                    strengthText.textContent = 'Strong password';
                    break;
            }
        });

        function checkPasswordStrength(password) {
            let score = 0;

            if (password.length >= 6) score++;
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
            if (/\d/.test(password)) score++;
            if (/[^a-zA-Z0-9]/.test(password)) score++;

            return {
                level: Math.min(Math.max(score - 1, 1), 4),
                score: score
            };
        }

        // Password confirmation validation
        const confirmPassword = document.getElementById('password_confirmation');

        confirmPassword.addEventListener('input', function () {
            if (passwordInput.value && this.value) {
                if (passwordInput.value !== this.value) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#10b981';
                }
            }
        });

        // Input focus animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function () {
                this.parentElement.classList.remove('focused');
            });
        });

        // Auto-hide alerts
        setTimeout(function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>

</html>