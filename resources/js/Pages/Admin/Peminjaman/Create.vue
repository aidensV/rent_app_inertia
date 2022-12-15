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
    type: [],
    default: () => ({}),
  },
  user: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  name: '',
  description: '',
  course:'',
  items: '',
  start_jam: 24,
  start_menit: 60,
  end_jam: 24,
  end_menit: 60,
  username: props.user.name,
  course_user: props.user.course,
  dosen_name: '',
  dosen_nip: '',
  date_trx:'',
})
</script>

<template>
  <LayoutAuthenticated>

    <Head title="Peminjaman" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountKey" title="Peminjaman" main>
        <BaseButton :route-name="route('peminjaman.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <CardBox form @submit.prevent="form.post(route('peminjaman.store'))">
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
        <FormField label="Laboratorium">
          <select id="default" v-model="form.items"
            class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected>Pilih Laboratorium</option>
            <option v-for="item in items" :key="item.id" :value="item.id">
              {{ item.name }}
            </option>
          </select>
        </FormField>

        <FormField label="Name Praktikum" :class="{ 'text-red-400': form.errors.name }">
          <FormControl v-model="form.name" readonly="false" type="text" placeholder="Enter Name" :error="form.errors.name">
            <div class="text-red-400 text-sm" v-if="form.errors.name">
              {{ form.errors.name }}
            </div>
          </FormControl>

        </FormField>
        <FormField label="Mata Kuliah" :class="{ 'text-red-400': form.errors.course }">
          <FormControl v-model="form.course" type="text" placeholder="Enter Mata Kuliah" :error="form.errors.course">
            <div class="text-red-400 text-sm" v-if="form.errors.course">
              {{ form.errors.course }}
            </div>
          </FormControl>
          

        </FormField>
          <FormField label="Dosen Pengajar" :class="{ 'text-red-400': form.errors.dosen_name }">
            <FormControl v-model="form.dosen_name" type="text" placeholder="Enter Mata Dosen Pengajar" :error="form.errors.dosen_name">
              <div class="text-red-400 text-sm" v-if="form.errors.dosen_name">
                {{ form.errors.dosen_name }}
              </div>
            </FormControl>
          
          
          </FormField>
          <FormField label="NIP Dosen Pengajar" :class="{ 'text-red-400': form.errors.dosen_nip }">
            <FormControl v-model="form.dosen_nip" type="text" placeholder="Enter Mata NIP Dosen Pengajar"
              :error="form.errors.dosen_nip">
              <div class="text-red-400 text-sm" v-if="form.errors.dosen_nip">
                {{ form.errors.dosen_nip }}
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
        
        
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <FormField label="Jam Mulai Pinjam" :class="{ 'text-red-400': form.errors.course }">
            <div class="flex">
              <select name="hours" v-model="form.start_jam"
                class="bg-transparent appearance-none outline-none rounded text-gray-900 text-l focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <template v-for="jam in 24" :key="jam">
                  <option v-if="jam== '24'" :value="'00'">
                    00
                  </option>
                  <option v-else :value="jam">
                    {{jam}}
                  </option>
                </template>
            
              </select>
              <span class="text-xl mr-3 ml-3 mt-1">:</span>
              <select name="minutes" v-model="form.start_menit"
                class=" bg-transparent appearance-none outline-none text-gray-900 text-l rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <template v-for="menit in 60" :key="menit">
                  <option v-if="menit== '60'" :value="'00'">
                    00
                  </option>
                  <option v-else :value="menit">
                    {{menit}}
                  </option>
                </template>
              </select>
            
            </div>
            </FormField>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <FormField label="Jam Pengembalian" :class="{ 'text-red-400': form.errors.course }">
              <div class="flex">
                <select name="hours"  v-model="form.end_jam"
                  class="bg-transparent appearance-none outline-none rounded text-gray-900 text-l focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <template v-for="jam in 24" :key="jam">
                    <option v-if="jam== '24'" :value="'00'" selected>
                      00
                    </option>
                    <option v-else :value="jam">
                      {{jam}}
                    </option>
                  </template>
            
                </select>
                <span class="text-xl mr-3 ml-3 mt-1">:</span>
                <select name="minutes" v-model="form.end_menit"
                  class=" bg-transparent appearance-none outline-none text-gray-900 text-l rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <template v-for="menit in 60" :key="menit">
                    <option v-if="menit== '60'" :value="'00'" selected>
                      00
                    </option>
                    <option v-else :value="menit">
                      {{menit}}
                    </option>
                  </template>
                </select>
            
              </div>
            </FormField>
          </div>
        </div>
        
        <FormField label="Deskripsi" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="text" placeholder="Enter Description"
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
