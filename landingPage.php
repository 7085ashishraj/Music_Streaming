<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodTunes - Music for Every Emotion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    <style>
        .mood-card:hover .play-icon {
            opacity: 1;
            transform: scale(1.1);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-indigo-900 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
        <img src="music-player.png" alt="Music Logo" class="w-12 h-12 font-bold">
        <h1 class="text-xl font-bold">MoodTunes</h1>
    </div>
            <div class="hidden md:flex space-x-6">
                <a href="#features" class="hover:text-indigo-200 transition">Features</a>
                <a href="#moods" class="hover:text-indigo-200 transition">Moods</a>
                <a href="#testimonials" class="hover:text-indigo-200 transition">Testimonials</a>
            </div>
            <div class="flex space-x-3">
                <a href="login.html" class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-100 transition">Login</a>
                <a href="signup.html" class="bg-indigo-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-400 transition">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20 relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Text Content -->
                <div class="md:w-1/2 mb-10 md:mb-0 z-10">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Music That Matches Your Mood</h1>
                    <p class="text-xl mb-8">Discover perfect playlists for every emotion. Or create your own mood collections with your favorite songs.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="index.html" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-medium hover:bg-indigo-100 transition text-lg text-center">
                            Start Listening Free
                        </a>
                        <button onclick="openVideoModal()" class="bg-transparent border-2 border-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition text-lg">
                            See Demo
                        </button>
                    </div>
                </div>

                <!-- Image -->
                <div class="md:w-1/2 relative z-10">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Person listening to music" class="rounded-lg shadow-xl transform rotate-2">
                    <div class="absolute -bottom-5 -left-5 w-32 h-32 bg-yellow-400 rounded-full opacity-20 z-0"></div>
                    <div class="absolute -top-5 -right-5 w-40 h-40 bg-pink-500 rounded-full opacity-20 z-0"></div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-purple-500 rounded-full opacity-10"></div>
            <div class="absolute top-3/4 right-1/4 w-48 h-48 bg-blue-400 rounded-full opacity-10"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Why Choose MoodTunes?</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">The perfect soundtrack for every moment of your life.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-heart text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Mood-Based Playlists</h3>
                    <p class="text-gray-600">Curated playlists for every emotion - happy, sad, energetic, relaxed, and more. Find the perfect music for how you feel.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-plus-circle text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Add Your Own Songs</h3>
                    <p class="text-gray-600">Personalize your experience by adding your favorite tracks to any mood category. Build your perfect mood music library.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-sliders-h text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Smart Recommendations</h3>
                    <p class="text-gray-600">Our algorithm learns your preferences and suggests new music that fits your mood and taste perfectly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Moods Section -->
    <section id="moods" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Explore By Mood</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">Select your current mood and let us handle the music.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Happy -->
                <div class="mood-card bg-yellow-100 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all relative">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-laugh-beam text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Happy</h3>
                        <p class="text-gray-600 mb-4">Upbeat tracks to keep the good vibes going</p>
                        <div class="play-icon absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center opacity-0 transition-all shadow-md">
                            <i class="fas fa-play text-yellow-500"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Sad -->
                <div class="mood-card bg-blue-100 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all relative">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-blue-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sad-tear text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Sad</h3>
                        <p class="text-gray-600 mb-4">Comforting songs for when you're feeling down</p>
                        <div class="play-icon absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center opacity-0 transition-all shadow-md">
                            <i class="fas fa-play text-blue-500"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Energetic -->
                <div class="mood-card bg-red-100 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all relative">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-red-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bolt text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Energetic</h3>
                        <p class="text-gray-600 mb-4">High-energy tracks to power your day</p>
                        <div class="play-icon absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center opacity-0 transition-all shadow-md">
                            <i class="fas fa-play text-red-500"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Relaxed -->
                <div class="mood-card bg-green-100 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all relative">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-green-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-spa text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Relaxed</h3>
                        <p class="text-gray-600 mb-4">Calming melodies to unwind and de-stress</p>
                        <div class="play-icon absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center opacity-0 transition-all shadow-md">
                            <i class="fas fa-play text-green-500"></i>
                        </div>
                    </div>
                </div>
                
            
                
                <!-- Romantic -->
                <div class="mood-card bg-pink-100 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all relative">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-pink-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-heart text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Romantic</h3>
                        <p class="text-gray-600 mb-4">Love songs for those special moments</p>
                        <div class="play-icon absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center opacity-0 transition-all shadow-md">
                            <i class="fas fa-play text-pink-500"></i>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">How MoodTunes Works</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">Three simple steps to your perfect mood music.</p>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Step 1 -->
                <div class="text-center mb-10 md:mb-0">
                    <div class="bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h3 class="text-xl font-bold mb-2">Select Your Mood</h3>
                    <p class="text-gray-600 max-w-xs mx-auto">Choose from our mood categories or create your own.</p>
                </div>
                
                <div class="hidden md:block">
                    <i class="fas fa-arrow-right text-2xl text-indigo-300"></i>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center mb-10 md:mb-0">
                    <div class="bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h3 class="text-xl font-bold mb-2">Enjoy Curated Playlists</h3>
                    <p class="text-gray-600 max-w-xs mx-auto">Listen to perfectly matched music for your selected mood.</p>
                </div>
                
                <div class="hidden md:block">
                    <i class="fas fa-arrow-right text-2xl text-indigo-300"></i>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center">
                    <div class="bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h3 class="text-xl font-bold mb-2">Personalize Your Experience</h3>
                    <p class="text-gray-600 max-w-xs mx-auto">Add your favorite songs to any mood and create custom playlists.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">What Our Users Say</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">See how MoodTunes has helped people find the perfect music for every moment.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User avatar" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Priya Sharma</h4>
                            <p class="text-gray-500">Music Lover</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"MoodTunes has completely changed how I listen to music. The happy playlist is my morning routine now!"</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User avatar" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Rahul Patel</h4>
                            <p class="text-gray-500">Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The focus playlists help me study for hours without getting distracted. Game changer!"</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User avatar" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Ananya Gupta</h4>
                            <p class="text-gray-500">Yoga Instructor</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"I use the relaxed playlists for all my yoga classes. My students love the calming atmosphere it creates."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Find Your Perfect Mood Music?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Join thousands of users who are discovering music that perfectly matches their emotions.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="signup.html" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-medium hover:bg-indigo-100 transition text-lg">Sign Up Free</a>
                <a href="#moods" class="bg-transparent border-2 border-white px-8 py-3 rounded-lg font-medium hover:bg-indigo-700 transition text-lg">Explore Moods</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">About personalized Music Streaming System</h3>
                    <p class="text-white-200">
                        Our personalized music streaming platform helps users discover and enjoy music tailored to their preferences. Users can easily create playlists, track their listening habits, and explore new artists and genres. Additionally, the platform provides real-time insights for users to enhance their musical experience.
                    </p>
                </div>
                
                <!-- Developers Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Development Team</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Ashish Raj
                            <a href="https://www.linkedin.com/in/ashish-raj-47a120277/" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Rajnish Kumar
                            <a href="https://www.linkedin.com/in/raman-kumar-379081297" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Shivam Kumar Singh
                            <a href="https://www.linkedin.com/in/riturazz?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Md.Firdous
                            <a href="https://www.linkedin.com/in/md-firdous-alam-22b2ba298?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app
                            " class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                    <address class="text-blue-200 not-italic">
                        <p class="mb-2 hover:font-bold">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <a href="https://www.google.com/maps/place/Lovely+Professional+University,+Phagwara,+Punjab" target="_blank" class="hover:text-white">
                                Lovely Professional University, Phagwara, Punjab
                            </a>
                        </p>
                        <p class="mb-2 hover:font-bold">
                            <i class="fas fa-phone mr-2"></i>
                            <a href="tel:+919835787192" class="hover:text-white">
                                +91 98357-87192
                            </a>
                        </p>
                        <p class="hover:font-bold">
                            <i class="fas fa-envelope mr-2"></i>
                            <a href="mailto:ashishrajstm2003@gmail.com" class="hover:text-white">
                                ashishrajstm2003@gmail.com
                            </a>
                        </p>
                    </address>
                </div>
            </div>
            
            <div class="border-t border-blue-800 mt-8 pt-6 text-center text-blue-300">
                <p>&copy; <?php echo date('Y'); ?> Event Music System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Video Modal -->
    <div id="videoModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-75 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg overflow-hidden w-full max-w-3xl shadow-lg">
            <div class="flex justify-between items-center bg-indigo-600 text-white px-4 py-2">
                <h3 class="text-lg font-semibold">MoodTunes Demo</h3>
                <button onclick="closeVideoModal()" class="text-white text-2xl font-bold">&times;</button>
            </div>
            <div class="w-full">
                <video id="demoVideo" class="w-full" controls>
                    <source src="demo1.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>

    <script>
        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            });
        });

        function openVideoModal() {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('demoVideo');
            modal.classList.remove('hidden');
            video.currentTime = 0;
            video.play();
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('demoVideo');
            video.pause();
            video.currentTime = 0;
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>