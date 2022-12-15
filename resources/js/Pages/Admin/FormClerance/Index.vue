<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3"
import {
  mdiAccountKey,
  mdiPlus,
  mdiCheckCircle,
  mdiTrashCan,
  mdiAlertBoxOutline,
  
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButtons from "@/Components/BaseButtons.vue"
import NotificationBar from "@/Components/NotificationBar.vue"
import Pagination from "@/Components/Admin/Pagination.vue"
import Sort from "@/Components/Admin/Sort.vue"

const props = defineProps({
  clearance: {
    type: Object,
    default: () => ({}),
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  search: props.filters.search,
})

const formDelete = useForm({})

function destroy(id) {
  if (confirm("Are you sure you want to delete?")) {
    formDelete.delete(route("form-clearance.destroy", id))
  }
}
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Form Clearance" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Form Clearance"
        main
      >
        <BaseButton
          v-if="can.create"
          :route-name="route('form-clearance.create')"
          :icon="mdiPlus"
          label="Add"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar
        v-if="$page.props.flash.message"
        color="success"
        :icon="mdiAlertBoxOutline"
      >
        {{ $page.props.flash.message }}
      </NotificationBar>
      <CardBox class="mb-6" has-table>
        <form @submit.prevent="form.get(route('form-clearance.index'))">
          <div class="py-2 flex">
            <div class="flex pl-4">
              <input
                type="search"
                v-model="form.search"
                class="
                  rounded-md
                  shadow-sm
                  border-gray-300
                  focus:border-indigo-300
                  focus:ring
                  focus:ring-indigo-200
                  focus:ring-opacity-50
                "
                placeholder="Search"
              />
              <BaseButton
                label="Search"
                type="submit"
                color="info"
                class="ml-4 inline-flex items-center px-4 py-2"
              />
            </div>
          </div>
        </form>
      </CardBox>
      <CardBox class="mb-6" has-table>
        <table>
          <thead>
            <tr>
              <th>
                <Sort label="Name" attribute="name" />
              </th>
              <th>
                <Sort label="Course" attribute="course" />
              </th>
              <th>
                <Sort label="Tanggal" attribute="date" />
              </th>
              <th>
                <Sort label="Status" attribute="status" />
              </th>
              <th v-if="can.edit || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="tool in clearance.data" :key="tool.id">
              <td data-label="Name">
                <Link
                  :href="route('form-clearance.show', tool.id)"
                  class="
                    no-underline
                    hover:underline
                    text-cyan-600
                    dark:text-cyan-400
                  "
                >
                  {{ tool.user.name }}
                </Link>
              </td>
              <td>
                {{ tool.user.course }}
              </td>
              <td>
                {{ tool.date_trx }}
              </td>
              <td data-label="Status">
                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{tool.status}}</span>
              </td>
              <td
                v-if="can.approve || can.delete"
                class="before:hidden lg:w-1 whitespace-nowrap"
              >
              <template v-if="tool.status != 'approved' ">
                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                    <BaseButton
                    v-if="can.approve"
                    :route-name="route('form-clearance.edit', tool.id)"
                    color="success"
                    :icon="mdiCheckCircle"
                    small
                  />
                  <BaseButton
                    v-if="can.delete"
                    color="danger"
                    :icon="mdiTrashCan"
                    small
                    @click="destroy(tool.id)"
                  />
                  
                </BaseButtons>
              </template>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="py-4">
          <Pagination :data="clearance" />
        </div>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
