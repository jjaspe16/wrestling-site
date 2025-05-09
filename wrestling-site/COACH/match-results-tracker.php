<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Results</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4f46e5',secondary:'#6366f1'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type="number"] {
            -moz-appearance: textfield;
        }
        
        .custom-radio input[type="radio"] {
            display: none;
        }
        
        .custom-radio label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .custom-radio input[type="radio"]:checked + label.win {
            background-color: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #22c55e;
        }
        
        .custom-radio input[type="radio"]:checked + label.loss {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #ef4444;
        }
        
        .custom-radio input[type="radio"]:checked + label.draw {
            background-color: rgba(107, 114, 128, 0.1);
            border-color: #6b7280;
            color: #6b7280;
        }
        
        .result-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .result-win {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }
        
        .result-loss {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        
        .result-draw {
            background-color: rgba(107, 114, 128, 0.1);
            color: #6b7280;
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
        
        input:checked + .switch-slider {
            background-color: #4f46e5;
        }
        
        input:checked + .switch-slider:before {
            transform: translateX(20px);
        }
        .whole-container {
            display: flex;

        }

    </style>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="whole-container">


<!-- Sidebar ===========================================================-->
<?php
include './sidebar.html';
?>




    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center">
                    <button class="p-2 rounded-full hover:bg-gray-100 mr-3 !rounded-button whitespace-nowrap">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <a href="./schedule-matches.php"> <i class="ri-arrow-left-line ri-lg"></i> </a>
                        </div>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-900">Back</h1>
                </div> <br><br>
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Match Results</h1>
            <p class="text-gray-500 mt-2">Track and analyze your match performance</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Statistics Summary -->
            <div class="lg:col-span-1 order-2 lg:order-1">
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Statistics</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Total Matches</span>
                                <span class="text-sm font-medium text-gray-900">24</span>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Win Rate</span>
                                <span class="text-sm font-medium text-gray-900">58.3%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 58.3%"></div>
                            </div>
                        </div>
                        
                        <div class="pt-2">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                    <span class="text-sm text-gray-700">Wins</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">14</span>
                            </div>
                            
                            <div class="flex justify-between items-center mt-2">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                    <span class="text-sm text-gray-700">Losses</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">7</span>
                            </div>
                            
                            <div class="flex justify-between items-center mt-2">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 bg-gray-400 rounded-full mr-2"></span>
                                    <span class="text-sm text-gray-700">Draws</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">3</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 h-64" id="resultsChart"></div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">Recent Opponents</h2>
                    </div>
                    
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Manchester United</span>
                            <span class="text-sm text-gray-500">3 matches</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Liverpool FC</span>
                            <span class="text-sm text-gray-500">2 matches</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Arsenal</span>
                            <span class="text-sm text-gray-500">2 matches</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Chelsea</span>
                            <span class="text-sm text-gray-500">1 match</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">Tottenham Hotspur</span>
                            <span class="text-sm text-gray-500">1 match</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 order-1 lg:order-2">
                <!-- Add New Result -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Record Match Result</h2>
                    
                    <form id="matchForm" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="matchDate" class="block text-sm font-medium text-gray-700 mb-1">Match Date</label>
                                <input type="date" id="matchDate" name="matchDate" value="2025-05-02" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="opponent" class="block text-sm font-medium text-gray-700 mb-1">Opponent</label>
                                <input type="text" id="opponent" name="opponent" placeholder="Enter opponent name" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Result</label>
                            <div class="flex flex-wrap gap-3">
                                <div class="custom-radio">
                                    <input type="radio" id="win" name="result" value="win" checked>
                                    <label for="win" class="win border border-gray-300">
                                        <div class="w-4 h-4 flex items-center justify-center mr-2 rounded-full border border-current">
                                            <div class="w-2 h-2 rounded-full bg-current"></div>
                                        </div>
                                        Win
                                    </label>
                                </div>
                                
                                <div class="custom-radio">
                                    <input type="radio" id="loss" name="result" value="loss">
                                    <label for="loss" class="loss border border-gray-300">
                                        <div class="w-4 h-4 flex items-center justify-center mr-2 rounded-full border border-current">
                                            <div class="w-2 h-2 rounded-full bg-current opacity-0"></div>
                                        </div>
                                        Loss
                                    </label>
                                </div>
                                
                                <div class="custom-radio">
                                    <input type="radio" id="draw" name="result" value="draw">
                                    <label for="draw" class="draw border border-gray-300">
                                        <div class="w-4 h-4 flex items-center justify-center mr-2 rounded-full border border-current">
                                            <div class="w-2 h-2 rounded-full bg-current opacity-0"></div>
                                        </div>
                                        Draw
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-medium text-gray-700">Score (Optional)</label>
                                <label class="custom-switch">
                                    <input type="checkbox" id="includeScore">
                                    <span class="switch-slider"></span>
                                </label>
                            </div>
                            
                            <div id="scoreInputs" class="grid grid-cols-2 gap-4 opacity-50 pointer-events-none">
                                <div>
                                    <label for="yourScore" class="block text-sm font-medium text-gray-700 mb-1">Your Score</label>
                                    <input type="number" id="yourScore" name="yourScore" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                                
                                <div>
                                    <label for="opponentScore" class="block text-sm font-medium text-gray-700 mb-1">Opponent Score</label>
                                    <input type="number" id="opponentScore" name="opponentScore" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap">Save Result</button>
                        </div>
                    </form>
                </div>
                
                <!-- Results List -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">Match History</h2>
                        
                        <div class="flex items-center">
                            <div class="relative">
                                <input type="text" placeholder="Search matches" class="pl-9 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-search-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="text-sm text-gray-500">May 2, 2025</div>
                                    <span class="result-badge result-win">Win</span>
                                </div>
                                <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                    <i class="ri-delete-bin-line"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h3 class="font-medium text-gray-900">vs. Manchester City</h3>
                                <div class="mt-1 text-sm text-gray-600">Score: 3 - 1</div>
                            </div>
                        </div>
                        
                        <div class="p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="text-sm text-gray-500">April 28, 2025</div>
                                    <span class="result-badge result-loss">Loss</span>
                                </div>
                                <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                    <i class="ri-delete-bin-line"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h3 class="font-medium text-gray-900">vs. Liverpool FC</h3>
                                <div class="mt-1 text-sm text-gray-600">Score: 1 - 2</div>
                            </div>
                        </div>
                        
                        <div class="p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="text-sm text-gray-500">April 21, 2025</div>
                                    <span class="result-badge result-draw">Draw</span>
                                </div>
                                <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                    <i class="ri-delete-bin-line"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h3 class="font-medium text-gray-900">vs. Arsenal</h3>
                                <div class="mt-1 text-sm text-gray-600">Score: 2 - 2</div>
                            </div>
                        </div>
                        
                        <div class="p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="text-sm text-gray-500">April 14, 2025</div>
                                    <span class="result-badge result-win">Win</span>
                                </div>
                                <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                    <i class="ri-delete-bin-line"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h3 class="font-medium text-gray-900">vs. Chelsea</h3>
                                <div class="mt-1 text-sm text-gray-600">Score: 2 - 0</div>
                            </div>
                        </div>
                        
                        <div class="p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="text-sm text-gray-500">April 7, 2025</div>
                                    <span class="result-badge result-win">Win</span>
                                </div>
                                <div class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                    <i class="ri-delete-bin-line"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h3 class="font-medium text-gray-900">vs. Tottenham Hotspur</h3>
                                <div class="mt-1 text-sm text-gray-600">Score: 3 - 2</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-center">
                        <nav class="flex items-center">
                            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 mr-2 text-gray-500 hover:bg-gray-50">
                                <i class="ri-arrow-left-s-line"></i>
                            </button>
                            <button class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white mr-2">1</button>
                            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 mr-2 text-gray-700 hover:bg-gray-50">2</button>
                            <button class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-gray-50">
                                <i class="ri-arrow-right-s-line"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize chart
            const chartDom = document.getElementById('resultsChart');
            const myChart = echarts.init(chartDom);
            
            const option = {
                animation: false,
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(255, 255, 255, 0.8)',
                    borderColor: '#f1f5f9',
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                legend: {
                    top: '0%',
                    left: 'center',
                    textStyle: {
                        color: '#1f2937'
                    }
                },
                series: [
                    {
                        name: 'Match Results',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 8,
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
                                fontSize: 16,
                                fontWeight: 'bold',
                                color: '#1f2937'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [
                            { value: 14, name: 'Wins', itemStyle: { color: 'rgba(87, 181, 231, 1)' } },
                            { value: 7, name: 'Losses', itemStyle: { color: 'rgba(252, 141, 98, 1)' } },
                            { value: 3, name: 'Draws', itemStyle: { color: 'rgba(141, 211, 199, 1)' } }
                        ]
                    }
                ]
            };
            
            myChart.setOption(option);
            
            // Handle window resize
            window.addEventListener('resize', function() {
                myChart.resize();
            });
            
            // Toggle score inputs
            const includeScoreCheckbox = document.getElementById('includeScore');
            const scoreInputs = document.getElementById('scoreInputs');
            
            includeScoreCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    scoreInputs.classList.remove('opacity-50', 'pointer-events-none');
                } else {
                    scoreInputs.classList.add('opacity-50', 'pointer-events-none');
                }
            });
            
            // Handle form submission
            const matchForm = document.getElementById('matchForm');
            
            matchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form values
                const matchDate = document.getElementById('matchDate').value;
                const opponent = document.getElementById('opponent').value;
                const result = document.querySelector('input[name="result"]:checked').value;
                const includeScore = document.getElementById('includeScore').checked;
                const yourScore = document.getElementById('yourScore').value;
                const opponentScore = document.getElementById('opponentScore').value;
                
                // Validate form
                if (!matchDate || !opponent) {
                    alert('Please fill in all required fields');
                    return;
                }
                
                if (includeScore && (!yourScore || !opponentScore)) {
                    alert('Please enter both scores');
                    return;
                }
                
                // Here you would normally save the data to a database
                // For this example, we'll just show a success message
                alert('Match result saved successfully!');
                
                // Reset form
                matchForm.reset();
                document.getElementById('matchDate').value = '2025-05-02';
                document.getElementById('win').checked = true;
                document.getElementById('includeScore').checked = false;
                scoreInputs.classList.add('opacity-50', 'pointer-events-none');
            });
            
            // Custom radio buttons
            const radioInputs = document.querySelectorAll('.custom-radio input[type="radio"]');
            
            radioInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const labels = document.querySelectorAll('.custom-radio label');
                    
                    labels.forEach(label => {
                        const radio = document.getElementById(label.getAttribute('for'));
                        
                        if (radio.checked) {
                            label.querySelector('.w-2').classList.remove('opacity-0');
                        } else {
                            label.querySelector('.w-2').classList.add('opacity-0');
                        }
                    });
                });
            });
            
            // Initialize radio buttons
            document.getElementById('win').dispatchEvent(new Event('change'));
        });
    </script>
    </div>
</body>
</html>
