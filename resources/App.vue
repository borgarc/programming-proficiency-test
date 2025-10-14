<template>
  <div id="app">
    <SelectComponent
      v-model="selectedUser"
      :options="mapUsers"
      placeholder="Filtro por usuarios"
      label="Usuarios"
    />
    <TableComponent
      :users="users"
      :propertyTypes="propertyTypes"
      :properties="properties"
      :tableHeaders="tableHeaders"
    />
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import TableComponent from '@/components/TableComponent.vue';
import SelectComponent from '@/components/SelectComponent.vue';

export default {
  name: 'App',
  components: {
    TableComponent,
    SelectComponent,
  },
  data: () => ({
    users,
    propertyTypes,
    properties,
    selectedUser: null,
    tableHeaders: [
      'Usuario', 'Propiedad', 'Tipo', 'Desde', 'Hasta', 'Duracion',
      'Alquilado',
    ],
    userList: [],
  }),
  computed: {
    mapUsers() {
      return this.users.map((u) => ({ value: u.id, label: u.name }));
    },
    mapPropertyTypes() {
      return this.propertyTypes.map((p) => ({ value: p.id, label: p.name }));
    },
  },
};
</script>
