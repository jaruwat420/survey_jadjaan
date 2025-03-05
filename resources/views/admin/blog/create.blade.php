@extends('admin.layouts.master')

@section('title', 'สร้างบล๊อก')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>บล๊อก</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <div class="card-header-action">
            <h4>สร้างบล๊อก</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>รูปภาพ</label>

                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">เลือกไฟล์</label>
                    <input type="file" name="image" id="image-upload">
                </div>
            </div>
            <div class="form-group">
                <label>ประเภทบล๊อก</label>
                <input type="text" name="blog_type" class="form-control">
            </div>
            <div class="form-group">
                <label>ชื่อบล็อก</label>
                <input type="text" name="blog_title" class="form-control">
            </div>
            <div class="form-group">
                <label>ลิงค์บล็อก</label>
                <input type="text" name="blog_link" class="form-control">
            </div>
            <div class="form-group">
                <label>สถานะ</label>
                <select name="blog_status" id="" class="form-control">
                    <option value="1">แสดง</option>
                    <option value="0">ไม่แสดง</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function (){

        })
    </script>
@endpush
