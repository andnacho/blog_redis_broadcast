
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app'
// });

$('form').on('submit', function(){
$(this).find('input[type=submit]').attr('disabled', true);
});

Echo.channel('messages-channel')
    .listen('MessageWasReceived', (data) => {
        let message = data.message;
        let html = `
        <tr>
            <td>${message.id}</td>

            <td>${message.nombre}</td>
            <td>${message.email}</td>
            <td>${message.mensaje}</td>
            <td></td>
            <td></td>
            
            


            <td><a class="btn btn-primary btn-sm" href="/mensajes/${message.id}/edit">Editar</a>
            
            <form style="display:inline" action="/mensajes/${message.id}" method="post">
               <input type="hidden" name="_token" value="${Laravel.csrfToken}"/>
               <input type="hidden" name="_method" value="DELETE"/>
              
                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
            </form> 
            
            </td>
            
            </tr>
        `;

        $(html).hide().prependTo('tbody').fadeIn();
    })