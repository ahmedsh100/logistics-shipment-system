<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - نظام تتبع الشحنات</title>
    <!-- Bootstrap 5 CSS (RTL) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-dpuaG1suBy+9clQFzSbyI-J8yVMB4AqP30luVOQ9KvNG7wRPwI0zf1RAVAR7kSZY" crossorigin="anonymous">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            min-height: calc(100vh - 40px);
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%) !important;
            border-radius: 15px 15px 0 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 5px;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .content-wrapper {
            padding: 30px;
            min-height: calc(100vh - 200px);
        }
        
        .footer-custom {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            border-radius: 0 0 15px 15px;
            margin-top: auto;
        }
        
        .btn-custom {
            border-radius: 25px;
            font-weight: 600;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .content-wrapper {
                padding: 20px;
            }
        }
    </style>
</head>
<body class="d-flex flex-column">
    <div class="container-fluid">
        <div class="main-container d-flex flex-column">
            {{-- شريط التنقل --}}
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <i class="fa-solid fa-truck-fast me-2"></i> نظام تتبع الشحنات
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <i class="fa-solid fa-home me-1"></i> الرئيسية
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">
                                    <i class="fa-solid fa-phone me-1"></i> اتصل بنا
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            @guest('customer')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer.login') }}">
                                        <i class="fa-solid fa-user me-1"></i> دخول العملاء
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-light btn-custom text-dark ms-2" href="{{ route('customer.register') }}">
                                        <i class="fa-solid fa-user-plus me-1"></i> تسجيل جديد
                                    </a>
                                </li>
                            @endguest
                            @auth('customer')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer.dashboard') }}">
                                        <i class="fa-solid fa-tachometer-alt me-1"></i> لوحة تحكمي
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('customer.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-danger btn-custom text-white ms-2">
                                            <i class="fa-solid fa-sign-out-alt me-1"></i> خروج
                                        </button>
                                    </form>
                                </li>
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link btn btn-warning btn-custom text-dark ms-2" href="{{ route('admin.login') }}">
                                    <i class="fa-solid fa-shield-alt me-1"></i> الإدارة
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- محتوى الصفحة --}}
            <main class="content-wrapper flex-grow-1">
                @yield('content')
            </main>

            {{-- تذييل الصفحة --}}
            <footer class="footer-custom text-white text-center py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-2">
                                <i class="fa-solid fa-truck-fast me-2"></i>
                                نظام تتبع الشحنات
                            </h6>
                            <p class="mb-0 small">خدمة تتبع موثوقة وآمنة لجميع شحناتك</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-2">تواصل معنا</h6>
                            <p class="mb-0 small">
                                <i class="fa-solid fa-phone me-1"></i> +966 50 123 4567<br>
                                <i class="fa-solid fa-envelope me-1"></i> info@shipment-tracker.com
                            </p>
                        </div>
                    </div>
                    <hr class="my-3">
                    <p class="mb-0 small">جميع الحقوق محفوظة &copy; {{ date('Y') }} نظام تتبع الشحنات</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
