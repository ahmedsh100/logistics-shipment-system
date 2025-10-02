<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | لوحة تحكم الإدارة</title>
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
        
        .admin-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 20px;
            min-height: calc(100vh - 40px);
            overflow: hidden;
        }
        
        .navbar-top {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            border-radius: 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        .navbar-top .navbar-brand {
            color: white !important;
            font-weight: 700;
        }
        
        .navbar-top .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
        }
        
        .navbar-top .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }
        
        .sidebar {
            width: 280px;
            height: calc(100vh - 80px);
            position: fixed;
            top: 80px;
            right: 20px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            border-radius: 15px;
            padding: 20px 0;
            z-index: 1030;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .sidebar .nav-item {
            margin: 5px 15px;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 15px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: right 0.5s;
        }
        
        .sidebar .nav-link:hover::before {
            right: 100%;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            transform: translateX(-5px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }
        
        .content {
            margin-right: 300px;
            padding: 30px;
            background: transparent;
        }
        
        .content-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .content-body {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .btn {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-weight: 600;
        }
        
        .badge {
            border-radius: 20px;
            padding: 8px 15px;
            font-weight: 500;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
        }
        
        @media (max-width: 992px) {
            .admin-container {
                margin: 10px;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                top: 0;
                right: 0;
                margin-bottom: 20px;
            }
            
            .content {
                margin-right: 0;
                padding: 20px;
            }
            
            .navbar-top {
                margin-right: 0;
            }
        }
        
        .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .dropdown-item {
            border-radius: 8px;
            margin: 2px 8px;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            transform: translateX(-5px);
        }
    </style>
</head>
<body>

    {{-- الشريط العلوي (Top Navbar) --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-top">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold">
                <i class="fa-solid fa-shield-alt me-2"></i>
                لوحة تحكم الإدارة
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-circle me-2"></i> 
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fa-solid fa-sign-out-alt me-2"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admin-container">
        <div class="d-flex flex-grow-1">
            {{-- الشريط الجانبي (Sidebar) --}}
            <nav id="sidebarMenu" class="collapse d-lg-block sidebar">
                <div class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-tachometer-alt"></i> 
                        <span class="ms-3">الإحصائيات</span>
                    </a>
                    <a href="{{ route('admin.shipments.index') }}" class="nav-link {{ request()->routeIs('admin.shipments.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-box-open"></i> 
                        <span class="ms-3">إدارة الشحنات</span>
                    </a>
                    <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i> 
                        <span class="ms-3">إدارة العملاء</span>
                    </a>
                    <a href="{{ route('admin.inquiries.index') }}" class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-question-circle"></i> 
                        <span class="ms-3">استفسارات العملاء</span>
                    </a>
                    <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line"></i> 
                        <span class="ms-3">التقارير</span>
                    </a>
                </div>
            </nav>

            {{-- محتوى الصفحة الرئيسي --}}
            <main class="content flex-grow-1">
                <div class="content-body">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
