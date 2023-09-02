<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3"
import {
  mdiEmail,
  mdiArrowLeftBoldOutline,
  mdiAlertBoxOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import NotificationBar from "@/Components/NotificationBar.vue"

const props = defineProps({
  user: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  name: '',
  description : '',
  username: props.user.name,
  course_user: props.user.course,
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Kritik & Saran" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiEmail"
        title="Kritik & Saran"
        main
      >
       
      </SectionTitleLineWithButton>
         <NotificationBar
          v-if="$page.props.flash.message"
          color="success"
          :icon="mdiAlertBoxOutline"
        >
          {{ $page.props.flash.message }}
        </NotificationBar>
      <CardBox
        form
        @submit.prevent="form.post(route('kritik.store'))"
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

              <FormField label="Kritik & Saran" >
            <FormControl v-model="form.description" type="text" placeholder="Masukan Kritik & Saran">
             
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
