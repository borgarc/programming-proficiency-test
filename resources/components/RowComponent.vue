<template>
  <tr>
    <td
      class="border px-3 py-2 text-center align-middle"
      v-for="(value, key) in row"
      :key="key"
    >
    {{ value }}
    </td>
  </tr>
</template>

<script>

export default {
  name: 'RowComponent',
  props: {
    row: {
      type: Object,
      required: true,
      default: () => {},
    },
  },
  data: () => ({
  }),
};
</script>
