@extends('admin.layouts.master')

@section('title', 'สร้างสไลด์')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>สไลด์</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>สไลด์</h4>
        <div class="card-header-action">
            <h4>สร้างสไลด์</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" ">
            @csrf
            <div class="form-group">
                <label>รูปภาพ</label>
                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">เลือกไฟล์</label>
                    <input type="file" name="image" id="image-upload">
                </div>
            </div>
            <div class="form-group">
                <label>ลดราคา</label>
                <input type="text" name="offer" class="form-control">
            </div>
            <div class="form-group">
                <label>หัวข้อ</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>หัวข้อย่อย</label>
                <input type="text" name="sub_title" class="form-control">
            </div>
            <div class="form-group">
                <label>รายละเอียดย่อ</label>
                <textarea type="text" name="short_description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>ปุ่มลิงค์</label>
                <input type="text" name="button_link" class="form-control">
            </div>
            <div class="form-group">
                <label>สถานะ</label>
                <select name="status" id="" class="form-control">
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
