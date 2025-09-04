<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="gallery">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Gallery</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($galleries as $gallery)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group gallery-card border border-gray-100">
            <!-- Image Section -->
            <div class="relative overflow-hidden">
                <img src="{{ asset($gallery->image_path) }}" 
                     alt="{{ $gallery->title ?: 'Gallery Image' }}" 
                     class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent"></div>
            </div>

            <!-- Content Section -->
            <div class="p-5 space-y-2">
                <!-- Title -->
                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-amber-700 transition-colors duration-200">
                    {{ $gallery->title ?: 'Untitled Achievement' }}
                </h3>

                <!-- Description -->
                @if($gallery->description)
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ $gallery->description }}
                    </p>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg">No gallery images available yet.</p>
        </div>
    @endforelse
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