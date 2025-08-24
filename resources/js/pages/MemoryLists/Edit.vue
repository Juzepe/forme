<template>
  <AppLayout :title="`Edit ${memoryList.title}`">
    <template #header>
      <Heading>Edit Memory List</Heading>
    </template>

    <div class="max-w-2xl mx-auto">
      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <Label for="title">Title</Label>
          <Input
            id="title"
            v-model="form.title"
            type="text"
            required
            placeholder="Enter list title"
          />
          <InputError v-if="errors.title" :message="errors.title" />
        </div>

        <div>
          <Label for="description">Description (Optional)</Label>
          <textarea
            id="description"
            v-model="form.description"
            rows="3"
            class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            placeholder="Enter description"
          />
          <InputError v-if="errors.description" :message="errors.description" />
        </div>

        <div>
          <Label>List Items</Label>
          <div class="space-y-3">
            <div
              v-for="(item, index) in form.items"
              :key="index"
              class="flex gap-2 items-start"
            >
              <div class="flex-1">
                <Input
                  v-model="item.content"
                  type="text"
                  required
                  :placeholder="`Item ${index + 1}`"
                />
              </div>
              <Button
                v-if="form.items.length > 1"
                type="button"
                variant="outline"
                size="sm"
                @click="removeItem(index)"
              >
                Remove
              </Button>
            </div>
          </div>
          <InputError v-if="errors.items" :message="errors.items" />
          
          <Button
            type="button"
            variant="outline"
            size="sm"
            class="mt-3"
            @click="addItem"
          >
            Add Item
          </Button>
        </div>

        <div class="flex gap-3">
          <TextLink :href="route('memory-lists.show', memoryList.id)" class="btn-secondary">
            Cancel
          </TextLink>
          <Button type="submit" :disabled="processing">
            {{ processing ? 'Updating...' : 'Update List' }}
          </Button>
        </div>
      </form>
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
import InputError from '@/components/InputError.vue'

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

interface Errors {
  title?: string
  description?: string
  items?: string
}

const props = defineProps<{
  memoryList: MemoryList
  errors?: Errors
}>()

const processing = ref(false)

const form = ref({
  title: '',
  description: '',
  items: [{ content: '' }]
})

onMounted(() => {
  form.value.title = props.memoryList.title
  form.value.description = props.memoryList.description || ''
  form.value.items = props.memoryList.items.map(item => ({ content: item.content }))
})

const addItem = () => {
  form.value.items.push({ content: '' })
}

const removeItem = (index: number) => {
  form.value.items.splice(index, 1)
}

const submit = () => {
  processing.value = true
  
  router.put(route('memory-lists.update', props.memoryList.id), form.value, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>
