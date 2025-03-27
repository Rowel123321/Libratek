<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref, onMounted, onUnmounted } from 'vue';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const showLogo = ref(false);

let interval: ReturnType<typeof setInterval> | null = null;

onMounted(() => {
    interval = setInterval(() => {
        showLogo.value = !showLogo.value;
    }, 3000); // Switch every 3 seconds
});

onUnmounted(() => {
    if (interval) clearInterval(interval);
});
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Great+Vibes&display=swap" rel="stylesheet">
    </Head>

    <div class="flex min-h-screen">
        
        <div 
            class="hidden lg:flex relative z-10 w-1/2 text-center space-y-6 flex-1 flex flex-col justify-center"
            :style="{
                backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(images/bg-libratek.avif)',
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                backgroundRepeat: 'no-repeat'
            }"
        >
        
        <!-- Slide-Out Text -->
        <transition name="slide" mode="out-in">
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
                <img src="/images/logo1.png" alt="Logo" class="w-56 mx-auto" />
            </div>
        </transition>

        <p class="text-sm lg:text-sm ml-24 mr-24 max-w-xl mx-auto 
            relative transition-all duration-300 ease-in-out 
            hover:opacity-90 hover:shadow-md hover:scale-[1.02] text-white">
            Track, locate, and organize your library with our RFID-based technology — 
            making book handling faster, easier, and secure.
        </p>
    </div>
        
        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8">
            <AuthBase title="Log in to your account" description="Enter your email and password below to log in">
                <Head title="Log in" />

                <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="email"
                                v-model="form.email"
                                placeholder="email@example.com"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center justify-between">
                                <Label for="password">Password</Label>
                                <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm" :tabindex="5">
                                    Forgot password?
                                </TextLink>
                            </div>
                            <Input
                                id="password"
                                type="password"
                                required
                                :tabindex="2"
                                autocomplete="current-password"
                                v-model="form.password"
                                placeholder="Password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between" :tabindex="3">
                            <Label for="remember" class="flex items-center space-x-3">
                                <Checkbox id="remember" v-model:checked="form.remember" :tabindex="4" />
                                <span>Remember me</span>
                            </Label>
                        </div>

                        <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Log in
                        </Button>
                    </div>

                    <div class="text-center text-sm text-muted-foreground">
                        Don't have an account?
                        <TextLink :href="route('register')" :tabindex="5">Sign up</TextLink>
                    </div>
                </form>
            </AuthBase>
        </div>
    </div>
</template>

<style>
.slide-enter-active, .slide-leave-active {
    transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
}
.slide-enter-from {
    transform: translateY(20px);
    opacity: 0;
}
.slide-leave-to {
    transform: translateY(-20px);
    opacity: 0;
}

</style>
