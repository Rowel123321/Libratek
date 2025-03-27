<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Great+Vibes&display=swap" rel="stylesheet">
    </Head>
    <div class="relative flex min-h-screen flex-col p-6 text-white lg:justify-center lg:p-8">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black  z-0"></div>
        <!-- Content Section -->
        <div 
        class="relative z-10 w-full text-center space-y-6 flex-1 flex flex-col justify-center"
            :style="{
                backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(images/bg-libratek.avif)',
                backgroundSize: '100%',
                backgroundPosition: 'bottom',
                backgroundRepeat: 'no-repeat'
            }"
        >
        <div class="group transition-all duration-300 ease-in-out hover:opacity-90 hover:shadow-lg hover:scale-[1.02]">
            <h1 class="text-4xl sm:text-5xl leading-snug relative"
                style="font-family: 'Days One', sans-serif;">
                EMPOWERING 
                <span class="Days One"> 
                    <span style="font-family: 'Great Vibes'; font-size: 1.8em;">L</span>EARNING,
                </span><br>
                SECURING KNOWLEDGE
            </h1>

            <hr class="w-20 mt-8 border-t-2 border-white mx-auto transition-all duration-300 ease-in-out 
                group-hover:w-28 group-hover:opacity-90 group-hover:shadow-md" />
        </div>


            <p class="text-lg lg:text-xl max-w-xl mx-auto relative transition-all duration-300 ease-in-out hover:opacity-90 hover:shadow-md hover:scale-[1.02]">
                Track, locate, and organize your library with the RFID-based technology — 
                making book handling faster, easier, and secure.
            </p>
        </div>
       <!-- Header with Logo and Navigation -->
        <header class="absolute top-0 left-0 w-full flex items-center justify-between p-4 z-10 bg-black">
            <div class="flex items-center gap-2 -mb-12">
                <img src="images/logo1.png" alt="Libratek Logo" class="h-12 w-32 -mt-8">
            </div>
            <nav class="flex gap-4 mr-4">
                <Link 
                    :href="route('register')" 
                    class="text-white text-sm hover:underline"
                >Sign up</Link>
                <Link 
                    :href="route('login')" 
                    class="text-white text-sm hover:underline"
                >Login</Link>
            </nav>
        </header>
      

        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>
