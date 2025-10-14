<template>
  <div id="table-component">
    <table class="w-full border-collapse border text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th
            class="border px-3 py-2"
            v-for="(label, index) in tableHeaders"
            :key="index">
            {{ label }}
          </th>
        </tr>
      </thead>
      <tbody>
        <RowComponent
          v-for="(row, index) in tableData"
          :key="index"
          :row="row"
        />
      </tbody>
    </table>
  </div>
</template>

<script>
import RowComponent from '@/components/RowComponent.vue';

export default {
  name: 'TableComponent',
  components: {
    RowComponent,
  },
  props: {
    users: {
      type: Array,
      required: true,
      default: () => [],
    },
    propertyTypes: {
      type: Array,
      required: true,
      default: () => [],
    },
    properties: {
      type: Array,
      required: true,
      default: () => [],
    },
    tableHeaders: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
  data: () => ({
    tableData: [],
  }),
  mounted() {
    this.formatDataRows();
    console.log(this.tableData);
  },
  methods: {
    formatDataRows() {
      // Map de usuarios y tipos para acceso rápido
      const userMap = Object.fromEntries(this.users.map((u) => [u.id, u.name]));
      const typeMap = Object.fromEntries(this.propertyTypes.map((t) => [t.id, t.name]));

      // Relacionar y ordenar propiedades por rentedFrom
      this.tableData = this.properties
        .map((p) => ({
          userName: userMap[p.userId],
          propertyName: p.name,
          typeName: typeMap[p.typeId],
          rentedFrom: p.rentedFrom,
          rentedTo: p.rentedTo,
          monthsRented: this.monthsRented(p),
          itsCurrentlyRented: !!p.rentedFrom && !p.rentedTo,
        }));
    },
    monthsRented(property) {
      const { rentedFrom, rentedTo } = property;

      if (!rentedFrom) return '0 mes(es) y 0 día(s).';

      const endDate = rentedTo || new Date();

      // Diferencia total en milisegundos
      const totalDays = Math.floor((endDate - rentedFrom) / (1000 * 60 * 60 * 24));

      // Calcular meses completos y días restantes
      const months = Math.floor(totalDays / 30.44); // promedio de días por mes
      const days = Math.round(totalDays - months * 30.44);

      return `${months} mes(es) y ${days} día(s).`;
    },
  },
};
</script>
