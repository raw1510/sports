  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="gallery">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Gallery</h2>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
  <!-- Card 1 -->
  <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
    <div class="relative overflow-hidden">
      <img src="gallery1.webp" alt="Caption 1" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
      <div class="absolute inset-0 bg-amber-900/0 group-hover:bg-amber-900/10 transition-colors duration-300"></div>
    </div>
    <div class="p-4">
      <p class="text-sm text-gray-600 group-hover:text-amber-800 transition-colors duration-200">Caption for image 1</p>
    </div>
  </div>
</div>
 </div>
</div>
<style>
  /* Additional brown theme enhancements for gallery cards */
  .gallery-card {
    border: 1px solid transparent;
    transition: all 0.3s ease;
  }
  
  .gallery-card:hover {
    border-color: rgb(217 119 6); /* amber-600 */
    box-shadow: 0 20px 25px -5px rgba(146, 64, 14, 0.1), 0 10px 10px -5px rgba(146, 64, 14, 0.04);
  }
  
  /* Focus states for accessibility */
  .gallery-card:focus-within {
    outline: 2px solid rgb(217 119 6); /* amber-600 */
    outline-offset: 2px;
  }
</style>