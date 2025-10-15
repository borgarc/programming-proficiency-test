<template>
  <tr>
    <td
      class="border px-3 py-2 text-center align-middle"
      v-for="(value, key) in row"
      :key="key"
    >
    {{ displayValue(value) }}
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
  methods: {
    // 👇 Detecta si es fecha y devuelve formateada
    displayValue(value) {
      if (this.isDate(value)) {
        return this.formatDate(new Date(value));
      }
      return value;
    },

    // Comprueba si el valor es una fecha o cadena ISO válida
    isDate(value) {
      if (value instanceof Date) return true;
      if (typeof value === 'string' && !Number.isNaN(Date.parse(value))) return true;
      return false;
    },

    // Da formato bonito en español
    formatDate(date) {
      if (!(date instanceof Date) || Number.isNaN(date)) return '';
      return date.toLocaleDateString('es-ES', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });
    },
  },
};
</script>
