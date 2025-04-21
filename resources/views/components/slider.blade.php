<section class="bg-[#0A2240] py-12 text-white">
    <div class="container mx-auto text-center mb-8">
        <h2 class="text-2xl md:text-3xl font-bold">Trusted by the nation's leading construction teams</h2>
        <div class="h-1 w-20 bg-[#E31B23] mx-auto mt-4"></div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Desktop Logos -->
        <div class="hidden md:block">
            <div class="grid grid-cols-6 gap-6 items-center">
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="/images/clients/client1.svg" alt="Construct Pro" class="max-h-16">
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="/images/clients/client2.svg" alt="BuildTech" class="max-h-16">
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="/images/clients/client3.svg" alt="Apex Build" class="max-h-16">
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="/images/clients/client4.svg" alt="Prime Homes" class="max-h-16">
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="/images/clients/client5.svg" alt="Metro Construction" class="max-h-16">
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24 transition-transform duration-300 hover:transform hover:scale-105">
                    <img src="/images/clients/client6.svg" alt="Apex Builders" class="max-h-16">
                </div>
            </div>
        </div>

        <!-- Mobile Logos Slider -->
        <div class="md:hidden overflow-hidden">
            <div class="client-carousel">
                <div class="flex">
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24">
                            <img src="/images/clients/client1.svg" alt="Construct Pro" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24">
                            <img src="/images/clients/client2.svg" alt="BuildTech" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24">
                            <img src="/images/clients/client3.svg" alt="Apex Build" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24">
                            <img src="/images/clients/client4.svg" alt="Prime Homes" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24">
                            <img src="/images/clients/client5.svg" alt="Metro Construction" class="max-h-16">
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-1/2 p-2">
                        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-center h-24">
                            <img src="/images/clients/client6.svg" alt="Apex Builders" class="max-h-16">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <a href="/clients" class="inline-block px-6 py-3 bg-[#E31B23] text-white font-medium rounded-lg hover:bg-[#c8171f] transition-colors duration-300">
                View All Clients
            </a>
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