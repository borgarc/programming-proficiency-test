<template>
  <div id="app">
    <SelectComponent
      v-model="selectedUser"
      :options="mapUsers"
      placeholder="Todos"
      label="Usuarios"
    />
    <SelectComponent
      v-model="selectedType "
      :options="mapPropertyTypes"
      placeholder="Todos"
      label="Tipos"
    />
    <TableComponent
      :users="users"
      :propertyTypes="propertyTypes"
      :properties="properties"
      :tableHeaders="tableHeaders"
      :selectedUser="selectedUser"
      :selectedType="selectedType"
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
    selectedUser: 'all',
    selectedType: 'all',
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
};
</script>
