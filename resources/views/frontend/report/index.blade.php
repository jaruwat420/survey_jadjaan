@extends('frontend.layouts.master')

@section('title', 'รายงานการขาย')
@section('css')
<style>
    /* ปรับแต่งส่วน Container */
    .fp__list__group {
        margin-top: 180px !important;
        background-color: #f8f9fa;
        padding: 30px 0;
    }

    /* ปรับแต่ง Card */
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* ปรับแต่ง Card Header */
    .bg-style {
        background: linear-gradient(45deg, #f5ca1b, #ffd700);
        padding: 20px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-header h4 {
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ปรับแต่ง List Group */
    .list-group-item {
        padding: 15px 20px;
        border: none;
        margin-bottom: 5px;
        border-radius: 8px !important;
        transition: all 0.3s ease;
        cursor: pointer;
        font-weight: 500;
    }

    .list-group-item:hover, .list-group-item.active {
        background-color: #f5ca1b !important;
        color: #ffffff !important;
        transform: translateX(10px);
        box-shadow: 0 4px 15px rgba(245, 202, 27, 0.3);
    }

    /* ปรับแต่ง Form Select */
    .form-select {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    /* ปรับแต่ง Month Buttons */
    .month-btn {
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .month-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(245, 202, 27, 0.3);
    }



    /* ปรับแต่ง Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    #contentArea {
        animation: fadeIn 0.5s ease-out;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
        }

        .month-btn {
            font-size: 14px;
            padding: 10px;
        }
    }
/* ปรับแต่ง Container หลัก */
.container-fluid {
    padding: 20px;
}

/* ปรับแต่ง Report Container */
.report-container {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* อัตราส่วน 16:9 */
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    background: #ffffff;
    animation: fadeIn 0.5s ease-out;
    margin: 20px 0;
}

/* ปรับแต่ง iframe */
iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
}

/* เพิ่ม animation สำหรับการแสดง report */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive design */
@media (max-width: 768px) {
    .container-fluid {
        padding: 10px;
    }
    .report-container {
        margin: 10px 0;
    }
}
</style>
@endsection

@section('content')
<section class="fp__list__group mt_100 xs_mt_100 mb_100 xs_mb_100">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header bg-style" >
                        <h4 class="text-white">SALES PERFORMANCE</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group " id="performanceMenu">
                            <li class="list-group-item " data-target="dailySales">Daily Sales Dashboard</li>
                            <li class="list-group-item" data-target="weekly">Weekly</li>
                            <li class="list-group-item" data-target="monthly">Monthly</li>
                            <li class="list-group-item" data-target="monthly">Year on Year Analysis​</li>
                            <li class="list-group-item" data-target="monthly">Product Analysis​</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div id="contentArea">
                    <!-- Content will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div id="reportContainer" class="report-container" style="display: none;">
                    <iframe id="reportFrame"
                            title="Power BI Report"
                            allowfullscreen="true"
                            loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const contentArea = $('#contentArea');
        const performanceMenu = $('#performanceMenu');
        const reportContainer = $('#reportContainer');
        const reportFrame = $('#reportFrame');

        // Define content for each menu item
        const contents = {
            dailySales: `
                <div class="card">
                    <div class="card-header bg-style">
                        <h4 class="text-white">Daily Sales Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select" id="yearSelect">
                                    <option selected>2567</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="monthButtonsContainer">
                            ${generateMonthButtons()}
                        </div>
                    </div>
                </div>
            `,
            weekly: `
                <div class="card">
                    <div class="card-header bg-style">
                        <h4 class="text-white">Weekly Sales Report</h4>
                    </div>
                    <div class="card-body">
                        <p>Coming Soon.</p>
                    </div>
                </div>
            `,
            monthly: `
                <div class="card">
                    <div class="card-header bg-style">
                        <h4 class="text-white">Monthly Sales Summary</h4>
                    </div>
                    <div class="card-body">
                        <p>Monthly sales summary will be shown here.</p>
                    </div>
                </div>
            `
        };

        function generateMonthButtons() {
            const months = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                            'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
            const urlMonth = {
                '1': 'https://app.powerbi.com/view?r=eyJrIjoiNmU3MTNkNmQtOGQyNy00ZDdmLWJlMzgtZTRlOWFjOWUyN2ZiIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '2': 'https://app.powerbi.com/view?r=eyJrIjoiNmU3MTNkNmQtOGQyNy00ZDdmLWJlMzgtZTRlOWFjOWUyN2ZiIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '3': 'https://app.powerbi.com/view?r=eyJrIjoiYTRkZGMzZjEtYmZkZC00YjdlLTg4YjUtODkzZjY4YzMyOTlhIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '4': 'https://app.powerbi.com/view?r=eyJrIjoiYWUwMTUxMjUtOGY2YS00YjczLWJjOTgtYTg4MjMzMzhlNmE3IiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '5': 'https://app.powerbi.com/view?r=eyJrIjoiZTAzMjFhNDAtOTcyYy00NjkyLTkzN2QtMzA2NDhhNThhYzQyIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '6': 'https://app.powerbi.com/view?r=eyJrIjoiOTkwZDUzNzYtOTg2OC00ODMwLWEyYzYtMDkxY2YyYjA5NTIyIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '7': 'https://app.powerbi.com/view?r=eyJrIjoiMTg5OTdiMzEtMmMyNC00ODVjLWFmOGYtZWRjZDUxMTI4NjhjIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '8': 'https://app.powerbi.com/view?r=eyJrIjoiZjk3ZTFjNDYtODdiZi00ZjA2LThlMTMtY2E4ODZmMDNjOGUyIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '9': 'https://app.powerbi.com/view?r=eyJrIjoiMGUxNWYwNzgtZmE1Yy00NjIxLWFmZTYtNmE1ZTAzNjA5ZTE1IiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '10': 'https://app.powerbi.com/view?r=eyJrIjoiMjRkZTg3OTItMjJlZi00Mjg3LWEwNWItOTRiODBkZDViMDY5IiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '11': 'https://app.powerbi.com/view?r=eyJrIjoiYTZjN2M0ZTItZGY5Yy00OTYwLWE1OGEtMjcyYzM4MWQ3YjEzIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
                '12': 'https://app.powerbi.com/view?r=eyJrIjoiOGZiY2YwMTMtMTlkMS00N2QxLTkxM2QtODJjNGU4MWMxZmUzIiwidCI6IjA5NTYwOGFkLWZkMzQtNDVmYi05OGU3LTE3ZDQ4MzYxNjMwMCIsImMiOjEwfQ%3D%3D',
            };

            let buttonsHtml = '';
            months.forEach((month, index) => {
                const monthNumber = (index + 1).toString();
                const url = urlMonth[monthNumber] || '#';
                buttonsHtml += `
                    <div class="col-md-2 mb-2">
                        <button type="button" class="common_btn w-100 month-btn bg-style" data-month="${monthNumber}" data-url="${url}">
                            ${month}
                        </button>
                    </div>
                `;
            });
            return buttonsHtml;
        }

        // Event listener for menu items
        performanceMenu.on('click', 'li', function() {
            const target = $(this).data('target');
            contentArea.html(contents[target]);
            performanceMenu.find('li').removeClass('active');
            $(this).addClass('active');

            // Hide the report container when switching menu items
            reportContainer.hide();

            // Attach event listeners to month buttons if daily sales is selected
            if (target === 'dailySales') {
                attachMonthButtonListeners();
            }
        });

        function attachMonthButtonListeners() {
            $('#monthButtonsContainer').on('click', '.month-btn', function() {
                const url = $(this).data('url');
                const month = $(this).data('month');
                const year = $('#yearSelect').val();

                if (url && url !== '#') {
                    reportFrame.attr('src', url);
                    reportContainer.show();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('report.store') }}",
                        data: {
                            year: year,
                            month: month
                            },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "JSON",
                        success: function (response) {
                            console.log(response.message);
                        }
                    });

                } else {
                    alert('URL for this month is not available.');
                    reportContainer.hide();
                }
            });
        }

        // Initialize with Daily Sales Dashboard
        contentArea.html(contents.dailySales);
        performanceMenu.find('li[data-target="dailySales"]').addClass('active');
        attachMonthButtonListeners();

        // Event listener for year selection
        $(document).on('change', '#yearSelect', function() {
            const selectedYear = $(this).val();
            // Here you can update the month buttons or URLs based on the selected year
            // console.log('Selected year:', selectedYear);
            // For now, we'll just regenerate the buttons (you might want to update URLs based on the year)
            $('#monthButtonsContainer').html(generateMonthButtons());
            reportContainer.hide();
        });
    });
</script>
@endpush
