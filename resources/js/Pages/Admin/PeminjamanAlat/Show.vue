<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButton from "@/Components/BaseButton.vue"

const props = defineProps({
  tools: {
    type: Object,
    default: () => ({}),
  },
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="View Detail" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="View Detail"
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
      <CardBox class="mb-6">
        <table>
          <tbody>
            <tr>
              <td
                class="
                  p-4
                  pl-8
                  text-slate-500
                  dark:text-slate-400
                  hidden
                  lg:block
                "
              >
                Name
              </td>
              <td data-label="Name">
                {{ tools.name }}
              </td>
            </tr>
            <tr>
              <td class="
                              p-4
                              pl-8
                              text-slate-500
                              dark:text-slate-400
                              hidden
                              lg:block
                            ">
                Description
              </td>
              <td data-label="Name">
                {{ tools.description }}
              </td>
            </tr>
            <tr>
              <td
                class="
                  p-4
                  pl-8
                  text-slate-500
                  dark:text-slate-400
                  hidden
                  lg:block
                "
              >
                Created
              </td>
              <template v-if="tools.status != 'approved'">
              <td data-label="Created">
                {{ new Date(tools.created_at).toLocaleString() }}
              </td>
              </template>
            </tr>
          </tbody>
        </table>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
