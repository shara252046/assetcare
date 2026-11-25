<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Login</title>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8fafc;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-container {
        display: flex;
        width: 900px;
        max-width: 95%;
        height: 550px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    /* 🌟 Left Side: Gradient Banner */
    .login-banner {
        flex: 1;
        background: linear-gradient(135deg, #1e3a8a, #2563eb, #3b82f6);
        color: #fff;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    /* Banner er vitore sundor abstract circles */
    .login-banner::before {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        top: -50px;
        left: -50px;
    }
    .login-banner::after {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        bottom: -30px;
        right: -30px;
    }
    .login-banner h1 {
        font-size: 36px;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }
    .login-banner p {
        font-size: 16px;
        line-height: 1.6;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }
    
    /* 🌟 Right Side: Login Form */
    .login-form-box {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .login-form-box h2 {
        color: #1e293b;
        font-size: 24px;
        margin-bottom: 8px;
    }
    .login-form-box p.subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 30px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        color: #475569;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 15px;
        background: #f8fafc;
        transition: all 0.3s;
    }
    .form-group input:focus {
        outline: none;
        border-color: #2563eb;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
    }
    .btn-login {
        width: 100%;
        padding: 14px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s, transform 0.1s;
        margin-top: 10px;
    }
    .btn-login:hover {
        background: #1d4ed8;
    }
    .btn-login:active {
        transform: scale(0.98);
    }
    .error-msg {
        background: #fef2f2;
        color: #dc2626;
        padding: 10px;
        border-radius: 8px;
        font-size: 14px;
        margin-bottom: 20px;
        text-align: center;
        border: 1px solid #fecaca;
    }
    
    /* 📱 Mobile Responsive */
    @media (max-width: 768px) {
        .login-banner { display: none; }
        .login-container { height: auto; }
        .login-form-box { padding: 30px; }
    }
</style>
</head>
<body>
<div class="login-container">
    
    <!-- Left Side Banner -->
    <div class="login-banner">
        <h1>AssetCare</h1>
        <p>Smart Asset & Maintenance Tracker with Predictive Reminders. Manage your assets, tickets, and maintenance all in one place.</p>
    </div>

    <!-- Right Side Form -->
    <div class="login-form-box">
        <h2>Welcome Back</h2>
        <p class="subtitle">Please sign in to your account</p>

        @if ($errors->any())
            <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn-login">Sign In</button>
        </form>
    </div>

</div>
</body>
</html>