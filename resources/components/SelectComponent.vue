<template>
  <div class="select-component">
    <label v-if="label" class="select-component__label">{{ label }}</label>

    <div class="select-component__wrapper">
      <select v-model="selectedValue" class="select-component__dropdown">
        <option disabled hidden :value="null">{{ placeholder }}</option>
        <option
          v-for="option in options"
          :key="option.value"
          :value="option.value"
        >
          {{ option.label }}
        </option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  name: 'select-component',
  props: {
    value: [String, Number, Object],
    options: {
      type: Array,
      required: true,
    },
    placeholder: {
      type: String,
      default: 'Elige una opcion',
    },
    label: String,
  },
  computed: {
    selectedValue: {
      get() {
        return this.value;
      },
      set(val) {
        this.$emit('input', val);
      },
    },
  },
};
</script>

<style scoped>
.select-component {
  display: flex;
  flex-direction: column;
  gap: 6px;
  font-family: sans-serif;
  width: 240px;
}

.select-component__label {
  font-weight: 600;
  font-size: 14px;
}

.select-component__wrapper {
  position: relative;
}

.select-component__dropdown {
  width: 100%;
  padding: 10px 14px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background: white;
  transition: border-color 0.2s ease;
  appearance: none;
}

.select-component__dropdown:hover {
  border-color: #888;
}

.select-component__dropdown:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
}
</style>
