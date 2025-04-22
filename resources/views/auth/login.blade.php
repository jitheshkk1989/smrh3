<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMRH Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            display: flex;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 950px; /* Slightly wider */
            width: 95%;
        }

        .login-form-container {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-illustration {
            flex: 1;
            background-color: #e6f7ff; /* Very light blue for illustration area */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .login-illustration img {
            max-width: 80%; /* Adjust image size */
            height: auto;
        }

        .login-type-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .login-type-tab {
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
            color: #555;
            border: none;
            background-color: transparent;
            border-bottom: 2px solid transparent;
        }

        .login-type-tab.active {
            color: #1976d2; /* Primary blue */
            border-bottom: 2px solid #1976d2;
        }

        .form-group label {
            margin-top: 10px;
            margin-bottom: 5px;
            display: block;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            border-radius: 5px;
            padding: 10px 20px;
            background-color: #1976d2;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%; /* Full width button */
        }

        .btn-primary:hover {
            background-color: #1565c0;
        }

        .form-check {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .form-check-label {
            color: #555;
        }

        .mt-3 {
            margin-top: 1.5rem !important;
        }

        .text-center {
            text-align: center !important;
            color: #777;
            font-size: 0.9rem;
        }

        .mt-2 {
            margin-top: 0.5rem !important;
        }

        .btn-link {
            text-decoration: none !important;
            color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form-container">
            <div class="text-center mb-3">
                <img src="{{ asset('images/hrms-logo.png') }}" alt="SMRH Logo" style="max-width: 150px; height: auto;">
            </div>
            <div class="login-type-tabs">
                <button class="login-type-tab active" onclick="showTab('administrator')">Administrator</button>
                <button class="login-type-tab" onclick="showTab('employee')">Employee</button>
            </div>

            <div id="administrator-tab">
                <h3 class="card-title text-center mb-3">Administrator Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Keep me logged in
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                    <div class="mt-3 text-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div id="employee-tab" style="display: none;">
                <h3 class="card-title text-center mb-3">Employee Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="employee_id">Employee ID</label>
                        <input type="text" class="form-control" id="employee_id" name="employee_id" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_employee">
                        <label class="form-check-label" for="remember_employee">
                            Keep me logged in
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                    <div class="mt-3 text-center">
                        <a class="btn btn-link" href="#">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="login-illustration">
            <img src="{{ asset('images/login-illustration.png') }}" alt="Login Illustration" style="max-height: 300px;">
        </div>
    </div>

    <script>
        function showTab(tabId) {
            const administratorTab = document.getElementById('administrator-tab');
            const employeeTab = document.getElementById('employee-tab');
            const administratorButton = document.querySelector('.login-type-tabs button:first-child');
            const employeeButton = document.querySelector('.login-type-tabs button:last-child');

            if (tabId === 'administrator') {
                administratorTab.style.display = 'block';
                employeeTab.style.display = 'none';
                administratorButton.classList.add('active');
                employeeButton.classList.remove('active');
            } else if (tabId === 'employee') {
                administratorTab.style.display = 'none';
                employeeTab.style.display = 'block';
                administratorButton.classList.remove('active');
                employeeButton.classList.add('active');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>