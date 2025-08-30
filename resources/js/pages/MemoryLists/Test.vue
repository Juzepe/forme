<template>
  <AppLayout :title="`Memory Test - ${memoryList.title}`">
    <template #header>
      <Heading title="Memory Test" />
      <p class="text-muted-foreground mt-1">
        {{ memoryList.title }} - {{ memoryList.items.length }} items
      </p>
    </template>

    <div class="max-w-4xl mx-auto">
      <div class="space-y-6">
        <div class="text-center py-4">
          <h2 class="text-2xl font-semibold text-primary mb-4">{{ memoryList.title }}</h2>
          <p class="text-muted-foreground">
            Enter the items in the correct order from memory. You can leave fields blank if you're unsure - just submit what you remember!
          </p>
          <p class="text-sm text-muted-foreground mt-2">
            Tip: Empty fields will be marked as incorrect, but you can still submit your test.
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
                :placeholder="`Enter item ${index + 1}`"
                class="text-lg"
                autocomplete="off"
              />
            </div>
          </div>

          <div class="flex justify-center gap-4 pt-6">
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
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import Heading from '@/components/Heading.vue'
import TextLink from '@/components/TextLink.vue'
import Button from '@/components/ui/button/Button.vue'
import Input from '@/components/ui/input/Input.vue'
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

const props = defineProps<{
  memoryList: MemoryList
}>()

const processing = ref(false)
const answers = ref<string[]>([])

onMounted(() => {
  // Initialize answers array with empty strings
  answers.value = new Array(props.memoryList.items.length).fill('')
})

const submitTest = () => {
  processing.value = true
  
  // Ensure all answers are strings, converting undefined/null to empty strings
  const processedAnswers = answers.value.map(answer => answer || '')
  
  router.post(route('memory-lists.check-test', props.memoryList.id), {
    answers: processedAnswers
  }, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>
