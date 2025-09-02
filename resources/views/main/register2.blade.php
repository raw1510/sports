<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Para Sports Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
    <style>
        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            outline: none;
        }
    </style>
</head>
<body class="min-h-screen bg-brown-50 text-brown-900">
    @include('components.homepage.navbar')
    <main class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">
        <section class="bg-white shadow-lg rounded-xl border border-brown-100 overflow-hidden">
            <div class="bg-brown-700 text-white px-6 py-5">
                <h1 class="text-2xl font-semibold">Para Sports Registration</h1>
                <p class="text-brown-100 text-sm mt-1">Fill your basic information, choose one disability category, and up to three games.</p>
            </div>
            <form id="registrationForm" action="/register" method="POST" class="p-6" enctype="multipart/form-data">
                <!-- CSRF token for Laravel -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <fieldset class="space-y-6">
                    <legend class="text-xl font-semibold text-brown-800">Basic Information</legend>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-brown-700">Surname Name</label>
                            <input type="text" name="surname" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Enter surname" value="{{ old('surname') }}" />
                            @error('surname')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brown-700">Name of the Athlete</label>
                            <input type="text" name="athlete_name" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Enter full name" value="{{ old('athlete_name') }}" />
                            @error('athlete_name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brown-700">Father's Name</label>
                            <input type="text" name="father_name" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Enter father's name" value="{{ old('father_name') }}" />
                            @error('father_name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brown-700">Date of Birth</label>
                            <input type="date" name="dob" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" value="{{ old('dob') }}" />
                            @error('dob')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brown-700">Male / Female</label>
                            <select name="gender" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400">
                                <option value="" disabled selected>Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brown-700">Age Groups</label>
                            <select name="age_group" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400">
                                <option value="" disabled selected>Select</option>
                                <option value="14">Under 14</option>
                                <option value="17">Under 17</option>
                                <option value="19">Under 19</option>
                                <option value="open">Open</option>
                                <option value="masters">Masters</option>
                            </select>
                            @error('age_group')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-brown-700">Full Postal Address</label>
                            <textarea name="address" rows="3" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Street, City, State, ZIP">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-brown-700">Contact Number</label>
                                <input type="tel" name="phone" pattern="[0-9+\-\s]{7,}" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="+1 234 567 890" value="{{ old('phone') }}" />
                                @error('phone')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-brown-700">E-mail ID</label>
                                <input type="email" name="email" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="name@example.com" value="{{ old('email') }}" />
                                @error('email')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>

                <hr class="my-3 border-brown-700">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-brown-700">Percentage</label>
                        <input type="number" name="percentage" min="0" max="100" step="1" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="0 - 100" value="{{ old('percentage') }}" />
                        @error('percentage')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <hr class="my-3 border-brown-700">

                <fieldset class="space-y-4">
                    <legend class="text-xl font-semibold text-brown-800">Disability Category (Select one)</legend>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
                            <input type="radio" name="disability" value="Blindness" class="mt-1" />
                            <span>Blindness</span>
                        </label>

                        @foreach ($disabilities as $disability)
                        <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
                            <input type="radio" name="disability" value="{{$disability}}" class="mt-1" />
                            <span>{{$disability}}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('disability')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>
                <hr class="my-3 border-brown-700">

                <fieldset class="space-y-4">
                    <legend class="text-xl font-semibold text-brown-800">Select Games (Up to 3)</legend>
                    <p class="text-sm text-brown-600">You can choose a maximum of three games. After three selections, the remaining options will be disabled.</p>

                    <div id="games-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach ($games as $key => $value)
                        <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
                            <input type="checkbox" name="games[]" value="{{$key}}" class="mt-1 game-checkbox" />
                            <span>{{$value}}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('games')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </fieldset>

                <hr class="my-3 border-brown-700">

                <!-- Document Upload Section -->
                <fieldset class="space-y-6">
                    <legend class="text-xl font-semibold text-brown-800">Upload Documents</legend>
                    <p class="text-sm text-brown-600">All files must be under 300KB. Accepted formats: JPG, JPEG, PNG, PDF</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Aadhar Card -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-brown-700">
                                Aadhar Card <span class="text-red-500">*</span>
                            </label>
                            <div class="document-upload border-2 border-dashed border-brown-300 rounded-lg p-4 text-center cursor-pointer bg-brown-50/50 hover:bg-brown-100/50 transition">
                                <div class="upload-icon">📄</div>
                                <p class="text-brown-700 text-sm">Click to upload Aadhar Card</p>
                                <input type="file" name="aadhar_card" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <div class="file-preview hidden">
                                <div class="flex items-center justify-between p-2 bg-brown-100 rounded">
                                    <span class="file-name text-sm text-brown-700"></span>
                                    <button type="button" class="remove-file text-red-500 hover:text-red-700">×</button>
                                </div>
                            </div>
                            @error('aadhar_card')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Disability Certificate -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-brown-700">
                                Disability Certificate <span class="text-red-500">*</span>
                            </label>
                            <div class="document-upload border-2 border-dashed border-brown-300 rounded-lg p-4 text-center cursor-pointer bg-brown-50/50 hover:bg-brown-100/50 transition">
                                <div class="upload-icon">📋</div>
                                <p class="text-brown-700 text-sm">Click to upload Disability Certificate</p>
                                <input type="file" name="disability_certificate" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <div class="file-preview hidden">
                                <div class="flex items-center justify-between p-2 bg-brown-100 rounded">
                                    <span class="file-name text-sm text-brown-700"></span>
                                    <button type="button" class="remove-file text-red-500 hover:text-red-700">×</button>
                                </div>
                            </div>
                            @error('disability_certificate')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bank Passbook -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-brown-700">
                                Bank Passbook <span class="text-red-500">*</span>
                            </label>
                            <div class="document-upload border-2 border-dashed border-brown-300 rounded-lg p-4 text-center cursor-pointer bg-brown-50/50 hover:bg-brown-100/50 transition">
                                <div class="upload-icon">🏦</div>
                                <p class="text-brown-700 text-sm">Click to upload Bank Passbook</p>
                                <input type="file" name="bank_passbook" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <div class="file-preview hidden">
                                <div class="flex items-center justify-between p-2 bg-brown-100 rounded">
                                    <span class="file-name text-sm text-brown-700"></span>
                                    <button type="button" class="remove-file text-red-500 hover:text-red-700">×</button>
                                </div>
                            </div>
                            @error('bank_passbook')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Passport Size Photo -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-brown-700">
                                Passport Size Photo <span class="text-red-500">*</span>
                            </label>
                            <div class="document-upload border-2 border-dashed border-brown-300 rounded-lg p-4 text-center cursor-pointer bg-brown-50/50 hover:bg-brown-100/50 transition">
                                <div class="upload-icon">📸</div>
                                <p class="text-brown-700 text-sm">Click to upload Passport Size Photo</p>
                                <input type="file" name="passport_photo" class="hidden" accept=".jpg,.jpeg,.png">
                            </div>
                            <div class="file-preview hidden">
                                <div class="flex items-center justify-between p-2 bg-brown-100 rounded">
                                    <span class="file-name text-sm text-brown-700"></span>
                                    <button type="button" class="remove-file text-red-500 hover:text-red-700">×</button>
                                </div>
                            </div>
                            @error('passport_photo')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Passport Pages (Optional) -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-brown-700">
                            Passport Front and Last Page (Combined PDF) <span class="text-brown-500">(Optional)</span>
                        </label>
                        <div class="document-upload border-2 border-dashed border-brown-300 rounded-lg p-4 text-center cursor-pointer bg-brown-50/50 hover:bg-brown-100/50 transition">
                            <div class="upload-icon">📘</div>
                            <p class="text-brown-700 text-sm">Click to upload Passport Pages (PDF only)</p>
                            <input type="file" name="passport_pages" class="hidden" accept=".pdf">
                        </div>
                        <div class="file-preview hidden">
                            <div class="flex items-center justify-between p-2 bg-brown-100 rounded">
                                <span class="file-name text-sm text-brown-700"></span>
                                <button type="button" class="remove-file text-red-500 hover:text-red-700">×</button>
                            </div>
                        </div>
                        @error('passport_pages')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </fieldset>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" id="submitBtn" class="w-full bg-brown-600 hover:bg-brown-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
                        Submit Registration
                    </button>
                </div>
            </form>
        </section>
    </main>
    @include('components.homepage.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Game checkbox limit functionality
            const gameCheckboxes = document.querySelectorAll('.game-checkbox');
            function updateGameCheckboxStates() {
                const checked = Array.from(gameCheckboxes).filter(cb => cb.checked);
                const atLimit = checked.length >= 3;
                gameCheckboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = atLimit;
                        cb.parentElement.classList.toggle('opacity-50', atLimit);
                        cb.parentElement.classList.toggle('cursor-not-allowed', atLimit);
                    } else {
                        cb.parentElement.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                });
            }
            gameCheckboxes.forEach(cb => cb.addEventListener('change', updateGameCheckboxStates));
            updateGameCheckboxStates();

            // Document upload functionality
            const documentUploads = document.querySelectorAll('.document-upload');
            
            documentUploads.forEach(upload => {
                const input = upload.querySelector('input[type="file"]');
                const preview = upload.nextElementSibling;
                const fileName = preview.querySelector('.file-name');
                const removeBtn = preview.querySelector('.remove-file');
                
                upload.addEventListener('click', () => {
                    input.click();
                });

                input.addEventListener('change', function(e) {
                    const file = this.files[0];
                    if (file) {
                        // Check file size (300KB = 307200 bytes)
                        if (file.size > 307200) {
                            alert('File size must be under 300KB');
                            this.value = '';
                            return;
                        }
                        
                        fileName.textContent = file.name;
                        preview.classList.remove('hidden');
                        upload.classList.add('border-green-300', 'bg-green-50');
                    }
                });

                removeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    input.value = '';
                    preview.classList.add('hidden');
                    upload.classList.remove('border-green-300', 'bg-green-50');
                });
            });
        });
    </script>
</body>
</html>