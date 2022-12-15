<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3"
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
  user: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  name: '',
  description : '',
  type:'lab',
  username: props.user.name,
  course_user: props.user.course,
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Pengajuan Clearance" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Pengajuan Clearance"
        main
      >
        <BaseButton
          :route-name="route('form-clearance.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('form-clearance.store'))"
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
          <FormField>
            <FormControl v-model="form.type" type="hidden" >
              
            </FormControl>
          </FormField>
        <FormField label="Deskripsi" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="textarea" placeholder="Enter Form Clearance" :error="form.errors.description">
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
