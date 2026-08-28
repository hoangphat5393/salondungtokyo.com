@extends('backend.layouts.master')
@section('seo')
    @php
        $title_head = 'Admin Dashboard';
        $seo = [
            'title' => 'Admin Dashboard',
            'keywords' => '',
            'description' => '',
            'og_title' => 'Admin Dashboard',
            'og_description' => '',
            'og_url' => Request::url(),
            'og_img' => asset('assets/images/logo_seo.png'),
            'current_url' => Request::url(),
            'current_url_amp' => '',
        ];
    @endphp
    @include('backend.partials.seo')
@endsection

@section('content')
    {{-- begin::App Content Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-end"><ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">@lang('admin.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol></nav>
                </div>
            </div>
        </div>
    </div>
    {{-- end::App Content Header --}}

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col - Dịch vụ Salon-->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary shadow-sm">
                        <div class="inner">
                            <h3>{{ $totalServices ?? 0 }}</h3>
                            <p>Dịch Vụ Salon</p>
                        </div>
                        <i class="small-box-icon bi bi-scissors"></i>
                        <a href="{{ route('admin.service.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Quản lý dịch vụ <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col - Bộ sưu tập tóc-->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success shadow-sm">
                        <div class="inner">
                            <h3>{{ $totalAlbums ?? 0 }}</h3>
                            <p>Bộ Sưu Tập Mẫu Tóc</p>
                        </div>
                        <i class="small-box-icon bi bi-images"></i>
                        <a href="{{ route('admin.album.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Quản lý Album tóc <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col - Đặt lịch / Liên hệ-->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning shadow-sm">
                        <div class="inner">
                            <h3>{{ $totalContacts ?? 0 }}</h3>
                            <p>Khách Đặt Lịch & Liên Hệ</p>
                        </div>
                        <i class="small-box-icon bi bi-calendar-check"></i>
                        <a href="{{ route('admin.contact.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            Xem lịch hẹn <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col - Bài viết / Xu hướng-->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger shadow-sm">
                        <div class="inner">
                            <h3>{{ $totalPosts ?? 0 }}</h3>
                            <p>Bài viết</p>
                        </div>
                        <i class="small-box-icon bi bi-newspaper"></i>
                        <a href="{{ route('admin.post.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Quản lý tin tức <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row - Latest Contacts Table-->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title fw-bold text-dark mb-0">
                                <i class="bi bi-calendar-heart text-primary me-2"></i> Khách Hàng Đặt Lịch & Liên Hệ Mới Nhất
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>Họ và tên</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Nội dung / Dịch vụ yêu cầu</th>
                                            <th>Thời gian gửi</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($latestContacts ?? [] as $contact)
                                            <tr>
                                                <td><span class="badge bg-secondary">#{{ $contact->id }}</span></td>
                                                <td class="fw-semibold text-primary">{{ $contact->name }}</td>
                                                <td><a href="tel:{{ $contact->phone }}" class="text-decoration-none fw-bold text-dark">{{ $contact->phone }}</a></td>
                                                <td>{{ $contact->email ?: 'N/A' }}</td>
                                                <td><div class="text-truncate" style="max-width: 300px;">{{ $contact->content ?: $contact->title }}</div></td>
                                                <td><small class="text-muted">{{ $contact->created_at ? $contact->created_at->format('d/m/Y H:i') : '' }}</small></td>
                                                <td>
                                                    <a href="{{ route('admin.contact.show', $contact->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i> Chi tiết
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">
                                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i> Chưa có liên hệ / lịch hẹn mới nào
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-end py-2">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-primary">
                                Xem toàn bộ lịch hẹn <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection


@push('scripts')
    <script>
        const connectedSortables = document.querySelectorAll('.connectedSortable');
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: 'shared',
                handle: '.card-header',
            });
        });

        const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    </script>

    {{-- ChartJS --}}
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    </script>

    {{-- jsvectormap --}}
    <script>
        const visitorsData = {
            US: 398, // USA
            SA: 400, // Saudi Arabia
            CA: 1000, // Canada
            DE: 500, // Germany
            FR: 760, // France
            CN: 300, // China
            AU: 700, // Australia
            BR: 600, // Brazil
            IN: 800, // India
            GB: 320, // Great Britain
            RU: 3000, // Russia
        };

        // World map by jsVectorMap
        const map = new jsVectorMap({
            selector: '#world-map',
            map: 'world',
        });

        // Sparkline charts
        const option_sparkline1 = {
            series: [{
                data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
        sparkline1.render();

        const option_sparkline2 = {
            series: [{
                data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
        sparkline2.render();

        const option_sparkline3 = {
            series: [{
                data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
        sparkline3.render();
    </script>
@endpush
