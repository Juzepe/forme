<template>
  <AppLayout :title="`Test Memory - ${memoryList.title}`">
    <template #header>
      <Heading>Test Your Memory</Heading>
      <p class="text-muted-foreground mt-1">
        {{ memoryList.title }} - {{ memoryList.items.length }} items
      </p>
    </template>

    <div class="max-w-4xl mx-auto">
      <div v-if="!showTest" class="space-y-6">
        <div class="text-center py-8">
          <h2 class="text-2xl font-semibold mb-4">Study the List</h2>
          <p class="text-muted-foreground mb-6">
            Take your time to memorize the items in the correct order. When you're ready, click "Start Test" to begin.
          </p>
          
          <div class="grid gap-4 md:grid-cols-2 max-w-2xl mx-auto">
            <Card
              v-for="item in memoryList.items"
              :key="item.id"
              class="text-center"
            >
              <CardHeader>
                <div class="flex items-center justify-center gap-3">
                  <div class="flex-shrink-0 w-10 h-10 bg-primary text-primary-foreground rounded-full flex items-center justify-center text-lg font-bold">
                    {{ item.position }}
                  </div>
                  <CardTitle class="text-xl">{{ item.content }}</CardTitle>
                </div>
              </CardHeader>
            </Card>
          </div>
          
          <Button @click="startTest" class="mt-8" size="lg">
            Start Test
          </Button>
        </div>
      </div>

      <div v-else class="space-y-6">
        <div class="text-center py-4">
          <h2 class="text-2xl font-semibold mb-4">Memory Test</h2>
          <p class="text-muted-foreground">
            Enter the items in the correct order. Try to remember exactly what was written!
          </p>
        </div>

        <form @submit.prevent="submitTest" class="space-y-6">
          <div class="grid gap-4 md:grid-cols-2">
            <div
              v-for="(item, index) in memoryList.items"
              :key="index"
              class="space-y-2"
            >
              <Label :for="`item-${index}`">
                Item {{ index + 1 }}
              </Label>
              <Input
                :id="`item-${index}`"
                v-model="answers[index]"
                type="text"
                required
                :placeholder="`Enter item ${index + 1}`"
                class="text-lg"
                autocomplete="off"
              />
            </div>
          </div>

          <div class="flex justify-center gap-4 pt-6">
            <Button type="button" variant="outline" @click="showTest = false">
              Back to Study
            </Button>
            <Button type="submit" :disabled="processing">
              {{ processing ? 'Checking...' : 'Check Answers' }}
            </Button>
          </div>
        </form>
      </div>

      <div class="text-center pt-8">
        <TextLink :href="route('memory-lists.show', memoryList.id)" class="btn-secondary">
          Back to List
        </TextLink>
      </div>
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
import Card from '@/components/ui/card/Card.vue'
import CardHeader from '@/components/ui/card/CardHeader.vue'
import CardTitle from '@/components/ui/card/CardTitle.vue'

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

const props = defineProps<{
  memoryList: MemoryList
}>()

const showTest = ref(false)
const processing = ref(false)
const answers = ref<string[]>([])

const startTest = () => {
  showTest.value = true
  // Initialize answers array with empty strings
  answers.value = new Array(props.memoryList.items.length).fill('')
}

const submitTest = () => {
  processing.value = true
  
  router.post(route('memory-lists.check-test', props.memoryList.id), {
    answers: answers.value
  }, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>
