<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - Travio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .admin-header {
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .admin-header i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 1rem;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-admin {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .admin-footer {
            text-align: center;
            padding: 1rem;
            background: #f8f9fa;
        }
        .alert {
            border: none;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="admin-register-card">
        <div class="admin-header">
            <i class="fas fa-user-shield"></i>
            <h3>Daftar Admin</h3>
            <p class="mb-0">Travio Management System</p>
        </div>
        
        <div class="p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.register') }}">
                @csrf
                
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-user text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" name="name" 
                               placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-envelope text-muted"></i>
                        </span>
                        <input type="email" class="form-control border-start-0" name="email" 
                               placeholder="Email Admin" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-lock text-muted"></i>
                        </span>
                        <input type="password" class="form-control border-start-0" name="password" 
                               placeholder="Password (min 8 karakter)" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-lock text-muted"></i>
                        </span>
                        <input type="password" class="form-control border-start-0" name="password_confirmation" 
                               placeholder="Konfirmasi Password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-admin">
                    <i class="fas fa-user-plus me-2"></i>
                    Daftar Admin
                </button>
            </form>
        </div>

        <div class="admin-footer">
            <p class="text-muted mb-0">
                <small>Sudah punya akun admin? 
                    <a href="{{ route('admin.login') }}" class="text-decoration-none">Login di sini</a>
                </small>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>