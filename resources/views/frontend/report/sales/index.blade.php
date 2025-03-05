@extends('frontend.layouts.master')

@section('title', 'content')

@section('css')
<style>
  .btn-type {
    width: 100% !important;
    height: 150px;
    background-color: var(--colorPrimary);
    color: #ffffff;
    font-size: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.btn-disable {
    width: 100% !important;
    height: 150px;
    background-color: var(--colorPrimary);
    color: #ffffff;
    font-size: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.btn-type:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(230, 179, 1, 0.3);
    background-color: #f4c101 !important;
    color: #ffffff;
}


.btn-disable:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(230, 179, 1, 0.3);
    background-color: gray !important;
    color: #ffffff;
}

/* ลบส่วนที่ไม่จำเป็นออก */
.card, .card-success, .custom {
    display: none;
}
</style>
@endsection

@section('content')
<!--=============================
        BREADCRUMB START
    ==============================-->
    <div class="container" style="margin-top: 150px; ">
        <div class="fp__breadcrumb_text">
        <h1 style="color: var(--colorBlack)">ภาพรวม</h1>
            <ul>
                <li><a  href="{{ route('report.index') }}" style="color: var(--colorBlack)">ย้อนกลับ</a></li>
                <li><a>-</a></li>
                <li><a  href="#" style="color: var(--colorBlack)">ภาพรวม</a></li>
            </ul>
        </div>
    </div>
    <!--=============================
        BREADCRUMB END
    ==============================-->
    <section class="fp__about_us mt-5">
        <div class="container">
            <!-- ปุ่มบนสุด 2 ปุ่ม -->
            <div class="row">
                <div class="col-md-6">
                    <div class="d-grid">
                        <button class="btn btn-disable" type="button">
                            <i class="fas fa-store me-2"></i>
                            ธุรกิจแฟรนไชส์ 38 MB​
                        </button>
                        {{-- <button class="btn btn-type" type="button" onclick="window.location='{{ route('sales.report.franchise') }}'">
                            <i class="fas fa-store me-2"></i>
                            ธุรกิจแฟรนไชส์ 38 MB​
                        </button> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-grid">
                        <button class="btn btn-disable" type="button"">
                            <i class="fas fa-utensils me-2"></i>
                            ธุรกิจร้านอาหาร 20 MB​
                        </button>
                    </div>
                </div>
            </div>

            <!-- ปุ่มด้านล่าง -->
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid radius-6 my-3">
                        <button class="btn btn-type" type="button" onclick="window.location='{{ route('sales.report.franchise') }}'">
                            แฟรนไชส์
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function (){

    });
</script>
@endpush
