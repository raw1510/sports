<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Para Sports Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brown: {
              50:  '#faf6f2',
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
    /* Smooth checkbox/radio focus styles for accessibility */
    input[type="text"], input[type="date"], input[type="email"], input[type="tel"], select, textarea {
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

      <form class="p-6 grid grid-cols-1 gap-8" method="POST" action="{{ route('main.register.post') }}" enctype="multipart/form-data">
        @csrf
        <!-- Basic Information -->
        <fieldset class="space-y-6">
          <legend class="text-xl font-semibold text-brown-800">Basic Information</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-sm font-medium text-brown-700">Surname Name</label>
              <input type="text" name="surname"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Enter surname" />
            </div>

            <div>
              <label class="block text-sm font-medium text-brown-700">Name of the Athlete</label>
              <input type="text" name="athlete_name"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Enter full name" />
            </div>

            <div>
              <label class="block text-sm font-medium text-brown-700">Father’s Name</label>
              <input type="text" name="father_name" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Enter father's name" />
            </div>

            <div>
              <label class="block text-sm font-medium text-brown-700">Date of Birth</label>
              <input type="date" name="dob"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" />
            </div>

            <div>
              <label class="block text-sm font-medium text-brown-700">Male / Female</label>
              <select name="gender"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400">
                <option value="" disabled selected>Select</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
                <option>Prefer not to say</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-brown-700">Age Groups</label>
              <select name="age_group"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400">
                <option value="" disabled selected>Select</option>
                <option>Under 14</option>
                <option>Under 17</option>
                <option>Under 19</option>
                <option>Open</option>
                <option>Masters</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-sm font-medium text-brown-700">Full Postal Address</label>
              <textarea name="address" rows="3"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="Street, City, State, ZIP"></textarea>
            </div>

            <div class="grid grid-cols-1 gap-5">
              <div>
                <label class="block text-sm font-medium text-brown-700">Contact Number</label>
                <input type="tel" name="phone"  pattern="[0-9+\-\s]{7,}" class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="+1 234 567 890" />
              </div>

              <div>
                <label class="block text-sm font-medium text-brown-700">E-mail ID</label>
                <input type="email" name="email"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="name@example.com" />
              </div>
            </div>
          </div>
          
        </fieldset>
        <hr class="my-1 border-brown-700">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-2 my-2">
            <div>
              <label class="block text-sm font-medium text-brown-700">Percentage</label>
              <input type="number" name="percentage" min="0" max="100" step="1"  class="mt-1 w-full rounded-lg border border-brown-200 bg-brown-50/50 px-3 py-2 focus:ring-2 focus:ring-brown-400 focus:border-brown-400" placeholder="0 - 100" />
            </div>
          </div>

        <hr class="my-1 border-brown-700">

        <!-- Disability Category (single choice) -->
        <fieldset class="space-y-4">
          <legend class="text-xl font-semibold text-brown-800">Disability Category (Select one)</legend>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <!-- Generate radio buttons -->
            <!-- Columnized list -->
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Blindness"  class="mt-1" />
              <span>Blindness</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Low Vision" class="mt-1" />
              <span>Low Vision</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Leprosy Cured Persons" class="mt-1" />
              <span>Leprosy Cured Persons</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Hearing Impairment (Deaf and Hard of Hearing)" class="mt-1" />
              <span>Hearing Impairment (Deaf and Hard of Hearing)</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Locomotor Disability" class="mt-1" />
              <span>Locomotor Disability</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Dwarfism" class="mt-1" />
              <span>Dwarfism</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Intellectual Disability" class="mt-1" />
              <span>Intellectual Disability</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Mental Illness" class="mt-1" />
              <span>Mental Illness</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Autism Spectrum Disorder" class="mt-1" />
              <span>Autism Spectrum Disorder</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Cerebral Palsy" class="mt-1" />
              <span>Cerebral Palsy</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Muscular Dystrophy" class="mt-1" />
              <span>Muscular Dystrophy</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Chronic Neurological Conditions" class="mt-1" />
              <span>Chronic Neurological Conditions</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Specific Learning Disabilities" class="mt-1" />
              <span>Specific Learning Disabilities</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Multiple Sclerosis" class="mt-1" />
              <span>Multiple Sclerosis</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Speech and Language Disability" class="mt-1" />
              <span>Speech and Language Disability</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Thalassemia" class="mt-1" />
              <span>Thalassemia</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Hemophilia" class="mt-1" />
              <span>Hemophilia</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Sickle Cell Disease" class="mt-1" />
              <span>Sickle Cell Disease</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Multiple Disabilities" class="mt-1" />
              <span>Multiple Disabilities (more than one of the above specified disabilities)</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Acid Attack Victim" class="mt-1" />
              <span>Acid Attack Victim</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Parkinson’s Disease" class="mt-1" />
              <span>Parkinson’s Disease</span>
            </label>
          </div>

          
        </fieldset>
        <hr class="my-1 border-brown-700">

        <!-- Games (max 3 checkboxes) -->
        <fieldset class="space-y-4">
          <legend class="text-xl font-semibold text-brown-800">Select Games (Up to 3)</legend>
          <p class="text-sm text-brown-600">You can choose a maximum of three games. After three selections, the remaining options will be disabled.</p>

          <div id="games-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <!-- Checkbox list -->
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Archery" class="mt-1 game-checkbox" />
              <span>Archery</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para athletics" class="mt-1 game-checkbox" />
              <span>Para athletics</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para badminton" class="mt-1 game-checkbox" />
              <span>Para badminton</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Boccia" class="mt-1 game-checkbox" />
              <span>Boccia</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para canoe" class="mt-1 game-checkbox" />
              <span>Para canoe</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para cycling" class="mt-1 game-checkbox" />
              <span>Para cycling</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para equestrian" class="mt-1 game-checkbox" />
              <span>Para equestrian</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Blind football" class="mt-1 game-checkbox" />
              <span>Blind football</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Goalball" class="mt-1 game-checkbox" />
              <span>Goalball</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para Cricket" class="mt-1 game-checkbox" />
              <span>Para Cricket</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para judo" class="mt-1 game-checkbox" />
              <span>Para judo</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para powerlifting" class="mt-1 game-checkbox" />
              <span>Para powerlifting</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para rowing" class="mt-1 game-checkbox" />
              <span>Para rowing</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Shooting para sport" class="mt-1 game-checkbox" />
              <span>Shooting para sport</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Sitting volleyball" class="mt-1 game-checkbox" />
              <span>Sitting volleyball</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para swimming" class="mt-1 game-checkbox" />
              <span>Para swimming</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para table tennis" class="mt-1 game-checkbox" />
              <span>Para table tennis</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para taekwondo" class="mt-1 game-checkbox" />
              <span>Para taekwondo</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Para triathlon" class="mt-1 game-checkbox" />
              <span>Para triathlon</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Wheelchair basketball" class="mt-1 game-checkbox" />
              <span>Wheelchair basketball</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="checkbox" name="games[]" value="Wheelchair fencing" class="mt-1 game-checkbox" />
              <span>Wheelchair fencing</span>
            </label>
          </div>
        </fieldset>


        

      <h2 class="text-2xl font-bold text-brown-800">Upload Your Documents</h2>

        <!-- Drag & Drop Area -->
        <div id="dropzone"
            class="border-2 border-dashed border-yellow-400 rounded-lg p-6 text-center cursor-pointer bg-yellow-50 hover:bg-yellow-100 transition">
            <p class="text-brown-700">Click here to Upload file</p>
            <input type="file" id="fileInput" multiple class="hidden" name="documents[]">
        </div>

        <!-- File Preview -->
        <ul id="fileList" class="space-y-2 text-brown-800"></ul>

        <!-- Submit -->
        <div class="flex items-center justify-between pt-2">
          <p class="text-sm text-brown-700">All fields marked as required must be completed.</p>

            {{-- convert button in to a --}}
          <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-brown-700 text-white px-5 py-2.5 hover:bg-brown-800 focus:outline-none focus:ring-2 focus:ring-brown-400">
            Submit
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </button>


        </div>
      </form>
    </section>
  </main>
  @include('components.homepage.footer')

  <script>


   const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    // Array to store selected files
    let filesArray = [];

    // Trigger file input when clicking the dropzone
    dropzone.addEventListener('click', () => fileInput.click());

    // Handle manual file selection
    fileInput.addEventListener('change', (e) => {
        addFiles(e.target.files);
        fileInput.value = ""; // Reset so same file can be selected again
    });


    // Add files to array and update preview
    function addFiles(newFiles) {
        for (let file of newFiles) {
            filesArray.push(file);
        }
        console.log(filesArray)
        renderFileList();
    }
function updateFileInput() {
    const dataTransfer = new DataTransfer();
    filesArray.forEach(file => dataTransfer.items.add(file));
    fileInput.files = dataTransfer.files;
}

// Call this before submit:
document.querySelector('form').addEventListener('submit', () => {
    updateFileInput();
});
    // Render file preview
    function renderFileList() {
        fileList.innerHTML = "";
        filesArray.forEach((file, index) => {
            const li = document.createElement('li');
            li.className = "flex justify-between items-center bg-yellow-200 px-3 py-2 rounded-lg";
            li.innerHTML = `
                <span>${file.name}</span>
                <button type="button" class="text-red-500 hover:text-red-700" onclick="removeFile(${index})">Remove</button>
            `;
            fileList.appendChild(li);
        });
    }

    // Remove file from array
    function removeFile(index) {
        filesArray.splice(index, 1);
        renderFileList();
    }


    // Limit games to max 3 selections
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

    // Simple demo submit handler
    /*function handleSubmit(e) {
      e.preventDefault();
      // Collect data
      const form = e.target;
      const data = new FormData(form);
      const selectedGames = Array.from(gameCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
      const payload = Object.fromEntries(data.entries());
      payload.games = selectedGames;

      // You can replace this with an actual POST request.
      alert('Form submitted!\n\n' + JSON.stringify(payload, null, 2));
    }*/
  </script>
</body>
</html>

{{-- table admain panel  --}}
{{-- 
<table class="min-w-full divide-y divide-brown-200">
                                <thead class="bg-brown-50">
                                    <tr>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Name</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Email</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Disability Category</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Games</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Documents</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Status</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-brown-200">
                                    <tr>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-brown-900">John Doe</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">john.doe@example.com</td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                                Physical Disability
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-sm text-brown-500">
                                            <div>Swimming, Athletics</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                                            <div class="flex flex-wrap gap-1">
                                                <span class="px-2 py-1 bg-brown-100 rounded text-xs">medical.pdf</span>
                                                <span class="px-2 py-1 bg-brown-100 rounded text-xs">id.pdf</span>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-brown-600 hover:text-brown-900 mr-3">View</a>
                                            <a href="#" class="text-amber-600 hover:text-amber-900">Edit</a>
                                        </td>
                                    </tr>
                                    <tr class="bg-brown-50">
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-brown-900">Jane Smith</div>
                                            <div class="text-sm text-brown-500">ID: #PS002</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">jane.smith@example.com</td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Visual Impairment
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-sm text-brown-500">
                                            <div>Goalball, Athletics</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                                            <div class="flex flex-wrap gap-1">
                                                <span class="px-2 py-1 bg-brown-100 rounded text-xs">certificate.pdf</span>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-brown-600 hover:text-brown-900 mr-3">View</a>
                                            <a href="#" class="text-amber-600 hover:text-amber-900">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-brown-900">Robert Johnson</div>
                                            <div class="text-sm text-brown-500">ID: #PS003</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">robert.j@example.com</td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Hearing Impairment
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-sm text-brown-500">
                                            <div>Swimming, Cycling</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                                            <div class="flex flex-wrap gap-1">
                                                <span class="px-2 py-1 bg-brown-100 rounded text-xs">medical.pdf</span>
                                                <span class="px-2 py-1 bg-brown-100 rounded text-xs">id.pdf</span>
                                                <span class="px-2 py-1 bg-brown-100 rounded text-xs">cert.pdf</span>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-brown-600 hover:text-brown-900 mr-3">View</a>
                                            <a href="#" class="text-amber-600 hover:text-amber-900">Edit</a>
                                        </td>
                                    </tr>
                                    <tr class="bg-brown-50">
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-brown-900">Emily Davis</div>
                                            <div class="text-sm text-brown-500">ID: #PS004</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">emily.davis@example.com</td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Intellectual Disability
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-sm text-brown-500">
                                            <div>Table Tennis, Boccia</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                                            <div class="flex flex-wrap gap-1">
                                                <span class="px-2 py-1 bg-brown-100 rounded text-xs">document.pdf</span>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Documents Required
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-brown-600 hover:text-brown-900 mr-3">View</a>
                                            <a href="#" class="text-amber-600 hover:text-amber-900">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> --}}

{{-- <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Low Vision" class="mt-1" />
              <span>Low Vision</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Leprosy Cured Persons" class="mt-1" />
              <span>Leprosy Cured Persons</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Hearing Impairment (Deaf and Hard of Hearing)" class="mt-1" />
              <span>Hearing Impairment (Deaf and Hard of Hearing)</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Locomotor Disability" class="mt-1" />
              <span>Locomotor Disability</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Dwarfism" class="mt-1" />
              <span>Dwarfism</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Intellectual Disability" class="mt-1" />
              <span>Intellectual Disability</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Mental Illness" class="mt-1" />
              <span>Mental Illness</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Autism Spectrum Disorder" class="mt-1" />
              <span>Autism Spectrum Disorder</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Cerebral Palsy" class="mt-1" />
              <span>Cerebral Palsy</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Muscular Dystrophy" class="mt-1" />
              <span>Muscular Dystrophy</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Chronic Neurological Conditions" class="mt-1" />
              <span>Chronic Neurological Conditions</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Specific Learning Disabilities" class="mt-1" />
              <span>Specific Learning Disabilities</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Multiple Sclerosis" class="mt-1" />
              <span>Multiple Sclerosis</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Speech and Language Disability" class="mt-1" />
              <span>Speech and Language Disability</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Thalassemia" class="mt-1" />
              <span>Thalassemia</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Hemophilia" class="mt-1" />
              <span>Hemophilia</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Sickle Cell Disease" class="mt-1" />
              <span>Sickle Cell Disease</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Multiple Disabilities" class="mt-1" />
              <span>Multiple Disabilities (more than one of the above specified disabilities)</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Acid Attack Victim" class="mt-1" />
              <span>Acid Attack Victim</span>
            </label>
            <label class="flex items-start gap-3 p-3 rounded-lg border border-brown-200 bg-brown-50/40 hover:bg-brown-100/40 cursor-pointer">
              <input type="radio" name="disability" value="Parkinson’s Disease" class="mt-1" />
              <span>Parkinson’s Disease</span>
            </label> --}}