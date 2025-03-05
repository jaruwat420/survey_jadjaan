@extends('frontend.layouts.master')

@section('title', 'ยอดขาย')
@section('css')
<style>
.btn-type {
    width: 100% !important;
    height: 150px;
    background-color: var(--colorPrimary);
    color: #ffffff;
    font-size: 25px;
    /* เพิ่มความสวยงาม */
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    text-transform: uppercase;
}

/* เพิ่ม hover effect */
.btn-type:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(230, 179, 1, 0.3);
    background-color: #f4c101 !important;
    color: #ffffff;
}

/* เพิ่ม active state */
.btn-type:active {
    transform: translateY(2px);
}

/* ปรับ container */
.fp__about_us {
    padding: 40px 0;
    background-color: #f8f9fa;
}

/* เพิ่ม spacing ระหว่างปุ่ม */
.row {
    gap: 20px 0;
}

/* เพิ่ม gradient background สำหรับปุ่ม (optional) */
.btn-type {
    background: linear-gradient(45deg, var(--colorPrimary), #f4c101);
}
</style>
@endsection

@section('content')
<section class="fp__about_us " style="margin-top: 180px;" >
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-grid">
                    <button class="btn  btn-type" type="button" onclick="window.location='{{ route('sales.performance') }}'">
                        <i class="fas fa-chart-line me-2 "></i>
                        ยอดขาย
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-grid">
                    <button class="btn btn-type" type="button" onclick="#">
                        <i class="fas fa-percentage me-2"></i>
                        โปรโมชั่น
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-grid radius-6 my-3 " style="text-align: center;">
                    <a class="btn btn-type" href="https://prop.chaixi.co.th/main" target="_blank">
                        <i class="fas fa-bullhorn me-2"></i>
                        แคมเปญ
                    </a>
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
