@extends('admin.layouts.master')

@section('title', 'ประวัติการใช้งาน')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>ประวัติการใช้งาน</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">รายงาน</a></div>
            <div class="breadcrumb-item">ประวัติการใช้งาน</div>
        </div>
    </div>
    {{-- URL --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>:: ประวัติการใช้งาน ::</h4>
                </div>
                <div class="card-body">
                    <div class="clearfix mb-3"></div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="history-table">
                            <thead>
                            </thead>
                            <tbody>
                                {{ $dataTable->table() }}
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="float-right">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> --}}
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
