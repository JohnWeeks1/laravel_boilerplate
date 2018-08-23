
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

$(function(){
    $(".display_instructions").text("You can't send an empty message");

    $(".message_seller_textbox").keyup(function () {
        if ($(this).val()) {
            $(".show_button_if_not_empty").show();
            $(".display_instructions").hide();
        }
        else {
            $(".show_button_if_not_empty").hide();
            $(".display_instructions").show();
        }
    });
    $(".show_button_if_not_empty").click(function () {
        $(".message_seller_textbox").val('').hide();
    });

});