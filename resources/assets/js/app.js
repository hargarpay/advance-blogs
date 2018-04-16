
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
	el: "#app"
})

$(document).ready(function () {

    $('#sidebarCollapse').on('click', () => {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });

   	$('tbody tr td:first-child').on('click', function(e){
   		let $this = $(this);
   		$this.siblings('td').slideToggle();
   	});

	if($('.notification-wrapper .alert-important').length === 0){
	   	setTimeout(() => $('.notification-wrapper').slideUp(), 1500);
	}else{
		$('button.close').on('click', () => $('.notification-wrapper').slideUp());
	}

});
