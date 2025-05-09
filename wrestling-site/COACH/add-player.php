<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Player | Player Management</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4f46e5',secondary:'#6366f1'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
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
            background-color: #fff;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .custom-checkbox.checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        .custom-checkbox.checked::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 7px;
            width: 6px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .custom-date-input::-webkit-calendar-picker-indicator {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z'/%3E%3C/svg%3E");
            cursor: pointer;
        }
        .custom-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
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
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e5e7eb;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
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
        input:checked + .slider {
            background-color: #4f46e5;
        }
        input:checked + .slider:before {
            transform: translateX(20px);
        }
        .photo-upload-placeholder {
            border: 2px dashed #d1d5db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .photo-upload-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .photo-upload-placeholder .upload-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #4f46e5;
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                <div class="flex items-center">
                    <button class="p-2 rounded-full hover:bg-gray-100 mr-3 !rounded-button whitespace-nowrap">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <a href="./players-page.php"> <i class="ri-arrow-left-line ri-lg"></i> </a>
                        </div>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-900">New Player</h1>
                </div>
                <button class="bg-primary text-white px-4 py-2 rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap">
                    Save Player
                </button>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <form id="playerForm">
                    <!-- Player Information Section -->
                    <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Player Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="playerName" class="block text-sm font-medium text-gray-700 mb-1">
                                    Player Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="playerName" name="playerName" required
                                    class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                    placeholder="Enter player name">
                            </div>
                            
                            <div>
                                <label for="playerId" class="block text-sm font-medium text-gray-700 mb-1">
                                    Player ID/Number <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="playerId" name="playerId" required
                                    class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                    placeholder="Enter player ID">
                            </div>
                            
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 mb-1">
                                    Position <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select id="position" name="position" required
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none appearance-none custom-select pr-8">
                                        <option value="" disabled selected>Select position</option>
                                        <option value="goalkeeper">Goalkeeper</option>
                                        <option value="defender">Defender</option>
                                        <option value="midfielder">Midfielder</option>
                                        <option value="forward">Forward</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label for="team" class="block text-sm font-medium text-gray-700 mb-1">
                                    Team <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select id="team" name="team" required
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none appearance-none custom-select pr-8">
                                        <option value="" disabled selected>Select team</option>
                                        <option value="team-a">Team A</option>
                                        <option value="team-b">Team B</option>
                                        <option value="team-c">Team C</option>
                                        <option value="team-d">Team D</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label for="dateOfBirth" class="block text-sm font-medium text-gray-700 mb-1">
                                    Date of Birth <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="dateOfBirth" name="dateOfBirth" required
                                    class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none custom-date-input">
                            </div>
                            
                            <div>
                                <label for="contactEmail" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="contactEmail" name="contactEmail" required
                                    class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                    placeholder="player@example.com">
                            </div>
                            
                            <div>
                                <label for="contactPhone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Phone Number
                                </label>
                                <input type="tel" id="contactPhone" name="contactPhone"
                                    class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                    placeholder="+1 (123) 456-7890">
                            </div>
                        </div>
                    </section>
                    
                    <!-- Player Photo Upload Section -->
                    <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Player Photo</h2>
                        
                        <div class="flex flex-col items-center sm:flex-row sm:items-start gap-6">
                            <div class="photo-upload-placeholder" id="photoPreviewContainer">
                                <div class="text-center" id="uploadPlaceholder">
                                    <div class="w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                        <i class="ri-user-line ri-2x text-gray-400"></i>
                                    </div>
                                    <p class="text-xs text-gray-500">No photo</p>
                                </div>
                                <img id="photoPreview" class="hidden" src="" alt="Player photo">
                                <div class="upload-icon">
                                    <div class="w-5 h-5 flex items-center justify-center">
                                        <i class="ri-camera-line"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex-1">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Upload Photo
                                    </label>
                                    <input type="file" id="photoUpload" name="photoUpload" accept="image/*" class="hidden">
                                    <button type="button" id="uploadButton" class="bg-white border border-gray-300 rounded-button px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary !rounded-button whitespace-nowrap">
                                        Choose File
                                    </button>
                                </div>
                                
                                <div class="text-sm text-gray-500">
                                    <p class="mb-1">Supported formats: JPG, PNG, GIF</p>
                                    <p>Maximum size: 5MB</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Player Statistics Section -->
                    <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-semibold text-gray-900">Player Statistics</h2>
                            <button type="button" id="toggleStats" class="text-primary hover:text-primary/80 flex items-center text-sm font-medium !rounded-button whitespace-nowrap">
                                <span id="toggleText">Hide</span>
                                <div class="w-5 h-5 flex items-center justify-center ml-1">
                                    <i class="ri-arrow-up-s-line" id="toggleIcon"></i>
                                </div>
                            </button>
                        </div>
                        
                        <div id="statsContent">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="height" class="block text-sm font-medium text-gray-700 mb-1">
                                        Height (cm)
                                    </label>
                                    <input type="number" id="height" name="height"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="175">
                                </div>
                                
                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">
                                        Weight (kg)
                                    </label>
                                    <input type="number" id="weight" name="weight"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="70">
                                </div>
                                
                                <div>
                                    <label for="gamesPlayed" class="block text-sm font-medium text-gray-700 mb-1">
                                        Games Played
                                    </label>
                                    <input type="number" id="gamesPlayed" name="gamesPlayed"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="0">
                                </div>
                                
                                <div>
                                    <label for="goals" class="block text-sm font-medium text-gray-700 mb-1">
                                        Goals
                                    </label>
                                    <input type="number" id="goals" name="goals"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="0">
                                </div>
                                
                                <div>
                                    <label for="assists" class="block text-sm font-medium text-gray-700 mb-1">
                                        Assists
                                    </label>
                                    <input type="number" id="assists" name="assists"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="0">
                                </div>
                                
                                <div>
                                    <label for="yellowCards" class="block text-sm font-medium text-gray-700 mb-1">
                                        Yellow Cards
                                    </label>
                                    <input type="number" id="yellowCards" name="yellowCards"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="0">
                                </div>
                                
                                <div>
                                    <label for="redCards" class="block text-sm font-medium text-gray-700 mb-1">
                                        Red Cards
                                    </label>
                                    <input type="number" id="redCards" name="redCards"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="0">
                                </div>
                                
                                <div>
                                    <label for="minutesPlayed" class="block text-sm font-medium text-gray-700 mb-1">
                                        Minutes Played
                                    </label>
                                    <input type="number" id="minutesPlayed" name="minutesPlayed"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="0">
                                </div>
                                
                                <div>
                                    <label for="passAccuracy" class="block text-sm font-medium text-gray-700 mb-1">
                                        Pass Accuracy (%)
                                    </label>
                                    <input type="number" id="passAccuracy" name="passAccuracy" min="0" max="100"
                                        class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                        placeholder="0">
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Additional Information Section -->
                    <section class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Additional Information</h2>
                        
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                Notes
                            </label>
                            <textarea id="notes" name="notes" rows="4"
                                class="w-full px-4 py-2.5 rounded border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none"
                                placeholder="Add any additional notes about the player..."></textarea>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="custom-checkbox" id="activeStatus"></div>
                                <input type="checkbox" id="activeStatusInput" name="activeStatus" class="hidden">
                                <label for="activeStatus" class="ml-2 text-sm text-gray-700 cursor-pointer">
                                    Active Status
                                </label>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="custom-checkbox" id="availableForSelection"></div>
                                <input type="checkbox" id="availableForSelectionInput" name="availableForSelection" class="hidden">
                                <label for="availableForSelection" class="ml-2 text-sm text-gray-700 cursor-pointer">
                                    Available for Selection
                                </label>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="custom-checkbox" id="medicalClearance"></div>
                                <input type="checkbox" id="medicalClearanceInput" name="medicalClearance" class="hidden">
                                <label for="medicalClearance" class="ml-2 text-sm text-gray-700 cursor-pointer">
                                    Medical Clearance
                                </label>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Action Buttons -->
                    <div class="sticky bottom-0 bg-white shadow-md rounded-t-lg p-4 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-3 max-w-4xl mx-auto">
                            <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-button font-medium hover:bg-primary/90 transition-colors !rounded-button whitespace-nowrap">
                                Save Player
                            </button>
                            <button type="button" class="flex-1 sm:flex-none sm:w-32 bg-white border border-gray-300 text-gray-700 py-3 rounded-button font-medium hover:bg-gray-50 transition-colors !rounded-button whitespace-nowrap">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle statistics section
            const toggleStats = document.getElementById('toggleStats');
            const statsContent = document.getElementById('statsContent');
            const toggleText = document.getElementById('toggleText');
            const toggleIcon = document.getElementById('toggleIcon');
            
            toggleStats.addEventListener('click', function() {
                if (statsContent.style.display === 'none') {
                    statsContent.style.display = 'block';
                    toggleText.textContent = 'Hide';
                    toggleIcon.className = 'ri-arrow-up-s-line';
                } else {
                    statsContent.style.display = 'none';
                    toggleText.textContent = 'Show';
                    toggleIcon.className = 'ri-arrow-down-s-line';
                }
            });
            
            // Custom checkbox functionality
            const checkboxes = document.querySelectorAll('.custom-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function() {
                    this.classList.toggle('checked');
                    const inputId = this.id + 'Input';
                    const input = document.getElementById(inputId);
                    input.checked = this.classList.contains('checked');
                });
            });
            
            // Photo upload functionality
            const uploadButton = document.getElementById('uploadButton');
            const photoUpload = document.getElementById('photoUpload');
            const photoPreview = document.getElementById('photoPreview');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            
            uploadButton.addEventListener('click', function() {
                photoUpload.click();
            });
            
            photoUpload.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                        photoPreview.classList.remove('hidden');
                        uploadPlaceholder.classList.add('hidden');
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            // Form submission
            const playerForm = document.getElementById('playerForm');
            playerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const submitButton = playerForm.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                submitButton.innerHTML = '<span class="inline-block animate-spin mr-2">↻</span> Saving...';
                submitButton.disabled = true;
                
                // Simulate form submission
                setTimeout(() => {
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                    
                    // Show success message
                    alert('Player saved successfully!');
                }, 1500);
            });
        });
    </script>
</body>
</html>