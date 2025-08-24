<template>
  <AppLayout :title="`Test Results - ${memoryList.title}`">
    <template #header>
      <Heading>Test Results</Heading>
      <p class="text-muted-foreground mt-1">
        {{ memoryList.title }} - Memory Test
      </p>
    </template>

    <div class="max-w-4xl mx-auto">
      <div class="space-y-6">
        <!-- Score Summary -->
        <Card class="text-center">
          <CardHeader>
            <CardTitle class="text-3xl">Your Score</CardTitle>
          </CardHeader>
          <CardContent>
            <div class="text-6xl font-bold text-primary mb-4">{{ score }}%</div>
            <p class="text-xl text-muted-foreground">
              You got {{ correct }} out of {{ total }} items correct
            </p>
            
            <div class="mt-6">
              <div class="w-full bg-gray-200 rounded-full h-4">
                <div
                  class="bg-primary h-4 rounded-full transition-all duration-500"
                  :style="{ width: `${score}%` }"
                ></div>
              </div>
            </div>
          </CardContent>
        </Card>

        <!-- Detailed Results -->
        <div>
          <HeadingSmall>Detailed Results</HeadingSmall>
          <div class="grid gap-4 md:grid-cols-2">
            <Card
              v-for="(result, index) in results"
              :key="index"
              :class="result.is_correct ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'"
            >
              <CardHeader>
                <div class="flex items-center gap-3">
                  <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium"
                       :class="result.is_correct ? 'bg-green-500 text-white' : 'bg-red-500 text-white'">
                    {{ result.position }}
                  </div>
                  <CardTitle class="text-lg">
                    {{ result.is_correct ? 'Correct' : 'Incorrect' }}
                  </CardTitle>
                </div>
              </CardHeader>
              <CardContent class="space-y-3">
                <div>
                  <Label class="text-sm font-medium text-muted-foreground">Expected:</Label>
                  <p class="font-medium">{{ result.expected }}</p>
                </div>
                <div v-if="!result.is_correct">
                  <Label class="text-sm font-medium text-muted-foreground">Your Answer:</Label>
                  <p class="font-medium">{{ result.user_answer || '(No answer)' }}</p>
                </div>
              </CardContent>
            </Card>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4 pt-6">
          <TextLink :href="route('memory-lists.test', memoryList.id)" class="btn-primary">
            Try Again
          </TextLink>
          <TextLink :href="route('memory-lists.show', memoryList.id)" class="btn-secondary">
            Back to List
          </TextLink>
          <TextLink :href="route('memory-lists.index')" class="btn-secondary">
            All Lists
          </TextLink>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import Heading from '@/components/Heading.vue'
import HeadingSmall from '@/components/HeadingSmall.vue'
import TextLink from '@/components/TextLink.vue'
import Card from '@/components/ui/card/Card.vue'
import CardHeader from '@/components/ui/card/CardHeader.vue'
import CardTitle from '@/components/ui/card/CardTitle.vue'
import CardContent from '@/components/ui/card/CardContent.vue'
import Label from '@/components/ui/label/Label.vue'

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

interface TestResult {
  position: number
  expected: string
  user_answer: string
  is_correct: boolean
}

defineProps<{
  memoryList: MemoryList
  results: TestResult[]
  score: number
  correct: number
  total: number
}>()
</script>
