
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import swal from 'sweetalert';

const feather = require('feather-icons')
feather.replace();

var Chart = require('chart.js');

var ctx = document.getElementById('balanceChart');
var ctx2 = document.getElementById('paymentsChart');
var ctx3 = document.getElementById('economyChart');
$(document).ready(function(){
	$.get("/api/stats/balance/studio", function(data, status){
	     var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: data.months,
		        datasets: [{
		            label: 'Balansas eurais',
		            data: data.balances,
		            backgroundColor: '#6E86F0',
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
    });

    $.get("/api/stats/payments/studio", function(data, status){
	     var myChart2 = new Chart(ctx2, {
		    type: 'bar',
		    data: {
		        labels: data.months,
		        datasets: [{
		            label: 'Balansas eurais',
		            data: data.payments,
		            backgroundColor: '#6E86F0',
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
    });
});


