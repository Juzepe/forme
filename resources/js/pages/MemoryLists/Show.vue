<template>
  <AppLayout :title="memoryList.title">
    <template #header>
      <div class="space-y-4">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
          <div class="space-y-2">
            <Heading :title="memoryList.title" />
            <p v-if="memoryList.description" class="text-muted-foreground text-lg max-w-2xl">
              {{ memoryList.description }}
            </p>
          </div>
          <div class="flex flex-wrap gap-3">
            <TextLink :href="route('memory-lists.edit', memoryList.id)" class="btn-outline">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
              Edit List
            </TextLink>
            <TextLink :href="route('memory-lists.test', memoryList.id)" class="btn-primary btn-lg">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
              Test Memory
            </TextLink>
          </div>
        </div>
        
        <!-- List Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="bg-muted/30 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-foreground">{{ memoryList.items.length }}</div>
            <div class="text-sm text-muted-foreground">Total Items</div>
          </div>
          <div class="bg-muted/30 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-foreground">12</div>
            <div class="text-sm text-muted-foreground">Times Tested</div>
          </div>
          <div class="bg-muted/30 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-foreground">87%</div>
            <div class="text-sm text-muted-foreground">Success Rate</div>
          </div>
          <div class="bg-muted/30 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-foreground">2.5h</div>
            <div class="text-sm text-muted-foreground">Study Time</div>
          </div>
        </div>
      </div>
    </template>

    <div class="max-w-6xl mx-auto space-y-8 animate-fade-in">
      <!-- Navigation -->
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-sm text-muted-foreground">
          <TextLink :href="route('memory-lists.index')" class="hover:text-foreground transition-colors">
            Memory Lists
          </TextLink>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="text-foreground">{{ memoryList.title }}</span>
        </div>
        <TextLink :href="route('memory-lists.index')" class="btn-outline">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Back to Lists
        </TextLink>
      </div>

      <!-- List Items -->
      <div class="space-y-6">
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-semibold text-foreground">List Items ({{ memoryList.items.length }})</h2>
          <div class="flex items-center gap-2 text-sm text-muted-foreground">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Click items to reorder them</span>
          </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
          <Card
            v-for="item in memoryList.items"
            :key="item.id"
            class="card-hover card-gradient group relative overflow-hidden"
          >
            <!-- Position Badge -->
            <div class="absolute top-4 right-4 w-8 h-8 bg-primary text-primary-foreground rounded-full flex items-center justify-center text-sm font-bold shadow-lg">
              {{ item.position }}
            </div>
            
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-chart-2/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <CardHeader class="relative pb-4">
              <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-200">
                  <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                  </svg>
                </div>
                <div class="flex-1 min-w-0">
                  <CardTitle class="text-lg font-semibold text-foreground group-hover:text-primary transition-colors duration-200">
                    {{ item.content }}
                  </CardTitle>
                  <p class="text-sm text-muted-foreground mt-1">
                    Position {{ item.position }} in the sequence
                  </p>
                </div>
              </div>
            </CardHeader>
            
            <CardContent class="relative">
              <div class="flex items-center justify-between text-sm text-muted-foreground">
                <span>Item ID: {{ item.id.slice(-8) }}</span>
                <div class="flex items-center gap-1">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                  </svg>
                  <span>Click to drag</span>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- Call to Action -->
      <Card class="card-hover card-gradient border-l-4 border-l-chart-1/50 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-chart-1/5 to-transparent"></div>
        <CardHeader class="relative">
          <CardTitle class="text-xl flex items-center gap-2">
            <div class="w-8 h-8 bg-chart-1/10 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-chart-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
            </div>
            Ready to test your memory?
          </CardTitle>
        </CardHeader>
        <CardContent class="relative">
          <p class="text-muted-foreground mb-6 text-lg">
            Now that you've reviewed your list, it's time to put your memory to the test! 
            Click the "Test Memory" button above to see how well you remember the order of these items.
          </p>
          <div class="flex flex-wrap gap-3">
            <TextLink :href="route('memory-lists.test', memoryList.id)" class="btn-primary btn-lg">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
              Start Memory Test
            </TextLink>
            <TextLink :href="route('memory-lists.edit', memoryList.id)" class="btn-outline btn-lg">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
              Edit List
            </TextLink>
          </div>
        </CardContent>
      </Card>

      <!-- Study Tips -->
      <Card class="card-hover card-gradient">
        <CardHeader>
          <CardTitle class="flex items-center gap-2">
            <div class="w-8 h-8 bg-chart-3/10 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-chart-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
            </div>
            Study Tips for This List
          </CardTitle>
        </CardHeader>
        <CardContent>
          <div class="grid gap-4 md:grid-cols-2">
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Visual Association</h4>
              <p class="text-sm text-muted-foreground">
                Try to create mental images or stories that connect each item to its position.
              </p>
            </div>
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Chunking</h4>
              <p class="text-sm text-muted-foreground">
                Group related items together to remember them as a single unit.
              </p>
            </div>
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Repetition</h4>
              <p class="text-sm text-muted-foreground">
                Practice recalling the order multiple times with increasing intervals.
              </p>
            </div>
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Active Recall</h4>
              <p class="text-sm text-muted-foreground">
                Test yourself instead of just re-reading the list.
              </p>
            </div>
          </div>
        </CardContent>
      </Card>
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
import CardContent from '@/components/ui/card/CardContent.vue'

interface MemoryListItem {
  id: string
  content: string
  position: number
}

interface MemoryList {
  id: string
  title: string
  description: string | null
  items: MemoryListItem[]
}

defineProps<{
  memoryList: MemoryList
}>()
</script>
