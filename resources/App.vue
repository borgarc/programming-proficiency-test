<template>
  <div id="app" class="min-h-screen bg-gray-50 p-4 md:p-8 flex flex-col items-center">
    <!-- Seccion filtros -->
    <div
      class="
        w-full max-w-5xl mb-6 flex flex-col
        sm:flex-row sm:items-end sm:justify-between gap-4 bg-white shadow-sm
        p-4 rounded-xl border border-gray-200
      "
    >
      <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto flex-wrap">
        <DatePickerComponent v-model="selectedFromDate" :label="fromLabel"/>
        <DatePickerComponent v-model="selectedToDate" :label="toLabel"/>
        <SelectComponent
          v-model="selectedUser"
          :options="mapUsers"
          placeholder="Todos los usuarios"
          label="Usuarios"
        />
        <SelectComponent
          v-model="selectedType"
          :options="mapPropertyTypes"
          placeholder="Todos los tipos"
          label="Tipos"
        />
      </div>
    </div>

    <!-- Seccion tabla -->
    <div class="w-full max-w-5xl bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
      <TableComponent
        :users="users"
        :propertyTypes="propertyTypes"
        :properties="properties"
        :tableHeaders="tableHeaders"
        :selectedUser="selectedUser"
        :selectedType="selectedType"
        :selectedFromDate="selectedFromDate"
        :selectedToDate="selectedToDate"
      />
    </div>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import TableComponent from '@/components/TableComponent.vue';
import SelectComponent from '@/components/SelectComponent.vue';
import DatePickerComponent from '@/components/DatePickerComponent.vue';

export default {
  name: 'App',
  components: {
    TableComponent,
    SelectComponent,
    DatePickerComponent,
  },
  data: () => ({
    users,
    propertyTypes,
    properties,
    selectedUser: 'all',
    selectedType: 'all',
    selectedFromDate: null,
    selectedToDate: null,
    fromLabel: 'Desde',
    toLabel: 'Hasta',
    tableHeaders: [
      'Usuario', 'Propiedad', 'Tipo', 'Desde', 'Hasta', 'Duracion',
      'Alquilado',
    ],
    userList: [],
  }),
  computed: {
    mapUsers() {
      return [
        ...this.users.map((u) => ({
          value: u.name,
          label: u.name,
        })),
      ];
    },
    mapPropertyTypes() {
      return [
        ...this.propertyTypes.map((t) => ({
          value: t.name,
          label: t.name,
        })),
      ];
    },
  },
  watch: {
    // Cada vez que cambie un filtro, actualiza la URL
    selectedUser() {
      this.updateQueryParams();
    },
    selectedType() {
      this.updateQueryParams();
    },
    selectedFromDate() {
      this.updateQueryParams();
    },
    selectedToDate() {
      this.updateQueryParams();
    },
  },
  mounted() {
    this.applyFiltersFromRoute();
  },
  methods: {
    // Carga los filtros desde la URL
    applyFiltersFromRoute() {
      const {
        user,
        type,
        from,
        to,
      } = this.$route.query;

      if (user) this.selectedUser = user;
      if (type) this.selectedType = type;
      if (from) this.selectedFromDate = new Date(from);
      if (to) this.selectedToDate = new Date(to);
    },

    // Actualiza los query params del router
    updateQueryParams() {
      this.$router.replace({
        query: {
          user: this.selectedUser !== 'all' ? this.selectedUser : undefined,
          type: this.selectedType !== 'all' ? this.selectedType : undefined,
          from: this.selectedFromDate
            ? this.selectedFromDate.toISOString().split('T')[0]
            : undefined,
          to: this.selectedToDate
            ? this.selectedToDate.toISOString().split('T')[0]
            : undefined,
        },
      });
    },
  },
};
</script>
