<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Schedule - Wrestling Coach Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6', secondary: '#64748b' }, borderRadius: { 'none': '0px', 'sm': '4px', DEFAULT: '8px', 'md': '12px', 'lg': '16px', 'xl': '20px', '2xl': '24px', '3xl': '32px', 'full': '9999px', 'button': '8px' } } } }</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <style>

.whole-container {
            display: flex;

        }

        :where([class^="ri-"])::before {
            content: "\f3c2";
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
        }

        .custom-checkbox input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            background-color: #fff;
            border: 2px solid #d1d5db;
            border-radius: 4px;
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 6px;
            top: 2px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-switch {
            position: relative;
            display: inline-block;
            width: 46px;
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
            transform: translateX(22px);
        }

        .custom-select {
            position: relative;
            display: inline-block;
        }

        .custom-select-selected {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: white;
            cursor: pointer;
        }

        .custom-select-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 10;
            margin-top: 0.25rem;
            padding: 0.5rem 0;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            max-height: 200px;
            overflow-y: auto;
            display: none;
        }

        .custom-select-option {
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .custom-select-option:hover {
            background-color: #f3f4f6;
        }

        .calendar-day {
            min-height: 100px;
            border: 1px solid #e5e7eb;
        }

        .calendar-day-header {
            text-align: center;
            padding: 4px;
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .practice-event {
            margin: 2px;
            padding: 4px 6px;
            border-radius: 4px;
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
        }

        .practice-wrestling {
            background-color: rgba(87, 181, 231, 0.2);
            border-left: 3px solid rgba(87, 181, 231, 1);
        }

        .practice-conditioning {
            background-color: rgba(141, 211, 199, 0.2);
            border-left: 3px solid rgba(141, 211, 199, 1);
        }

        .practice-technique {
            background-color: rgba(251, 191, 114, 0.2);
            border-left: 3px solid rgba(251, 191, 114, 1);
        }

        .practice-competition {
            background-color: rgba(252, 141, 98, 0.2);
            border-left: 3px solid rgba(252, 141, 98, 1);
        }

        .status-scheduled {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .status-completed {
            background-color: #dcfce7;
            color: #15803d;
        }

        @media (max-width: 768px) {
            .calendar-grid {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
<div class="whole-container">

    <!-- Sidebar ===========================================================-->
    <?php
    include './sidebar.html';
    ?>


    <div class="flex h-screen overflow-hidden">
        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top navigation -->
            <div class="flex items-center justify-between h-16 px-4 bg-white border-b border-gray-200 md:px-6">
                <div class="flex items-center">
                    <h1 class="text-xl font-['Pacifico'] text-primary">logo</h1>
                </div>
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold text-gray-800">Practice Schedule</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="button" class="p-1 text-gray-500 rounded-full hover:text-gray-700 hover:bg-gray-100">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-notification-3-line"></i>
                        </div>
                    </button>
                    <button type="button" class="p-1 text-gray-500 rounded-full hover:text-gray-700 hover:bg-gray-100">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-message-2-line"></i>
                        </div>
                    </button>
                </div>
            </div>
            <!-- Main content area -->
            <div class="flex-1 overflow-y-auto">
                <div class="px-4 py-6 md:px-6">
                    <!-- Header section -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Practice Schedule</h1>
                            <p class="mt-1 text-sm text-gray-500">Friday, May 2, 2025</p>
                        </div>
                        <div class="mt-4 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 md:mt-0">
                            <div class="relative">
                                <button id="viewToggleBtn"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-button bg-white text-gray-700 hover:bg-gray-50 whitespace-nowrap">
                                    <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                    Weekly View
                                    <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                </button>
                                <div id="viewOptions"
                                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10">
                                    <div class="py-1" role="menu" aria-orientation="vertical">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">Daily View</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">Weekly View</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">Monthly View</a>
                                    </div>
                                </div>
                            </div>
                            <button id="createPracticeBtn"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-button bg-primary text-white hover:bg-blue-600 whitespace-nowrap">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-add-line"></i>
                                </div>
                                Create New Practice
                            </button>
                        </div>
                    </div>
                    <!-- Status dashboard -->
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-primary">
                                            <i class="ri-calendar-check-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Total Practices</dt>
                                            <dd class="flex items-baseline">
                                                <div class="text-2xl font-semibold text-gray-900">24</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-green-600">
                                            <i class="ri-time-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Practices
                                            </dt>
                                            <dd class="flex items-baseline">
                                                <div class="text-2xl font-semibold text-gray-900">8</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-yellow-600">
                                            <i class="ri-user-follow-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Avg. Attendance</dt>
                                            <dd class="flex items-baseline">
                                                <div class="text-2xl font-semibold text-gray-900">92%</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                        <div class="w-6 h-6 flex items-center justify-center text-red-600">
                                            <i class="ri-history-line"></i>
                                        </div>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Recent Changes</dt>
                                            <dd class="flex items-baseline">
                                                <div class="text-2xl font-semibold text-gray-900">3</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Calendar section -->
                    <div class="bg-white shadow rounded-lg mb-6">
                        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Weekly Calendar</h3>
                                <div class="flex space-x-2">
                                    <button
                                        class="inline-flex items-center p-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 whitespace-nowrap">
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-left-s-line"></i>
                                        </div>
                                    </button>
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 whitespace-nowrap">
                                        Today
                                    </button>
                                    <button
                                        class="inline-flex items-center p-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 whitespace-nowrap">
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-right-s-line"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 calendar-grid">
                            <div class="grid grid-cols-7 gap-1">
                                <div class="text-center text-sm font-medium text-gray-500">Sun</div>
                                <div class="text-center text-sm font-medium text-gray-500">Mon</div>
                                <div class="text-center text-sm font-medium text-gray-500">Tue</div>
                                <div class="text-center text-sm font-medium text-gray-500">Wed</div>
                                <div class="text-center text-sm font-medium text-gray-500">Thu</div>
                                <div class="text-center text-sm font-medium text-gray-500">Fri</div>
                                <div class="text-center text-sm font-medium text-gray-500">Sat</div>
                                <!-- Calendar days -->
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-400">28</div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-400">29</div>
                                    <div class="practice-event practice-wrestling" title="Team Wrestling Practice">
                                        3:30 PM - Wrestling
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-400">30</div>
                                    <div class="practice-event practice-conditioning" title="Conditioning Session">
                                        4:00 PM - Conditioning
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">1</div>
                                    <div class="practice-event practice-technique" title="Technique Workshop">
                                        3:30 PM - Technique
                                    </div>
                                </div>
                                <div class="calendar-day bg-blue-50">
                                    <div class="calendar-day-header text-gray-500">2</div>
                                    <div class="practice-event practice-wrestling" title="Team Wrestling Practice">
                                        3:30 PM - Wrestling
                                    </div>
                                    <div class="practice-event practice-competition" title="Mock Competition">
                                        5:00 PM - Competition
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">3</div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">4</div>
                                    <div class="practice-event practice-conditioning" title="Conditioning Session">
                                        10:00 AM - Conditioning
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">5</div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">6</div>
                                    <div class="practice-event practice-wrestling" title="Team Wrestling Practice">
                                        3:30 PM - Wrestling
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">7</div>
                                    <div class="practice-event practice-technique" title="Technique Workshop">
                                        4:00 PM - Technique
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">8</div>
                                    <div class="practice-event practice-conditioning" title="Conditioning Session">
                                        3:30 PM - Conditioning
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">9</div>
                                    <div class="practice-event practice-wrestling" title="Team Wrestling Practice">
                                        3:30 PM - Wrestling
                                    </div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">10</div>
                                </div>
                                <div class="calendar-day">
                                    <div class="calendar-day-header text-gray-500">11</div>
                                    <div class="practice-event practice-competition" title="Mock Competition">
                                        9:00 AM - Competition
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Upcoming practices list -->
                    <div class="bg-white shadow rounded-lg mb-6">
                        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Upcoming Practices</h3>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-blue-100 rounded-full p-2 mr-4">
                                                <div class="w-6 h-6 flex items-center justify-center text-primary">
                                                    <i class="ri-calendar-event-line"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-primary">Team Wrestling Practice</p>
                                                <p class="flex items-center text-sm text-gray-500">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-time-line"></i>
                                                </div>
                                                Today, 3:30 PM - 5:00 PM
                                                <span class="mx-2">•</span>
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-map-pin-line"></i>
                                                </div>
                                                Main Gym
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full status-scheduled mr-2">Scheduled</span>
                                            <div class="flex items-center space-x-2">
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-edit-line"></i>
                                                    </div>
                                                </button>
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                            <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                <i class="ri-group-line"></i>
                                            </div>
                                            18 players assigned
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <button
                                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs rounded-button bg-white hover:bg-gray-50 whitespace-nowrap">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-notification-line"></i>
                                                </div>
                                                Send Reminder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-red-100 rounded-full p-2 mr-4">
                                                <div class="w-6 h-6 flex items-center justify-center text-red-600">
                                                    <i class="ri-calendar-event-line"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Mock Competition</p>
                                                <p class="flex items-center text-sm text-gray-500">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-time-line"></i>
                                                </div>
                                                Today, 5:00 PM - 7:00 PM
                                                <span class="mx-2">•</span>
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-map-pin-line"></i>
                                                </div>
                                                Competition Hall
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full status-scheduled mr-2">Scheduled</span>
                                            <div class="flex items-center space-x-2">
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-edit-line"></i>
                                                    </div>
                                                </button>
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                            <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                <i class="ri-group-line"></i>
                                            </div>
                                            12 players assigned
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <button
                                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs rounded-button bg-white hover:bg-gray-50 whitespace-nowrap">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-notification-line"></i>
                                                </div>
                                                Send Reminder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-green-100 rounded-full p-2 mr-4">
                                                <div class="w-6 h-6 flex items-center justify-center text-green-600">
                                                    <i class="ri-calendar-event-line"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Conditioning Session</p>
                                                <p class="flex items-center text-sm text-gray-500">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-time-line"></i>
                                                </div>
                                                Saturday, May 4, 10:00 AM - 11:30 AM
                                                <span class="mx-2">•</span>
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-map-pin-line"></i>
                                                </div>
                                                Fitness Center
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full status-scheduled mr-2">Scheduled</span>
                                            <div class="flex items-center space-x-2">
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-edit-line"></i>
                                                    </div>
                                                </button>
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                            <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                <i class="ri-group-line"></i>
                                            </div>
                                            22 players assigned
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <button
                                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs rounded-button bg-white hover:bg-gray-50 whitespace-nowrap">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-notification-line"></i>
                                                </div>
                                                Send Reminder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-blue-100 rounded-full p-2 mr-4">
                                                <div class="w-6 h-6 flex items-center justify-center text-primary">
                                                    <i class="ri-calendar-event-line"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-primary">Team Wrestling Practice</p>
                                                <p class="flex items-center text-sm text-gray-500">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-time-line"></i>
                                                </div>
                                                Monday, May 6, 3:30 PM - 5:00 PM
                                                <span class="mx-2">•</span>
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-map-pin-line"></i>
                                                </div>
                                                Main Gym
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full status-scheduled mr-2">Scheduled</span>
                                            <div class="flex items-center space-x-2">
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-edit-line"></i>
                                                    </div>
                                                </button>
                                                <button class="p-1 text-gray-500 hover:text-gray-700">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                            <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                <i class="ri-group-line"></i>
                                            </div>
                                            20 players assigned
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <button
                                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs rounded-button bg-white hover:bg-gray-50 whitespace-nowrap">
                                                <div class="w-4 h-4 mr-1 flex items-center justify-center">
                                                    <i class="ri-notification-line"></i>
                                                </div>
                                                Send Reminder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg">
                            <button
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-primary hover:text-blue-600 whitespace-nowrap">
                                View All Practices
                                <div class="w-5 h-5 ml-1 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Attendance chart -->
                    <div class="bg-white shadow rounded-lg mb-6">
                        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Attendance Statistics</h3>
                        </div>
                        <div class="p-4">
                            <div id="attendanceChart" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                    <!-- Action bar -->
                    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 md:hidden">
                        <div class="flex justify-between">
                            <button
                                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 text-gray-600">
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-calendar-line"></i>
                                </div>
                            </button>
                            <button
                                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary text-white">
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-add-line"></i>
                                </div>
                            </button>
                            <button
                                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 text-gray-600">
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-notification-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Practice Modal -->
    <div id="createPracticeModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Create New Practice</h3>
                    <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-close-line"></i>
                        </div>
                    </button>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="practice-title" class="block text-sm font-medium text-gray-700">Practice
                            Title</label>
                        <div class="mt-1">
                            <input type="text" id="practice-title"
                                class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="e.g. Team Wrestling Practice">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="practice-type" class="block text-sm font-medium text-gray-700">Practice Type</label>
                        <div class="mt-1 custom-select">
                            <div class="custom-select-selected">
                                <span>Wrestling</span>
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                            </div>
                            <div class="custom-select-options">
                                <div class="custom-select-option">Wrestling</div>
                                <div class="custom-select-option">Conditioning</div>
                                <div class="custom-select-option">Technique</div>
                                <div class="custom-select-option">Competition</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="practice-date" class="block text-sm font-medium text-gray-700">Date</label>
                        <div class="mt-1">
                            <input type="date" id="practice-date"
                                class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                value="2025-05-02">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="practice-time" class="block text-sm font-medium text-gray-700">Time</label>
                        <div class="mt-1 grid grid-cols-2 gap-4">
                            <input type="time" id="practice-start-time"
                                class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                value="15:30">
                            <input type="time" id="practice-end-time"
                                class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                value="17:00">
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="practice-location" class="block text-sm font-medium text-gray-700">Location</label>
                        <div class="mt-1">
                            <input type="text" id="practice-location"
                                class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="e.g. Main Gym">
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="practice-description"
                            class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <textarea id="practice-description" rows="3"
                                class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="Add practice details here..."></textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-700">Player Groups</label>
                        <div class="mt-2 space-y-2">
                            <div class="flex items-center">
                                <label class="custom-checkbox">
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <span class="ml-2 text-sm text-gray-700">Varsity Team</span>
                            </div>
                            <div class="flex items-center">
                                <label class="custom-checkbox">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="ml-2 text-sm text-gray-700">Junior Varsity</span>
                            </div>
                            <div class="flex items-center">
                                <label class="custom-checkbox">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="ml-2 text-sm text-gray-700">Freshman Team</span>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-6 border-t border-gray-200 pt-5">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Send Notifications</span>
                            <label class="custom-switch">
                                <input type="checkbox" checked>
                                <span class="switch-slider"></span>
                            </label>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center">
                                <label class="custom-checkbox">
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <span class="ml-2 text-sm text-gray-700">Email</span>
                            </div>
                            <div class="flex items-center">
                                <label class="custom-checkbox">
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <span class="ml-2 text-sm text-gray-700">Push Notification</span>
                            </div>
                            <div class="flex items-center">
                                <label class="custom-checkbox">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="ml-2 text-sm text-gray-700">SMS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-button text-white bg-primary hover:bg-blue-600 whitespace-nowrap">
                    Create Practice
                </button>
            </div>
        </div>
    </div>


 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // View toggle dropdown
            const viewToggleBtn = document.getElementById('viewToggleBtn');
            const viewOptions = document.getElementById('viewOptions');
            viewToggleBtn.addEventListener('click', function () {
                viewOptions.classList.toggle('hidden');
            });
            document.addEventListener('click', function (event) {
                if (!viewToggleBtn.contains(event.target) && !viewOptions.contains(event.target)) {
                    viewOptions.classList.add('hidden');
                }
            });
            // Custom select functionality
            const customSelects = document.querySelectorAll('.custom-select');
            customSelects.forEach(select => {
                const selected = select.querySelector('.custom-select-selected');
                const options = select.querySelector('.custom-select-options');
                const optionItems = options.querySelectorAll('.custom-select-option');
                selected.addEventListener('click', function () {
                    options.style.display = options.style.display === 'block' ? 'none' : 'block';
                });
                optionItems.forEach(option => {
                    option.addEventListener('click', function () {
                        selected.querySelector('span').textContent = this.textContent;
                        options.style.display = 'none';
                    });
                });
                document.addEventListener('click', function (event) {
                    if (!select.contains(event.target)) {
                        options.style.display = 'none';
                    }
                });
            });
            // Modal functionality
            const createPracticeBtn = document.getElementById('createPracticeBtn');
            const createPracticeModal = document.getElementById('createPracticeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            createPracticeBtn.addEventListener('click', function () {
                createPracticeModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
            closeModalBtn.addEventListener('click', function () {
                createPracticeModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
            // Close modal when clicking outside
            createPracticeModal.addEventListener('click', function (event) {
                if (event.target === createPracticeModal) {
                    createPracticeModal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize attendance chart
            const attendanceChart = echarts.init(document.getElementById('attendanceChart'));
            const option = {
                animation: false,
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(255, 255, 255, 0.8)',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                legend: {
                    data: ['Attendance Rate', 'Total Players'],
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    top: '60px',
                    containLabel: true
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: ['Apr 25', 'Apr 27', 'Apr 29', 'May 1', 'May 2'],
                    axisLine: {
                        lineStyle: {
                            color: '#e5e7eb'
                        }
                    },
                    axisLabel: {
                        color: '#1f2937'
                    }
                },
                yAxis: [
                    {
                        type: 'value',
                        name: 'Attendance Rate',
                        min: 0,
                        max: 100,
                        interval: 20,
                        axisLabel: {
                            formatter: '{value}%',
                            color: '#1f2937'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#e5e7eb'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#f3f4f6'
                            }
                        }
                    },
                    {
                        type: 'value',
                        name: 'Total Players',
                        min: 0,
                        max: 25,
                        interval: 5,
                        axisLabel: {
                            formatter: '{value}',
                            color: '#1f2937'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#e5e7eb'
                            }
                        },
                        splitLine: {
                            show: false
                        }
                    }
                ],
                series: [
                    {
                        name: 'Attendance Rate',
                        type: 'line',
                        yAxisIndex: 0,
                        data: [88, 92, 90, 95, 92],
                        smooth: true,
                        symbol: 'none',
                        lineStyle: {
                            width: 3,
                            color: 'rgba(87, 181, 231, 1)'
                        },
                        areaStyle: {
                            color: {
                                type: 'linear',
                                x: 0,
                                y: 0,
                                x2: 0,
                                y2: 1,
                                colorStops: [{
                                    offset: 0,
                                    color: 'rgba(87, 181, 231, 0.2)'
                                }, {
                                    offset: 1,
                                    color: 'rgba(87, 181, 231, 0.01)'
                                }]
                            }
                        }
                    },
                    {
                        name: 'Total Players',
                        type: 'bar',
                        yAxisIndex: 1,
                        data: [18, 20, 22, 19, 18],
                        barWidth: 10,
                        itemStyle: {
                            color: 'rgba(141, 211, 199, 1)',
                            borderRadius: [4, 4, 0, 0]
                        }
                    }
                ]
            };
            attendanceChart.setOption(option);
            // Resize chart when window is resized
            window.addEventListener('resize', function () {
                attendanceChart.resize();
            });
        });
    </script>

</div>
</body>

</html>