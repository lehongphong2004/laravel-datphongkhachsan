    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'HotelGo - Booking Khách Sạn')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            body {
                font-family: 'Segoe UI', sans-serif;
                background: url('/images/bg-hotel.jpg') center/cover no-repeat fixed;
            }
            .navbar-brand { font-weight: bold; font-size: 1.3rem; }

            /* Back to top button */
            #backToTop {
                position: fixed; bottom: 20px; right: 20px;
                display: none; z-index: 99;
            }

            /* Floating contact buttons */
            .contact-buttons {
                position: fixed;
                bottom: 90px;
                right: 20px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                z-index: 9999;
            }
            .btn-contact {
                width: 50px; height: 50px;
                border-radius: 50%;
                color: #fff;
                display: flex; align-items: center; justify-content: center;
                box-shadow: 0 4px 10px rgba(0,0,0,0.2);
                text-decoration: none;
                animation: shake 2s infinite;
                transition: transform 0.2s, background 0.2s;
            }
            .btn-contact:hover { transform: scale(1.1); }
            .btn-contact.phone { background: #28a745; }
            .btn-contact.zalo { background: #0068ff; }
            .btn-contact.messenger { background: #0084ff; }
            .btn-contact svg { width: 24px; height: 24px; fill: #fff; }

            @keyframes shake {
                0%, 100% { transform: translate(0, 0); }
                20% { transform: translate(-2px, 0); }
                40% { transform: translate(2px, 0); }
                60% { transform: translate(-2px, 0); }
                80% { transform: translate(2px, 0); }
            }

            /* Footer đẹp */
            footer {
                background: linear-gradient(135deg, #0d47a1, #1976d2);
                color: #f1f1f1;
            }
            footer h6 { font-weight: bold; margin-bottom: 15px; }
            footer a { color: #f1f1f1; text-decoration: none; }
            footer a:hover { color: #ffca28; }
            .social-icon {
                display: inline-flex;
                width: 36px; height: 36px;
                border-radius: 50%;
                align-items: center; justify-content: center;
                background: rgba(255,255,255,0.1);
                margin-right: 8px;
                transition: background 0.3s, color 0.3s;
            }
            .social-icon:hover { background: #ffca28; color: #000; }

            /* Tooltip tweak */
            .tooltip-inner { font-size: 13px; padding: 6px 10px; }
        </style>
    </head>
    <body>
            <!-- Chatbot -->
    <script src="https://app.tudongchat.com/js/chatbox.js"></script>
    <script>
      const tudong_chatbox = new TuDongChat('IKnJo-GCt3ouB65HnyZtU');
      tudong_chatbox.initial();
    </script>
  </body>
</html>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('landing') }}">
                    <i class="bi bi-building"></i> HotelGo
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Center menu -->
                    <ul class="navbar-nav mx-auto align-items-lg-center">
                        <li class="nav-item"><a href="{{ route('landing') }}" class="nav-link">Trang chủ</a></li>
                        <li class="nav-item"><a href="{{ route('user.hotels') }}" class="nav-link">Khách sạn</a></li>
                        <li class="nav-item"><a href="{{ route('uudai.index') }}" class="nav-link">Ưu đãi</a></li>
                        <li class="nav-item"><a href="{{ route('user.blog.index') }}" class="nav-link">Blog du lịch</a></li>
                    </ul>

                    <!-- Account menu -->
                    <ul class="navbar-nav align-items-lg-center">
                        @if(!session('taikhoan_id'))
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Đăng nhập</a></li>
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Đăng ký</a></li>
                        @else
                            @if(session('vai_tro') === 'admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Admin</a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('admin.home') }}">Trang quản trị</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        Xin chào, {{ session('ten_dang_nhap') }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('user.lichsu') }}">Lịch sử đặt phòng</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.password.form') }}">Đổi mật khẩu</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="container mt-4">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="pt-5 pb-3 mt-5">
            <div class="container">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-3 mb-3">
                        <h6>Về HotelGo</h6>
                        <p>HotelGo mang đến trải nghiệm đặt phòng khách sạn hiện đại, tiện lợi và nhanh chóng.</p>
                    </div>
                    <!-- Contact -->
                    <div class="col-md-3 mb-3">
                        <h6>Liên hệ</h6>
                        <p><i class="bi bi-telephone"></i> 0123 456 789</p>
                        <p><i class="bi bi-envelope"></i> support@hotelgo.com</p>
                    </div>
                    <!-- Quick links -->
                    <div class="col-md-3 mb-3">
                        <h6>Liên kết</h6>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('landing') }}">Trang chủ</a></li>
                            <li><a href="{{ route('user.hotels') }}">Khách sạn</a></li>
                            <li><a href="{{ route('uudai.index') }}">Ưu đãi</a></li>
                            <li><a href="{{ route('user.blog.index') }}">Blog du lịch</a></li>
                        </ul>
                    </div>
                    <!-- Quick contact -->
                    <div class="col-md-3 mb-3">
                        <h6>Liên hệ nhanh</h6>
                        <form action="{{ url('/contact') }}" method="POST">
                            @csrf
                            <input type="text" name="name" class="form-control mb-2" placeholder="Họ tên" required>
                            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                            <textarea name="message" class="form-control mb-2" rows="2" placeholder="Nội dung" required></textarea>
                            <button type="submit" class="btn btn-warning btn-sm w-100">Gửi</button>
                        </form>
                    </div>
                </div>
                <hr class="border-light">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">&copy; {{ date('Y') }} HotelGo. All rights reserved.</p>
                    <div>
                        <a href="https://www.facebook.com/van.phi.98162" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/vanphi_04/" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://x.com/travelokaVN/status/1276033713529212928" class="social-icon" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Floating Contact Buttons -->
        <div class="contact-buttons">
            <!-- Hotline (SVG) -->
            <a href="tel:0123456789" class="btn-contact phone" data-bs-toggle="tooltip" data-bs-placement="left" title="Gọi ngay" aria-label="Gọi ngay">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M6.62 10.79a15.054 15.054 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 011 1V22a1 1 0 01-1 1C10.29 23 1 13.71 1 2a1 1 0 011-1h4.5a1 1 0 011 1c0 1.25.2 2.46.57 3.58a1 1 0 01-.24 1.01l-2.21 2.2z"/>
                </svg>
            </a>

            <!-- Zalo (SVG tối giản) -->
            <a href="https://zalo.me/0123456789" class="btn-contact zalo" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Chat Zalo" aria-label="Chat Zalo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path d="M24 4C13 4 4 12.6 4 23.2c0 6 2.8 11.4 7.6 15l-1 7.8 7.1-3.9c2.1.6 4.3.9 6.3.9 11 0 20-8.6 20-19.2C44 12.6 35 4 24 4z" fill="none"/>
                    <path d="M16 16h16l-10 10h10v6H16l10-10H16v-6z" fill="#fff"/>
                </svg>
            </a>

            <!-- Messenger (SVG) -->
            <a href="https://m.me/yourpageid" class="btn-contact messenger" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Messenger" aria-label="Messenger">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path d="M24 4C13 4 4 12.6 4 23.2c0 6 2.8 11.4 7.6 15l-1 7.8 7.1-3.9c2.1.6 4.3.9 6.3.9 11 0 20-8.6 20-19.2C44 12.6 35 4 24 4zm2.1 27.7l-5.4-5.8-10.2 5.8 11.9-12.8 5.5 5.8 10.1-5.8-11.9 12.8z" />
                </svg>
            </a>
        </div>

        <!-- Back to top -->
        <button id="backToTop" class="btn btn-primary rounded-circle" aria-label="Back to top">
            <i class="bi bi-arrow-up"></i>
        </button>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Back to top visibility
            const backToTop = document.getElementById("backToTop");
            window.addEventListener('scroll', () => {
                backToTop.style.display = document.documentElement.scrollTop > 200 ? "block" : "none";
            });
            backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Enable Bootstrap tooltips
            document.addEventListener('DOMContentLoaded', () => {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
            });
        </script>
    </body>
    </html>
