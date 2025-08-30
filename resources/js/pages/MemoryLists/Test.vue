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
          <h2 class="text-2xl font-semibold mb-4">Memory Test</h2>
          <p class="text-muted-foreground">
            Enter the items in the correct order from memory. Try to remember exactly what was written and in what order!
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
  
  router.post(route('memory-lists.check-test', props.memoryList.id), {
    answers: answers.value
  }, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>
