
@extends('frontend.layouts.master')

@section('title', 'content')

@section('css')

@endsection

@section('content')

    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: ; url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>สมัครสมาชิก</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">หน้าแรก</a></li>
                        <li><a href="#">สมัครสมาชิก</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=========================
        SIGN UP START
    ==========================-->
    <section class="fp__signup" style="background: url({{ asset('frontend/images/login_bg.jpg') }});">
        <div class="fp__signup_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class=" container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                        <div class="fp__login_area">
                            <h2>ยินดีต้อนรับกลับ !</h2>
                            <p>ลงทะเบียนเพื่อดำเนินการต่อ</p>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>ชื่อผู้ใช้งาน</label>
                                            <input type="text" placeholder="ชื่อผู้ใช้งาน" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>อีเมล์</label>
                                            <input type="email" placeholder="อีเมล์"  name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>หมายเลขโทรศัพท์</label>
                                            <input type="tel" placeholder="หมายเลขโทรศัพท์" name="phone_number" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>รหัสผ่าน</label>
                                            <input type="password" placeholder="รหัสผ่าน" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>ยืนยันรหัสผ่าน</label>
                                            <input type="password" placeholder="ยืนยันรหัสผ่าน" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <button type="submit" class="common_btn">สมัครมาชิก</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="or"></p>
                            {{-- <p class="or"><span>OR</span></p> --}}
                            {{-- <ul class="d-flex">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul> --}}
                            <p class="create_account">หากคุณมีบัญชีแล้ว ? <a href="{{ route('login') }}">เข้าสู่ระบบ</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        SIGN UP END
    ==========================-->
@endsection

@section('scripts')
    <script>

    </script>
@endsection
