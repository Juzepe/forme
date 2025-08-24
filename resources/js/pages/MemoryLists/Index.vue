<template>
  <AppLayout title="Memory Lists">
    <template #header>
      <div class="space-y-2">
        <Heading title="Memory Lists" />
        <p class="text-muted-foreground text-lg">
          Create, manage, and test your memory skills with custom lists
        </p>
      </div>
    </template>

    <div class="space-y-8 animate-fade-in">
      <!-- Header Actions -->
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-6 bg-gradient-to-r from-primary/5 to-transparent rounded-xl border border-primary/10">
        <div>
          <h2 class="text-xl font-semibold text-foreground">Your Memory Lists</h2>
          <p class="text-muted-foreground mt-1">
            {{ memoryLists.length }} list{{ memoryLists.length !== 1 ? 's' : '' }} created
          </p>
        </div>
        <TextLink :href="route('memory-lists.create')" class="btn-primary btn-lg">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Create New List
        </TextLink>
      </div>

      <!-- Empty State -->
      <div v-if="memoryLists.length === 0" class="text-center py-16">
        <div class="w-24 h-24 mx-auto mb-6 bg-muted/30 rounded-full flex items-center justify-center">
          <svg class="w-12 h-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-foreground mb-2">No memory lists yet</h3>
        <p class="text-muted-foreground mb-6 max-w-md mx-auto">
          Create your first memory list to start improving your memory skills. You can add items and test yourself on their order.
        </p>
        <TextLink :href="route('memory-lists.create')" class="btn-primary btn-lg">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Create Your First List
        </TextLink>
      </div>

      <!-- Memory Lists Grid -->
      <div v-else class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <Card 
          v-for="list in memoryLists" 
          :key="list.id" 
          class="card-hover card-gradient group relative overflow-hidden"
        >
          <!-- Background Pattern -->
          <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-chart-2/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          
          <CardHeader class="relative">
            <div class="flex items-start justify-between">
              <div class="flex-1 min-w-0">
                <CardTitle class="text-lg font-semibold text-foreground group-hover:text-primary transition-colors duration-200">
                  {{ list.title }}
                </CardTitle>
                <CardDescription v-if="list.description" class="mt-2 line-clamp-2">
                  {{ list.description }}
                </CardDescription>
              </div>
              <div class="flex-shrink-0 ml-3">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-200">
                  <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                  </svg>
                </div>
              </div>
            </div>
          </CardHeader>
          
          <CardContent class="relative">
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
              <span class="font-medium">{{ list.items.length }}</span>
              <span>item{{ list.items.length !== 1 ? 's' : '' }}</span>
            </div>
            
            <!-- Progress Bar (placeholder for future feature) -->
            <div class="mt-4">
              <div class="flex items-center justify-between text-xs text-muted-foreground mb-1">
                <span>Progress</span>
                <span>75%</span>
              </div>
              <div class="w-full bg-muted rounded-full h-2">
                <div class="bg-primary h-2 rounded-full transition-all duration-300" style="width: 75%"></div>
              </div>
            </div>
          </CardContent>
          
          <CardFooter class="relative flex gap-2 pt-4">
            <TextLink 
              :href="route('memory-lists.show', list.id)" 
              class="btn-outline btn-sm flex-1 justify-center"
            >
              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
              View
            </TextLink>
            <TextLink 
              :href="route('memory-lists.edit', list.id)" 
              class="btn-outline btn-sm flex-1 justify-center"
            >
              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
              Edit
            </TextLink>
            <TextLink 
              :href="route('memory-lists.test', list.id)" 
              class="btn-primary btn-sm flex-1 justify-center"
            >
              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
              Test
            </TextLink>
          </CardFooter>
        </Card>
      </div>

      <!-- Quick Tips -->
      <Card class="card-hover card-gradient border-l-4 border-l-chart-3/50">
        <CardHeader>
          <CardTitle class="flex items-center gap-2">
            <div class="w-8 h-8 bg-chart-3/10 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-chart-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
            </div>
            Memory Training Tips
          </CardTitle>
        </CardHeader>
        <CardContent>
          <div class="grid gap-4 md:grid-cols-2">
            <div class="space-y-2">
              <h4 class="font-medium text-foreground">Spaced Repetition</h4>
              <p class="text-sm text-muted-foreground">Review items at increasing intervals for better retention.</p>
            </div>
            <div class="space-y-2">
              <h4 class="font-medium text-foreground">Active Recall</h4>
              <p class="text-sm text-muted-foreground">Test yourself regularly instead of just re-reading.</p>
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
import CardDescription from '@/components/ui/card/CardDescription.vue'
import CardContent from '@/components/ui/card/CardContent.vue'
import CardFooter from '@/components/ui/card/CardFooter.vue'

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
  memoryLists: MemoryList[]
}>()
</script>
