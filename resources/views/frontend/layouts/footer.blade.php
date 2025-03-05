<footer>
    <div class="footer_overlay pt_100 xs_pt_70 pb_100 xs_pb_70">
        <div class="container wow fadeInUp" data-wow-duration="1s">
            <div class="row justify-content-between">
                <div class="col-lg-4 col-sm-8 col-md-6">
                    <div class="fp__footer_content">
                        <a class="footer_logo" href="index.html">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="FoodPark" class="img-fluid w-100">
                        </a>
                        <span>บริษัท ชายสี่ คอร์ปอเรชั่น</span>
                        <p class="info"><i class="far fa-map-marker-alt"></i> บริษัท ชายสี่ คอร์ปอเรชั่น จำกัด (สำนักงานใหญ่)</br> 7/7 หมู่ที่ 8 ต.คลองหก อ.คลองหลวง จ.ปทุมธานี 12120
                        </p>
                        <a class="info" href="callto:1234567890123"><i class="fas fa-phone-alt"></i>
                            02-9045223-5</a>
                        <a class="info" href="mailto:websolutionus1@gmail.com"><i class="fas fa-envelope"></i>
                            it@chaixi.co.th</a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-md-6">
                    <div class="fp__footer_content">
                        <h3>ทางลัด</h3>
                        <ul>
                            <li><a href="{{ route('home') }}">หน้าแรก</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-md-6 order-sm-4 order-lg-3">
                    <div class="fp__footer_content">
                        <h3>ช่วยเหลือ</h3>
                        <ul>
                            <li><a href="#">Terms And Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-8 col-md-6 order-lg-4">
                    <div class="fp__footer_content">
                        <h3>ติดต่อกลับ</h3>
                        <form>
                            <input type="text" placeholder="หมายเลขโทรศัพท์">
                            <button>ติดต่อกลับ</button>
                        </form>
                        <div class="fp__footer_social_link">
                            <h5>ช่องทางติดตาม :</h5>
                            <ul class="d-flex flex-wrap">
                                <li><a href="https://www.facebook.com/chaixibameekiao/?locale=th_TH"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://th.linkedin.com/company/chaixi-group"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="https://th.linkedin.com/company/chaixi-group"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/chaixibameekiao/"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fp__footer_bottom d-flex flex-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fp__footer_bottom_text d-flex flex-wrap justify-content-between">
                        <p>Copyright 2022 <b>CHAIXI</b> All Rights Reserved.</p>
                        {{-- <ul class="d-flex flex-wrap">
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">payment</a></li>
                            <li><a href="#">settings</a></li>
                            <li><a href="#">privacy policy</a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
