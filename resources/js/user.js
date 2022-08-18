/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('moment/locale/id');

window.Vue = require('vue');

// Plugins momentjs
import moment from 'moment'

//Notifikasi dengan sweetalerts
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});

window.Toast = Toast;

// import { Form, HasError, AlertError } from 'vform'

// window.Form = Form
// Vue.component(HasError.name, HasError)
// Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Form Wizard
// import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
// Vue.use(VueFormWizard)

//Progress Bar
import VueProgressBar from 'vue-progressbar'

//Datepicker
// import VueDatePicker from '@mathieustan/vue-datepicker';
// Vue.use(VueDatePicker)

const newLocal = '/ppdb';
let routes = [
    /**
     * Dashboard Ortu
     */
    // { path: '/ppdb', component: require('./components/psb/Dashboard.vue').default},
    // // { path: '/dokumen/:id', component: require('./components/psb/Dokumen.vue').default},
    // { path: '/tambahcalon', component: require('./components/psb/TambahCalon.vue').default},
    // { path: '/editcalon/:id', component: require('./components/psb/EditCalon.vue').default},
    // { path: '/editcalons/:id', component: require('./components/psb/EditCalon.vue').default},

    /**
     * Component untuk page yang belum dibuat/tidak ada
     */
    { path: '*', component: require('./components/Page.vue').default}
]

const router =  new VueRouter({
    mode: 'history',
    routes
})

const progressbar_option = {
    color: '#dd675',
    thickness: '15px',
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, progressbar_option)

//Input Data Currency
import Vue from 'vue'
import VueNumeric from 'vue-numeric'

Vue.use(VueNumeric)

//Membuat Table
// import SmartTable from 'vuejs-smart-table'

// Vue.use(SmartTable)

//Plugins Select2
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

//Membuat Filter agar setting tampilan sesuai yang diinginkan (Tanggal dengan format Indonesia)
Vue.filter('Tanggal', function(tanggalnya){
    if (tanggalnya) {
        return moment(tanggalnya).format('DD MMMM YYYY');
    } else {
        return 'Tidak Ada';
    }
});

Vue.filter('TanggalKecil', function(tanggalnya){
    if(tanggalnya) {
        return moment(tanggalnya).format('DD-MM-YY');
    } else {
        return 'Tidak Ada';
    }
});

// Vue.filter('Usia', function(tanggalnya){
//     let th = parseInt(moment(tanggalnya).format('YYYY'));
//     let bl = parseInt(moment(tanggalnya).format('MM'));
//     let dt = parseInt(moment(tanggalnya).format('DD'));

//     var d1 = new Date(2021, 7, 1);
//     var d2 = new Date(th, bl, dt);

//     var diff = new Date(
//         d1.getFullYear()-d2.getFullYear(), 
//         d1.getMonth()-d2.getMonth(), 
//         d1.getDate()-d2.getDate()
//     );
//     return diff.getYear() + " Tahun, " + diff.getMonth() + " Bulan, " + diff.getDate() + " Hari";
// });

Vue.filter('toCurrency', function (value) {

    if(isNaN(value)){
        var uangnya = 0;
    } else {
        var uangnya = value;
    }

    var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });
    return formatter.format(parseInt(uangnya));
});

// Vue.filter('YaTidak', function (value) {
//     if(value === 0){
//         return 'Tidak';
//     } else {
//         return 'Ya';
//     }
// })

// Vue.filter('Judul', function (str) {
//     if (!str) return ''
//     str = str.toLowerCase().split(' ');
//     let final = [ ];

//     for(let  word of str){
//         final.push(word.charAt(0).toUpperCase()+ word.slice(1));
//     }

//     return final.join(' ')
// })

//Untuk Event
let Fire = new Vue()
window.Fire = Fire;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
//     router
// });
