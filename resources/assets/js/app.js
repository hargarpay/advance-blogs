
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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

  $("td.actions-button a.btn:not('.btn-info')").on('click', function(e){
      e.preventDefault();
      $this = $(this);
      if($this.hasClass('btn-danger')){
          $('form#delete-method').attr('action', $this.data('href')).submit();
      }else if($this.hasClass('btn-default') || $this.hasClass('btn-warning'))
      {
          $('form#put-method').attr('action', $this.data('href')).submit();
      }
  })

});
