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
  items: {
    type: Object,
    default: () => ({}),
  },
  user: {
    type: Object,
    default: () => ({}),
  },
  qty: {
    type: Array,
    default: () => ({}),
  },
})


const form = useForm({
  name: '',
  description: '',
  course:'',
  items: [],
  username: props.user.name,
  course_user: props.user.course,
  qty: [],
  date_trx:''
})


 
</script>

<script>
</script>

<template>
  <LayoutAuthenticated>

    <Head title="Peminjaman Alat" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountKey" title="Peminjaman Alat" main>
        <BaseButton :route-name="route('peminjaman.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <CardBox form @submit.prevent="form.post(route('peminjaman-alat.store'))">
          <FormField label="Peminjam" :class="{ 'text-red-400': form.errors.name }">
            <FormControl v-model="form.username" readonly="true" type="text" placeholder="Enter Name" :error="form.errors.name">
              <div class="text-red-400 text-sm" v-if="form.errors.name">
                {{ form.errors.name }}
              </div>
            </FormControl>
          
          </FormField>
            <FormField label="Course" :class="{ 'text-red-400': form.errors.course }">
              <FormControl v-model="form.course_user" readonly="true" type="text" placeholder="Enter course" :error="form.errors.course">
                <div class="text-red-400 text-sm" v-if="form.errors.course">
                  {{ form.errors.course }}
                </div>
              </FormControl>
            
            </FormField>
              <FormField label="Tanggal" :class="{ 'text-red-400': form.errors.date }">
                <FormControl v-model="form.date_trx" type="date" placeholder="Enter date"
                  :error="form.errors.date">
                  <div class="text-red-400 text-sm" v-if="form.errors.date">
                    {{ form.errors.date }}
                  </div>
                </FormControl>
              
              </FormField>
            <FormField label="Alat" wrap-body>
              <div class="flex items-center mb-4" v-for="(item,index) in props.items">
                  <div class="w-full md:w-auto px-3 mb-6 md:mb-0">
                <input id="default-checkbox" type="checkbox" :value="item.id" v-model="form.items"
                  class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{item.name}} -> Jumlah Tersedia ({{item.qty}})</label>
                </div>
                <div class="w-full md:w-auto px-3 mb-6 md:mb-0">
                <input type="text" placeholder="Jumlah"  v-model="form.qty[index]"
                  class="text-white bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                  </div>

              </div>
            </FormField>

        <FormField label="Keperluan" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="text" placeholder="Keperluan"
            :error="form.errors.description">
            <div class="text-red-400 text-sm" v-if="form.errors.description">
              {{ form.errors.description }}
            </div>
          </FormControl>
        </FormField>
        <template #footer>
          <BaseButtons>
            <BaseButton type="submit" color="info" label="Submit" :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing" />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
