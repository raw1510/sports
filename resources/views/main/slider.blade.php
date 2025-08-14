<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Management - Para Sports Admin</title>
    <!-- Inside <head> of your main layout -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Add this inside <head> -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipa15PlEeo5g8hj9N59YbVnpvYp4gDq0KZSejN1u3g=" crossorigin="anonymous"></script>
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

<div class="hidden md:block fixed inset-y-0 left-0 z-30 w-64 bg-brown-800 text-white">
            <div class="p-5 border-b border-brown-700">
                <h1 class="text-xl font-bold">Para Sports Admin</h1>
            </div>
            <nav class="mt-5">
                <a href="#" class="flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
                    <i class="fas fa-users mr-3"></i> 
                    <span>Registrations</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 bg-brown-700 border-l-4 border-amber-500">
                    <i class="fas fa-images mr-3"></i> 
                    <span>Slider Management</span>
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

                    <!-- Upload Form Section (Simplified) -->
                    <div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden mb-8">
                        <div class="px-6 py-4 border-b border-brown-100">
                            <h3 class="text-lg font-semibold text-brown-800 flex items-center">
                                <i class="fas fa-cloud-upload-alt mr-2 text-blue-600"></i>
                                Upload New Slider Image
                            </h3>
                        </div>
                        <div class="p-6">
                            <!-- Form starts here -->
                            <form action="{{ route('admin.slider.post') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4">
                                @csrf <!-- CSRF token for security -->

                                <div class="flex-grow">
                                    <!-- Title Input -->
                                    <div class="mb-4">
                                        <label for="title" class="block text-sm font-medium text-brown-700 mb-2">Slide Title (Optional)</label>
                                        <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Champions 2023">
                                    </div>

                                    <!-- Description Input -->
                                    <div class="mb-4">
                                        <label for="description" class="block text-sm font-medium text-brown-700 mb-2">Description (Optional)</label>
                                        <input type="text" id="description" name="description" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Team India at Paralympics">
                                    </div>

                                    <!-- Image Upload Input -->
                                    <div>
                                        <label for="image" class="block text-sm font-medium text-brown-700 mb-2">Image Upload <span class="text-red-500">*</span></label>
                                        <div class="flex items-center">
                                            <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-brown-300 rounded-lg cursor-pointer bg-brown-50 hover:bg-brown-100">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-brown-400 mb-2"></i>
                                                    <p class="mb-2 text-sm text-brown-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                    <p class="text-xs text-brown-500">PNG, JPG, GIF, WebP up to 5MB</p>
                                                </div>
                                                <!-- Input name is 'image' to match controller validation -->
                                                <input type="file" id="image" name="image" class="hidden" required />
                                            </label>
                                        </div>
                                        <!-- Display validation errors for 'image' -->
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
                            <!-- Form ends here -->

                            <!-- Display general success or error messages -->
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
            </main>
        </div>
    </div>
</body>
</html>