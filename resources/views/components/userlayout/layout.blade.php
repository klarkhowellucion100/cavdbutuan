<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>| CAVD Butuan</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('frontend/guestlayout/images/cavd.png') }}" />

    <link rel="stylesheet" href="{{ url('frontend/userlayout/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/userlayout/css/backend.css?v=1.0.0') }}">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<header>
    <style>
        /* The modal background */
        .custom-modal {
            display: none;
            /* hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* black with opacity */
        }

        /* Modal content box */
        .custom-modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        /* Modal header */
        .custom-modal-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Close button top-right */
        .custom-close-btn {
            position: absolute;
            right: 15px;
            top: 15px;
            cursor: pointer;
            font-size: 20px;
            border: none;
            background: none;
        }

        /* Modal footer buttons */
        .custom-modal-footer {
            margin-top: 20px;
            text-align: right;
        }

        .selected-date-highlight {
            background-color: #0d6efd !important;
            /* Bootstrap primary color */
            color: white !important;
        }

        .toast-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.4s ease;
            min-width: 250px;
            max-width: 350px;
        }

        .toast-show {
            opacity: 1;
            transform: translateX(0);
        }

        .toast-icon {
            font-size: 20px;
            margin-right: 12px;
        }

        .toast-message {
            flex: 1;
            font-weight: 500;
        }

        .toast-close {
            background: transparent;
            border: none;
            font-size: 20px;
            color: #fff;
            cursor: pointer;
            margin-left: 10px;
        }


        @media (max-width: 576px) {
            .fc-event-title {
                font-size: 0.75rem;
            }

            .fc-toolbar-title {
                font-size: 1rem;
            }

            .fc-daygrid-event {
                padding: 1px !important;
            }

            .fc .fc-toolbar-title {
                font-size: 0.9rem;
            }

            .fc .fc-button {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
            }

            .fc .fc-toolbar {
                padding: 0.3rem 0;
            }

            .fc .fc-col-header-cell-cushion {
                font-size: 0.75rem;
                padding: 2px 4px;
            }

            .fc .fc-daygrid-day-number {
                font-size: 0.75rem;
                padding: 2px;
            }

            .fc-daygrid-body {
                max-height: 300px;
                overflow-y: auto;
            }

            .fc-daygrid-day-frame {
                max-height: 100px;
                overflow-y: auto;
            }
        }
    </style>
</header>

<body class="color-light ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="iq-sidebar  sidebar-default">
            <div class="iq-sidebar-logo d-flex align-items-end justify-content-between">
                <a href="{{ route('dashboard') }}" class="header-logo">
                    <img src="{{ url('frontend/guestlayout/images/CAVD.png') }}"
                        class="img-fluid rounded-normal light-logo" alt="logo">
                    <img src="{{ url('frontend/guestlayout/images/CAVD.png') }}"
                        class="img-fluid rounded-normal d-none sidebar-light-img" alt="logo">
                    <span>CAVD</span>
                </a>
                <div class="side-menu-bt-sidebar-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="side-menu">
                        <li class=" sidebar-layout">
                            <a href="{{ route('dashboard') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </i>
                                <span class="ml-2">Dashboard</span>
                                <p class="mb-0 w-10 badge badge-pill badge-primary">6</p>
                            </a>
                        </li>
                        <li class="px-3 pt-3 pb-2">
                            <span class="text-uppercase small font-weight-bold">Services</span>
                        </li>
                        {{-- <li class=" sidebar-layout">
                            <a href="../app/user-profile.html" class="svg-icon">
                                <i class="">
                                    <svg class="svg-icon" id="iq-user-1-1" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </i><span class="ml-2">User Profile</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-layout">
                            <a href="#app1" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                                <i class=""><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                </i>
                                <span class="ml-2">Farm Mechanization</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"
                                    width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <ul id="app1" class="submenu collapse" data-parent="#iq-sidebar-toggle">

                                <li class="sidebar-layout">
                                    <a href="{{ route('farmmechanization.user.availability.index') }}" class="svg-icon">
                                        <i class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                        </i><span class="">Availability</span>
                                    </a>
                                </li>

                                <div class="line"></div>

                                <li class="sidebar-layout">
                                    <a href="{{ route('farmmechanization.user.blockdates.index') }}" class="svg-icon">
                                        <i class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                        </i><span class="">Block Dates</span>
                                    </a>
                                </li>

                                <li class="sidebar-layout">
                                    <a href="{{ route('farmmechanization.user.scheduled.admincreate') }}"
                                        class="svg-icon">
                                        <i class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </i><span class="">Create</span>
                                    </a>
                                </li>

                                <li class="sidebar-layout">
                                    <a href="{{ route('farmmechanization.user.pending.index') }}" class="svg-icon">
                                        <i class=""><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                        </i>
                                        <span class="">Appointments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-layout">
                            <a href="#app6" class="collapsed svg-icon" data-toggle="collapse"
                                aria-expanded="false">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 64 64"
                                        class="size-6">
                                        <!-- Heel Pad -->
                                        <path d="M32 44c-7 0-14 4-14 10s7 10 14 10 14-4 14-10-7-10-14-10z" />

                                        <!-- Toe Pads -->
                                        <ellipse cx="16" cy="24" rx="6" ry="8" />
                                        <ellipse cx="48" cy="24" rx="6" ry="8" />
                                        <ellipse cx="24" cy="12" rx="5" ry="7" />
                                        <ellipse cx="40" cy="12" rx="5" ry="7" />
                                    </svg>
                                </i>
                                <span class="ml-2">Castration and Spay</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"
                                    width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <ul id="app6" class="submenu collapse" data-parent="#iq-sidebar-toggle">

                                <li class="sidebar-layout">
                                    <a href="{{ route('castrationandspay.user.availability.index') }}"
                                        class="svg-icon">
                                        <i class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                        </i><span class="">Availability</span>
                                    </a>
                                </li>

                                <div class="line"></div>

                                <li class="sidebar-layout">
                                    <a href="{{ route('castrationandspay.user.blockdates.index') }}"
                                        class="svg-icon">
                                        <i class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                        </i><span class="">Block Dates</span>
                                    </a>
                                </li>
                                <li class="sidebar-layout">
                                    <a href="#" class="svg-icon">
                                        <i class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </i><span class="">Create</span>
                                    </a>
                                </li>
                                <li class="sidebar-layout">
                                    <a href="#" class="svg-icon">
                                        <i class=""><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                        </i>
                                        <span class="">Appointments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="pt-5 pb-5"></div>
            </div>
        </div>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="side-menu-bt-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary wrapper-menu" width="30"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle"
                                        id="notification-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        <span class="bg-primary"></span>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu"
                                        aria-labelledby="notification-dropdown">
                                        <div class="card shadow-none m-0 border-0">
                                            <div class="p-3 card-header-border">
                                                <h6 class="text-center">
                                                    Notifications
                                                </h6>
                                            </div>
                                            <div class="card-body overflow-auto card-header-border p-0 card-body-list"
                                                style="max-height: 500px;">
                                                <ul class="dropdown-menu-1 overflow-auto list-style-1 mb-0">
                                                    <li class="dropdown-item-1 float-none p-3">
                                                        <div
                                                            class="list-item d-flex justify-content-start align-items-start">
                                                            <div class="avatar">
                                                                <div class="avatar-img avatar-danger avatar-20">
                                                                    <span>
                                                                        <svg class="icon line" width="30"
                                                                            height="30" id="cart-alt1"
                                                                            stroke="white"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24">
                                                                            <path
                                                                                d="M3,3H5.32a1,1,0,0,1,.93.63L10,13,8.72,15.55A1,1,0,0,0,9.62,17H19"
                                                                                style="fill: none;stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                                            </path>
                                                                            <polyline points="10 13 18.2 13 21 6"
                                                                                style="fill: none;stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                                            </polyline>
                                                                            <line x1="20.8" y1="6"
                                                                                x2="7.2" y2="6"
                                                                                style="fill: none;stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                                            </line>
                                                                            <circle cx="10.5" cy="20.5"
                                                                                r="0.5"
                                                                                style="fill: none;stroke-miterlimit: 10; stroke-width: 2;">
                                                                            </circle>
                                                                            <circle cx="16.5" cy="20.5"
                                                                                r="0.5"
                                                                                style="fill: none;stroke-miterlimit: 10; stroke-width: 2;">
                                                                            </circle>
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="list-style-detail ml-2 mr-2">
                                                                <h6 class="font-weight-bold">Your order is placed</h6>
                                                                <p class="m-0">
                                                                    <small class="text-secondary">If several languages
                                                                        coalesce</small>
                                                                </p>
                                                                <p class="m-0">
                                                                    <small class="text-secondary">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="text-secondary mr-1" width="15"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                        </svg>
                                                                        3 hours ago</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item-1 float-none p-3">
                                                        <div
                                                            class="list-item d-flex justify-content-start align-items-start">
                                                            <div class="avatar">
                                                                <div class="avatar-img avatar-success avatar-20">
                                                                    <span><img class="avatar is-squared rounded-circle"
                                                                            src="frontend/userlayout/images/user/2.jpg"
                                                                            alt="2.jpg"></span>
                                                                </div>
                                                            </div>
                                                            <div class="list-style-detail ml-2 mr-2">
                                                                <h6 class="font-weight-bold">New message form cate
                                                                </h6>
                                                                <p class="m-0">
                                                                    <small class="text-secondary">You have 3 unreded
                                                                        messages</small>
                                                                </p>
                                                                <p class="m-0">
                                                                    <small class="text-secondary">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="text-secondary mr-1" width="15"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                        </svg>
                                                                        5 hours ago</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item-1 float-none p-3">
                                                        <div
                                                            class="list-item d-flex justify-content-start align-items-start">
                                                            <div class="avatar">
                                                                <div class="avatar-img avatar-warning avatar-20">
                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            version="1.1" width="30"
                                                                            height="30" stroke="white"
                                                                            id="Capa_1" x="0px" y="0px"
                                                                            viewBox="0 0 512 512"
                                                                            style="enable-background:new 0 0 512 512;"
                                                                            xml:space="preserve">
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M386.689,304.403c-35.587,0-64.538,28.951-64.538,64.538s28.951,64.538,64.538,64.538    c35.593,0,64.538-28.951,64.538-64.538S422.276,304.403,386.689,304.403z M386.689,401.21c-17.796,0-32.269-14.473-32.269-32.269    c0-17.796,14.473-32.269,32.269-32.269c17.796,0,32.269,14.473,32.269,32.269C418.958,386.738,404.485,401.21,386.689,401.21z" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M166.185,304.403c-35.587,0-64.538,28.951-64.538,64.538s28.951,64.538,64.538,64.538s64.538-28.951,64.538-64.538    S201.772,304.403,166.185,304.403z M166.185,401.21c-17.796,0-32.269-14.473-32.269-32.269c0-17.796,14.473-32.269,32.269-32.269    c17.791,0,32.269,14.473,32.269,32.269C198.454,386.738,183.981,401.21,166.185,401.21z" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M430.15,119.675c-2.743-5.448-8.32-8.885-14.419-8.885h-84.975v32.269h75.025l43.934,87.384l28.838-14.5L430.15,119.675z" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <rect x="216.202" y="353.345"
                                                                                        width="122.084"
                                                                                        height="32.269" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M117.781,353.345H61.849c-8.912,0-16.134,7.223-16.134,16.134c0,8.912,7.223,16.134,16.134,16.134h55.933    c8.912,0,16.134-7.223,16.134-16.134C133.916,360.567,126.693,353.345,117.781,353.345z" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M508.612,254.709l-31.736-40.874c-3.049-3.937-7.755-6.239-12.741-6.239H346.891V94.655    c0-8.912-7.223-16.134-16.134-16.134H61.849c-8.912,0-16.134,7.223-16.134,16.134s7.223,16.134,16.134,16.134h252.773v112.941    c0,8.912,7.223,16.134,16.134,16.134h125.478l23.497,30.268v83.211h-44.639c-8.912,0-16.134,7.223-16.134,16.134    c0,8.912,7.223,16.134,16.134,16.134h60.773c8.912,0,16.134-7.223,16.135-16.134V264.605    C512,261.023,510.806,257.538,508.612,254.709z" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M116.706,271.597H42.487c-8.912,0-16.134,7.223-16.134,16.134c0,8.912,7.223,16.134,16.134,16.134h74.218    c8.912,0,16.134-7.223,16.134-16.134C132.84,278.82,125.617,271.597,116.706,271.597z" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M153.815,208.134H16.134C7.223,208.134,0,215.357,0,224.269s7.223,16.134,16.134,16.134h137.681    c8.912,0,16.134-7.223,16.134-16.134S162.727,208.134,153.815,208.134z" />
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M180.168,144.672H42.487c-8.912,0-16.134,7.223-16.134,16.134c0,8.912,7.223,16.134,16.134,16.134h137.681    c8.912,0,16.134-7.223,16.134-16.134C196.303,151.895,189.08,144.672,180.168,144.672z" />
                                                                                </g>
                                                                            </g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                            <g></g>
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="list-style-detail ml-2 mr-2">
                                                                <h6 class="font-weight-bold">Your item is shipped</h6>
                                                                <p class="m-0">
                                                                    <small class="text-secondary">You got new order of
                                                                        goods</small>
                                                                </p>
                                                                <p class="m-0">
                                                                    <small class="text-secondary">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="text-secondary mr-1" width="15"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                        </svg>
                                                                        5 hours ago</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-footer text-muted p-3">
                                                <p class="mb-0 text-primary text-center font-weight-bold">Show all
                                                    notifications</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item nav-icon search-content">
                                    <a href="#" class="search-toggle rounded" id="dropdownSearch"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="svg-icon text-secondary" id="h-suns" height="25"
                                            width="25" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu"
                                        aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12"
                                                    placeholder="type here to search...">
                                                <a href="#" class="search-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class=""
                                                        width="20" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="nav-item nav-icon dropdown-toggle pr-0 search-toggle"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img src="{{ url('frontend/userlayout/images/user/1.jpg') }}"
                                            class="img-fluid avatar-rounded" alt="user">
                                        <span class="mb-0 ml-2 user-name">{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-item d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-secondary" id="h-01-p" width="20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <a href="../app/user-profile.html">My Profile</a>
                                        </li>
                                        <li class="dropdown-item d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-secondary" id="h-02-p" width="20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <a href="../app/user-profile-edit.html">Edit Profile</a>
                                        </li>
                                        <li class="dropdown-item d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-secondary" id="h-03-p" width="20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <a href="../app/user-account-setting.html">Account Settings</a>
                                        </li>
                                        <li class="dropdown-item d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-secondary" id="h-04-p" width="20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            <a href="../app/user-privacy-setting.html">Privacy Settings</a>
                                        </li>
                                        @auth
                                            <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                                style="display: none;">
                                                @csrf
                                                @method('POST')
                                            </form>
                                            <li class="dropdown-item  d-flex svg-icon border-top">
                                                <svg class="svg-icon mr-0 text-secondary" id="h-05-p" width="20"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                <a
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            </li>
                                        @endauth
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="toast-alert toast-show" id="toastAlert">
                    <div class="toast-icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div class="toast-message">
                        {{ session('success') }}
                    </div>
                    <button class="toast-close"
                        onclick="document.getElementById('toastAlert').style.display='none';">&times;</button>
                </div>
            @endif

            <script>
                setTimeout(function() {
                    const toast = document.getElementById('toastAlert');
                    if (toast) toast.classList.remove('toast-show');
                }, 5000);
            </script>

        </div>
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    {{-- <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="../backend/privacy-policy.html">Privacy Policy</a>
                        </li>
                        <li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of Use</a>
                        </li>
                    </ul> --}}
                </div>
                <div class="col-lg-6 text-right">
                    <span class="mr-1">
                        City Agriculture and Veterinary Department
                        <script>
                            document.write(new Date().getFullYear())
                        </script> <a href="#" class="">CAVD</a>
                    </span>
                </div>
            </div>
        </div>
    </footer> <!-- Backend Bundle JavaScript -->
    <script src="{{ url('frontend/userlayout/js/backend-bundle.min.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ url('frontend/userlayout/js/customizer.js') }}"></script>

    <script src="{{ url('frontend/userlayout/js/sidebar.js') }}"></script>

    <!-- Flextree Javascript-->
    <script src="{{ url('frontend/userlayout/js/flex-tree.min.js') }}"></script>
    <script src="{{ url('frontend/userlayout/js/tree.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ url('frontend/userlayout/js/table-treeview.js') }}"></script>

    <!-- SweetAlert JavaScript -->
    <script src="{{ url('frontend/userlayout/js/sweetalert.js') }}"></script>

    <!-- Vectoe Map JavaScript -->
    <script src="{{ url('frontend/userlayout/js/vector-map-custom.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ url('frontend/userlayout/js/chart-custom.js') }}"></script>
    <script src="{{ url('frontend/userlayout/js/charts/01.js') }}"></script>
    <script src="{{ url('frontend/userlayout/js/charts/02.js') }}"></script>

    <!-- slider JavaScript -->
    <script src="{{ url('frontend/userlayout/js/slider.js') }}"></script>

    <!-- Emoji picker -->
    <script src="{{ url('frontend/userlayout/vendor/emoji-picker-element/index.js') }}" type="module"></script>


    <!-- app JavaScript -->
    <script src="{{ url('frontend/userlayout/js/app.js') }}"></script>
</body>

</html>
