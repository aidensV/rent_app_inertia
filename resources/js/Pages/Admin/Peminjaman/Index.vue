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
          v-if="can.delete"
          :route-name="route('peminjaman.create')"
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
        <form @submit.prevent="form.get(route('peminjaman.index'))">
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
                <Sort label="Item" attribute="item" />
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
              <th v-if="can.edit || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="transaction in transactions.data" :key="transaction.id">
              <td data-label="Name">
                <Link
                  :href="route('tool-manage.show', transaction.id)"
                  class="
                    no-underline
                    hover:underline
                    text-cyan-600
                    dark:text-cyan-400
                  "
                >
                  {{ transaction.name }}
                </Link>
              </td>
                <td data-label="Item">
                  {{ transaction.item.name }}
                </td>
                  <td data-label="Item">
                    {{ transaction.start_time.substring(0, 5) }}
                  </td>
                  <td data-label="Item">
                    {{ transaction.end_time.substring(0, 5) }}
                  </td>
                  <td data-label="Item">
                    {{ transaction.status }}
                  </td>
              <td
                v-if="can.edit || can.delete"
                class="before:hidden lg:w-1 whitespace-nowrap"
              >
              <template v-if="transaction.status == 'waiting'">
                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                  <BaseButton
                    v-if="can.edit"
                    :route-name="route('peminjaman.edit', transaction.id)"
                    color="success"
                    :icon="mdiCheckCircle"
                    small
                  />
                  <BaseButton
                    v-if="can.delete"
                    color="danger"
                    :icon="mdiCloseBox"
                    small
                    @click="destroy(transaction.id)"
                  />
                </BaseButtons>
                </template>
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
