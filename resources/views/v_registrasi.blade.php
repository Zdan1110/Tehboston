<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Teh Boston</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #073716;
            --primary-medium: #0b581b;
            --primary-light: #c8e6c9;
            --accent-green: #28a745;
            --accent-red: #dc3545;
            --light-bg: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e6f4e6 0%, #c8e6c9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
            transition: background 0.5s ease;
        }
        
        .container-animated {
            width: 100%;
            max-width: 500px;
            animation: fadeInScale 0.8s ease-out;
            transform-origin: center;
        }
        
        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.95);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .card-custom {
            border-radius: 18px;
            border: none;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(7, 55, 22, 0.2);
            transition: all 0.5s ease;
            background: white;
            position: relative;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            padding: 25px 15px;
            text-align: center;
            border-bottom: 3px solid var(--primary-light);
            position: relative;
        }
        
        .card-header img {
            width: 120px;
            filter: drop-shadow(0 3px 5px rgba(0,0,0,0.2));
            transition: transform 0.5s ease;
        }
        
        .card-header:hover img {
            transform: rotate(5deg) scale(1.05);
        }
        
        .card-header h2 {
            color: white;
            margin-top: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 3px rgba(0,0,0,0.2);
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .input-group {
            margin-bottom: 5px;
        }
        
        .input-group-text {
            background: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 8px 0 0 8px !important;
            width: 45px;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .form-control {
            height: 50px;
            border: 2px solid #e9ecef;
            border-radius: 0 8px 8px 0 !important;
            padding-left: 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-medium);
            box-shadow: 0 0 0 0.25rem rgba(11, 88, 27, 0.2);
        }
        
        .form-control:focus + .input-group-text {
            background: var(--primary-medium);
            transform: scale(1.05);
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-medium));
            border: none;
            height: 50px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(7, 55, 22, 0.3);
            margin-top: 10px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-medium), var(--primary-dark));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(7, 55, 22, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .card-footer {
            background-color: var(--light-bg);
            border-top: 1px solid rgba(0,0,0,0.05);
            padding: 20px;
            text-align: center;
            border-radius: 0 0 18px 18px;
        }
        
        .card-footer a {
            color: var(--primary-medium);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
        }
        
        .card-footer a:hover {
            color: var(--primary-dark);
            text-decoration: none;
        }
        
        .card-footer a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: var(--primary-medium);
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease;
        }
        
        .card-footer a:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
        
        .tea-decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.15;
            transition: all 1s ease;
        }
        
        .tea-leaf-1 {
            top: 10%;
            left: 5%;
            width: 70px;
            transform: rotate(-20deg);
        }
        
        .tea-leaf-2 {
            bottom: 15%;
            right: 5%;
            width: 60px;
            transform: rotate(25deg);
        }
        
        .tea-leaf-3 {
            top: 40%;
            right: 15%;
            width: 50px;
            transform: rotate(60deg);
        }
        
        .tea-leaf-4 {
            bottom: 40%;
            left: 15%;
            width: 55px;
            transform: rotate(300deg);
        }
        
        .error-message {
            color: var(--accent-red);
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
            animation: shake 0.5s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .brand-text {
            color: var(--primary-medium);
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            font-weight: 500;
            opacity: 0;
            animation: fadeIn 1s ease 0.5s forwards;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        
        .brand-text span {
            font-weight: 700;
            color: var(--primary-dark);
        }
        
        .progress-container {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            margin: 15px 0;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, #ff6b6b, #ffd166, #06d6a0);
            width: 0%;
            transition: width 0.5s ease;
        }
        
        .password-strength {
            font-size: 0.85rem;
            text-align: right;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .strength-0 { width: 20%; background: #ff6b6b; }
        .strength-1 { width: 40%; background: #ff9e66; }
        .strength-2 { width: 60%; background: #ffd166; }
        .strength-3 { width: 80%; background: #8ac926; }
        .strength-4 { width: 100%; background: #06d6a0; }
        
        .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }
        
        .show-password:hover {
            color: var(--primary-medium);
        }
    </style>
</head>
<body>
    <!-- Dekorasi daun teh animasi -->
    <img src="https://cdn-icons-png.flaticon.com/512/2346/2346705.png" class="tea-decoration tea-leaf-1" alt="Tea leaf">
    <img src="https://cdn-icons-png.flaticon.com/512/2346/2346705.png" class="tea-decoration tea-leaf-2" alt="Tea leaf">
    <img src="https://cdn-icons-png.flaticon.com/512/2346/2346705.png" class="tea-decoration tea-leaf-3" alt="Tea leaf">
    <img src="https://cdn-icons-png.flaticon.com/512/2346/2346705.png" class="tea-decoration tea-leaf-4" alt="Tea leaf">

    <div class="container-animated">
        <div class="card card-custom">
            <!-- Header dengan animasi -->
            <div class="card-header">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8W7oiRio5Eh4_ppE0Pour4OVey07Wh2W8Ag&s" alt="Teh Boston Logo">
                <h2>Buat Akun Baru</h2>
            </div>

            <div class="card-body">
                <form id="registerForm" action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <!-- Nama -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    
                    <!-- No HP -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control" name="no_hp" placeholder="Masukkan No. HP" required>
                        </div>
                    </div>
                    
                    <!-- Username -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                        </div>
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                            <span class="show-password" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" id="passwordStrength"></div>
                        </div>
                        <div class="password-strength" id="strengthText">Kekuatan password: lemah</div>
                    </div>
                    
                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi Password" required>
                            <span class="show-password" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="error-message" id="passwordError">Konfirmasi password tidak cocok!</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </button>
                </form>
            </div>

            <div class="card-footer">
                <small>Sudah punya akun? <a href="/login" id="loginLink">Masuk disini</a></small>
            </div>
        </div>
        
        <div class="brand-text">
            Teh Boston &copy; 2023 - <span>Minuman Berkualitas, Varian Rasa Unik</span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi daun teh
            const teaLeaves = document.querySelectorAll('.tea-decoration');
            teaLeaves.forEach(leaf => {
                leaf.style.opacity = '0';
                setTimeout(() => {
                    leaf.style.transition = 'opacity 1s ease, transform 10s ease';
                    leaf.style.opacity = '0.15';
                }, 500);
            });
            
            // Toggle show password
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            // Password strength checker
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strengthBar = document.getElementById('passwordStrength');
                const strengthText = document.getElementById('strengthText');
                let strength = 0;
                
                if (password.length > 0) strength += 1;
                if (password.length >= 8) strength += 1;
                if (/[A-Z]/.test(password)) strength += 1;
                if (/[0-9]/.test(password)) strength += 1;
                if (/[^A-Za-z0-9]/.test(password)) strength += 1;
                
                strengthBar.className = 'progress-bar strength-' + (strength - 1);
                
                const strengthMessages = [
                    'Sangat lemah',
                    'Lemah',
                    'Sedang',
                    'Kuat',
                    'Sangat kuat'
                ];
                
                strengthText.textContent = 'Kekuatan password: ' + strengthMessages[strength];
            });
            
            // Password confirmation check
            confirmPasswordInput.addEventListener('input', function() {
                const password = document.getElementById('password').value;
                const errorElement = document.getElementById('passwordError');
                
                if (this.value !== password) {
                    errorElement.style.display = 'block';
                } else {
                    errorElement.style.display = 'none';
                }
            });
            
            // Form validation
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                const errorElement = document.getElementById('passwordError');
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    errorElement.style.display = 'block';
                    
                    // Shake animation for error
                    errorElement.style.animation = 'none';
                    setTimeout(() => {
                        errorElement.style.animation = 'shake 0.5s ease';
                    }, 10);
                }
            });
            
            // Simulate page transition for login link
            document.getElementById('loginLink').addEventListener('click', function(e) {
                e.preventDefault();
                
                // Animate the card out
                const card = document.querySelector('.card-custom');
                card.style.animation = 'fadeOutScale 0.5s ease forwards';
                
                // Change background
                document.body.style.background = 'linear-gradient(135deg, #c8e6c9 0%, #e6f4e6 100%)';
                
                // Redirect after animation
                setTimeout(() => {
                    window.location.href = this.href;
                }, 500);
            });
            
            // Add custom keyframe for fadeOutScale
            const styleSheet = document.styleSheets[0];
            styleSheet.insertRule(`
                @keyframes fadeOutScale {
                    0% {
                        opacity: 1;
                        transform: scale(1);
                    }
                    100% {
                        opacity: 0;
                        transform: scale(0.95);
                    }
                }
            `, styleSheet.cssRules.length);
        });
    </script>
</body>
</html>