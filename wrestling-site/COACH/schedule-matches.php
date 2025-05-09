<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule New Match - Wrestling Coach Dashboard</title>
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

        .weight-class-section.expanded .weight-class-content {
            max-height: 500px;
            opacity: 1;
        }

        .weight-class-section:not(.expanded) .weight-class-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }

        .weight-class-content {
            transition: all 0.3s ease-in-out;
        }

        .location-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            z-index: 10;
            max-height: 200px;
            overflow-y: auto;
        }

        .location-dropdown.hidden {
            display: none;
        }

        .custom-radio {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            background-color: white;
            cursor: pointer;
        }

        .custom-radio.checked {
            border-color: #3b82f6;
        }

        .custom-radio.checked::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #3b82f6;
        }

        .date-picker-calendar {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            z-index: 10;
            width: 280px;
        }

        .date-picker-calendar.hidden {
            display: none;
        }

        .calendar-day {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 50%;
        }

        .calendar-day:hover {
            background-color: #f3f4f6;
        }

        .calendar-day.selected {
            background-color: #3b82f6;
            color: white;
        }

        .calendar-day.today {
            border: 1px solid #3b82f6;
        }

        .calendar-day.other-month {
            color: #9ca3af;
        }

        .whole-container {
            display: flex;

        }
    </style>
</head>

<body>


    <div class="whole-container">


        <!-- Sidebar ===========================================================-->
        <?php
        include './sidebar.html';
        ?>


        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden" style="padding: 50px;">
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
                <div class="flex items-center space-x-4">
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
                    <button type="button" class="px-4 py-2 text-white rounded-md" style="background-color: blue;">
                        <a href="./match-results-tracker.php">See Match Result</a>
                    </button>
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
                                src="https://readdy.ai/api/search-image?query=professional%2520male%2520wrestling%2520coach%2520portrait%252C%252040%2520years%2520old%252C%2520athletic%2520build%252C%2520short%2520hair%252C%2520determined%2520expression%252C%2520neutral%2520background&width=100&height=100&seq=coach1&orientation=squarish"
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
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Schedule New Match</h1>
                                <p class="mt-1 text-sm text-gray-500">Friday, May 2, 2025</p>
                            </div>
                            <div class="flex space-x-3">
                                <button
                                    class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                    <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                    View Calendar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Match Form -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="p-6">
                            <form id="schedule-match-form">
                                <div class="space-y-6">
                                    <!-- Match Type Section -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Match Type</label>
                                        <div class="flex flex-wrap gap-4">
                                            <div class="flex items-center">
                                                <div class="custom-radio checked" data-value="dual-meet"></div>
                                                <label class="ml-2 block text-sm text-gray-700">Dual Meet</label>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="custom-radio" data-value="tournament"></div>
                                                <label class="ml-2 block text-sm text-gray-700">Tournament</label>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="custom-radio" data-value="exhibition"></div>
                                                <label class="ml-2 block text-sm text-gray-700">Exhibition</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Date and Time Section -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="match-date"
                                                class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                            <div class="relative">
                                                <div class="flex">
                                                    <input type="text" id="match-date"
                                                        class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                                                        placeholder="Select date" readonly value="May 15, 2025">
                                                    <div
                                                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <div
                                                            class="w-5 h-5 flex items-center justify-center text-gray-400">
                                                            <i class="ri-calendar-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="date-picker-calendar" class="date-picker-calendar hidden">
                                                    <div class="p-3 border-b border-gray-200">
                                                        <div class="flex items-center justify-between">
                                                            <button
                                                                class="p-1 text-gray-500 hover:text-gray-700 !rounded-button whitespace-nowrap">
                                                                <div class="w-5 h-5 flex items-center justify-center">
                                                                    <i class="ri-arrow-left-s-line"></i>
                                                                </div>
                                                            </button>
                                                            <div class="text-sm font-medium">May 2025</div>
                                                            <button
                                                                class="p-1 text-gray-500 hover:text-gray-700 !rounded-button whitespace-nowrap">
                                                                <div class="w-5 h-5 flex items-center justify-center">
                                                                    <i class="ri-arrow-right-s-line"></i>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="grid grid-cols-7 gap-1 mt-2">
                                                            <div class="text-xs text-center text-gray-500">Su</div>
                                                            <div class="text-xs text-center text-gray-500">Mo</div>
                                                            <div class="text-xs text-center text-gray-500">Tu</div>
                                                            <div class="text-xs text-center text-gray-500">We</div>
                                                            <div class="text-xs text-center text-gray-500">Th</div>
                                                            <div class="text-xs text-center text-gray-500">Fr</div>
                                                            <div class="text-xs text-center text-gray-500">Sa</div>
                                                        </div>
                                                    </div>
                                                    <div class="p-2">
                                                        <div class="grid grid-cols-7 gap-1">
                                                            <div class="calendar-day other-month">28</div>
                                                            <div class="calendar-day other-month">29</div>
                                                            <div class="calendar-day other-month">30</div>
                                                            <div class="calendar-day">1</div>
                                                            <div class="calendar-day today">2</div>
                                                            <div class="calendar-day">3</div>
                                                            <div class="calendar-day">4</div>
                                                            <div class="calendar-day">5</div>
                                                            <div class="calendar-day">6</div>
                                                            <div class="calendar-day">7</div>
                                                            <div class="calendar-day">8</div>
                                                            <div class="calendar-day">9</div>
                                                            <div class="calendar-day">10</div>
                                                            <div class="calendar-day">11</div>
                                                            <div class="calendar-day">12</div>
                                                            <div class="calendar-day">13</div>
                                                            <div class="calendar-day">14</div>
                                                            <div class="calendar-day selected">15</div>
                                                            <div class="calendar-day">16</div>
                                                            <div class="calendar-day">17</div>
                                                            <div class="calendar-day">18</div>
                                                            <div class="calendar-day">19</div>
                                                            <div class="calendar-day">20</div>
                                                            <div class="calendar-day">21</div>
                                                            <div class="calendar-day">22</div>
                                                            <div class="calendar-day">23</div>
                                                            <div class="calendar-day">24</div>
                                                            <div class="calendar-day">25</div>
                                                            <div class="calendar-day">26</div>
                                                            <div class="calendar-day">27</div>
                                                            <div class="calendar-day">28</div>
                                                            <div class="calendar-day">29</div>
                                                            <div class="calendar-day">30</div>
                                                            <div class="calendar-day">31</div>
                                                            <div class="calendar-day other-month">1</div>
                                                        </div>
                                                    </div>
                                                    <div class="p-3 border-t border-gray-200 flex justify-between">
                                                        <button
                                                            class="text-sm text-primary hover:text-primary-dark !rounded-button whitespace-nowrap">Today</button>
                                                        <button
                                                            class="text-sm text-primary hover:text-primary-dark !rounded-button whitespace-nowrap">Clear</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="match-time"
                                                class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                            <div class="relative">
                                                <input type="time" id="match-time"
                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                                                    value="16:30">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Location Section -->
                                    <div>
                                        <label for="match-location"
                                            class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                        <div class="relative">
                                            <div class="flex">
                                                <input type="text" id="match-location"
                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                                                    placeholder="Search for a location"
                                                    value="Riverside High School Gymnasium">
                                                <div
                                                    class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                                        <i class="ri-map-pin-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="location-dropdown" class="location-dropdown hidden">
                                                <div class="p-2">
                                                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">Riverside
                                                        High School Gymnasium</div>
                                                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">Central
                                                        Sports Complex</div>
                                                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">Eastside
                                                        Warriors Wrestling Center</div>
                                                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">Metro
                                                        Community Center</div>
                                                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">North
                                                        County Athletic Club</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Opponent Section -->
                                    <div>
                                        <label for="opponent-team"
                                            class="block text-sm font-medium text-gray-700 mb-1">Opponent
                                            Team/School</label>
                                        <input type="text" id="opponent-team"
                                            class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                                            placeholder="Enter opponent name" value="Eastside Warriors">
                                    </div>

                                    <!-- Recurring Match Option -->
                                    <div>
                                        <div class="flex items-center">
                                            <label class="custom-switch">
                                                <input type="checkbox" id="recurring-match">
                                                <span class="switch-slider"></span>
                                            </label>
                                            <label for="recurring-match" class="ml-2 block text-sm text-gray-700">
                                                Recurring Match
                                            </label>
                                        </div>
                                        <div id="recurring-options" class="mt-3 pl-12 hidden">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="recurrence-pattern"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Repeat</label>
                                                    <select id="recurrence-pattern"
                                                        class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                        <option>Weekly</option>
                                                        <option>Bi-weekly</option>
                                                        <option>Monthly</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="recurrence-end"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Until</label>
                                                    <input type="date" id="recurrence-end"
                                                        class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Notification Option -->
                                    <div>
                                        <div class="flex items-center">
                                            <label class="custom-switch">
                                                <input type="checkbox" id="send-notifications" checked>
                                                <span class="switch-slider"></span>
                                            </label>
                                            <label for="send-notifications" class="ml-2 block text-sm text-gray-700">
                                                Send notifications to selected participants
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Weight Classes Section -->
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">Weight Classes</h3>
                                        <div class="space-y-4">
                                            <!-- 106 lbs -->
                                            <div
                                                class="weight-class-section border border-gray-200 rounded-lg overflow-hidden expanded">
                                                <div
                                                    class="flex items-center justify-between p-4 bg-gray-50 cursor-pointer weight-class-header">
                                                    <h4 class="text-sm font-medium text-gray-900">106 lbs</h4>
                                                    <div class="w-5 h-5 flex items-center justify-center text-gray-500">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </div>
                                                </div>
                                                <div class="weight-class-content p-4 border-t border-gray-200">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Primary
                                                                Wrestler</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option>Select wrestler</option>
                                                                    <option selected>Ryan Thompson (8-2)</option>
                                                                    <option>Jake Wilson (5-3)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Backup
                                                                (Optional)</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option selected>Select wrestler</option>
                                                                    <option>Jake Wilson (5-3)</option>
                                                                    <option>Michael Chen (3-1)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 113 lbs -->
                                            <div
                                                class="weight-class-section border border-gray-200 rounded-lg overflow-hidden">
                                                <div
                                                    class="flex items-center justify-between p-4 bg-gray-50 cursor-pointer weight-class-header">
                                                    <h4 class="text-sm font-medium text-gray-900">113 lbs</h4>
                                                    <div class="w-5 h-5 flex items-center justify-center text-gray-500">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </div>
                                                </div>
                                                <div class="weight-class-content p-4 border-t border-gray-200">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Primary
                                                                Wrestler</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option>Select wrestler</option>
                                                                    <option selected>Michael Chen (3-1)</option>
                                                                    <option>David Garcia (6-4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Backup
                                                                (Optional)</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option selected>Select wrestler</option>
                                                                    <option>David Garcia (6-4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 120 lbs -->
                                            <div
                                                class="weight-class-section border border-gray-200 rounded-lg overflow-hidden">
                                                <div
                                                    class="flex items-center justify-between p-4 bg-gray-50 cursor-pointer weight-class-header">
                                                    <h4 class="text-sm font-medium text-gray-900">120 lbs</h4>
                                                    <div class="w-5 h-5 flex items-center justify-center text-gray-500">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </div>
                                                </div>
                                                <div class="weight-class-content p-4 border-t border-gray-200">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Primary
                                                                Wrestler</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option>Select wrestler</option>
                                                                    <option selected>David Garcia (6-4)</option>
                                                                    <option>Alex Johnson (7-5)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Backup
                                                                (Optional)</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option selected>Select wrestler</option>
                                                                    <option>Alex Johnson (7-5)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 126 lbs -->
                                            <div
                                                class="weight-class-section border border-gray-200 rounded-lg overflow-hidden">
                                                <div
                                                    class="flex items-center justify-between p-4 bg-gray-50 cursor-pointer weight-class-header">
                                                    <h4 class="text-sm font-medium text-gray-900">126 lbs</h4>
                                                    <div class="w-5 h-5 flex items-center justify-center text-gray-500">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </div>
                                                </div>
                                                <div class="weight-class-content p-4 border-t border-gray-200">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Primary
                                                                Wrestler</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option>Select wrestler</option>
                                                                    <option selected>Alex Johnson (7-5)</option>
                                                                    <option>Tyler Rodriguez (15-7)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Backup
                                                                (Optional)</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option selected>Select wrestler</option>
                                                                    <option>Tyler Rodriguez (15-7)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 132 lbs -->
                                            <div
                                                class="weight-class-section border border-gray-200 rounded-lg overflow-hidden">
                                                <div
                                                    class="flex items-center justify-between p-4 bg-gray-50 cursor-pointer weight-class-header">
                                                    <h4 class="text-sm font-medium text-gray-900">132 lbs</h4>
                                                    <div class="w-5 h-5 flex items-center justify-center text-gray-500">
                                                        <i class="ri-arrow-down-s-line"></i>
                                                    </div>
                                                </div>
                                                <div class="weight-class-content p-4 border-t border-gray-200">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Primary
                                                                Wrestler</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option>Select wrestler</option>
                                                                    <option selected>Tyler Rodriguez (15-7)</option>
                                                                    <option>Carlos Ramirez (10-6)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Backup
                                                                (Optional)</label>
                                                            <div class="relative">
                                                                <select
                                                                    class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary pr-8">
                                                                    <option selected>Select wrestler</option>
                                                                    <option>Carlos Ramirez (10-6)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Show more weights button -->
                                            <button type="button"
                                                class="flex items-center justify-center w-full py-2 text-sm font-medium text-primary bg-blue-50 rounded-md hover:bg-blue-100 !rounded-button whitespace-nowrap">
                                                <div class="w-5 h-5 mr-1 flex items-center justify-center">
                                                    <i class="ri-add-line"></i>
                                                </div>
                                                Show More Weight Classes
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Attachments Section -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Attachments
                                            (Optional)</label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <div
                                                    class="w-12 h-12 mx-auto flex items-center justify-center text-gray-400">
                                                    <i class="ri-upload-2-line ri-2x"></i>
                                                </div>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="file-upload"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-dark focus-within:outline-none">
                                                        <span>Upload files</span>
                                                        <input id="file-upload" name="file-upload" type="file"
                                                            class="sr-only" multiple>
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    PDF, DOCX, or image files up to 10MB
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Notes Section -->
                                    <div>
                                        <label for="match-notes"
                                            class="block text-sm font-medium text-gray-700 mb-1">Additional
                                            Notes</label>
                                        <textarea id="match-notes" rows="4"
                                            class="block w-full py-2 px-3 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                                            placeholder="Enter any additional details about this match">Bus departure time: 3:30 PM. All wrestlers must be at the school by 3:15 PM. Bring both home and away uniforms.</textarea>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex justify-between pt-4">
                                        <div>
                                            <button type="button"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                                Save as Draft
                                            </button>
                                        </div>
                                        <div class="flex space-x-3">
                                            <button type="button"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md shadow-sm hover:bg-blue-600 !rounded-button whitespace-nowrap">
                                                Schedule Match
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Confirmation Dialog (hidden by default) -->
                    <div id="confirmation-dialog"
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Confirm Match Schedule</h3>
                            </div>
                            <div class="px-6 py-4">
                                <p class="text-sm text-gray-500">
                                    You are about to schedule a dual meet against Eastside Warriors on May 15, 2025 at
                                    4:30 PM. This will notify all selected participants. Are you sure you want to
                                    proceed?
                                </p>
                            </div>
                            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                                <button id="cancel-confirm"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 !rounded-button whitespace-nowrap">
                                    Cancel
                                </button>
                                <button id="confirm-schedule"
                                    class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md shadow-sm hover:bg-blue-600 !rounded-button whitespace-nowrap">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Weight class section toggle
            const weightClassHeaders = document.querySelectorAll('.weight-class-header');
            weightClassHeaders.forEach(header => {
                header.addEventListener('click', function () {
                    const section = this.closest('.weight-class-section');
                    section.classList.toggle('expanded');
                    const icon = this.querySelector('i');
                    if (section.classList.contains('expanded')) {
                        icon.classList.remove('ri-arrow-down-s-line');
                        icon.classList.add('ri-arrow-up-s-line');
                    } else {
                        icon.classList.remove('ri-arrow-up-s-line');
                        icon.classList.add('ri-arrow-down-s-line');
                    }
                });
            });

            // Location dropdown
            const locationInput = document.getElementById('match-location');
            const locationDropdown = document.getElementById('location-dropdown');

            locationInput.addEventListener('focus', function () {
                locationDropdown.classList.remove('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!locationInput.contains(event.target) && !locationDropdown.contains(event.target)) {
                    locationDropdown.classList.add('hidden');
                }
            });

            const locationOptions = locationDropdown.querySelectorAll('.p-2');
            locationOptions.forEach(option => {
                option.addEventListener('click', function () {
                    locationInput.value = this.textContent.trim();
                    locationDropdown.classList.add('hidden');
                });
            });

            // Date picker
            const dateInput = document.getElementById('match-date');
            const datePickerCalendar = document.getElementById('date-picker-calendar');

            dateInput.addEventListener('click', function () {
                datePickerCalendar.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!dateInput.contains(event.target) && !datePickerCalendar.contains(event.target)) {
                    datePickerCalendar.classList.add('hidden');
                }
            });

            const calendarDays = document.querySelectorAll('.calendar-day');
            calendarDays.forEach(day => {
                day.addEventListener('click', function () {
                    calendarDays.forEach(d => d.classList.remove('selected'));
                    this.classList.add('selected');
                    const month = 'May';
                    const day = this.textContent.trim();
                    const year = '2025';
                    dateInput.value = `${month} ${day}, ${year}`;
                    datePickerCalendar.classList.add('hidden');
                });
            });

            // Custom radio buttons
            const customRadios = document.querySelectorAll('.custom-radio');
            customRadios.forEach(radio => {
                radio.addEventListener('click', function () {
                    customRadios.forEach(r => r.classList.remove('checked'));
                    this.classList.add('checked');
                });
            });

            // Recurring match toggle
            const recurringMatchCheckbox = document.getElementById('recurring-match');
            const recurringOptions = document.getElementById('recurring-options');

            recurringMatchCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    recurringOptions.classList.remove('hidden');
                } else {
                    recurringOptions.classList.add('hidden');
                }
            });

            // Form submission and confirmation
            const scheduleForm = document.getElementById('schedule-match-form');
            const confirmationDialog = document.getElementById('confirmation-dialog');
            const cancelConfirmButton = document.getElementById('cancel-confirm');
            const confirmScheduleButton = document.getElementById('confirm-schedule');

            scheduleForm.addEventListener('submit', function (event) {
                event.preventDefault();
                confirmationDialog.classList.remove('hidden');
            });

            cancelConfirmButton.addEventListener('click', function () {
                confirmationDialog.classList.add('hidden');
            });

            confirmScheduleButton.addEventListener('click', function () {
                confirmationDialog.classList.add('hidden');
                // Here you would normally submit the form or make an API call
                // For demo purposes, we'll just show a success message
                alert('Match successfully scheduled!');
            });

            // Close confirmation when clicking outside
            confirmationDialog.addEventListener('click', function (event) {
                if (event.target === confirmationDialog) {
                    confirmationDialog.classList.add('hidden');
                }
            });
        });
    </script>

    </div>
</body>

</html>