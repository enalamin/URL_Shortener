require('./bootstrap');

//require('alpinejs');

import { createApp } from 'vue';
import router from './router'
import App from './views/App';

//import UrlsIndex from './components/urlshortner/UrlsIndex.vue';

createApp(App).use(router).mount('#app')

// new Vue({
//     el: '#app',
//     router,
//     store,
//     i18n,
//     render: h => h(App),
//   });
  
