<script setup lang="ts">
import { ref, computed, watchEffect } from 'vue';
import AppLayout from "@/layouts/AppLayout.vue";

interface Log {
    id: number;
    type: 'info' | 'warning' | 'error';
    message: string;
    details: string;
    timestamp: string;
}

const logs = ref<Log[]>([
    {
        id: 1,
        type: 'info',
        message: 'User logged in successfully.',
        details: 'User ID: 1024 | IP: 192.168.1.1',
        timestamp: '2025-03-27 09:30 AM'
    },
    {
        id: 2,
        type: 'warning',
        message: 'Low disk space warning.',
        details: 'Server storage has reached 90% capacity.',
        timestamp: '2025-03-26 11:15 AM'
    },
    {
        id: 3,
        type: 'error',
        message: 'Database connection failure.',
        details: 'Failed to connect to the database server at 10.0.0.5',
        timestamp: '2025-03-25 03:45 PM'
    }
]);

const selectedLog = ref<Log | null>(null);
const searchQuery = ref('');
const theme = ref(localStorage.getItem('theme') || 'light');

const filteredLogs = computed(() =>
    logs.value.filter(log =>
        log.message.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        log.type.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
);

const selectLog = (log: Log) => {
    selectedLog.value = log;
};

watchEffect(() => {
    document.documentElement.setAttribute('data-theme', theme.value);
});
</script>

<template>
    <AppLayout>
    <div class="flex h-screen">
        <!-- Sidebar / Log List -->
        <div class="w-1/3 p-4 border-r border-border-color">
            <h2 class="text-lg font-bold mb-4">System Logs</h2>

            <!-- Search Input 
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search logs..."
                class="w-full p-2 mb-4 border rounded-md"
            />
            -->
            <ul class="space-y-2 max-h-[75vh] overflow-y-auto">
                <li v-for="log in filteredLogs" :key="log.id"
                    class="p-3 rounded-md cursor-pointer border border-transparent"
                    :class="{
                        'bg-highlight border-highlight': log.type === 'info',
                        'bg-warning border-warning': log.type === 'warning',
                        'bg-error border-error': log.type === 'error'
                    }"
                    @click="selectLog(log)">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">{{ log.type.toUpperCase() }}</span>
                        <span class="text-sm">{{ log.timestamp }}</span>
                    </div>
                    <p class="text-sm truncate">{{ log.message }}</p>
                </li>
            </ul>
        </div>

        <!-- Log Details -->
        <div class="w-2/3 p-6">
            <div v-if="selectedLog" class="space-y-4">
                <h1 class="text-2xl font-bold">{{ selectedLog.type.toUpperCase() }}</h1>
                <div class="flex justify-between items-center text-sm">
                    <span>{{ selectedLog.timestamp }}</span>
                </div>
                <hr />
                <p class="font-semibold">{{ selectedLog.message }}</p>
                <p>{{ selectedLog.details }}</p>
            </div>

            <div v-else class="flex items-center justify-center h-full">
                <p>Select a log to view details</p>
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
    --highlight: #dbeafe;
    --warning: #fef9c3;
    --error: #fee2e2;
    --border-color: #e5e7eb;
}

/* Dark Mode */
[data-theme='dark'] {
    --bg-primary: #1f2937;
    --text-primary: #f9fafb;
    --text-secondary: #9ca3af;
    --highlight: #3b82f6;
    --warning: #fbbf24;
    --error: #ef4444;
    --border-color: #4b5563;
}

div {
    background-color: var(--bg-primary);
    color: var(--text-primary);
}
ul::-webkit-scrollbar {
    width: 6px;
}
ul::-webkit-scrollbar-thumb {
    background-color: var(--text-secondary);
    border-radius: 10px;
}
</style>
