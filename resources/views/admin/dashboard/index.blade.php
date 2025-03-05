@extends('admin.layouts.master')

@section('title', 'หน้าแรก')

@section('css')
<style>
    .custom-table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-table thead {
        background-color: var(--colorPrimary);
        color: white;
    }

    .custom-table th {
        padding: 15px;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #dee2e6;
    }

    .custom-table td {
        padding: 12px;
        vertical-align: middle;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
    }

    .custom-table tbody tr:hover {
        background-color: rgba(230, 179, 1, 0.1);
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-responsive {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }

    /* สำหรับการแสดงผลบนมือถือ */
    @media (max-width: 768px) {
        .custom-table {
            font-size: 14px;
        }

        .custom-table th,
        .custom-table td {
            padding: 10px 8px;
        }
    }
</style>
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1>ภาพรวม</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>ผู้ดูแล</h4>
                    </div>
                    <div class="card-body">
                        {{ $admin_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>ผู้งาน</h4>
                    </div>
                    <div class="card-body">
                        {{ $user_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>สไลด์</h4>
                    </div>
                    <div class="card-body">
                        {{ $slider_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>บล๊อก</h4>
                    </div>
                    <div class="card-body">
                        {{ $blogs_count }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Report--}}
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="monthlyClickChart" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-6 col-12">
                <div class="table-responsive">
                    <table class="table table-hover custom-table">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">ปี</th>
                                <th scope="col">เดือน</th>
                                <th scope="col">จำนวนการกด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clickData as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->user_name }}</td>
                                <td>{{ $data->year }}</td>
                                <td>{{ $data->month }}</td>
                                <td>{{ $data->click_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- Script --}}
@yield('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('monthlyClickChart').getContext('2d');
    var chartData = @json($chartData);
    console.log(chartData);
    new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Clicks'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Users'  // เปลี่ยนจาก 'Months' เป็น 'Users'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            // คุณสามารถกำหนดรูปแบบของ tooltip ที่นี่
                            return `${context.dataset.label}: ${context.parsed.y} clicks`;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        // ปรับแต่ง label ในส่วน legend
                        generateLabels: function(chart) {
                            // คุณสามารถกำหนดการแสดงผล label ตามต้องการ
                        }
                    }
                }
            }
        }
    });
});
</script>
