<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref, onMounted, onUnmounted } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const showLogo = ref(false);

let interval: ReturnType<typeof setInterval>;

onMounted(() => {
    interval = setInterval(() => {
        showLogo.value = !showLogo.value;
    }, 3000); // Toggle every 3 seconds
});

onUnmounted(() => {
    clearInterval(interval);
});
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Great+Vibes&display=swap" rel="stylesheet">
    </Head>
    <div class="flex min-h-screen">
        <!-- Left Side: Image & Text Section -->
        <div 
            class="hidden lg:flex relative z-10 w-1/2 text-center space-y-6 flex-1 flex flex-col justify-center"
            :style="{
                backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(images/bg-libratek.avif)',
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                backgroundRepeat: 'no-repeat'
            }"
        >
            <transition name="slide-out" mode="out-in">
                <div v-if="!showLogo" class="group transition-all duration-500 ease-in-out">
                    <h1 class="text-4xl sm:text-3xl leading-snug relative text-white"
                        style="font-family: 'Days One', sans-serif;">
                        EMPOWERING 
                        <span class="Days One"> 
                            <span style="font-family: 'Great Vibes'; font-size: 1.8em;">L</span>EARNING,
                        </span><br>
                        SECURING KNOWLEDGE
                    </h1>

                    <hr class="w-20 mt-8 border-t-2 border-white mx-auto 
                        transition-all duration-300 ease-in-out 
                        group-hover:w-28 group-hover:opacity-90 group-hover:shadow-md" />
                </div>

                <!-- Slide-In Logo -->
                <div v-else class="transition-all duration-500 ease-in-out">
                    <img src="/images/logo1.png" alt="Logo" class="w-56 mx-auto transform hover:scale-110 transition-all duration-300" />
                </div>
            </transition>

            <p class="text-sm lg:text-sm ml-24 mr-24 text-white max-w-xl mx-auto 
                relative transition-all duration-300 ease-in-out 
                hover:opacity-90 hover:shadow-md hover:scale-[1.02]">
                Join us today! Discover a smarter way to track, locate, and organize your library resources.
            </p>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8">
            <AuthBase title="Create an account" description="Enter your details below to create your account">
                <Head title="Register" />

                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email address</Label>
                            <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                required
                                :tabindex="3"
                                autocomplete="new-password"
                                v-model="form.password"
                                placeholder="Password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                required
                                :tabindex="4"
                                autocomplete="new-password"
                                v-model="form.password_confirmation"
                                placeholder="Confirm password"
                            />
                            <InputError :message="form.errors.password_confirmation" />
                        </div>

                        <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Create account
                        </Button>
                    </div>

                    <div class="text-center text-sm text-muted-foreground">
                        Already have an account?
                        <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Log in</TextLink>
                    </div>
                </form>
            </AuthBase>
        </div>
    </div>
</template>

<style>
.slide-out-enter-active, .slide-out-leave-active {
    transition: all 0.5s ease;
}
.slide-out-enter-from {
    opacity: 0;
    transform: translateY(20px);
}
.slide-out-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}
</style>
