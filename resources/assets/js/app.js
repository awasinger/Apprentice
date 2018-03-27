
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

// document.addEventListener("touchstart", function() {},false);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function closeNav() {
    $('.nav-list-container').addClass('nav-closed');
    $('.nav-list-container').removeClass('nav-open');
    $('.body-shade').css('background', 'none');
}

function openNav(e) {
    $('.nav-list-container').addClass('nav-open');
    $('.nav-list-container').removeClass('nav-closed');
    $('.body-shade').css('background', '#000');
    e.stopPropagation();
}

if ($('.mobile-open').length) {
    $('.mobile-open').click(function (e) {
        openNav(e);
    });
}

if ($('.mobile-close').length) {
    $('.mobile-close').click(closeNav);
    $('.nav-list-container').click(function (e) {
        e.stopPropagation();
    });
    $(window).click(closeNav);
}

$(document).scroll(function() {
    if ($(document).scrollTop() >= 5) {
        $('.nav-header').addClass('navscroll');
    } else {
        $('.nav-header').removeClass('navscroll');
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
    $('#logout-button').click(function() {
        $('#logout-form').submit();
        return false;
    });
}

if ($('#course-create').length) {
    $('#add-question').click(function (e) {
        var question = $('#question-single').clone();
        
        question.attr('name', 'questions[' + qTotal + ']');
        
        question.find('#question').attr('placeholder', 'Question ' + (qTotal + 1));
        question.find('#question').attr('name', 'questions[' + qTotal + '][0]');
        question.find('#question').val('');
        
        question.find('#a1').attr('name', 'questions[' + qTotal + '][1][0]');
        question.find('#a1').val('');
        
        question.find('#a2').attr('name', 'questions[' + qTotal + '][1][1]');
        question.find('#a2').val('');
        
        question.find('#a3').attr('name', 'questions[' + qTotal + '][1][2]');
        question.find('#a3').val('');
        
        question.find('#a4').attr('name', 'questions[' + qTotal + '][1][3]');
        question.find('#a4').val('');
        
//         question.find('input[type=radio]').attr('name', 'correct' + (qTotal + 1));
        question.find('input[type=radio]').attr('name', 'questions[' + qTotal + '][2]');
        question.find('input[type=radio]').prop('checked', false);
        
        qTotal++;
        question.appendTo('#question-container');
        
        return false;
    });
}

if ($('#countdown').length) {
    var releaseDate = new Date('April 3, 2018 12:00:00');
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
            $('#countdown').html('<p>The countdown has finished! We will be up shortly.</p>');
        }
    }
    setCountdown();
    var testDone = setInterval(setCountdown, 1000);
    if (!testDone) {
        clearInterval(testDone);
    }
}

if ($('.stripe-form').length) {
    // Create a Stripe client.
    var stripe = Stripe('pk_test_V3NuctvMrUO2LjYVFPZVpIqs');
    
    // Create an instance of Elements.
    var elements = stripe.elements();
    
    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
    
      // Submit the form
      form.submit();
    }
    
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };
    
    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});
    
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
    
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
    
      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });
    
    $('#show-checkout').click(function () {
        $('#show-checkout').css('display', 'none');
        $('#checkout').css('display', 'block');
    });
}

if ($('#file-select').length) {
    $('#file-select').change(function () {
        var file = $('#file-select')[0].files[0];
        $('#text-file-name').html(file.name);
    });
}

if ($('.file-remove').length) {
    $('.file-remove').click(function (e) {
        $.ajax({
            url: 'http://apprentice.local/courses/edit/remove',
            method: 'POST',
            data: {
                'item': $(e.target).prev().html(),
                'id': $('#id').val(),
            },
            success: function (data) {
                $(e.target).html(data);
            }
        });
    });
}

/*
if ($('#multiple-choice').length) {
    $('answer-question').click(function {
        $.ajax({
            url: 'http://apprentice.local/courses/take',
            method: 'POST',
            data: 
        });
    });
}
*/