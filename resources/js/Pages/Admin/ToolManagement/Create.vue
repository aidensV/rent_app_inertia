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

const form = useForm({
  name: '',
  description : '',
  type: 'other',
  qty: 0,
  location: '',
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Tambah Alat" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Tambah Alat"
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
        @submit.prevent="form.post(route('tool-manage.store'))"
      >
      <FormField>
        <FormControl v-model="form.typeAlat" type="hidden">
        </FormControl>
        </FormField>
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
        <FormField label="Jumlah Alat" :class="{ 'text-red-400': form.errors.qty }">
        
          <FormControl v-model="form.qty" type="text" placeholder="Enter jumlah alat" :error="form.errors.qty">
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
        <FormField label="Deskripsi" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="text" placeholder="Enter Description" :error="form.errors.description">
            <div class="text-red-400 text-sm" v-if="form.errors.description">
              {{ form.errors.description }}
            </div>
          </FormControl>
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
