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
                            50: '#faf6f2'
                            , 100: '#f3ebe3'
                            , 200: '#e4d3c3'
                            , 300: '#d3b79d'
                            , 400: '#b98e6c'
                            , 500: '#8b5e34'
                            , 600: '#734a27'
                            , 700: '#5a3a20'
                            , 800: '#422a19'
                            , 900: '#2d1d12'
                        , }
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
                                            <label for="slider_title" class="block text-sm font-medium text-brown-700 mb-2">Slide Title optional</label>
                                            <input type="text" id="slider_title" name="title" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Champions 2023">
                                        </div>

                                        <div class="mb-4">
                                            <label for="slider_description" class="block text-sm font-medium text-brown-700 mb-2">Description optional</label>
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
                                                    <input type="file" id="slider_image" name="image" class="hidden file-input-trigger" required accept="image/*"/>
                                                </label>
                                            </div>
                                            <p id="slider-file-name" class="mt-1 text-sm text-brown-600 italic">No file chosen</p>
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
                    <!-- Manage Existing Slider Images for Display -->
                    <div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden mt-6">
                        <div class="px-6 py-4 border-b border-brown-100">
                            <h3 class="text-lg font-semibold text-brown-800 flex items-center">
                                <i class="fas fa-sliders-h mr-2 text-purple-600"></i> <!-- Changed icon -->
                                Select Images for Frontend Slider
                            </h3>
                            <p class="text-xs text-brown-500 mt-1">Choose up to 3 images and assign them positions 1, 2, and 3.</p>
                        </div>
                        <div class="p-4 sm:p-6">
                            {{-- --}}
                            <form action="{{ route('admin.slider.setDisplayOrder') }}" method="POST">
                                <!-- We'll define this route -->
                                @csrf
                                @method('PUT')
                                <!-- We'll use PUT method for updating -->

                                @if(isset($allSliderImages) && $allSliderImages->isNotEmpty())
                                <div class="overflow-x-auto">
                                    <table id="slider-table" class="min-w-full divide-y divide-brown-200">
                                        <thead class="bg-brown-50">
                                            <tr>
                                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Image</th>
                                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Title</th>
                                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Status</th>
                                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Display Order</th>
                                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-brown-200">

                                            @foreach ($allSliderImages as $image)
                                            <tr class="hover:bg-brown-50">
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <div class="flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 rounded-md overflow-hidden border border-brown-300">
                                                        <img src="{{ asset($image->image_path) }}" alt="{{ $image->title ?? 'Slider Image' }}" class="w-full h-full object-cover">
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm text-brown-800 max-w-xs truncate">{{ $image->title ?? 'No Title' }}</td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    @if ($image->is_active)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                                    @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-brown-700 flex flex-wrap items-center gap-2">
                                                    <!-- Display Order Dropdown -->
                                                    <select name="display_order[{{ $image->id }}]" class="display-order-select block w-full pl-3 pr-10 py-2 text-base border-brown-300 focus:outline-none focus:ring-brown-500 focus:border-brown-500 sm:text-sm rounded-md flex-grow" data-id="{{ $image->id }}">
                                                        <!-- data-id is useful -->
                                                        <option value="">Not Selected</option>
                                                        <option value="1">Position 1</option>
                                                        <option value="2">Position 2</option>
                                                        <option value="3">Position 3</option>
                                                    </select>
                                                </td>

                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <a href="#" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" data-id="{{ $image->id }}" onclick="confirmDelete(event, {{ $image->id }})">
                                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                                    </a>

                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <i class="fas fa-save mr-2"></i> Save Display Order
                                    </button>
                                </div>
                                @else
                                <p class="text-brown-600 text-center py-4">No slider images uploaded yet.</p>
                                @endif
                            </form>
                        </div>
                    </div>
                    <!-- End Manage Existing Slider Images for Display -->











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
                                            <label for="gallery_title" class="block text-sm font-medium text-brown-700 mb-2">Gallery Title optional</label>
                                            <input type="text" id="gallery_title" name="gallery_title" class="w-full px-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" placeholder="e.g., Training Session">
                                        </div>

                                        <div class="mb-4">
                                            <label for="gallery_description" class="block text-sm font-medium text-brown-700 mb-2">Description optional</label>
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
                                                    <input type="file" id="gallery_image" name="gallery_image" class="hidden file-input-trigger" required accept="image/*" />
                                                </label>
                                            </div>
                                            <p id="gallery-file-name" class="mt-1 text-sm text-brown-600 italic">No file chosen</p>
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

                    <!-- Gallery Images History -->
                    <div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden mt-6">
                        <div class="px-6 py-4 border-b border-brown-100">
                            <h3 class="text-lg font-semibold text-brown-800 flex items-center">
                                <i class="fas fa-images mr-2 text-amber-600"></i>
                                Gallery Upload History
                            </h3>
                            <p class="text-xs text-brown-500 mt-1">All uploaded gallery images</p>
                        </div>
                        <div class="p-4 sm:p-6">
                            @if(isset($allGalleryImages) && $allGalleryImages->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-brown-200">
                                    <thead class="bg-brown-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Image</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Title</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Description</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Status</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-brown-700 uppercase tracking-wider">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-brown-200">
                                        @foreach ($allGalleryImages as $gallery)
                                        <tr class="hover:bg-brown-50">
                                            <td class="px-4 py-3">
                                                <div class="w-16 h-16 rounded-md overflow-hidden border border-brown-300">
                                                    <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->title ?? 'Gallery Image' }}" class="w-full h-full object-cover">
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-brown-800">{{ $gallery->title ?? 'No Title' }}</td>
                                            <td class="px-4 py-3 text-sm text-brown-600 max-w-xs truncate">{{ $gallery->description ?? '—' }}</td>
                                            {{-- <td class="px-4 py-3 whitespace-nowrap">
    <button class="toggle-status px-3 py-1 rounded-full text-xs font-semibold
        {{ $gallery->is_active ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}"
                                            data-id="{{ $gallery->id }}">
                                            {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                            </td> --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <button class="toggle-switch relative inline-block w-12 h-6 rounded-full cursor-pointer transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2
                                                        {{ $gallery->is_active ? 'bg-green-500 hover:shadow-lg hover:shadow-green-200 focus:ring-green-300' : 'bg-gray-300 hover:shadow-lg hover:shadow-gray-200 focus:ring-gray-300' }}" data-id="{{ $gallery->id }}" data-active="{{ $gallery->is_active ? 'true' : 'false' }}">
                                                        <div class="toggle-slider absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transition-all duration-300 ease-in-out transform
                                                        {{ $gallery->is_active ? 'translate-x-6' : 'translate-x-0' }}"></div>
                                                    </button>
                                                    <span class="status-text ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        {{ $gallery->is_active ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="px-4 py-3 text-sm text-brown-600">{{ $gallery->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
    <button class="btn btn-danger btn-sm delete-gallery" data-id="{{ $gallery->id }}">
        Delete
    </button>
</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-brown-600 text-center py-4">No gallery images uploaded yet.</p>
                            @endif
                        </div>
                    </div>






                </div>
            </main>
        </div>
    </div>
    @include('sweetalert::alert')

    <!-- If using Vite for navbar JS, place this before closing body tag -->
    @vite('resources/js/adminnavbar.js')

    <script>
//delete gallery code 
document.addEventListener('click', function (event) {
    if (event.target.matches('.delete-gallery')) {
        var id = event.target.dataset.id;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the gallery item.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admin/gallery/' + id, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(response => {
                    if (response.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        var button = document.querySelector('button[data-id="' + id + '"]');
                        if (button) {
                            var row = button.closest('tr');
                            if (row) {
                                row.style.transition = 'opacity 0.3s ease';
                                row.style.opacity = 0;
                                setTimeout(() => row.remove(), 300);
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    Swal.fire('Error!', 'Something went wrong while deleting.', 'error');
                });
            }
        });
    }
});






        //gallery toggle button
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-switch').forEach(button => {
                button.addEventListener('click', function() {
                    // Prevent multiple clicks during request
                    if (this.classList.contains('opacity-50')) return;

                    const id = this.dataset.id;
                    const isActive = this.dataset.active === 'true';
                    const slider = this.querySelector('.toggle-slider');
                    const statusText = this.parentElement.querySelector('.status-text');

                    // Add loading state
                    this.classList.add('opacity-50', 'cursor-not-allowed');
                    slider.classList.add('animate-pulse');

                    fetch(`/admin/gallery/toggle/${id}`, {
                            method: 'POST'
                            , headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                , 'Accept': 'application/json'
                                , 'Content-Type': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                const newStatus = data.status === 'Active';

                                

                                // Update button state
                                this.dataset.active = newStatus.toString();

                                if (newStatus) {
                                    // Active state
                                    this.classList.remove('bg-gray-300', 'hover:shadow-gray-200', 'focus:ring-gray-300');
                                    this.classList.add('bg-green-500', 'hover:shadow-green-200', 'focus:ring-green-300');
                                    slider.classList.remove('translate-x-0');
                                    slider.classList.add('translate-x-6');
                                    statusText.className = 'status-text ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
                                    statusText.textContent = 'Active';
                                } else {
                                    // Inactive state
                                    this.classList.remove('bg-green-500', 'hover:shadow-green-200', 'focus:ring-green-300');
                                    this.classList.add('bg-gray-300', 'hover:shadow-gray-200', 'focus:ring-gray-300');
                                    slider.classList.remove('translate-x-6');
                                    slider.classList.add('translate-x-0');
                                    statusText.className = 'status-text ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800';
                                    statusText.textContent = 'Inactive';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // You might want to show a toast notification here
                            alert('Failed to update status. Please try again.');
                        })
                        .finally(() => {
                            // Remove loading state
                            this.classList.remove('opacity-50', 'cursor-not-allowed');
                            slider.classList.remove('animate-pulse');
                        });
                });
            });
        });






////////////////////slider 




document.addEventListener("DOMContentLoaded", function () {
    // Gallery input
    const galleryInput = document.getElementById("gallery_image");
    const galleryFileName = document.getElementById("gallery-file-name");

    galleryInput.addEventListener("change", function () {
        if (galleryInput.files.length > 0) {
            galleryFileName.textContent = galleryInput.files[0].name;
        } else {
            galleryFileName.textContent = "No file chosen";
        }
    });

    // Slider input
    const sliderInput = document.getElementById("slider_image");
    const sliderFileName = document.getElementById("slider-file-name");

    sliderInput.addEventListener("change", function () {
        if (sliderInput.files.length > 0) {
            sliderFileName.textContent = sliderInput.files[0].name;
        } else {
            sliderFileName.textContent = "No file chosen";
        }
    });
});






        //dropdown js to prevent further choosing
        function updateSelectionUI() {
            const selects = document.querySelectorAll('#slider-table .display-order-select');
            let selectedPositions = new Set(); // Keep track of which positions are taken

            // Loop through all dropdowns and check their current values
            selects.forEach(select => {
                const value = select.value;
                if (value !== '' && value !== '0') { // If it's not "Not Selected"
                    selectedPositions.add(value);
                }
            });

            // Disable any dropdown that could potentially lead to more than 3 selections
            selects.forEach(select => {
                const currentValue = select.value;
                const selectId = select.getAttribute('data-id');

                // Only disable if this dropdown isn't already selected and there are already 3 selections
                if (currentValue === '' || currentValue === '0') {
                    // Check if there are already 3 selections
                    if (selectedPositions.size >= 3) {
                        select.disabled = true;
                    } else {
                        select.disabled = false; // Enable it if less than 3 selections exist
                    }
                }
            });
        }

        // Listen for changes in the dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('#slider-table .display-order-select');

            // Initialize the UI state when the page loads
            updateSelectionUI();

            // Listen for changes in any dropdown
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    // Re-evaluate the UI state after a change
                    updateSelectionUI();
                });
            });
        });

        function updateSelectionUI() {
            // 1. Find all relevant dropdowns
            const selects = document.querySelectorAll('#slider-table .display-order-select');
            // 2. Create a set to hold currently selected positions (1, 2, 3)
            let selectedPositions = new Set();

            // 3. Check each dropdown to see what's currently selected
            selects.forEach(select => {
                const value = select.value;
                // If a valid position is selected (not empty string)
                if (value === '1' || value === '2' || value === '3') {
                    selectedPositions.add(value);
                }
            });

            // 4. Determine if the limit of 3 selections is reached
            const isLimitReached = selectedPositions.size >= 3;

            // 5. Update the state of each dropdown
            selects.forEach(select => {
                const currentValue = select.value;

                if (currentValue === '1' || currentValue === '2' || currentValue === '3') {
                    // If this dropdown IS currently selected, it should remain enabled
                    // so the user can change or deselect it.
                    select.disabled = false;
                } else {
                    // If this dropdown is NOT currently selected (i.e., "Not Selected"),
                    // its state depends on whether the limit is reached.
                    select.disabled = isLimitReached;
                }
            });
        }


        // Listen for changes in the dropdowns and initialize the UI
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Find all relevant dropdowns
            const selects = document.querySelectorAll('#slider-table .display-order-select');

            // 2. Initialize the UI state when the page loads based on pre-selected values
            updateSelectionUI(); // Run once on load

            // 3. Add a 'change' event listener to each dropdown
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    // 4. Whenever a dropdown changes, re-run the update function
                    updateSelectionUI();
                });
            });
        });


        //delete ajax
        function confirmDelete(event, imageId) {
            event.preventDefault();

            if (confirm('Are you sure you want to delete this slider image? This action cannot be undone.')) {
                fetch(`/admin/slider/${imageId}`, {
                        method: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            , 'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Reload the page to reflect changes
                            window.location.reload();
                        } else {
                            alert('Failed to delete slider image.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the slider image.');
                    });
            }
        }

    </script>

</body>
</html>
