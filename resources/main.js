import Vue from 'vue';
import App from './App.vue';
import router from './router/index';

const tailwind = document.createElement('script');
tailwind.src = 'https://cdn.tailwindcss.com';
document.head.appendChild(tailwind);

Vue.config.productionTip = false;

tailwind.onload = () => {
  new Vue({
    router,
    render: (h) => h(App),
  }).$mount('#app');
};
