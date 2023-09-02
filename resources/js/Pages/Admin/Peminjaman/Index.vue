<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3"
import {
  mdiAccountKey,
  mdiPlus,
  mdiCheckCircle,
  mdiCloseBox,
  mdiAlertBoxOutline,
  mdiFileDownloadOutline,
  mdiArrowRightCircle
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
      <SectionTitleLineWithButton :icon="mdiAccountKey" title="Manajemen Peminjaman" main>
        <BaseButton v-if="can.create" :route-name="route('peminjaman.create')" :icon="mdiPlus" label="Add" color="info"
          rounded-full small />
      </SectionTitleLineWithButton>
      <NotificationBar v-if="$page.props.flash.message" color="success" :icon="mdiAlertBoxOutline">
        {{ $page.props.flash.message }}
      </NotificationBar>
      <CardBox class="mb-6" has-table>
        <form @submit.prevent="form.get(route('peminjaman.index'))">
          <div class="py-2 flex">
            <div class="flex pl-4">
              <input type="search" v-model="form.search" class="
                  rounded-md
                  shadow-sm
                  border-gray-300
                  focus:border-indigo-300
                  focus:ring
                  focus:ring-indigo-200
                  focus:ring-opacity-50
                " placeholder="Search" />
              <BaseButton label="Search" type="submit" color="info" class="ml-4 inline-flex items-center px-4 py-2" />
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
                <Sort label="Item" attribute="item" />
              </th>
              <th>
                <Sort label="Tanggal" attribute="date_trx" />
              </th>
              <th>
                <Sort label="Waktu Pinjam" attribute="start_time" />
              </th>
              <th>
                <Sort label="Waktu Pengembalian" attribute="end_time" />
              </th>
              <th>
                <Sort label="Status" attribute="status" />
              </th>
              <th v-if="can.approve || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="transaction in transactions.data" :key="transaction.id">
              <td data-label="Name">
                {{ transaction.name }}
              </td>
              <td data-label="Item">
                {{ transaction.item.name }}
              </td>
              <td data-label="Item">
                {{ transaction.trx_date }}
              </td>
              <td data-label="Item">
                {{ transaction.start_time.substring(0, 5) }}
              </td>

              <td data-label="Item">
                {{ transaction.end_time.substring(0, 5)  }}
              </td>
              <td data-label="Item">
                {{ transaction.status }}
              </td>
              <td v-if="can.approve || can.delete" class="before:hidden lg:w-1 whitespace-nowrap">
                <template v-if="transaction.status == 'waiting'">
                  <BaseButtons type="justify-start lg:justify-end" no-wrap>
                    <BaseButton v-if="can.approve" :route-name="route('peminjaman.edit', transaction.id)"
                      color="success" :icon="mdiCheckCircle" small />
                    <BaseButton v-if="can.delete" color="danger" :icon="mdiCloseBox" small
                      @click="destroy(transaction.id)" />
                  </BaseButtons>
                </template>
                <template v-else-if="transaction.status == 'approved'">
                   <BaseButtons type="justify-start" no-wrap>
                    <BaseButton :route-name="route('peminjaman.closed', transaction.id)"
                      color="info" :icon="mdiArrowRightCircle" small />
                  </BaseButtons>
                </template>

                  <a v-else-if="transaction.status == 'finished'" class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded ring-purple-700 bg-purple-600 dark:bg-purple-500 text-white border-purple-600 dark:border-purple-500 hover:bg-purple-700 hover:border-purple-700 hover:dark:bg-purple-600 hover:dark:border-purple-600 text-sm p-1 mr-3 last:mr-0 mb-3"
                    target="_blank" disabled="false" :href="route('peminjaman.report', transaction.id)"><span
                      class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24" width="16"
                        height="16" class="inline-block">
                        <path fill="currentColor"
                          d="M14,2L20,8V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V4A2,2 0 0,1 6,2H14M18,20V9H13V4H6V20H18M12,19L8,15H10.5V12H13.5V15H16L12,19Z">
                        </path>
                      </svg></span></a>

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
