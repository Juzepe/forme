<template>
  <AppLayout>
    <template #header>
      <div class="space-y-2">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary to-primary/70 bg-clip-text text-transparent">
          Welcome back! 👋
        </h1>
        <p class="text-muted-foreground text-lg">
          Here's what's happening with your memory training
        </p>
      </div>
    </template>

    <div class="space-y-8 animate-fade-in">
      <!-- Stats Overview -->
      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <Card class="card-hover card-gradient border-l-4 border-l-primary/50">
          <CardHeader class="pb-3">
            <div class="flex items-center justify-between">
              <CardTitle class="text-sm font-medium text-muted-foreground">Total Lists</CardTitle>
              <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
              </div>
            </div>
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold text-foreground">12</div>
            <p class="text-xs text-muted-foreground mt-1">+2 from last week</p>
          </CardContent>
        </Card>

        <Card class="card-hover card-gradient border-l-4 border-l-chart-2/50">
          <CardHeader class="pb-3">
            <div class="flex items-center justify-between">
              <CardTitle class="text-sm font-medium text-muted-foreground">Items Memorized</CardTitle>
              <div class="w-8 h-8 bg-chart-2/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-chart-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
              </div>
            </div>
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold text-foreground">156</div>
            <p class="text-xs text-muted-foreground mt-1">+23 from last week</p>
          </CardContent>
        </Card>

        <Card class="card-hover card-gradient border-l-4 border-l-chart-3/50">
          <CardHeader class="pb-3">
            <div class="flex items-center justify-between">
              <CardTitle class="text-sm font-medium text-muted-foreground">Success Rate</CardTitle>
              <div class="w-8 h-8 bg-chart-3/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-chart-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
              </div>
            </div>
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold text-foreground">87%</div>
            <p class="text-xs text-muted-foreground mt-1">+5% from last week</p>
          </CardContent>
        </Card>

        <Card class="card-hover card-gradient border-l-4 border-l-chart-4/50">
          <CardHeader class="pb-3">
            <div class="flex items-center justify-between">
              <CardTitle class="text-sm font-medium text-muted-foreground">Study Time</CardTitle>
              <div class="w-8 h-8 bg-chart-4/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-chart-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold text-foreground">2.5h</div>
            <p class="text-xs text-muted-foreground mt-1">+0.5h from last week</p>
          </CardContent>
        </Card>
      </div>

      <!-- Welcome Section -->
      <Card class="card-hover card-gradient overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent"></div>
        <CardHeader class="relative">
          <CardTitle class="text-2xl">Ready to boost your memory? 🧠</CardTitle>
          <CardDescription class="text-lg">
            Your personal dashboard is here to help you track progress and improve your memory skills.
          </CardDescription>
        </CardHeader>
        <CardContent class="relative">
          <p class="text-muted-foreground mb-6">
            You're successfully logged in! Use the sidebar navigation to explore different sections and start building your memory lists.
          </p>
          <div class="flex flex-wrap gap-3">
            <TextLink :href="route('memory-lists.index')" class="btn-primary btn-lg">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              View Memory Lists
            </TextLink>
            <TextLink :href="route('memory-lists.create')" class="btn-secondary btn-lg">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Create New List
            </TextLink>
          </div>
        </CardContent>
      </Card>

      <!-- Quick Actions -->
      <div class="grid gap-6 md:grid-cols-2">
        <Card class="card-hover card-gradient">
          <CardHeader>
            <CardTitle class="flex items-center gap-2">
              <div class="w-8 h-8 bg-chart-1/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-chart-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
              </div>
              Recent Activity
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div class="space-y-3">
              <div class="flex items-center gap-3 p-3 bg-muted/30 rounded-lg">
                <div class="w-2 h-2 bg-chart-1 rounded-full"></div>
                <div class="flex-1">
                  <p class="text-sm font-medium">Created "Shopping List"</p>
                  <p class="text-xs text-muted-foreground">2 hours ago</p>
                </div>
              </div>
              <div class="flex items-center gap-3 p-3 bg-muted/30 rounded-lg">
                <div class="w-2 h-2 bg-chart-2 rounded-full"></div>
                <div class="flex-1">
                  <p class="text-sm font-medium">Completed "Vocabulary Test"</p>
                  <p class="text-xs text-muted-foreground">Yesterday</p>
                </div>
              </div>
              <div class="flex items-center gap-3 p-3 bg-muted/30 rounded-lg">
                <div class="w-2 h-2 bg-chart-3 rounded-full"></div>
                <div class="flex-1">
                  <p class="text-sm font-medium">Updated "Work Tasks"</p>
                  <p class="text-xs text-muted-foreground">3 days ago</p>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        <Card class="card-hover card-gradient">
          <CardHeader>
            <CardTitle class="flex items-center gap-2">
              <div class="w-8 h-8 bg-chart-4/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-chart-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              Quick Start
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div class="space-y-3">
              <TextLink :href="route('memory-lists.create')" class="btn-outline w-full justify-start">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create your first list
              </TextLink>
              <TextLink :href="route('memory-lists.index')" class="btn-outline w-full justify-start">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Browse existing lists
              </TextLink>
              <TextLink :href="route('settings.appearance')" class="btn-outline w-full justify-start">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                </svg>
                Customize appearance
              </TextLink>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import Heading from '@/components/Heading.vue'
import TextLink from '@/components/TextLink.vue'
import Card from '@/components/ui/card/Card.vue'
import CardHeader from '@/components/ui/card/CardHeader.vue'
import CardTitle from '@/components/ui/card/CardTitle.vue'
import CardDescription from '@/components/ui/card/CardDescription.vue'
import CardContent from '@/components/ui/card/CardContent.vue'
</script>
