<template>
  <div id="app">
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

export default {
  name: 'App',
  components: {
    TableComponent,
  },
  data: () => ({
    users,
    propertyTypes,
    properties,
    tableHeaders: [
      'User', 'Property', 'Type', 'From', 'To', 'Duration',
      'Currently Rented',
    ],
  }),
};
</script>
