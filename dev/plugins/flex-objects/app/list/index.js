import Vue from 'vue';
import VueEvents from 'vue-events';
import App from './App.vue';

Vue.use(VueEvents);

const ID = '#flex-objects-list';
const element = document.querySelector(ID);

if (element) {
    const initialStore = element.dataset.initialStore;

    new Vue({ // eslint-disable-line no-new
        el: ID,
        render: h => h(App, {
            props: {initialStore}
        })
    });
}
