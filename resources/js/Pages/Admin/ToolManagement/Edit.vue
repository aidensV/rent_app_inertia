<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const props = defineProps({
  tools: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  _method: 'put',
  name: props.tools.name,
  description: props.tools.description,
  status: props.tools.status,
  qty: props.tools.qty,
  location: props.tools.location,
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Update Data" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Update Data"
        main
      >
        <BaseButton
          :route-name="route('tool-manage.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('tool-manage.update', props.tools.id))"
      >
        <FormField
          label="Name"
          :class="{ 'text-red-400': form.errors.name }"
        >
          <FormControl
            v-model="form.name"
            type="text"
            placeholder="Enter Name"
            :error="form.errors.name"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.name">
              {{ form.errors.name }}
            </div>
          </FormControl>
        </FormField>
          <FormField label="Jumlah ALat" :class="{ 'text-red-400': form.errors.qty }">
            <FormControl v-model="form.qty" type="text" placeholder="Enter Jumlah Alat" :error="form.errors.qty">
              <div class="text-red-400 text-sm" v-if="form.errors.qty">
                {{ form.errors.qty }}
              </div>
            </FormControl>
          </FormField>
            <FormField label="Lokasi" :class="{ 'text-red-400': form.errors.location }">
              <FormControl v-model="form.location" type="text" placeholder="Enter Lokasi" :error="form.errors.location">
                <div class="text-red-400 text-sm" v-if="form.errors.location">
                  {{ form.errors.location }}
                </div>
              </FormControl>
            </FormField>

        <FormField label="Description" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="text" placeholder="Enter Description" :error="form.errors.name">
            <div class="text-red-400 text-sm" v-if="form.errors.description">
              {{ form.errors.description }}
            </div>
          </FormControl>
        </FormField>
          <FormField label="Status">
            <select id="countries" v-model="form.status"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="available">Tersedia</option>
              <option value="unavailable">Tidak Tersedia</option>
            </select>
          </FormField>
        
        <template #footer>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="info"
              label="Submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
