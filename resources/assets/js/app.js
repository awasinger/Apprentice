
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*
Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
*/

// Custom

"use strict";

$(document).scroll(function() {
    if ($(document).scrollTop() >= 5) {
        $('#nav-header').addClass('navscroll');
    } else {
        $('#nav-header').removeClass('navscroll');
    }
});

if ($('#welcome-showcase-button').length) {
    $("#welcome-showcase-button").click(function() {
        $('html,body').animate({
            scrollTop: $("#welcome-mission").offset().top - 50});
            return false;
        });
}

if ($('#logout-button').length) {
    $('#logout-button').click( function() {
        $('#logout-form').submit();
        return false;
    });
}

if($('#countdown').length) {
    var releaseDate = new Date('April 1, 2018 12:00:00');
    function setCountdown() {
        var now = new Date().getTime();
        
        var remaining = releaseDate - now;
        
        var days = Math.floor(remaining / (1000 * 60 * 60 * 24));
        var hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((remaining % (1000 * 60)) / 1000);
                
        $('#days-number').text(days);
        
        $('#hours-number').text(hours);
        
        $('#minutes-number').text(minutes);
        
        $('#seconds-number').text(seconds);
        
        
        if (remaining < 0) {
            clearInterval(testDone);
            $('#countdown').text('The countdown has finished! We will be up shortly.');
        }
    }
    setCountdown();
    var testDone = setInterval(setCountdown, 1000);
    if (!testDone) {
        clearInterval(testDone);
    }

}