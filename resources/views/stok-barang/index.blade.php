@extends('layouts.admin') @section('content')
<div class="container-lg px-4">
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div
                class="card"
                style="--cui-card-cap-bg: #3b5998"
            >
                <div
                    class="card-header position-relative d-flex justify-content-center align-items-center"
                >
                    <svg class="icon icon-3xl text-white my-4">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"
                        ></use>
                    </svg>
                    <div
                        class="chart-wrapper position-absolute top-0 start-0 w-100 h-100"
                    >
                        <canvas
                            id="social-box-chart-1"
                            height="90"
                        ></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">89k</div>
                        <div
                            class="text-uppercase text-body-secondary small"
                        >
                            friends
                        </div>
                    </div>
                    <div class="vr"></div>
                    <div class="col">
                        <div class="fs-5 fw-semibold">459</div>
                        <div
                            class="text-uppercase text-body-secondary small"
                        >
                            feeds
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-4">
            <div
                class="card"
                style="--cui-card-cap-bg: #00aced"
            >
                <div
                    class="card-header position-relative d-flex justify-content-center align-items-center"
                >
                    <svg class="icon icon-3xl text-white my-4">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-twitter"
                        ></use>
                    </svg>
                    <div
                        class="chart-wrapper position-absolute top-0 start-0 w-100 h-100"
                    >
                        <canvas
                            id="social-box-chart-2"
                            height="90"
                        ></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">973k</div>
                        <div
                            class="text-uppercase text-body-secondary small"
                        >
                            followers
                        </div>
                    </div>
                    <div class="vr"></div>
                    <div class="col">
                        <div class="fs-5 fw-semibold">
                            1.792
                        </div>
                        <div
                            class="text-uppercase text-body-secondary small"
                        >
                            tweets
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-4">
            <div
                class="card"
                style="--cui-card-cap-bg: #4875b4"
            >
                <div
                    class="card-header position-relative d-flex justify-content-center align-items-center"
                >
                    <svg class="icon icon-3xl text-white my-4">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin"
                        ></use>
                    </svg>
                    <div
                        class="chart-wrapper position-absolute top-0 start-0 w-100 h-100"
                    >
                        <canvas
                            id="social-box-chart-3"
                            height="90"
                        ></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">500+</div>
                        <div
                            class="text-uppercase text-body-secondary small"
                        >
                            contacts
                        </div>
                    </div>
                    <div class="vr"></div>
                    <div class="col">
                        <div class="fs-5 fw-semibold">292</div>
                        <div
                            class="text-uppercase text-body-secondary small"
                        >
                            feeds
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    Traffic &amp; Sales
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div
                                        class="border-start border-start-4 border-start-info px-3 mb-3"
                                    >
                                        <div
                                            class="small text-body-secondary text-truncate"
                                        >
                                            New Clients
                                        </div>
                                        <div
                                            class="fs-5 fw-semibold"
                                        >
                                            9.123
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                                <div class="col-6">
                                    <div
                                        class="border-start border-start-4 border-start-danger px-3 mb-3"
                                    >
                                        <div
                                            class="small text-body-secondary text-truncate"
                                        >
                                            Recuring Clients
                                        </div>
                                        <div
                                            class="fs-5 fw-semibold"
                                        >
                                            22.643
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                            <hr class="mt-0" />
                            <div class="progress-group mb-4">
                                <div
                                    class="progress-group-prepend"
                                >
                                    <span
                                        class="text-body-secondary small"
                                        >Monday</span
                                    >
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-info"
                                            role="progressbar"
                                            style="width: 34%"
                                            aria-valuenow="34"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-danger"
                                            role="progressbar"
                                            style="width: 78%"
                                            aria-valuenow="78"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group mb-4">
                                <div
                                    class="progress-group-prepend"
                                >
                                    <span
                                        class="text-body-secondary small"
                                        >Tuesday</span
                                    >
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-info"
                                            role="progressbar"
                                            style="width: 56%"
                                            aria-valuenow="56"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-danger"
                                            role="progressbar"
                                            style="width: 94%"
                                            aria-valuenow="94"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group mb-4">
                                <div
                                    class="progress-group-prepend"
                                >
                                    <span
                                        class="text-body-secondary small"
                                        >Wednesday</span
                                    >
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-info"
                                            role="progressbar"
                                            style="width: 12%"
                                            aria-valuenow="12"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-danger"
                                            role="progressbar"
                                            style="width: 67%"
                                            aria-valuenow="67"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group mb-4">
                                <div
                                    class="progress-group-prepend"
                                >
                                    <span
                                        class="text-body-secondary small"
                                        >Thursday</span
                                    >
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-info"
                                            role="progressbar"
                                            style="width: 43%"
                                            aria-valuenow="43"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-danger"
                                            role="progressbar"
                                            style="width: 91%"
                                            aria-valuenow="91"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group mb-4">
                                <div
                                    class="progress-group-prepend"
                                >
                                    <span
                                        class="text-body-secondary small"
                                        >Friday</span
                                    >
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-info"
                                            role="progressbar"
                                            style="width: 22%"
                                            aria-valuenow="22"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-danger"
                                            role="progressbar"
                                            style="width: 73%"
                                            aria-valuenow="73"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group mb-4">
                                <div
                                    class="progress-group-prepend"
                                >
                                    <span
                                        class="text-body-secondary small"
                                        >Saturday</span
                                    >
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-info"
                                            role="progressbar"
                                            style="width: 53%"
                                            aria-valuenow="53"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-danger"
                                            role="progressbar"
                                            style="width: 82%"
                                            aria-valuenow="82"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group mb-4">
                                <div
                                    class="progress-group-prepend"
                                >
                                    <span
                                        class="text-body-secondary small"
                                        >Sunday</span
                                    >
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-info"
                                            role="progressbar"
                                            style="width: 9%"
                                            aria-valuenow="9"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-danger"
                                            role="progressbar"
                                            style="width: 69%"
                                            aria-valuenow="69"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div
                                        class="border-start border-start-4 border-start-warning px-3 mb-3"
                                    >
                                        <div
                                            class="small text-body-secondary text-truncate"
                                        >
                                            Pageviews
                                        </div>
                                        <div
                                            class="fs-5 fw-semibold"
                                        >
                                            78.623
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                                <div class="col-6">
                                    <div
                                        class="border-start border-start-4 border-start-success px-3 mb-3"
                                    >
                                        <div
                                            class="small text-body-secondary text-truncate"
                                        >
                                            Organic
                                        </div>
                                        <div
                                            class="fs-5 fw-semibold"
                                        >
                                            49.123
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                            <hr class="mt-0" />
                            <div class="progress-group">
                                <div
                                    class="progress-group-header"
                                >
                                    <svg
                                        class="icon icon-lg me-2"
                                    >
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"
                                        ></use>
                                    </svg>
                                    <div>Male</div>
                                    <div
                                        class="ms-auto fw-semibold"
                                    >
                                        43%
                                    </div>
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-warning"
                                            role="progressbar"
                                            style="width: 43%"
                                            aria-valuenow="43"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group mb-5">
                                <div
                                    class="progress-group-header"
                                >
                                    <svg
                                        class="icon icon-lg me-2"
                                    >
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-female"
                                        ></use>
                                    </svg>
                                    <div>Female</div>
                                    <div
                                        class="ms-auto fw-semibold"
                                    >
                                        37%
                                    </div>
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-warning"
                                            role="progressbar"
                                            style="width: 43%"
                                            aria-valuenow="43"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group">
                                <div
                                    class="progress-group-header"
                                >
                                    <svg
                                        class="icon icon-lg me-2"
                                    >
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-google"
                                        ></use>
                                    </svg>
                                    <div>Organic Search</div>
                                    <div
                                        class="ms-auto fw-semibold me-2"
                                    >
                                        191.235
                                    </div>
                                    <div
                                        class="text-body-secondary small"
                                    >
                                        (56%)
                                    </div>
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-success"
                                            role="progressbar"
                                            style="width: 56%"
                                            aria-valuenow="56"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group">
                                <div
                                    class="progress-group-header"
                                >
                                    <svg
                                        class="icon icon-lg me-2"
                                    >
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"
                                        ></use>
                                    </svg>
                                    <div>Facebook</div>
                                    <div
                                        class="ms-auto fw-semibold me-2"
                                    >
                                        51.223
                                    </div>
                                    <div
                                        class="text-body-secondary small"
                                    >
                                        (15%)
                                    </div>
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-success"
                                            role="progressbar"
                                            style="width: 15%"
                                            aria-valuenow="15"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group">
                                <div
                                    class="progress-group-header"
                                >
                                    <svg
                                        class="icon icon-lg me-2"
                                    >
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-twitter"
                                        ></use>
                                    </svg>
                                    <div>Twitter</div>
                                    <div
                                        class="ms-auto fw-semibold me-2"
                                    >
                                        37.564
                                    </div>
                                    <div
                                        class="text-body-secondary small"
                                    >
                                        (11%)
                                    </div>
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-success"
                                            role="progressbar"
                                            style="width: 11%"
                                            aria-valuenow="11"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-group">
                                <div
                                    class="progress-group-header"
                                >
                                    <svg
                                        class="icon icon-lg me-2"
                                    >
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin"
                                        ></use>
                                    </svg>
                                    <div>LinkedIn</div>
                                    <div
                                        class="ms-auto fw-semibold me-2"
                                    >
                                        27.319
                                    </div>
                                    <div
                                        class="text-body-secondary small"
                                    >
                                        (8%)
                                    </div>
                                </div>
                                <div
                                    class="progress-group-bars"
                                >
                                    <div
                                        class="progress progress-thin"
                                    >
                                        <div
                                            class="progress-bar bg-success"
                                            role="progressbar"
                                            style="width: 8%"
                                            aria-valuenow="8"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                    <!-- /.row--><br />
                    <div class="table-responsive">
                        <table class="table border mb-0">
                            <thead
                                class="fw-semibold text-nowrap"
                            >
                                <tr class="align-middle">
                                    <th
                                        class="bg-body-secondary text-center"
                                    >
                                        <svg class="icon">
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"
                                            ></use>
                                        </svg>
                                    </th>
                                    <th
                                        class="bg-body-secondary"
                                    >
                                        User
                                    </th>
                                    <th
                                        class="bg-body-secondary text-center"
                                    >
                                        Country
                                    </th>
                                    <th
                                        class="bg-body-secondary"
                                    >
                                        Usage
                                    </th>
                                    <th
                                        class="bg-body-secondary text-center"
                                    >
                                        Payment Method
                                    </th>
                                    <th
                                        class="bg-body-secondary"
                                    >
                                        Activity
                                    </th>
                                    <th
                                        class="bg-body-secondary"
                                    ></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <div
                                            class="avatar avatar-md"
                                        >
                                            <img
                                                class="avatar-img"
                                                src="assets/img/avatars/1.jpg"
                                                alt="user@email.com"
                                            /><span
                                                class="avatar-status bg-success"
                                            ></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-nowrap"
                                        >
                                            Yiorgos Avraamu
                                        </div>
                                        <div
                                            class="small text-body-secondary text-nowrap"
                                        >
                                            <span>New</span> |
                                            Registered: Jan 1,
                                            2023
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-us"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="d-flex justify-content-between align-items-baseline"
                                        >
                                            <div
                                                class="fw-semibold"
                                            >
                                                50%
                                            </div>
                                            <div
                                                class="text-nowrap small text-body-secondary ms-3"
                                            >
                                                Jun 11, 2023 -
                                                Jul 10, 2023
                                            </div>
                                        </div>
                                        <div
                                            class="progress progress-thin"
                                        >
                                            <div
                                                class="progress-bar bg-success"
                                                role="progressbar"
                                                style="
                                                    width: 50%;
                                                "
                                                aria-valuenow="50"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="small text-body-secondary"
                                        >
                                            Last login
                                        </div>
                                        <div
                                            class="fw-semibold text-nowrap"
                                        >
                                            10 sec ago
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-transparent p-0"
                                                type="button"
                                                data-coreui-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <svg
                                                    class="icon"
                                                >
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"
                                                    ></use>
                                                </svg>
                                            </button>
                                            <div
                                                class="dropdown-menu dropdown-menu-end"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Info</a
                                                ><a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Edit</a
                                                ><a
                                                    class="dropdown-item text-danger"
                                                    href="#"
                                                    >Delete</a
                                                >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <div
                                            class="avatar avatar-md"
                                        >
                                            <img
                                                class="avatar-img"
                                                src="assets/img/avatars/2.jpg"
                                                alt="user@email.com"
                                            /><span
                                                class="avatar-status bg-danger"
                                            ></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-nowrap"
                                        >
                                            Avram Tarasios
                                        </div>
                                        <div
                                            class="small text-body-secondary text-nowrap"
                                        >
                                            <span
                                                >Recurring</span
                                            >
                                            | Registered: Jan 1,
                                            2023
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-br"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="d-flex justify-content-between align-items-baseline"
                                        >
                                            <div
                                                class="fw-semibold"
                                            >
                                                10%
                                            </div>
                                            <div
                                                class="text-nowrap small text-body-secondary ms-3"
                                            >
                                                Jun 11, 2023 -
                                                Jul 10, 2023
                                            </div>
                                        </div>
                                        <div
                                            class="progress progress-thin"
                                        >
                                            <div
                                                class="progress-bar bg-info"
                                                role="progressbar"
                                                style="
                                                    width: 10%;
                                                "
                                                aria-valuenow="10"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-visa"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="small text-body-secondary"
                                        >
                                            Last login
                                        </div>
                                        <div
                                            class="fw-semibold text-nowrap"
                                        >
                                            5 minutes ago
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-transparent p-0"
                                                type="button"
                                                data-coreui-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <svg
                                                    class="icon"
                                                >
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"
                                                    ></use>
                                                </svg>
                                            </button>
                                            <div
                                                class="dropdown-menu dropdown-menu-end"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Info</a
                                                ><a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Edit</a
                                                ><a
                                                    class="dropdown-item text-danger"
                                                    href="#"
                                                    >Delete</a
                                                >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <div
                                            class="avatar avatar-md"
                                        >
                                            <img
                                                class="avatar-img"
                                                src="assets/img/avatars/3.jpg"
                                                alt="user@email.com"
                                            /><span
                                                class="avatar-status bg-warning"
                                            ></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-nowrap"
                                        >
                                            Quintin Ed
                                        </div>
                                        <div
                                            class="small text-body-secondary text-nowrap"
                                        >
                                            <span>New</span> |
                                            Registered: Jan 1,
                                            2023
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-in"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="d-flex justify-content-between align-items-baseline"
                                        >
                                            <div
                                                class="fw-semibold"
                                            >
                                                74%
                                            </div>
                                            <div
                                                class="text-nowrap small text-body-secondary ms-3"
                                            >
                                                Jun 11, 2023 -
                                                Jul 10, 2023
                                            </div>
                                        </div>
                                        <div
                                            class="progress progress-thin"
                                        >
                                            <div
                                                class="progress-bar bg-warning"
                                                role="progressbar"
                                                style="
                                                    width: 74%;
                                                "
                                                aria-valuenow="74"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-stripe"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="small text-body-secondary"
                                        >
                                            Last login
                                        </div>
                                        <div
                                            class="fw-semibold text-nowrap"
                                        >
                                            1 hour ago
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-transparent p-0"
                                                type="button"
                                                data-coreui-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <svg
                                                    class="icon"
                                                >
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"
                                                    ></use>
                                                </svg>
                                            </button>
                                            <div
                                                class="dropdown-menu dropdown-menu-end"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Info</a
                                                ><a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Edit</a
                                                ><a
                                                    class="dropdown-item text-danger"
                                                    href="#"
                                                    >Delete</a
                                                >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <div
                                            class="avatar avatar-md"
                                        >
                                            <img
                                                class="avatar-img"
                                                src="assets/img/avatars/4.jpg"
                                                alt="user@email.com"
                                            /><span
                                                class="avatar-status bg-secondary"
                                            ></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-nowrap"
                                        >
                                            Enéas Kwadwo
                                        </div>
                                        <div
                                            class="small text-body-secondary text-nowrap"
                                        >
                                            <span>New</span> |
                                            Registered: Jan 1,
                                            2023
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-fr"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="d-flex justify-content-between align-items-baseline"
                                        >
                                            <div
                                                class="fw-semibold"
                                            >
                                                98%
                                            </div>
                                            <div
                                                class="text-nowrap small text-body-secondary ms-3"
                                            >
                                                Jun 11, 2023 -
                                                Jul 10, 2023
                                            </div>
                                        </div>
                                        <div
                                            class="progress progress-thin"
                                        >
                                            <div
                                                class="progress-bar bg-danger"
                                                role="progressbar"
                                                style="
                                                    width: 98%;
                                                "
                                                aria-valuenow="98"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-paypal"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="small text-body-secondary"
                                        >
                                            Last login
                                        </div>
                                        <div
                                            class="fw-semibold text-nowrap"
                                        >
                                            Last month
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-transparent p-0"
                                                type="button"
                                                data-coreui-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <svg
                                                    class="icon"
                                                >
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"
                                                    ></use>
                                                </svg>
                                            </button>
                                            <div
                                                class="dropdown-menu dropdown-menu-end"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Info</a
                                                ><a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Edit</a
                                                ><a
                                                    class="dropdown-item text-danger"
                                                    href="#"
                                                    >Delete</a
                                                >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <div
                                            class="avatar avatar-md"
                                        >
                                            <img
                                                class="avatar-img"
                                                src="assets/img/avatars/5.jpg"
                                                alt="user@email.com"
                                            /><span
                                                class="avatar-status bg-success"
                                            ></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-nowrap"
                                        >
                                            Agapetus Tadeáš
                                        </div>
                                        <div
                                            class="small text-body-secondary text-nowrap"
                                        >
                                            <span>New</span> |
                                            Registered: Jan 1,
                                            2023
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-es"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="d-flex justify-content-between align-items-baseline"
                                        >
                                            <div
                                                class="fw-semibold"
                                            >
                                                22%
                                            </div>
                                            <div
                                                class="text-nowrap small text-body-secondary ms-3"
                                            >
                                                Jun 11, 2023 -
                                                Jul 10, 2023
                                            </div>
                                        </div>
                                        <div
                                            class="progress progress-thin"
                                        >
                                            <div
                                                class="progress-bar bg-info"
                                                role="progressbar"
                                                style="
                                                    width: 22%;
                                                "
                                                aria-valuenow="22"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-apple-pay"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="small text-body-secondary"
                                        >
                                            Last login
                                        </div>
                                        <div
                                            class="fw-semibold text-nowrap"
                                        >
                                            Last week
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="dropdown dropup"
                                        >
                                            <button
                                                class="btn btn-transparent p-0"
                                                type="button"
                                                data-coreui-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <svg
                                                    class="icon"
                                                >
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"
                                                    ></use>
                                                </svg>
                                            </button>
                                            <div
                                                class="dropdown-menu dropdown-menu-end"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Info</a
                                                ><a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Edit</a
                                                ><a
                                                    class="dropdown-item text-danger"
                                                    href="#"
                                                    >Delete</a
                                                >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <div
                                            class="avatar avatar-md"
                                        >
                                            <img
                                                class="avatar-img"
                                                src="assets/img/avatars/6.jpg"
                                                alt="user@email.com"
                                            /><span
                                                class="avatar-status bg-danger"
                                            ></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-nowrap"
                                        >
                                            Friderik Dávid
                                        </div>
                                        <div
                                            class="small text-body-secondary text-nowrap"
                                        >
                                            <span>New</span> |
                                            Registered: Jan 1,
                                            2023
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-pl"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="d-flex justify-content-between align-items-baseline"
                                        >
                                            <div
                                                class="fw-semibold"
                                            >
                                                43%
                                            </div>
                                            <div
                                                class="text-nowrap small text-body-secondary ms-3"
                                            >
                                                Jun 11, 2023 -
                                                Jul 10, 2023
                                            </div>
                                        </div>
                                        <div
                                            class="progress progress-thin"
                                        >
                                            <div
                                                class="progress-bar bg-success"
                                                role="progressbar"
                                                style="
                                                    width: 43%;
                                                "
                                                aria-valuenow="43"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg
                                            class="icon icon-xl"
                                        >
                                            <use
                                                xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-amex"
                                            ></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div
                                            class="small text-body-secondary"
                                        >
                                            Last login
                                        </div>
                                        <div
                                            class="fw-semibold text-nowrap"
                                        >
                                            Yesterday
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="dropdown dropup"
                                        >
                                            <button
                                                class="btn btn-transparent p-0"
                                                type="button"
                                                data-coreui-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <svg
                                                    class="icon"
                                                >
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"
                                                    ></use>
                                                </svg>
                                            </button>
                                            <div
                                                class="dropdown-menu dropdown-menu-end"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Info</a
                                                ><a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Edit</a
                                                ><a
                                                    class="dropdown-item text-danger"
                                                    href="#"
                                                    >Delete</a
                                                >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
</div>
@endsection