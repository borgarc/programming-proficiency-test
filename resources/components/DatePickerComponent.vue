<template>
  <div class="date-picker-component relative w-64">
    <label v-if="label" class="date-picker-component__label">{{ label }}</label>
    <!-- Input -->
    <input
      type="text"
      :value="formattedDate"
      @focus="showCalendar = true"
      readonly
      placeholder="Selecciona una fecha"
      class="
        w-full px-4 py-2 border rounded-lg shadow-sm
        focus:outline-none focus:ring-2 focus:ring-blue-500
        focus:border-blue-500 cursor-pointer
      "
    />

    <!-- Calendar dropdown -->
    <div
      v-if="showCalendar"
      class="absolute z-50 mt-1 w-full bg-white border rounded-lg shadow-lg p-4"
    >
      <div class="flex justify-between items-center mb-2">
        <button @click="prevMonth" class="px-2 py-1 rounded hover:bg-gray-200">&lt;</button>
        <span class="font-semibold">{{ monthNames[currentMonth] }} {{ currentYear }}</span>
        <button @click="nextMonth" class="px-2 py-1 rounded hover:bg-gray-200">&gt;</button>
      </div>

      <div class="grid grid-cols-7 gap-1 text-center text-sm mb-2">
        <div v-for="d in dayNames" :key="d" class="font-medium">{{ d }}</div>
      </div>

      <div class="grid grid-cols-7 gap-1 text-center text-sm">
        <div
          v-for="blank in firstDayOfMonth"
          :key="'b'+blank"
        ></div>
        <button
          v-for="day in daysInMonth"
          :key="day"
          @click="selectDate(day)"
          :class="[
            'p-1 rounded hover:bg-blue-200',
            isSelected(day) ? 'bg-blue-500 text-white' : ''
          ]"
        >
          {{ day }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DatePicker',
  props: {
    value: {
      type: Date,
      default: null,
    },
    label: {
      type: String,
      required: true,
    },
  },
  data() {
    const today = new Date();
    return {
      showCalendar: false,
      selectedDate: this.value,
      currentMonth: today.getMonth(),
      currentYear: today.getFullYear(),
      monthNames: [
        'Enero', 'Febrero', 'Marzo', 'Abri', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
      ],
      dayNames: ['D', 'L', 'M', 'Mi', 'J', 'V', 'S'],
    };
  },
  computed: {
    formattedDate() {
      return this.selectedDate
        ? this.selectedDate.toLocaleDateString('es-ES')
        : '';
    },
    daysInMonth() {
      return Array.from(
        { length: new Date(this.currentYear, this.currentMonth + 1, 0).getDate() },
        (_, i) => i + 1,
      );
    },
    firstDayOfMonth() {
      const firstDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
      // Ajustar para que la semana comience en Domingo
      return firstDay === 0 ? 0 : firstDay;
    },
  },
  methods: {
    handleClickOutside(e) {
      if (!this.$el.contains(e.target)) {
        this.showCalendar = false;
      }
    },
    prevMonth() {
      if (this.currentMonth === 0) {
        this.currentMonth = 11;
        this.currentYear -= 1;
      } else {
        this.currentMonth -= 1;
      }
    },
    nextMonth() {
      if (this.currentMonth === 11) {
        this.currentMonth = 0;
        this.currentYear += 1;
      } else {
        this.currentMonth += 1;
      }
    },
    selectDate(day) {
      this.selectedDate = new Date(this.currentYear, this.currentMonth, day);
      this.showCalendar = false;
      this.$emit('input', this.selectedDate);
    },
    isSelected(day) {
      if (!this.selectedDate) return false;
      return (
        this.selectedDate.getDate() === day
        && this.selectedDate.getMonth() === this.currentMonth
        && this.selectedDate.getFullYear() === this.currentYear
      );
    },
  },
  mounted() {
    // Cerrar calendario cuando se clicke fuera
    document.addEventListener('click', this.handleClickOutside);
  },
  beforeDestroy() {
    document.removeEventListener('click', this.handleClickOutside);
  },
};
</script>

<style lang="css" scoped>
.date-picker-component {
  display: flex;
  flex-direction: column;
  gap: 6px;
  font-family: sans-serif;
  width: 240px;
}
.date-picker-component__label {
  font-weight: 600;
  font-size: 14px;
}
</style>
