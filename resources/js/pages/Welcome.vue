<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome to Your Personal Space">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
        <!-- Navigation -->
        <nav class="flex items-center justify-between p-6">
            <div class="text-2xl font-bold text-slate-800 dark:text-slate-200">
                For Me
            </div>
            <div class="flex items-center gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-slate-700 dark:bg-slate-200 dark:text-slate-800 dark:hover:bg-slate-300"
                >
                    Go to Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-slate-700 dark:bg-slate-200 dark:text-slate-800 dark:hover:bg-slate-300"
                    >
                        Sign In
                    </Link>
                </template>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="mx-auto max-w-7xl px-6 py-20 text-center">
            <div class="mb-8">
                <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-600 text-4xl text-white shadow-lg">
                    🏠
                </div>
                <h1 class="mb-4 text-5xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-6xl">
                    Your Personal
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Digital Space
                    </span>
                </h1>
                <p class="mx-auto max-w-2xl text-xl text-slate-600 dark:text-slate-300">
                    A private corner of the internet where you can organize your thoughts, manage your projects, and keep everything that matters to you.
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="mx-auto mb-12 grid max-w-4xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="group rounded-xl bg-white/70 p-6 backdrop-blur-sm transition-all duration-300 hover:bg-white/90 hover:shadow-lg dark:bg-slate-800/70 dark:hover:bg-slate-800/90">
                    <div class="mb-4 text-3xl">📝</div>
                    <h3 class="mb-2 text-lg font-semibold text-slate-900 dark:text-white">Personal Notes</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Keep your thoughts organized and easily accessible whenever you need them.</p>
                </div>
                
                <div class="group rounded-xl bg-white/70 p-6 backdrop-blur-sm transition-all duration-300 hover:bg-white/90 hover:shadow-lg dark:bg-slate-800/70 dark:hover:bg-slate-800/90">
                    <div class="mb-4 text-3xl">🎯</div>
                    <h3 class="mb-2 text-lg font-semibold text-slate-900 dark:text-white">Goal Tracking</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Set personal goals and track your progress in a way that works for you.</p>
                </div>
                
                <div class="group rounded-xl bg-white/70 p-6 backdrop-blur-sm transition-all duration-300 hover:bg-white/90 hover:shadow-lg dark:bg-slate-800/70 dark:hover:bg-slate-800/90">
                    <div class="mb-4 text-3xl">🔒</div>
                    <h3 class="mb-2 text-lg font-semibold text-slate-900 dark:text-white">Private & Secure</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Your personal space is protected and accessible only to you.</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                <!-- Buttons removed -->
            </div>

            <!-- Personal Touch -->
            <div class="mt-16 rounded-2xl bg-white/50 p-8 backdrop-blur-sm dark:bg-slate-800/50">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="mb-4 text-2xl font-semibold text-slate-900 dark:text-white">
                        Why "For Me"?
                    </h2>
                    <p class="text-lg text-slate-600 dark:text-slate-300">
                        Because sometimes the best productivity tool is one that's designed specifically for you, not for everyone else. 
                        This is your personal digital workspace, built to adapt to your workflow, not force you to adapt to it.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-20 border-t border-slate-200/50 py-8 dark:border-slate-700/50">
            <div class="mx-auto max-w-7xl px-6 text-center text-sm text-slate-500 dark:text-slate-400">
                <p>Your personal space, your rules, your way.</p>
            </div>
        </footer>
    </div>
</template>
