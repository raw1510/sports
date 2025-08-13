<section class="py-16 bg-gradient-to-b from-amber-50 to-white my-4 bg-amber-50" id="contact">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="text-center mb-12">
      <h2 class="text-3xl font-extrabold text-amber-900 sm:text-4xl">Contact Us</h2>
      <div class="w-20 h-1 bg-amber-600 mx-auto mt-4 rounded-full"></div>
      <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
        Get in touch with the ParaSports Association of Surat — we’d love to hear from you.
      </p>
    </div>

    <div class="bg-white rounded-xl shadow-xl p-8 lg:p-12">
      <form class="">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Full Name -->
        <div class="md:col-span-1">
          <label for="full_name" class="block text-sm font-medium text-amber-900 mb-2">
            Full Name <span class="text-red-500">*</span>
          </label>
          <input type="text" id="full_name" name="full_name" required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
            placeholder="John Doe">
        </div>

        <!-- Age -->
        <div>
          <label for="age" class="block text-sm font-medium text-amber-900 mb-2">
            Age <span class="text-red-500">*</span>
          </label>
          <input type="number" id="age" name="age" required min="1" max="120"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
            placeholder="30">
        </div>

        <!-- Disability Type -->
        <div>
          <label for="disability_type" class="block text-sm font-medium text-amber-900 mb-2">
            Type of Disability <span class="text-red-500">*</span>
          </label>
          <select id="disability_type" name="disability_type" required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition bg-white">
            <option value="">Select disability type</option>
            <option value="physical">Physical Disability</option>
            <option value="visual">Visual Impairment</option>
            <option value="intellectual">Intellectual Disability</option>
            <option value="hearing">Hearing Impairment</option>
            <option value="multiple">Multiple Disabilities</option>
            <option value="other">Other</option>
          </select>
        </div>

        <!-- Contact Number -->
        <div>
          <label for="contact_number" class="block text-sm font-medium text-amber-900 mb-2">
            Contact Number <span class="text-red-500">*</span>
          </label>
          <input type="tel" id="contact_number" name="contact_number" required pattern="[0-9]{10}"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
            placeholder="9876543210">
        </div>

        <!-- Information Request -->
        <div class="md:col-span-2">
          <label for="information_request" class="block text-sm font-medium text-amber-900 mb-2">
            What kind of information are you looking for? <span class="text-red-500">*</span>
          </label>
          <textarea id="information_request" name="information_request" required rows="4"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition resize-y"
            placeholder="Please describe the information you're seeking or any questions you have..."></textarea>
        </div>

        <!-- Submit Button -->
        
        
      </div>
      <div class="md:col-span-2 flex justify-center">
            <button type="submit"
            class="w-full md:w-auto px-8 py-3 bg-amber-600 text-white font-semibold rounded-lg shadow-md hover:bg-amber-700 focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all">
                Submit Inquiry
            </button>
        </div>
      </form>

      <!-- Contact Info -->
      <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-8 border-t pt-8">
        <div class="flex items-center space-x-4">
          <div class="bg-amber-100 p-3 rounded-full">
            📧
          </div>
          <div>
            <h3 class="text-lg font-semibold text-amber-900">Email</h3>
            <p class="text-gray-600">info@parasportssurat.org</p>
          </div>
        </div>
        <div class="flex items-center space-x-4">
          <div class="bg-amber-100 p-3 rounded-full">
            📞
          </div>
          <div>
            <h3 class="text-lg font-semibold text-amber-900">Phone</h3>
            <p class="text-gray-600">+91 98765 43210</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
