@extends('admin.layouts.master')

@section('title', 'โปรไฟล์')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>โปรไฟล์</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">หน้าแรก</a></div>
            <div class="breadcrumb-item">โปรไฟล์</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
                <h4>แก้ไขผู้ใช้งาน</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-4">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">เลือก ไฟล์</label>
                            <input type="file" name="avatar" id="image-upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>ชื่อ</label>
                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label>อีเมล์</label>
                        <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <button class="btn btn-primary" type="submit">บันทึก</button>
                </form>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>แก้ไขรหัสผ่าน</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>รหัสผ่านเดิม</label>
                        <input type="password" class="form-control" name="current_password">
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <button class="btn btn-primary" type="submit">บันทึก</button>
                </form>
            </div>
        </div>
    </div>

</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('.image-preview').css({
            'background-image': 'url({{ asset(auth()->user()->avatar) }})',
            'background-size': 'cover',
            'background-position': 'center center'
        })
    })
</script>
@endpush
