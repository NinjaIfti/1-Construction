<section class="bg-[#0A2240] py-12 text-white">
    <div class="container mx-auto text-center mb-8">
        <h2 class="text-2xl md:text-3xl font-bold">Trusted by the nation's leading construction teams</h2>
        <div class="h-1 w-20 bg-[#E31B23] mx-auto mt-4"></div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Desktop Logos -->
        <div class="hidden md:block">
            <div class="grid grid-cols-6 gap-6 items-center">
                <div class="flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ae4bad9e5593310c8a_m.png" alt="M Construction" class="max-h-16">
                </div>
                <div class="flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ac20ba722b788db851_anthony.png" alt="Anthony Construction" class="max-h-16">
                </div>
                <div class="flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ac43843b952c018e63_brookfield.png" alt="Brookfield" class="max-h-16">
                </div>
                <div class="flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088acf9e6af987b5d2d36_dicks.png" alt="Dick's Construction" class="max-h-16">
                </div>
                <div class="flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ae48813c00c815116d_Lennar.png" alt="Lennar" class="max-h-16">
                </div>
                <div class="flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088aef9e6af987b5d2e30_premier.png" alt="Premier Construction" class="max-h-16">
                </div>
            </div>
        </div>

        <!-- Mobile Logos Slider -->
        <div class="md:hidden overflow-hidden">
            <div class="client-carousel">
                <div class="flex">
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="flex items-center justify-center h-24">
                            <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ae4bad9e5593310c8a_m.png" alt="M Construction" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="flex items-center justify-center h-24">
                            <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ac20ba722b788db851_anthony.png" alt="Anthony Construction" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="flex items-center justify-center h-24">
                            <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ac43843b952c018e63_brookfield.png" alt="Brookfield" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="flex items-center justify-center h-24">
                            <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088acf9e6af987b5d2d36_dicks.png" alt="Dick's Construction" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="flex items-center justify-center h-24">
                            <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088ae48813c00c815116d_Lennar.png" alt="Lennar" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="flex items-center justify-center h-24">
                            <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c088aef9e6af987b5d2e30_premier.png" alt="Premier Construction" class="max-h-16">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple mobile carousel logic
        const carousel = document.querySelector('.client-carousel .flex');
        if (carousel) {
            let position = 0;
            const slideWidth = carousel.offsetWidth / 2;
            const itemCount = carousel.children.length;
            let slideInterval;
            
            function updateCarousel() {
                carousel.style.transform = `translateX(-${position * slideWidth}px)`;
                carousel.style.transition = 'transform 0.5s ease-in-out';
            }
            
            function slideNext() {
                position = (position + 1) % (itemCount - 1);
                updateCarousel();
            }
            
            // Auto slide every 3 seconds
            slideInterval = setInterval(slideNext, 3000);
            
            // Pause on hover
            carousel.addEventListener('mouseenter', function() {
                clearInterval(slideInterval);
            });
            
            carousel.addEventListener('mouseleave', function() {
                slideInterval = setInterval(slideNext, 3000);
            });
        }
    });
</script>