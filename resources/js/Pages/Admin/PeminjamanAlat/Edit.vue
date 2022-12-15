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
  transactions: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  _method: 'put',
  username: props.transactions.user.name,
  username: props.transactions.user.name,
  status: props.transactions.status,
  date_trx: props.transactions.trx_date,
  items: props.transactions.items,
  description: props.transactions.description,
  item_description:[]
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
          :route-name="route('peminjaman-alat.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('peminjaman-alat.update', props.transactions.id))"
      >
        <FormField label="Peminjam" :class="{ 'text-red-400': form.errors.name }">
          <FormControl v-model="form.username" readonly="true" type="text" placeholder="Enter Name" :error="form.errors.name">
            <div class="text-red-400 text-sm" v-if="form.errors.name">
              {{ form.errors.name }}
            </div>
          </FormControl>
        
        </FormField>
        <FormField label="Course" :class="{ 'text-red-400': form.errors.course }">
          <FormControl v-model="form.course_user" readonly="true" type="text" placeholder="Enter course"
            :error="form.errors.course">
            <div class="text-red-400 text-sm" v-if="form.errors.course">
              {{ form.errors.course }}
            </div>
          </FormControl>
        
        </FormField>
        <FormField label="Tanggal" :class="{ 'text-red-400': form.errors.date }">
          <FormControl v-model="form.date_trx" type="date" placeholder="Enter date" :error="form.errors.date">
            <div class="text-red-400 text-sm" v-if="form.errors.date">
              {{ form.errors.date }}
            </div>
          </FormControl>
        
        </FormField>
        <FormField label="Alat" wrap-body>
          <div class="flex items-center mb-4" v-for="(item,index) in form.items">
            aaaa
            <div class="w-full md:w-auto px-3 mb-6 md:mb-0">
              <input id="default-checkbox" type="checkbox" :value="item.id" checked disabled
                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{item.name}} Jumlah ({{item.qty}}) </label>
            </div>
            <div class="w-full md:w-auto px-3 mb-6 md:mb-0">
              <input type="text"
              placeholder="Tambah deskripsi" v-model="item.description"
                class="text-white bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
        
          </div>
        </FormField>
        
        <FormField label="Keperluan" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="text" readonly="true" placeholder="Keperluan" :error="form.errors.description">
            <div class="text-red-400 text-sm" v-if="form.errors.description">
              {{ form.errors.description }}
            </div>
          </FormControl>
        </FormField>
        <template #footer>
          <template v-if="form.status != 'approved'">
          <BaseButtons>
            <BaseButton
             v-if="props.can.edit"
              type="submit"
              color="success"
              label="Approve"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </BaseButtons>
          </template>

        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
