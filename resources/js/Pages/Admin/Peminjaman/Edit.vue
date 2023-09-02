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
  transaction: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  _method: 'put',
  name: props.transaction.user.name,
  lab_name: props.transaction.item.name,
  description: props.transaction.description,
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Update Selesai Peminjaman" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Update Selesai Peminjaman"
        main
      >
        <BaseButton
          :route-name="route('peminjaman.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('peminjaman.update', props.transaction.id))"
      >
        <FormField
          label="Name"
          :class="{ 'text-red-400': form.errors.name }"
        >
          <FormControl
            v-model="form.name"
            type="text"
            placeholder="Enter Name"
            readonly="true"
            :error="form.errors.name"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.name">
              {{ form.errors.name }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="Laboratorium" :class="{ 'text-red-400': form.errors.name }">
          <FormControl v-model="form.lab_name" type="text" readonly="true" placeholder="Enter lab_name" :error="form.errors.lab_name">
            <div class="text-red-400 text-sm" v-if="form.errors.lab_name">
              {{ form.errors.lab_name }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="Keterangan" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="text" placeholder="Enter Description" :error="form.errors.name">
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
