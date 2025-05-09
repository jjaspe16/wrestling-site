<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wrestling Coach Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6', secondary: '#6366f1' }, borderRadius: { 'none': '0px', 'sm': '4px', DEFAULT: '8px', 'md': '12px', 'lg': '16px', 'xl': '20px', '2xl': '24px', '3xl': '32px', 'full': '9999px', 'button': '8px' } } } }</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        .custom-checkbox {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
            background-color: white;
            cursor: pointer;
        }

        .custom-checkbox.checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .custom-checkbox.checked::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 6px;
            width: 6px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .custom-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e5e7eb;
            transition: .4s;
            border-radius: 24px;
        }

        .switch-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.switch-slider {
            background-color: #3b82f6;
        }

        input:checked+.switch-slider:before {
            transform: translateX(20px);
        }

        .tab-active {
            color: #3b82f6;
            border-bottom: 2px solid #3b82f6;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge.cleared {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-badge.pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-badge.injured {
            background-color: #fee2e2;
            color: #b91c1c;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar ===========================================================-->
      <?php  
      include 'sidebar.html'; 
      ?>





        <!-- Main content ===============================-->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top navigation -->
            <header class="flex items-center justify-between h-16 px-4 sm:px-6 bg-white border-b border-gray-200">
                <div class="flex items-center md:hidden">
                    <button type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-menu-line"></i>
                        </div>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="relative w-64">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-search-line"></i>
                            </div>
                        </div>
                        <input type="text"
                            class="block w-full py-2 pl-10 pr-3 text-sm border-none rounded-md bg-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary"
                            placeholder="Search...">
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="button"
                        class="p-1 text-gray-400 hover:text-gray-500 focus:outline-none !rounded-button">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-notification-3-line"></i>
                        </div>
                    </button>
                    <div class="relative">
                        <button type="button"
                            class="flex items-center max-w-xs text-sm rounded-full focus:outline-none !rounded-button">
                            <img class="h-8 w-8 rounded-full"
                                src="https://readdy.ai/api/search-image?query=professional%20male%20wrestling%20coach%20portrait%2C%2040%20years%20old%2C%20athletic%20build%2C%20short%20hair%2C%20determined%20expression%2C%20neutral%20background&width=100&height=100&seq=coach1&orientation=squarish"
                                alt="">
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    <!-- Page header -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Coach Dashboard</h1>
                        <p class="mt-1 text-sm text-gray-500">Friday, May 2, 2025</p>
                    </div>

                    <!-- Stats cards -->
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                        <!-- Active players -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-primary">
                                            <i class="ri-user-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Active Players</dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">28</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-primary-dark">View all</a>
                                </div>
                            </div>
                        </div>

                        <!-- Upcoming matches -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-indigo-600">
                                            <i class="ri-calendar-event-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Matches</dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">5</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-primary-dark">View
                                        schedule</a>
                                </div>
                            </div>
                        </div>

                        <!-- Injuries -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-red-600">
                                            <i class="ri-heart-pulse-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Active Injuries</dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">3</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-primary-dark">View
                                        reports</a>
                                </div>
                            </div>
                        </div>

                        <!-- Medical clearance -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-yellow-600">
                                            <i class="ri-file-list-3-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Pending Clearances
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">4</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-primary-dark">Review all</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick actions -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-gray-900">Quick Actions</h2>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <button
                                class="flex items-center justify-center p-4 bg-white shadow rounded-lg hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                <div class="w-6 h-6 flex items-center justify-center text-primary mr-2">
                                    <i class="ri-user-add-line"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Add New Player</span>
                            </button>
                            <button
                                class="flex items-center justify-center p-4 bg-white shadow rounded-lg hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                <div class="w-6 h-6 flex items-center justify-center text-primary mr-2">
                                    <i class="ri-calendar-event-line"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Schedule Match</span>
                            </button>
                            <button
                                class="flex items-center justify-center p-4 bg-white shadow rounded-lg hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                <div class="w-6 h-6 flex items-center justify-center text-primary mr-2">
                                    <i class="ri-calendar-todo-line"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Schedule Practice</span>
                            </button>
                            <button
                                class="flex items-center justify-center p-4 bg-white shadow rounded-lg hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                <div class="w-6 h-6 flex items-center justify-center text-primary mr-2">
                                    <i class="ri-message-2-line"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Send Message</span>
                            </button>
                        </div>
                    </div>

                    <!-- Main content grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left column -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Upcoming events -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h2 class="text-lg font-medium text-gray-900">Upcoming Events</h2>
                                        <div class="flex space-x-2">
                                            <button
                                                class="px-3 py-1 text-xs font-medium text-primary bg-blue-50 rounded-full !rounded-button whitespace-nowrap">Matches</button>
                                            <button
                                                class="px-3 py-1 text-xs font-medium text-gray-500 bg-gray-100 rounded-full !rounded-button whitespace-nowrap">Practices</button>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                            <div
                                                class="flex-shrink-0 w-12 h-12 flex flex-col items-center justify-center bg-white rounded-lg shadow">
                                                <span class="text-xs font-medium text-gray-500">MAY</span>
                                                <span class="text-lg font-bold text-gray-900">5</span>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-sm font-medium text-gray-900">Regional Championship
                                                    Tournament</h3>
                                                <div class="flex items-center mt-1">
                                                    <div class="w-4 h-4 flex items-center justify-center text-gray-500">
                                                        <i class="ri-time-line"></i>
                                                    </div>
                                                    <span class="ml-1 text-xs text-gray-500">9:00 AM - 5:00 PM</span>
                                                    <div
                                                        class="w-4 h-4 flex items-center justify-center text-gray-500 ml-3">
                                                        <i class="ri-map-pin-line"></i>
                                                    </div>
                                                    <span class="ml-1 text-xs text-gray-500">Riverside High
                                                        School</span>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <button
                                                    class="p-1 text-gray-400 hover:text-gray-500 !rounded-button whitespace-nowrap">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-more-2-fill"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex items-center p-3 bg-white border border-gray-200 rounded-lg">
                                            <div
                                                class="flex-shrink-0 w-12 h-12 flex flex-col items-center justify-center bg-white rounded-lg shadow">
                                                <span class="text-xs font-medium text-gray-500">MAY</span>
                                                <span class="text-lg font-bold text-gray-900">8</span>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-sm font-medium text-gray-900">Dual Meet vs. Eastside
                                                    Warriors</h3>
                                                <div class="flex items-center mt-1">
                                                    <div class="w-4 h-4 flex items-center justify-center text-gray-500">
                                                        <i class="ri-time-line"></i>
                                                    </div>
                                                    <span class="ml-1 text-xs text-gray-500">4:30 PM - 7:00 PM</span>
                                                    <div
                                                        class="w-4 h-4 flex items-center justify-center text-gray-500 ml-3">
                                                        <i class="ri-map-pin-line"></i>
                                                    </div>
                                                    <span class="ml-1 text-xs text-gray-500">Home Gym</span>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <button
                                                    class="p-1 text-gray-400 hover:text-gray-500 !rounded-button whitespace-nowrap">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-more-2-fill"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex items-center p-3 bg-white border border-gray-200 rounded-lg">
                                            <div
                                                class="flex-shrink-0 w-12 h-12 flex flex-col items-center justify-center bg-white rounded-lg shadow">
                                                <span class="text-xs font-medium text-gray-500">MAY</span>
                                                <span class="text-lg font-bold text-gray-900">12</span>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-sm font-medium text-gray-900">Invitational Tournament
                                                </h3>
                                                <div class="flex items-center mt-1">
                                                    <div class="w-4 h-4 flex items-center justify-center text-gray-500">
                                                        <i class="ri-time-line"></i>
                                                    </div>
                                                    <span class="ml-1 text-xs text-gray-500">8:00 AM - 6:00 PM</span>
                                                    <div
                                                        class="w-4 h-4 flex items-center justify-center text-gray-500 ml-3">
                                                        <i class="ri-map-pin-line"></i>
                                                    </div>
                                                    <span class="ml-1 text-xs text-gray-500">Central Sports
                                                        Complex</span>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <button
                                                    class="p-1 text-gray-400 hover:text-gray-500 !rounded-button whitespace-nowrap">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-more-2-fill"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <a href="#"
                                            class="text-sm font-medium text-primary hover:text-primary-dark">View all
                                            events</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Team performance -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h2 class="text-lg font-medium text-gray-900">Team Performance</h2>
                                        <div>
                                            <select
                                                class="text-sm border-none bg-gray-100 rounded-md py-1 px-3 focus:outline-none focus:ring-2 focus:ring-primary pr-8">
                                                <option>Current Season</option>
                                                <option>Last Season</option>
                                                <option>All Time</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="team-performance-chart" class="h-64"></div>
                                </div>
                            </div>

                            <!-- Weight class distribution -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h2 class="text-lg font-medium text-gray-900">Weight Class Distribution</h2>
                                    </div>
                                    <div id="weight-distribution-chart" class="h-64"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Right column -->
                        <div class="space-y-6">
                            <!-- Medical alerts -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="p-6">
                                    <h2 class="text-lg font-medium text-gray-900 mb-4">Medical Alerts</h2>
                                    <div class="space-y-3">
                                        <div class="p-3 bg-red-50 rounded-lg">
                                            <div class="flex">
                                                <div class="w-5 h-5 flex items-center justify-center text-red-600">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-gray-900">Brandon Mitchell</h3>
                                                    <p class="text-xs text-gray-500 mt-1">Shoulder injury - Needs
                                                        clearance</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-yellow-50 rounded-lg">
                                            <div class="flex">
                                                <div class="w-5 h-5 flex items-center justify-center text-yellow-600">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-gray-900">Tyler Rodriguez</h3>
                                                    <p class="text-xs text-gray-500 mt-1">Medical form expires in 5 days
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-yellow-50 rounded-lg">
                                            <div class="flex">
                                                <div class="w-5 h-5 flex items-center justify-center text-yellow-600">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-gray-900">Marcus Johnson</h3>
                                                    <p class="text-xs text-gray-500 mt-1">Weight check required before
                                                        match</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <a href="#"
                                            class="text-sm font-medium text-primary hover:text-primary-dark">View all
                                            alerts</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent activity -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="p-6">
                                    <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h2>
                                    <div class="flow-root">
                                        <ul class="-mb-8">
                                            <li>
                                                <div class="relative pb-8">
                                                    <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                                        aria-hidden="true"></span>
                                                    <div class="relative flex items-start space-x-3">
                                                        <div class="relative">
                                                            <div
                                                                class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center ring-8 ring-white">
                                                                <div
                                                                    class="w-5 h-5 flex items-center justify-center text-primary">
                                                                    <i class="ri-trophy-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <div>
                                                                <div class="text-sm">
                                                                    <a href="#" class="font-medium text-gray-900">Match
                                                                        Result Added</a>
                                                                </div>
                                                                <p class="mt-0.5 text-sm text-gray-500">
                                                                    Daniel Thompson won by pin (2:45) vs. North High
                                                                </p>
                                                            </div>
                                                            <div class="mt-2 text-sm text-gray-500">
                                                                <p>Today at 10:32 AM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="relative pb-8">
                                                    <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                                        aria-hidden="true"></span>
                                                    <div class="relative flex items-start space-x-3">
                                                        <div class="relative">
                                                            <div
                                                                class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center ring-8 ring-white">
                                                                <div
                                                                    class="w-5 h-5 flex items-center justify-center text-green-600">
                                                                    <i class="ri-user-add-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <div>
                                                                <div class="text-sm">
                                                                    <a href="#" class="font-medium text-gray-900">New
                                                                        Player Added</a>
                                                                </div>
                                                                <p class="mt-0.5 text-sm text-gray-500">
                                                                    Jason Martinez (152 lbs) joined the team
                                                                </p>
                                                            </div>
                                                            <div class="mt-2 text-sm text-gray-500">
                                                                <p>Yesterday at 2:15 PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="relative pb-8">
                                                    <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                                        aria-hidden="true"></span>
                                                    <div class="relative flex items-start space-x-3">
                                                        <div class="relative">
                                                            <div
                                                                class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center ring-8 ring-white">
                                                                <div
                                                                    class="w-5 h-5 flex items-center justify-center text-indigo-600">
                                                                    <i class="ri-calendar-event-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <div>
                                                                <div class="text-sm">
                                                                    <a href="#" class="font-medium text-gray-900">Match
                                                                        Scheduled</a>
                                                                </div>
                                                                <p class="mt-0.5 text-sm text-gray-500">
                                                                    Dual meet vs. Eastside Warriors on May 8
                                                                </p>
                                                            </div>
                                                            <div class="mt-2 text-sm text-gray-500">
                                                                <p>Yesterday at 9:30 AM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="relative">
                                                    <div class="relative flex items-start space-x-3">
                                                        <div class="relative">
                                                            <div
                                                                class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center ring-8 ring-white">
                                                                <div
                                                                    class="w-5 h-5 flex items-center justify-center text-red-600">
                                                                    <i class="ri-heart-pulse-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <div>
                                                                <div class="text-sm">
                                                                    <a href="#" class="font-medium text-gray-900">Injury
                                                                        Reported</a>
                                                                </div>
                                                                <p class="mt-0.5 text-sm text-gray-500">
                                                                    Brandon Mitchell - Shoulder strain during practice
                                                                </p>
                                                            </div>
                                                            <div class="mt-2 text-sm text-gray-500">
                                                                <p>May 1 at 4:45 PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <a href="#"
                                            class="text-sm font-medium text-primary hover:text-primary-dark">View all
                                            activity</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Player roster -->
                    <div class="mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-gray-900">Player Roster</h2>
                            <div class="flex items-center space-x-2">
                                <div class="relative w-64">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                            <i class="ri-search-line"></i>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="block w-full py-2 pl-10 pr-3 text-sm border-none rounded-md bg-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary"
                                        placeholder="Search players...">
                                </div>
                                <button
                                    class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-blue-600 !rounded-button whitespace-nowrap">
                                    Add Player
                                </button>
                            </div>
                        </div>
                        <div class="overflow-hidden bg-white shadow rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Player
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ID Number
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Weight Class
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full"
                                                            src="https://readdy.ai/api/search-image?query=high%20school%20male%20wrestler%20portrait%2C%20athletic%20teenager%2C%20short%20hair%2C%20determined%20expression%2C%20neutral%20background&width=100&height=100&seq=player1&orientation=squarish"
                                                            alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            Daniel Thompson <!--Player Name-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"> P-0001</div> <!--ID Number-->
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">145 lbs</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"> Junior</div> <!--category-->
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">


                                                <button
                                                    class="text-primary hover:text-primary-dark !rounded-button whitespace-nowrap">
                                                    <img src="export.png" alt="">
                                                </button>
                                                <button
                                                    class="text-primary hover:text-primary-dark !rounded-button whitespace-nowrap">
                                                    <img src="qrcode.png" alt="">
                                                </button>
                                            </td>
                                        </tr>




                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Previous
                                    </a>
                                    <a href="#"
                                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Next
                                    </a>
                                </div>
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Showing <span class="font-medium">1</span> to <span
                                                class="font-medium">5</span> of <span class="font-medium">28</span>
                                            players
                                        </p>
                                    </div>
                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                            aria-label="Pagination">
                                            <a href="#"
                                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Previous</span>
                                                <div class="w-5 h-5 flex items-center justify-center">
                                                    <i class="ri-arrow-left-s-line"></i>
                                                </div>
                                            </a>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-primary text-sm font-medium text-white">
                                                1
                                            </a>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                2
                                            </a>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                3
                                            </a>
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                ...
                                            </span>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                6
                                            </a>
                                            <a href="#"
                                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Next</span>
                                                <div class="w-5 h-5 flex items-center justify-center">
                                                    <i class="ri-arrow-right-s-line"></i>
                                                </div>
                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Add Player Modal (hidden by default) -->
    <div id="add-player-modal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Add New Player</h3>
                    <button id="close-modal"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none !rounded-button whitespace-nowrap">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-close-line"></i>
                        </div>
                    </button>
                </div>
            </div>
            <div class="px-6 py-4">
                <form id="add-player-form">
                    <div class="space-y-4">
                        <div>
                            <label for="player-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" id="player-name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm"
                                placeholder="Enter player name">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="player-grade" class="block text-sm font-medium text-gray-700">Grade</label>
                                <select id="player-grade"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm pr-8">
                                    <option>Freshman</option>
                                    <option>Sophomore</option>
                                    <option>Junior</option>
                                    <option>Senior</option>
                                </select>
                            </div>
                            <div>
                                <label for="player-weight" class="block text-sm font-medium text-gray-700">Weight
                                    Class</label>
                                <select id="player-weight"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm pr-8">
                                    <option>106 lbs</option>
                                    <option>113 lbs</option>
                                    <option>120 lbs</option>
                                    <option>126 lbs</option>
                                    <option>132 lbs</option>
                                    <option>138 lbs</option>
                                    <option>145 lbs</option>
                                    <option>152 lbs</option>
                                    <option>160 lbs</option>
                                    <option>170 lbs</option>
                                    <option>182 lbs</option>
                                    <option>195 lbs</option>
                                    <option>220 lbs</option>
                                    <option>285 lbs</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="player-email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="player-email"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm"
                                placeholder="Enter email address">
                        </div>
                        <div>
                            <label for="player-phone" class="block text-sm font-medium text-gray-700">Phone
                                Number</label>
                            <input type="tel" id="player-phone"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm"
                                placeholder="Enter phone number">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Medical Clearance Status</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="radio" id="status-cleared" name="medical-status"
                                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300" checked>
                                    <label for="status-cleared" class="ml-2 block text-sm text-gray-700">
                                        Cleared
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="status-pending" name="medical-status"
                                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300">
                                    <label for="status-pending" class="ml-2 block text-sm text-gray-700">
                                        Pending
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="player-notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea id="player-notes" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm"
                                placeholder="Enter any additional notes"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button id="cancel-add-player"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 !rounded-button whitespace-nowrap">
                    Cancel
                </button>
                <button id="submit-add-player"
                    class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md shadow-sm hover:bg-blue-600 !rounded-button whitespace-nowrap">
                    Add Player
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Team performance chart
            const teamPerformanceChart = echarts.init(document.getElementById('team-performance-chart'));
            const teamPerformanceOption = {
                animation: false,
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(255, 255, 255, 0.8)',
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                legend: {
                    data: ['Wins', 'Losses'],
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    top: '15%',
                    containLabel: true
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'],
                    axisLine: {
                        lineStyle: {
                            color: '#e5e7eb'
                        }
                    },
                    axisLabel: {
                        color: '#6b7280'
                    }
                },
                yAxis: {
                    type: 'value',
                    axisLine: {
                        show: false
                    },
                    axisLabel: {
                        color: '#6b7280'
                    },
                    splitLine: {
                        lineStyle: {
                            color: '#e5e7eb'
                        }
                    }
                },
                series: [
                    {
                        name: 'Wins',
                        type: 'line',
                        stack: 'Total',
                        data: [5, 12, 18, 23, 29, 37, 42, 48],
                        areaStyle: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                { offset: 0, color: 'rgba(87, 181, 231, 0.2)' },
                                { offset: 1, color: 'rgba(87, 181, 231, 0.0)' }
                            ])
                        },
                        smooth: true,
                        symbol: 'none',
                        lineStyle: {
                            width: 3,
                            color: 'rgba(87, 181, 231, 1)'
                        },
                        itemStyle: {
                            color: 'rgba(87, 181, 231, 1)'
                        }
                    },
                    {
                        name: 'Losses',
                        type: 'line',
                        stack: 'Total',
                        data: [3, 6, 9, 12, 15, 18, 20, 22],
                        areaStyle: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                { offset: 0, color: 'rgba(252, 141, 98, 0.2)' },
                                { offset: 1, color: 'rgba(252, 141, 98, 0.0)' }
                            ])
                        },
                        smooth: true,
                        symbol: 'none',
                        lineStyle: {
                            width: 3,
                            color: 'rgba(252, 141, 98, 1)'
                        },
                        itemStyle: {
                            color: 'rgba(252, 141, 98, 1)'
                        }
                    }
                ]
            };
            teamPerformanceChart.setOption(teamPerformanceOption);

            // Weight distribution chart
            const weightDistributionChart = echarts.init(document.getElementById('weight-distribution-chart'));
            const weightDistributionOption = {
                animation: false,
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(255, 255, 255, 0.8)',
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                legend: {
                    orient: 'horizontal',
                    bottom: 'bottom',
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                series: [
                    {
                        name: 'Weight Class',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 6,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '14',
                                fontWeight: 'bold',
                                color: '#1f2937'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [
                            { value: 3, name: '106-120 lbs', itemStyle: { color: 'rgba(87, 181, 231, 1)' } },
                            { value: 5, name: '126-138 lbs', itemStyle: { color: 'rgba(141, 211, 199, 1)' } },
                            { value: 8, name: '145-160 lbs', itemStyle: { color: 'rgba(251, 191, 114, 1)' } },
                            { value: 7, name: '170-195 lbs', itemStyle: { color: 'rgba(252, 141, 98, 1)' } },
                            { value: 5, name: '220-285 lbs', itemStyle: { color: 'rgba(179, 179, 179, 1)' } }
                        ]
                    }
                ]
            };
            weightDistributionChart.setOption(weightDistributionOption);

            // Handle window resize for charts
            window.addEventListener('resize', function () {
                teamPerformanceChart.resize();
                weightDistributionChart.resize();
            });

            // Modal functionality
            const addPlayerButtons = document.querySelectorAll('.add-player-button');
            const addPlayerModal = document.getElementById('add-player-modal');
            const closeModalButton = document.getElementById('close-modal');
            const cancelAddPlayerButton = document.getElementById('cancel-add-player');

            function openModal() {
                addPlayerModal.classList.remove('hidden');
            }

            function closeModal() {
                addPlayerModal.classList.add('hidden');
            }

            addPlayerButtons.forEach(button => {
                button.addEventListener('click', openModal);
            });

            closeModalButton.addEventListener('click', closeModal);
            cancelAddPlayerButton.addEventListener('click', closeModal);

            // Close modal when clicking outside
            addPlayerModal.addEventListener('click', function (event) {
                if (event.target === addPlayerModal) {
                    closeModal();
                }
            });

            // Custom checkbox functionality
            const checkboxes = document.querySelectorAll('.custom-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function () {
                    this.classList.toggle('checked');
                });
            });

            // Custom switch functionality
            const switches = document.querySelectorAll('.custom-switch input');
            switches.forEach(switchEl => {
                switchEl.addEventListener('change', function () {
                    // Additional functionality can be added here
                });
            });
        });
    </script>
</body>

</html>