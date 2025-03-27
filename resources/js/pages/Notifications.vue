<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, computed, watchEffect } from 'vue';

interface Message {
    id: number;
    sender: string;
    subject: string;
    content: string;
    timestamp: string;
    unread: boolean;
}

const messages = ref<Message[]>([
    { id: 1, sender: '@Book Shelf 1', subject: 'Pagong at ang Saging has been removed', content: 'This book has been removed an hour ago.', timestamp: '2025-03-27 10:45 AM', unread: true },
    { id: 2, sender: '@Book Shelf 2', subject: 'The Little Mermaid', content: 'This book has been removed 30 minutes ago.', timestamp: '2025-03-26 2:15 PM', unread: false },
    { id: 3, sender: '@Book Shelf 3', subject: 'Code Geass Manga', content: 'This book has been removed a second ago', timestamp: '2025-03-25 8:30 AM', unread: false }
]);

const selectedMessage = ref<Message | null>(null);
const theme = ref(localStorage.getItem('theme') || 'light');

const selectMessage = (message: Message) => {
    selectedMessage.value = message;
    message.unread = false;
};

// Auto-switch theme
watchEffect(() => {
    document.documentElement.setAttribute('data-theme', theme.value);
});
</script>

<template>
    <AppLayout>
        <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="w-1/4 p-4 border-r border-border-color">
                <h2 class="text-lg font-bold mb-4">Notifications</h2>
                <ul class="space-y-2">
                    <li v-for="message in messages" :key="message.id"
                        class="p-3 rounded-md cursor-pointer border border-transparent hover:bg-hover-bg"
                        :class="{ 'bg-highlight border-highlight': message.unread }"
                        @click="selectMessage(message)">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">{{ message.sender }}</span>
                            <span class="text-sm text-text-muted">{{ message.timestamp }}</span>
                        </div>
                        <p class="text-sm text-text-secondary truncate">{{ message.subject }}</p>
                    </li>
                </ul>
            </div>

            <!-- Message Details -->
            <div class="w-3/4 p-6">
                <div v-if="selectedMessage" class="space-y-4">
                    <h1 class="text-2xl font-bold">{{ selectedMessage.subject }}</h1>
                    <div class="flex justify-between items-center text-sm text-text-muted">
                        <span>From: {{ selectedMessage.sender }}</span>
                        <span>{{ selectedMessage.timestamp }}</span>
                    </div>
                    <hr />
                    <p class="text-text-primary">{{ selectedMessage.content }}</p>
                </div>

                <div v-else class="flex items-center justify-center h-full text-text-muted">
                    <p>Select a message to read</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Light Mode */
:root {
    --bg-primary: #ffffff;
    --text-primary: #111827;
    --text-secondary: #374151;
    --text-muted: #6b7280;
    --highlight: #dbeafe;
    --border-color: #e5e7eb;
    --hover-bg: #f3f4f6;
}

/* Dark Mode */
[data-theme='dark'] {
    --bg-primary: #1f2937;
    --text-primary: #f9fafb;
    --text-secondary: #9ca3af;
    --text-muted: #6b7280;
    --highlight: #3b82f6;
    --border-color: #4b5563;
    --hover-bg: #374151;
}

div {
    background-color: var(--bg-primary);
    color: var(--text-primary);
}
ul::-webkit-scrollbar {
    width: 6px;
}
ul::-webkit-scrollbar-thumb {
    background-color: var(--text-muted);
    border-radius: 10px;
}
</style>
