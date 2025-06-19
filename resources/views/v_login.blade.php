<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teh Boston - Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #073716;
            --primary-medium: #0b581b;
            --primary-light: #c8e6c9;
            --accent-red: #dc3545;
            --light-bg: #f8f9fa;
            --success-bg: #d4edda;
            --success-color: #155724;
            --danger-bg: #f8d7da;
            --danger-color: #721c24;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e6f4e6 0%, var(--primary-light) 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
        }
        
        .container-main {
            width: 100%;
            max-width: 450px;
            padding: 0 15px;
            perspective: 1000px;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 35px;
            animation: fadeIn 1s ease;
        }
        
        .brand-header h1 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            font-weight: 700;
        }
        
        .container-auth {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            position: relative;
            height: auto;
        }
        
        .auth-card {
            width: 100%;
            backface-visibility: hidden;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(7, 55, 22, 0.2);
            background: white;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            transform-style: preserve-3d;
        }
        
        .login-card {
            transform: rotateY(0deg);
            z-index: 2;
            height: auto; /* Dynamic height */
        }
        
        .register-card {
            transform: rotateY(180deg);
            height: auto; /* Dynamic height */
            z-index: 1;
        }
        
        .container-auth.flipped .login-card {
            transform: rotateY(-180deg);
        }
        
        .container-auth.flipped .register-card {
            transform: rotateY(0deg);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 25px 20px;
            text-align: center;
            color: white;
            position: relative;
            border-bottom: 5px solid var(--primary-dark);
        }
        
        .card-header h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .card-header p {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .card-body {
            padding: 30px;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
            width: 100%;
        }
        
        .input-group {
            display: flex;
            align-items: center;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .input-group:focus-within {
            border-color: var(--primary-medium);
            box-shadow: 0 0 0 4px rgba(11, 88, 27, 0.2);
        }
        
        .input-group i {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-dark);
            color: white;
            font-size: 1.3rem;
        }
        
        .form-control {
            flex: 1;
            height: 55px;
            border: none;
            padding: 0 15px;
            font-size: 1rem;
            outline: none;
            background-color: var(--light-bg);
        }
        
        .form-control:focus {
            box-shadow: none;
            background-color: white;
        }

        .btn-submit {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            border: none;
            height: 55px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 1.15rem;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .btn-submit i {
            margin-right: 10px;
        }
        
        .btn-submit:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--primary-dark));
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(7, 55, 22, 0.35);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.95rem;
        }
        
        .form-footer a {
            color: var(--primary-medium);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .form-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .tea-decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.08;
            width: 120px;
            pointer-events: none;
        }
        
        .tea-leaf-1 {
            top: 8%;
            left: 3%;
            transform: rotate(-20deg);
        }
        
        .tea-leaf-2 {
            bottom: 10%;
            right: 3%;
            transform: rotate(30deg);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px) rotate(var(--initial-rotation, 0deg)); }
            50% { transform: translateY(-15px) rotate(var(--initial-rotation, 0deg)); }
            100% { transform: translateY(0px) rotate(var(--initial-rotation, 0deg)); }
        }

        .tea-leaf-1 { --initial-rotation: -20deg; }
        .tea-leaf-2 { --initial-rotation: 30deg; }
        
        .flip-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: var(--primary-medium);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .flip-link:hover {
            text-decoration: underline;
            transform: scale(1.02);
        }
        
        .error-message {
            color: var(--accent-red);
            font-size: 0.85rem;
            margin-top: 8px;
            display: block;
            text-align: left;
        }
        
        .is-invalid .input-group {
            border-color: var(--accent-red) !important;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2) !important;
        }
        
        .invalid-feedback {
            display: block; /* ensure it's visible when error */
            color: var(--accent-red);
            font-size: 0.85rem;
            margin-top: 8px;
        }
        
        /* Loading spinner */
        .spinner {
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            display: none;
            margin-right: 10px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Alert Messages */
        .alert-message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            opacity: 0; /* Start hidden for animation */
            transition: opacity 0.5s ease-in-out;
        }

        .alert-message.show {
            opacity: 1;
        }
        
        .alert-message.alert-success {
            background-color: var(--success-bg);
            color: var(--success-color);
        }
        
        .alert-message.alert-danger {
            background-color: var(--danger-bg);
            color: var(--danger-color);
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .container-main {
                max-width: 100%;
                padding: 0 15px;
            }

            .brand-header h1 {
                font-size: 2.2rem;
            }
            
            .login-card {
                height: auto;
            }
            
            .register-card {
                height: auto;
            }
            
            .card-header {
                padding: 20px 15px;
            }
            
            .card-header h2 {
                font-size: 1.8rem;
            }
            
            .card-header p {
                font-size: 0.95rem;
            }
            
            .card-body {
                padding: 25px;
            }
            
            .input-group i {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
            
            .form-control {
                height: 50px;
                font-size: 0.95rem;
            }
            
            .btn-submit {
                height: 50px;
                font-size: 1.05rem;
            }
            
            .tea-decoration {
                width: 100px;
            }
        }
        
        @media (max-width: 576px) {
            body {
                padding: 15px;
            }

            .brand-header {
                margin-bottom: 25px;
            }

            .brand-header h1 {
                font-size: 2rem;
            }

            .login-card {
                height: auto;
            }
            
            .register-card {
                height: auto;
            }
            
            .card-header h2 {
                font-size: 1.6rem;
            }
            
            .card-header p {
                font-size: 0.9rem;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .input-group i {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
            
            .form-control {
                height: 45px;
                font-size: 0.9rem;
            }
            
            .btn-submit {
                height: 45px;
                font-size: 1rem;
            }
            
            .tea-decoration {
                width: 80px;
            }
        }

        /* Landscape orientation for mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            body {
                padding: 10px;
                justify-content: flex-start;
            }
            
            .brand-header {
                margin-bottom: 10px;
            }
            
            .brand-header h1 {
                font-size: 1.8rem;
            }
            
            .login-card, .register-card {
                position: relative;
                height: auto;
                max-height: 80vh;
                overflow-y: auto;
            }
            
            .card-body {
                padding: 15px;
            }
            
            .form-group {
                margin-bottom: 10px;
            }
            
            .input-group i {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .form-control {
                height: 40px;
                font-size: 0.85rem;
            }
            
            .btn-submit {
                height: 40px;
                font-size: 0.9rem;
            }
            
            .form-footer {
                margin-top: 10px;
            }
            
            .tea-decoration {
                display: none;
            }
        }
    </style>
</head>
<body>
    <img src="https://cdn-icons-png.flaticon.com/512/2346/2346705.png" class="tea-decoration tea-leaf-1 floating" alt="Tea leaf">
    <img src="https://cdn-icons-png.flaticon.com/512/2346/2346705.png" class="tea-decoration tea-leaf-2 floating" alt="Tea leaf">
    
    <div class="container-main">
        <div class="brand-header">
            <h1>Teh Boston</h1>
        </div>
        
        <div class="container-auth" id="authContainer">
            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="alert-message alert-success" id="successAlert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert-message alert-danger" id="errorAlert">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('status'))
                <div class="alert-message alert-success" id="statusAlert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="auth-card login-card" id="loginCard">
                <div class="card-header">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('login.proses') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <div class="input-group @error('username') is-invalid @enderror">
                                <i class="fas fa-user"></i>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
                            </div>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group @error('password') is-invalid @enderror">
                                <i class="fas fa-lock"></i>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn-submit">
                            <span class="spinner" id="loginSpinner"></span>
                            <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                        </button>
                    </form>
                    <div class="form-footer">
                        <p>Lupa password? <a href="{{ route('password.request') }}">Reset di sini</a></p>
                        <a class="flip-link" id="switchToRegister">
                            Belum punya akun? <strong>Daftar di sini</strong>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="auth-card register-card" id="registerCard">
                <div class="card-header">
                    <h2>Register</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('register.proses') }}" method="POST" id="registerForm"> {{-- Updated action route --}}
                        @csrf
                        <div class="form-group">
                            <div class="input-group @error('nama') is-invalid @enderror">
                                <i class="fas fa-user"></i>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                            </div>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group @error('email') is-invalid @enderror">
                                <i class="fas fa-envelope"></i>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group @error('no_hp') is-invalid @enderror">
                                <i class="fas fa-phone"></i>
                                <input type="text" class="form-control" name="no_hp" placeholder="No. HP" value="{{ old('no_hp') }}" required>
                            </div>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group @error('username') is-invalid @enderror">
                                <i class="fas fa-user-tag"></i>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
                            </div>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group @error('password') is-invalid @enderror">
                                <i class="fas fa-lock"></i>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <i class="fas fa-lock"></i>
                                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi Password" required>
                            </div>
                            <div class="error-message" id="passwordError"></div>
                        </div>
                        <button type="submit" class="btn-submit">
                            <span class="spinner" id="registerSpinner"></span>
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </button>
                    </form>
                    <div class="form-footer">
                        <a class="flip-link" id="switchToLogin">
                            Sudah punya akun? <strong>Masuk di sini</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="brand-footer" style="margin-top: 30px; text-align: center; color: var(--primary-medium); font-size: 0.9rem;">
            <p>© 2023 Teh Boston - Peluang Bisnis Franchise yang Menguntungkan</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const authContainer = document.getElementById('authContainer');
            const loginCard = document.getElementById('loginCard');
            const registerCard = document.getElementById('registerCard');
            
            // Function to set container height based on active card
            function setContainerHeight() {
                if (authContainer.classList.contains('flipped')) {
                    authContainer.style.height = registerCard.offsetHeight + 'px';
                } else {
                    authContainer.style.height = loginCard.offsetHeight + 'px';
                }
            }

            // Show alert messages with animation
            function showAlert(alertId) {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.classList.add('show');
                    setTimeout(() => {
                        alertElement.classList.remove('show');
                        alertElement.style.display = 'none'; // Hide after animation
                    }, 5000); // Hide after 5 seconds
                }
            }

            // Initial check for session messages and display them
            @if(session('success'))
                showAlert('successAlert');
            @endif
            @if(session('error'))
                showAlert('errorAlert');
            @endif
            @if(session('status'))
                showAlert('statusAlert');
            @endif


            // Switch to register form
            document.getElementById('switchToRegister').addEventListener('click', function(e) {
                e.preventDefault();
                authContainer.classList.add('flipped');
                setContainerHeight();
            });
            
            // Switch to login form
            document.getElementById('switchToLogin').addEventListener('click', function(e) {
                e.preventDefault();
                authContainer.classList.remove('flipped');
                setContainerHeight();
            });
            
            // Password confirmation validation for register form
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const passwordError = document.getElementById('passwordError');
            
            function validatePassword() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    passwordError.textContent = 'Konfirmasi password tidak cocok!';
                    confirmPasswordInput.closest('.input-group').classList.add('is-invalid');
                    return false;
                } else {
                    passwordError.textContent = '';
                    confirmPasswordInput.closest('.input-group').classList.remove('is-invalid');
                    return true;
                }
            }
            
            confirmPasswordInput.addEventListener('input', validatePassword);
            passwordInput.addEventListener('input', validatePassword);
            
            // Register form submission validation and spinner
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                // Clear previous validation styles/messages
                document.querySelectorAll('#registerForm .is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
                document.querySelectorAll('#registerForm .invalid-feedback').forEach(el => {
                    el.textContent = ''; // Clear text content
                });

                let isValid = true;

                // Client-side validation for required fields
                this.querySelectorAll('input[required]').forEach(input => {
                    if (!input.value.trim()) {
                        input.closest('.input-group').classList.add('is-invalid');
                        let feedback = input.closest('.form-group').querySelector('.invalid-feedback');
                        if (!feedback) { // Create if not exists (for password_confirmation primarily)
                            feedback = document.createElement('div');
                            feedback.classList.add('invalid-feedback');
                            input.closest('.form-group').appendChild(feedback);
                        }
                        feedback.textContent = 'Harap isi bidang ini.';
                        isValid = false;
                    }
                });

                if (!validatePassword()) { // Check password confirmation
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault(); // Stop form submission if validation fails
                    setContainerHeight(); // Re-adjust height if errors appear/disappear
                } else {
                    document.getElementById('registerSpinner').style.display = 'inline-block';
                    // Disable button to prevent multiple submissions
                    this.querySelector('.btn-submit').setAttribute('disabled', 'disabled');
                }
            });
            
            // Login form submission and spinner
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                document.getElementById('loginSpinner').style.display = 'inline-block';
                // Disable button to prevent multiple submissions
                this.querySelector('.btn-submit').setAttribute('disabled', 'disabled');
            });
            
            // Display any Laravel validation errors
            @if($errors->any())
                // Check if errors are primarily for registration fields
                @php
                    $isRegisterError = $errors->hasAny(['nama', 'email', 'no_hp', 'username', 'password_confirmation']);
                @endphp

                @if($isRegisterError)
                    authContainer.classList.add('flipped');
                @else
                    authContainer.classList.remove('flipped');
                @endif
                
                // Set height after potential flip
                setTimeout(setContainerHeight, 50); // Small delay to allow flip animation to start

                // Add invalid class to respective input groups
                @foreach($errors->keys() as $field)
                    @if($field === 'password' && $isRegisterError)
                        const inputElement = document.querySelector('#registerForm input[name="password"]');
                    @elseif($field === 'password')
                        const inputElement = document.querySelector('#loginForm input[name="password"]');
                    @else
                        const inputElement = document.querySelector('input[name="{{ $field }}"]');
                    @endif
                    
                    if (inputElement) {
                        inputElement.closest('.input-group').classList.add('is-invalid');
                    }
                @endforeach
            @endif
            
            // Set initial container height
            setContainerHeight(); // Call initially to set correct height
            
            // Handle orientation changes and window resize
            function handleOrientationChange() {
                if (window.matchMedia("(max-height: 500px) and (orientation: landscape)").matches) {
                    document.querySelectorAll('.tea-decoration').forEach(el => {
                        el.style.display = 'none';
                    });
                } else {
                    document.querySelectorAll('.tea-decoration').forEach(el => {
                        el.style.display = 'block';
                    });
                }
                setContainerHeight(); // Re-adjust height on resize/orientation change
            }
            
            // Initial check
            handleOrientationChange();
            
            // Add event listener for orientation changes
            window.addEventListener('resize', handleOrientationChange);
        });
    </script>
</body>
</html>