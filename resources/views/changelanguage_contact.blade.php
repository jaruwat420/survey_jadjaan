<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Hans McMurdy">
    <title>Choose Language</title>
    <meta name="title" content="#JavaScriptFirst">
    <meta name="description" content="Learn how to code with #JavaScriptFirst: https://github.com/HansUXdev/JavaScript-First">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- Favicons -->

    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <style>
        /* Prevent scroll on narrow devices */
        html,
        body {
            overflow-x: hidden;
        }

        body {
            padding-top: 56px;
        }

        @media (max-width: 991.98px) {
            .offcanvas-collapse {
                position: fixed;
                top: 56px;
                /* Height of navbar */
                bottom: 0;
                left: 100%;
                width: 100%;
                padding-right: 1rem;
                padding-left: 1rem;
                overflow-y: auto;
                visibility: hidden;
                background-color: #343a40;
                transition: transform .3s ease-in-out, visibility .3s ease-in-out;
            }

            .offcanvas-collapse.open {
                visibility: visible;
                transform: translateX(-100%);
            }
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            color: rgba(255, 255, 255, .75);
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-underline .nav-link {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .875rem;
            color: #6c757d;
        }

        .nav-underline .nav-link:hover {
            color: #007bff;
        }

        .nav-underline .active {
            font-weight: 500;
            color: #343a40;
        }

        .text-white-50 {
            color: rgba(255, 255, 255, .5);
        }

        .bg-purple {
            background-color: #6f42c1;
        }

    </style>
    <style>
        .language-card {
            transition: all 0.3s ease;
            border: 2px solid #dee2e6;
            border-radius: 10px;
        }

        .language-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: #007bff;
        }

        .flag-container {
            transition: all 0.2s ease;
        }

        .flag-container:hover {
            transform: scale(1.05);
        }

        .selected {
            border-color: #007bff;
            background-color: rgba(0, 123, 255, 0.05);
        }

    </style>
</head>

<body class="bg-light" style="margin-top: 10vh;">
    <main class="container">
        <div class="container">
            <div class="row justify-content-center align-items-center my-5">
                <div class="col-12 text-center mb-4">
                    <h2>Select Language / 言語の選択</h2>
                </div>

                <div class="col-md-10">
                    <div class="row">
                        <!-- ฝั่งซ้าย: อังกฤษ -->
                        <div class="col-md-6 text-center language-option" id="thai-option">
                            <div class="card h-100 p-4 language-card">
                                <div class="flag-container mx-auto mb-3">
                                    <img src="{{ asset('frontend/images/eng.png') }}" alt="ภาษาไทย" class="img-fluid" style="max-height: 150px; cursor: pointer;">
                                </div>
                                <h3 class="mt-2">ENGLISH</h3>
                                <p class="text-muted">Click on the flag to select English.</p>
                            </div>
                        </div>

                        <!-- ฝั่งขวา: ญี่ปุ่น -->
                        <div class="col-md-6 text-center language-option" id="eng-option">
                            <div class="card h-100 p-4 language-card">
                                <div class="flag-container mx-auto mb-3">
                                    <img src="{{ asset('frontend/images/japan.png') }}" alt="ภาษาไทย" class="img-fluid" style="max-height: 150px; cursor: pointer;">
                                </div>
                                <h3 class="mt-2">JAPAN</h3>
                                <p class="text-muted">国旗をクリックして日本を選択します</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- คุณสามารถเก็บส่วนเนื้อหาเดิมไว้ด้านล่างตามต้องการ -->
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const thaiOption = document.getElementById('thai-option');
            const engOption = document.getElementById('eng-option');

            // เลือกธงและการ์ดทั้งหมด
            const thaiFlag = thaiOption.querySelector('img');
            const engFlag = engOption.querySelector('img');
            const thaiCard = thaiOption.querySelector('.language-card');
            const engCard = engOption.querySelector('.language-card');

            // ตั้งค่าเริ่มต้นให้ภาษาไทยถูกเลือก
            thaiCard.classList.add('selected');

            // เพิ่ม event listener สำหรับธงไทย
            thaiFlag.addEventListener('click', function() {
                // ไฮไลท์การ์ดภาษาไทย
                thaiCard.classList.add('selected');
                engCard.classList.remove('selected');

                // เปลี่ยนภาษาเป็นญี่ปุ่น (ตัวอย่างการใช้ใน Laravel)
                window.location.href = "{{ route('changeLang', ['lang' => 'jp']) }}";
            });

            // เพิ่ม event listener สำหรับธงอังกฤษ
            engFlag.addEventListener('click', function() {
                // ไฮไลท์การ์ดภาษาอังกฤษ
                engCard.classList.add('selected');
                thaiCard.classList.remove('selected');

                // เปลี่ยนภาษาเป็นอังกฤษ (ตัวอย่างการใช้ใน Laravel)
                window.location.href = "{{ route('changeLang', ['lang' => 'en']) }}";
            });

            // ทำให้สามารถคลิกที่การ์ดทั้งใบได้ด้วย
            thaiOption.addEventListener('click', function() {
                thaiFlag.click();
            });

            engOption.addEventListener('click', function() {
                engFlag.click();
            });
        });

    </script>
</body>

</html>
