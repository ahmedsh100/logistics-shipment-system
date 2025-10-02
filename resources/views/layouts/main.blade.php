<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - نظام CRM للشحن</title>
    <!-- Bootstrap 5 CSS (RTL) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" xintegrity="sha384-dpuaG1suBy+9clQFzSbyI-J8yVMB4AqP30luVOQ9KvNG7wRPwI0zf1RAVAR7kSZY" crossorigin="anonymous">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body style="background-color: #f8f9fa; font-family: 'Inter', sans-serif;">

    {{-- شريط التنقل --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fa-solid fa-truck-fast me-2"></i> CRM الشحن
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fa-solid fa-home me-1"></i> الرئيسية</a>
                    </li>
                    @guest('customer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.login') }}"><i class="fa-solid fa-user me-1"></i> دخول العملاء</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary btn-sm text-white ms-lg-2" href="{{ route('customer.register') }}"><i class="fa-solid fa-user-plus me-1"></i> تسجيل جديد</a>
                        </li>
                    @endguest
                    @auth('customer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.dashboard') }}"><i class="fa-solid fa-tachometer-alt me-1"></i> لوحة تحكمي</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('customer.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm text-white ms-lg-2 mt-2 mt-lg-0"><i class="fa-solid fa-sign-out-alt me-1"></i> خروج</button>
                            </form>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}"><i class="fa-solid fa-shield-alt me-1"></i> دخول الإدارة</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- محتوى الصفحة --}}
    <main>
        @yield('content')
    </main>

    {{-- تذييل الصفحة --}}
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">جميع الحقوق محفوظة &copy; {{ date('Y') }} نظام CRM الشحن</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
