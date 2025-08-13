<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Management - Para Sports Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brown: {
                            50: '#faf6f2',
                            100: '#f3ebe3',
                            200: '#e4d3c3',
                            300: '#d3b79d',
                            400: '#b98e6c',
                            500: '#8b5e34',
                            600: '#734a27',
                            700: '#5a3a20',
                            800: '#422a19',
                            900: '#2d1d12',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-brown-50 text-brown-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar (simplified for this example) -->
        <div class="hidden md:block fixed inset-y-0 left-0 z-30 w-64 bg-brown-800 text-white">
            <div class="p-5 border-b border-brown-700">
                <h1 class="text-xl font-bold">Para Sports Admin</h1>
            </div>
            <nav class="mt-5">
                <a href="#" class="flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
                    <i class="fas fa-users mr-3"></i> 
                    <span>Registrations</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
                    <i class="fas fa-chart-bar mr-3"></i> 
                    <span>Reports</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 bg-brown-700 border-l-4 border-amber-500">
                    <i class="fas fa-images mr-3"></i> 
                    <span>Slider Management</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
                    <i class="fas fa-paint-brush mr-3"></i> 
                    <span>Frontend</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-brown-100">
                <div class="flex justify-between items-center p-4">
                    <h2 class="text-xl font-semibold text-brown-800">Slider Management</h2>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-brown-200 flex items-center justify-center">
                            <i class="fas fa-user text-brown-700"></i>
                        </div>
                        <span class="ml-2 text-brown-700 hidden sm:inline">Admin</span>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <div class="p-4 sm:p-6">
                    <!-- Page Header -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-brown-800">Manage Hero Slider</h1>
                        <p class="text-brown-600 mt-2">Upload new images and manage existing slider content</p>
                    </div>

                    <!-- Upload Form -->
                    <div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden mb-8">
                        <div class="px-6 py-4 border-b border-brown-100">
                            <h3 class="text-lg font-semibold text-brown-800 flex items-center">
                                <i class="fas fa-cloud-upload-alt mr-2 text-blue-600"></i>
                                Upload New Slider Image
                            </h3>
                        </div>
                        <div class="p-6">
                            <form>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-brown-700 mb-2">Slide Title</label>
                                        <input type="text" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="Enter slide title">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-brown-700 mb-2">Description</label>
                                        <input type="text" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="Enter slide description">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-brown-700 mb-2">Image Upload</label>
                                        <div class="flex items-center">
                                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-brown-300 rounded-lg cursor-pointer bg-brown-50 hover:bg-brown-100">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-brown-400 mb-2"></i>
                                                    <p class="mb-2 text-sm text-brown-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                    <p class="text-xs text-brown-500">PNG, JPG, GIF up to 5MB</p>
                                                </div>
                                                <input type="file" class="hidden" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="bg-brown-600 hover:bg-brown-700 text-white px-6 py-2 rounded-lg flex items-center text-sm transition-colors">
                                        <i class="fas fa-plus mr-2"></i> Add Slide
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Slider Images Table -->
                    <!-- Slider Images Table -->
<div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-brown-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
        <h3 class="text-lg font-semibold text-brown-800 flex items-center">
            <i class="fas fa-th-large mr-2 text-amber-600"></i>
            Active Slider Images
        </h3>
        <div class="text-sm text-brown-600">
            <span class="font-medium">4</span> images currently active
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-brown-200">
            <thead class="bg-brown-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Preview</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-brown-200">
                <!-- Sample Row 1 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-brown-900">Champions 2023</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-brown-500">
                        Team India at Paralympics
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <!-- Toggle Switch -->
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                        <div class="flex items-center">
                            <button class="p-1 rounded hover:bg-brown-100">
                                <i class="fas fa-arrow-up text-brown-600"></i>
                            </button>
                            <span class="mx-2">1</span>
                            <button class="p-1 rounded hover:bg-brown-100">
                                <i class="fas fa-arrow-down text-brown-600"></i>
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-amber-600 hover:text-amber-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                
                <!-- Sample Row 2 -->
                <tr class="bg-brown-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-brown-900">Training Camp</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-brown-500">
                        Athletes in intensive training
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <!-- Toggle Switch -->
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                        <div class="flex items-center">
                            <button class="p-1 rounded hover:bg-brown-100">
                                <i class="fas fa-arrow-up text-brown-600"></i>
                            </button>
                            <span class="mx-2">2</span>
                            <button class="p-1 rounded hover:bg-brown-100">
                                <i class="fas fa-arrow-down text-brown-600"></i>
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-amber-600 hover:text-amber-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                
                <!-- Sample Row 3 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-brown-900">New Facility</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-brown-500">
                        Inauguration of our new gym
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <!-- Toggle Switch -->
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                        <div class="flex items-center">
                            <button class="p-1 rounded hover:bg-brown-100">
                                <i class="fas fa-arrow-up text-brown-600"></i>
                            </button>
                            <span class="mx-2">3</span>
                            <button class="p-1 rounded hover:bg-brown-100">
                                <i class="fas fa-arrow-down text-brown-600"></i>
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-amber-600 hover:text-amber-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-brown-100 bg-brown-50">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="text-sm text-brown-600">
                Showing <span class="font-medium">3</span> of <span class="font-medium">3</span> slider images
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-brown-600 text-white rounded-lg text-sm hover:bg-brown-700 transition-colors">
                    Save Order
                </button>
                <button class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm hover:bg-amber-700 transition-colors">
                    Preview Slider
                </button>
            </div>
        </div>
    </div>
</div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>