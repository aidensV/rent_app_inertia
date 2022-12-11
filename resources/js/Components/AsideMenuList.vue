<script setup>
import AsideMenuItem from '@/Components/AsideMenuItem.vue'
import { computed } from '@vue/reactivity';

defineProps({
  isDropdownList: Boolean,
  menu: {
    type: Array,
    default: () => []
  }
})

const emit = defineEmits(['menu-click'])

const menuClick = (event, item) => {
  emit('menu-click', event, item)
}
</script>

<template>
<ul>
 
  <template  v-for="(item, index) in menu" :key="index">
  <template v-for="permit in user_role">
  <AsideMenuItem
  v-if="permit.name == item.label"
    :item="item"
    :is-dropdown-list="isDropdownList"
    @menu-click="menuClick"
  />
  </template>
</template>
</ul>
</template>

<script>
export default {
  computed: {
    user_role() {
      return this.$page.props.auth.permissions
    }
  }
}
</script>
