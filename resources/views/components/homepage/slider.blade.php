<section aria-labelledby="hero-heading" class="relative">
  <div id="hero-slider" class="relative h-[48vh] md:h-[65vh] overflow-hidden">
    
    <!-- Slider dots -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
      <button class="slider-dot w-3 h-3 rounded-full bg-amber-600 transition-colors" data-index="0" aria-label="Go to slide 1"></button>
      <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-75 transition-colors" data-index="1" aria-label="Go to slide 2"></button>
      <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-75 transition-colors" data-index="2" aria-label="Go to slide 3"></button>
    </div>

    <!-- Slide 1 -->
    @foreach($sliderImages as $sliderImage)

      <div class="absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100 slide" data-index="0">
        <picture>
          <source srcset="{{ asset($sliderImage->image_path) }}" type="image/webp">
          <img src="{{ asset($sliderImage->image_path) }}" alt="Paralympic athletes celebrating" class="w-full h-full object-cover" loading="lazy" decoding="async">
        </picture>
        <div class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-amber-900/30 flex flex-col items-center justify-end text-center p-6">
          <h1 id="hero-heading" class="text-white text-2xl md:text-4xl font-bold mb-2">{{ $sliderImage->title }}</h1>
          <p class="text-amber-100 text-base md:text-lg max-w-3xl">{{ $sliderImage->description }}</p>
        </div>
      </div>
    @endforeach
    <!-- Slide 2 -->
  

    <!-- Slide 3 -->
    
  </div>
</section>

<style>
  /* Custom styles for slider dots and navigation */
  .slider-dot.active {
    background-color: rgb(217 119 6); /* amber-600 */
  }
  
  /* Enhanced button hover effects */
  #prev-slide:hover,
  #next-slide:hover {
    transform: translate(-50%, -50%) scale(1.1);
  }
  
  #prev-slide {
    left: 0.5rem;
  }
  
  #next-slide {
    right: 0.5rem;
  }
  
  /* Accessibility improvements */
  .slider-dot:focus,
  #prev-slide:focus,
  #next-slide:focus {
    outline: 2px solid rgb(251 245 232); /* amber-50 */
    outline-offset: 2px;
  }
</style>
