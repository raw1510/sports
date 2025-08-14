<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider & Gallery Management - Para Sports Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Using CDN for Tailwind (remove this if using Vite) -->
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
    
    <!-- SortableJS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipa15PlEeo5g8hj9N59YbVnpvYp4gDq0KZSejN1u3g=" crossorigin="anonymous"></script>
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
    
    <style>
        /* For the reorder handles */
        .drag-handle {
            cursor: move;
            cursor: -webkit-grab;
        }
        .drag-handle:active {
            cursor: -webkit-grabbing;
        }
    </style>
</head>
<body class="min-h-screen bg-brown-50 text-brown-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Simplified Sidebar for context -->
        @include('components.admin.navbar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-brown-100">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <button id="mobile-menu-toggle" class="lg:hidden text-brown-600 hover:text-brown-800 mr-3">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-brown-800">Slider & Gallery Management</h2>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-brown-200 flex items-center justify-center">
                                <i class="fas fa-user text-brown-700"></i>
                            </div>
                            <span class="ml-2 text-brown-700 hidden sm:inline">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area (Single main tag) -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <div class="p-4 sm:p-6">
                    <!-- Slider Management Section -->
                    <div class="mb-8">
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold text-brown-800">Manage Hero Slider</h1>
                            <p class="text-brown-600 mt-2">Upload and manage slider images</p>
                        </div>

                        <div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-brown-100">
                                <h3 class="text-lg font-semibold text-brown-800 flex items-center">
                                    <i class="fas fa-cloud-upload-alt mr-2 text-blue-600"></i>
                                    Upload New Slider Image
                                </h3>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('admin.slider.post') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4">
                                    @csrf

                                    <div class="flex-grow">
                                        <div class="mb-4">
                                            <label for="slider_title" class="block text-sm font-medium text-brown-700 mb-2">Slide Title (Optional)</label>
                                            <input type="text" id="slider_title" name="title" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Champions 2023">
                                        </div>

                                        <div class="mb-4">
                                            <label for="slider_description" class="block text-sm font-medium text-brown-700 mb-2">Description (Optional)</label>
                                            <input type="text" id="slider_description" name="description" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Team India at Paralympics">
                                        </div>

                                        <div>
                                            <label for="slider_image" class="block text-sm font-medium text-brown-700 mb-2">Image Upload <span class="text-red-500">*</span></label>
                                            <div class="flex items-center">
                                                <label for="slider_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-brown-300 rounded-lg cursor-pointer bg-brown-50 hover:bg-brown-100">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <i class="fas fa-cloud-upload-alt text-3xl text-brown-400 mb-2"></i>
                                                        <p class="mb-2 text-sm text-brown-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                        <p class="text-xs text-brown-500">PNG, JPG, GIF, WebP up to 5MB</p>
                                                    </div>
                                                    <input type="file" id="slider_image" name="image" class="hidden" required />
                                                </label>
                                            </div>
                                            @error('image')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col justify-end">
                                        <button type="submit" class="bg-brown-600 hover:bg-brown-700 text-white px-6 py-3 rounded-lg flex items-center justify-center text-sm transition-colors h-full">
                                            <i class="fas fa-plus mr-2"></i> Add Slide
                                        </button>
                                    </div>
                                </form>

                                @if (session('success'))
                                    <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any() && !$errors->has('image'))
                                    <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Management Section -->
                    <div>
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold text-brown-800">Manage Gallery</h1>
                            <p class="text-brown-600 mt-2">Upload and manage gallery images</p>
                        </div>

                        <div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-brown-100">
                                <h3 class="text-lg font-semibold text-brown-800 flex items-center">
                                    <i class="fas fa-cloud-upload-alt mr-2 text-amber-600"></i>
                                    Upload New Gallery Image
                                </h3>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('admin.gallery.post') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4">
                                    @csrf

                                    <div class="flex-grow">
                                        <div class="mb-4">
                                            <label for="gallery_title" class="block text-sm font-medium text-brown-700 mb-2">Gallery Title (Optional)</label>
                                            <input type="text" id="gallery_title" name="gallery_title" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Training Session">
                                        </div>

                                        <div class="mb-4">
                                            <label for="gallery_description" class="block text-sm font-medium text-brown-700 mb-2">Description (Optional)</label>
                                            <input type="text" id="gallery_description" name="gallery_description" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Athletes in training">
                                        </div>

                                        <div>
                                            <label for="gallery_image" class="block text-sm font-medium text-brown-700 mb-2">Image Upload <span class="text-red-500">*</span></label>
                                            <div class="flex items-center">
                                                <label for="gallery_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-brown-300 rounded-lg cursor-pointer bg-brown-50 hover:bg-brown-100">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <i class="fas fa-cloud-upload-alt text-3xl text-brown-400 mb-2"></i>
                                                        <p class="mb-2 text-sm text-brown-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                        <p class="text-xs text-brown-500">PNG, JPG, GIF, WebP up to 5MB</p>
                                                    </div>
                                                    <input type="file" id="gallery_image" name="gallery_image" class="hidden" required />
                                                </label>
                                            </div>
                                            @error('gallery_image')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col justify-end">
                                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-lg flex items-center justify-center text-sm transition-colors h-full">
                                            <i class="fas fa-plus mr-2"></i> Add Gallery Image
                                        </button>
                                    </div>
                                </form>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('sweetalert::alert')

    <!-- If using Vite for navbar JS, place this before closing body tag -->
        @vite('resources/js/adminnavbar.js')
</body>
</html>