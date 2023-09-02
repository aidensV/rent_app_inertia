<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3"
import {
  mdiEmail,
  mdiArrowLeftBoldOutline,
  mdiPhone
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseIcon from '@/Components/BaseIcon.vue'
const props = defineProps({
  user: {
    type: Object,
    default: () => ({}),
  },
})
console.log(mdiEmail);
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Kontak" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiEmail"
        title="Kontak"
        main
      >
      
      </SectionTitleLineWithButton>
      <div class="flex flex-row">
        <div class="basis-1/2">
     
  <a  class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
      <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="https://www.labssim-eform.my.id/avatar-1577909_1280.png" alt="">
      <div class="flex flex-col justify-between p-4 leading-normal">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mr john doe</h5>
          <div class="grid grid-cols-2 gap-2"></div>
          
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><BaseIcon
          :path="mdiPhone"
        />+6212345678</p>
      </div>
  </a>
  </div>
     <div class="basis-1/2">
     
    <a  class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="https://www.labssim-eform.my.id/avatar-1577909_1280.png" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mr john doe</h5>
            <div class="grid grid-cols-2 gap-2"></div>
          
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><BaseIcon
            :path="mdiPhone"
          />+6212345678</p>
        </div>
    </a>
    </div>
   </div>
      <div class="flex flex-row mt-2">
          <div class="basis-1/2">
     
    <a  class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="https://www.labssim-eform.my.id/avatar-1577909_1280.png" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mr john doe</h5>
            <div class="grid grid-cols-2 gap-2"></div>
          
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><BaseIcon
            :path="mdiPhone"
          />+6212345678</p>
        </div>
    </a>
    </div>
       <div class="basis-1/2">
     
      <a  class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
          <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="https://www.labssim-eform.my.id/avatar-1577909_1280.png" alt="">
          <div class="flex flex-col justify-between p-4 leading-normal">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mr john doe</h5>
              <div class="grid grid-cols-2 gap-2"></div>
          
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><BaseIcon
              :path="mdiPhone"
            />+6212345678</p>
          </div>
      </a>
      </div>
     </div>

    
    </SectionMain>
  </LayoutAuthenticated>
</template>
