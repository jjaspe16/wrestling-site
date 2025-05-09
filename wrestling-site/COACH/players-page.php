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

    <!-- PDF export libraries-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

    <!--QR CODE js library-->
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/dist/qrcode.min.js"></script>

    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        body {
            font-family: 'Inter', sans-serif;
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



        <!-- Player roster -->
        <div class="mt-6" style="padding: 50px;">
            <div class="flex items-center justify-between mb-4 ">
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
                        class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-blue-600 !rounded-button whitespace-nowrap"
                        type="button"><a href="./add-player.php">Add Player</a>
                    </button>

                </div>
            </div>
            <div class="overflow-hidden bg-white shadow rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-900">
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
                                            <img class="h-10 w-10 rounded-full" src="./images/pic1.jpeg" alt="pic1">
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

                                    <!--- <button onclick="exportTableToPDF()" class="text-primary hover:text-primary-dark !rounded-button whitespace-nowrap">
                                        <img src="icons/export.png" alt="Export PDF">
                                    </button>   -->

                                    <button onclick="exportDataInQrCodeFormat()"
                                        class="text-primary hover:text-primary-dark !rounded-button whitespace-nowrap">
                                        <img src="./icons/qrcode.png" alt="Export QR Code">
                                    </button>

                                    <!-- Container for QR Code (hidden) -->
                                    <div id="qrcode" style="display:none;"></div>

                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="./images/pic2.jpg" alt="pic2">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                Chrisvie Rivera <!--Player Name-->
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> P-0002</div> <!--ID Number-->
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">158 lbs</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> Junior</div> <!--category-->
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    <button onclick="exportDataInQrCodeFormat()"
                                        class="text-primary hover:text-primary-dark !rounded-button whitespace-nowrap">
                                        <img src="./icons/qrcode.png" alt="Export QR Code">
                                    </button>

                                    <!-- Container for QR Code (hidden) -->
                                    <div id="qrcode" style="display:none;"></div>


                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
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
                                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of
                                <span class="font-medium">28</span>
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

    </div> <!--whole container-->

    <!--script for PDF export-->
    <!--<script>
    async function exportTableToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
    
        doc.autoTable({
            html: '#dataTable',
            theme: 'grid',
            headStyles: { fillColor: [41, 128, 185] }, // Optional styling
            styles: { fontSize: 10 },
            margin: { top: 20 },
        });
    
        doc.save('table-data.pdf');
    }
    </script> -->

    <!--QR CODE JS-->
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script>
        function exportDataInQrCodeFormat() {
            const data = "Name: Julie Jsp, Age: 23, Weight: 38kg, Category: Junior";

            // Clear previous QR code
            const qrContainer = document.getElementById("qrcode");
            qrContainer.innerHTML = "";

            // Generate new QR code
            const qrCode = new QRCode(qrContainer, {
                text: data,
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            // Wait a bit for the QR code to be rendered
            setTimeout(() => {
                // Get the canvas or img element inside the QR container
                const img = qrContainer.querySelector("img") || qrContainer.querySelector("canvas");

                if (img) {
                    // Create a download link
                    const link = document.createElement("a");
                    link.href = img.src || img.toDataURL();
                    link.download = "qrCode.png";
                    link.click();
                } else {
                    alert("QR Code generation failed.");
                }
            }, 500); // Adjust delay if needed
        }
    </script>

</body>

</html>