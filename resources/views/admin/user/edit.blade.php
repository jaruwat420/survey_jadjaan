@extends('admin.layouts.master')

@section('title', 'UpdateUser')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>ผู้ใช้งาน</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>แก้ไขผู้ใช้งาน</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.user.update', $users->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{ $users->id }}">
            <div class="form-group">
                <label>รูปภาพ</label>
                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">เลือกไฟล์</label>
                    <input type="file" name="image" id="image-upload">
                </div>
            </div>
            <div class="form-group">
                <label>ชื่อ</label>
                <input type="text" name="name" class="form-control" value="{{ $users->name }}">
            </div>
            <div class="form-group">
                <label>อีเมล์</label>
                <input type="text" name="email" class="form-control" value="{{ $users->email }}">
            </div>
            <div class="form-group">
                {{-- <label>Password</label> --}}
                <input type="hidden" name="password" class="form-control" value="{{ $users->password }}" >
            </div>
            <div class="form-group">
                <label>ระดับสิทธิ์</label>
                <select name="role" class="form-control">
                    <option @selected($users->role === 'admin') value="admin">ผู้ดูแลระบบ</option>
                    <option @selected($users->role === 'user') value="user">ผู้ใช้งาน</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ตกลง</button>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function(){
        $('.image-preview').css({
            'background-image': 'url({{ asset($users->avatar) }})',
            'background-size': 'cover',
            'background-position': 'center center'
        })
    })
</script>
@endpush
