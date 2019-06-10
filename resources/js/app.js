
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import swal from 'sweetalert';

const feather = require('feather-icons')
feather.replace();

/*
Vue.js components defined here
*/
window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import axios from 'axios';


// 1. Define route components.
// These can be imported from other files
import navigation from './components/navigation.vue';

import signups from './components/signup-requests.vue';
import home from './components/home.vue';
import groups from './components/groups.vue';
import members from './components/members.vue';
import payments from './components/payments.vue';
import competition from './components/competition-show.vue';

import groupsCreate from './components/groups-create.vue';
import membersAdd from './components/members-add.vue';

import memberEdit from './components/members-edit.vue';
// 0. If using a module system (e.g. via vue-cli), import Vue and VueRouter
// and then call `Vue.use(VueRouter)`.



// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
  { path: '/home', component: home },
  { path: '/signups', component: signups },
  { path: '/groups', component: groups },
  { path: '/members', component: members },
  { path: '/groups', component: groups },
  { path: '/groups/create', component: groupsCreate },
  { path: '/payments', component: payments },
  { path: '/competition', component: competition },
  { path: '/members/add', component: membersAdd },
  { path: '/members/:id/edit', component: memberEdit },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes // short for `routes: routes`
})

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.

// register modal component
Vue.component('search-modal', {
  data: function () {
    return {
      q: null,
      search_results: [],
    }
  },
  watch: {
    q(after, before) {
      this.makeSearch();
    }
  },
  methods: {
    makeSearch: function (){
      if(this.q == ''){
        this.search_results = null;
      }else{
        axios.post('/api/search', {
          searchQ: this.q,
        }).then(response => {
          this.search_results = response.data
        });
      }

    }
  },
  template: '#modal-search',
  template: '#modal-confirm-member',
});

const app = new Vue({
  data: {
    showSearchModal: false,
    showConfirmMemberModal: false,
    selectedMemberID: 0,
  },
  router
}).$mount('#app')

// Now the app has started!
/*
-----------------------------
*/

// var Chart = require('chart.js');

// var ctx = document.getElementById('balanceChart');
// var ctx2 = document.getElementById('paymentsChart');
// var ctx3 = document.getElementById('economyChart');
// $(document).ready(function(){
// 	$.get("/api/stats/balance/studio", function(data, status){
// 	     var myChart = new Chart(ctx, {
// 		    type: 'bar',
// 		    data: {
// 		        labels: data.months,
// 		        datasets: [{
// 		            label: 'Balansas eurais',
// 		            data: data.balances,
// 		            backgroundColor: '#6E86F0',
// 		            borderWidth: 1
// 		        }]
// 		    },
// 		    options: {
// 		        scales: {
// 		            yAxes: [{
// 		                ticks: {
// 		                    beginAtZero: true
// 		                }
// 		            }]
// 		        }
// 		    }
// 		});
//     });

//     $.get("/api/stats/payments/studio", function(data, status){
// 	     var myChart2 = new Chart(ctx2, {
// 		    type: 'bar',
// 		    data: {
// 		        labels: data.months,
// 		        datasets: [{
// 		            label: 'Balansas eurais',
// 		            data: data.payments,
// 		            backgroundColor: '#6E86F0',
// 		            borderWidth: 1
// 		        }]
// 		    },
// 		    options: {
// 		        scales: {
// 		            yAxes: [{
// 		                ticks: {
// 		                    beginAtZero: true
// 		                }
// 		            }]
// 		        }
// 		    }
// 		});
//     });
// });


$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
