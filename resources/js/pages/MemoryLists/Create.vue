<template>
  <AppLayout title="Create Memory List">
    <template #header>
      <div class="space-y-2">
        <Heading title="Create Memory List" />
        <p class="text-muted-foreground text-lg">
          Build a new list to test and improve your memory skills
        </p>
      </div>
    </template>

    <div class="max-w-4xl mx-auto space-y-8 animate-fade-in">
      <!-- Form Section -->
      <Card class="card-hover card-gradient">
        <CardHeader>
          <CardTitle class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
            </div>
            List Information
          </CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid gap-6 md:grid-cols-2">
              <div class="space-y-2">
                <Label for="title" class="text-sm font-medium">Title</Label>
                <Input
                  id="title"
                  v-model="form.title"
                  type="text"
                  required
                  placeholder="Enter list title"
                  class="w-full"
                />
                <InputError v-if="errors.title" :message="errors.title" />
              </div>

              <div class="space-y-2">
                <Label for="description" class="text-sm font-medium">Description (Optional)</Label>
                <textarea
                  id="description"
                  v-model="form.description"
                  rows="3"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 resize-none"
                  placeholder="Describe what this list is for..."
                />
                <InputError v-if="errors.description" :message="errors.description" />
              </div>
            </div>

            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <Label class="text-sm font-medium">List Items</Label>
                <div class="flex items-center gap-2 text-sm text-muted-foreground">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>Order matters for memory testing</span>
                </div>
              </div>
              
              <div class="space-y-3">
                <div
                  v-for="(item, index) in form.items"
                  :key="index"
                  class="flex gap-3 items-start p-4 bg-muted/30 rounded-lg border border-muted/50 hover:border-primary/20 transition-colors duration-200"
                >
                  <div class="flex-shrink-0 w-8 h-8 bg-primary text-primary-foreground rounded-full flex items-center justify-center text-sm font-bold">
                    {{ index + 1 }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <Input
                      v-model="item.content"
                      type="text"
                      required
                      :placeholder="`Item ${index + 1}`"
                      class="w-full"
                    />
                  </div>
                  <Button
                    v-if="form.items.length > 1"
                    type="button"
                    variant="outline"
                    size="sm"
                    @click="removeItem(index)"
                    class="text-destructive hover:text-destructive hover:bg-destructive/10"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                  </Button>
                </div>
              </div>
              
              <InputError v-if="errors.items" :message="errors.items" />
              
              <Button
                type="button"
                variant="outline"
                size="sm"
                @click="addItem"
                class="w-full sm:w-auto"
              >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Another Item
              </Button>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-border">
              <TextLink :href="route('memory-lists.index')" class="btn-outline btn-lg flex-1 sm:flex-none justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Cancel
              </TextLink>
              <Button 
                type="submit" 
                :disabled="processing"
                class="btn-primary btn-lg flex-1 sm:flex-none"
              >
                <svg v-if="!processing" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <svg v-else class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                {{ processing ? 'Creating...' : 'Create Memory List' }}
              </Button>
            </div>
          </form>
        </CardContent>
      </Card>

      <!-- Tips Section -->
      <Card class="card-hover card-gradient border-l-4 border-l-chart-2/50">
        <CardHeader>
          <CardTitle class="flex items-center gap-2">
            <div class="w-8 h-8 bg-chart-2/10 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-chart-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
            </div>
            Creating Effective Memory Lists
          </CardTitle>
        </CardHeader>
        <CardContent>
          <div class="grid gap-4 md:grid-cols-2">
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Keep it Manageable</h4>
              <p class="text-sm text-muted-foreground">
                Start with 5-10 items for easier memorization. You can always add more later.
              </p>
            </div>
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Use Clear Language</h4>
              <p class="text-sm text-muted-foreground">
                Write items in simple, memorable terms that are easy to recall.
              </p>
            </div>
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Logical Grouping</h4>
              <p class="text-sm text-muted-foreground">
                Group related items together to create natural associations.
              </p>
            </div>
            <div class="space-y-3">
              <h4 class="font-medium text-foreground">Practice Regularly</h4>
              <p class="text-sm text-muted-foreground">
                Test yourself frequently to strengthen memory retention over time.
              </p>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import Heading from '@/components/Heading.vue'
import TextLink from '@/components/TextLink.vue'
import Button from '@/components/ui/button/Button.vue'
import Input from '@/components/ui/input/Input.vue'
import Label from '@/components/ui/label/Label.vue'
import InputError from '@/components/InputError.vue'
import Card from '@/components/ui/card/Card.vue'
import CardHeader from '@/components/ui/card/CardHeader.vue'
import CardTitle from '@/components/ui/card/CardTitle.vue'
import CardContent from '@/components/ui/card/CardContent.vue'

interface Errors {
  title?: string
  description?: string
  items?: string
}

defineProps<{
  errors?: Errors
}>()

const processing = ref(false)

const form = ref({
  title: '',
  description: '',
  items: [{ content: '' }]
})

const addItem = () => {
  form.value.items.push({ content: '' })
}

const removeItem = (index: number) => {
  form.value.items.splice(index, 1)
}

const submit = () => {
  processing.value = true
  
  router.post(route('memory-lists.store'), form.value, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>
