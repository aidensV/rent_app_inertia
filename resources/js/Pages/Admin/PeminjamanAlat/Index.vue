<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3"
import {
  mdiAccountKey,
  mdiPlus,
  mdiCheckCircle,
  mdiCloseBox,
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
  transactions: {
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
    formDelete.delete(route("peminjaman.destroy", id))
  }
}
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Manajemen Peminjaman" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Manajemen Peminjaman"
        main
      >
        <BaseButton
          :route-name="route('peminjaman-alat.create')"
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
        <form @submit.prevent="form.get(route('peminjaman-alat.index'))">
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
                <Sort label="Tgl Pinjam" attribute="trx_date" />
              </th>
              <th>
                <Sort label="Status" attribute="status" />
              </th>
               
            </tr>
          </thead>

          <tbody>
            <tr v-for="transaction in transactions.data" :key="transaction.id">
              <td data-label="Name">
                <Link
                  :href="route('peminjaman-alat.show', transaction.id)"
                  class="
                    no-underline
                    hover:underline
                    text-cyan-600
                    dark:text-cyan-400
                  "
                >
                  {{ transaction.user.name }}
                </Link>
              </td>
                  <td data-label="Item">
                    {{ transaction.user.course }}
                  </td>
                  <td data-label="Item">
                    {{ transaction.trx_date }}
                  </td>
                  
                  <td data-label="Item">
                    {{ transaction.status }}
                  </td>
              
            </tr>
          </tbody>
        </table>
        <div class="py-4">
          <Pagination :data="transactions" />
        </div>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
