// // Echo.channel('hello')
// //     .listen('SomethingHappens', (e) => {
// //         alert(e.whatHappens);
// //     });
// //
//
// //import TaskUpdate from "./components/TaskUpdate";
//
// //const TaskUpdate = require("./components/TaskUpdate.vue").default;
//
// //
//
// //
// //
// // let TaskUpdate = Vue.component('task-update', {
// //     props: ['taskId'],
// //
// //     data() {
// //         return {
// //             hasUpdate: false
// //         }
// //     },
// //
// //     mounted() {
// //
// //         Echo.private('task.' + this.taskId)
// //             .listen('TaskUpdated', (data) => {
// //                 this.hasUpdate = true
// //             });
// //     },
// //
// //     methods: {
// //         reload() {
// //             window.location.reload();
// //         }
// //     },
// //
// //     template:
// //         '<div>\n' +
// //         '     <div v-if="hasUpdate !== false">\n' +
// //         '           Задача была обновлена <button @click.prevent="reload()" class="btn btn-danger">Обновить страницу</button>\n' +
// //         '      </div>\n' +
// //         '</div>'
// // })
// import { createApp } from 'vue' ;
//
// //Vue.createApp({}).component('task-update', require('./components/TaskUpdate').default)
// // const app = Vue.createApp({
// //     components: {
// //         'task-update': require('./components/TaskUpdate').default
// //     }
// // })
// //Vue.component('task-update', require('./components/TaskUpdate').default)
//
// const app = createApp({})
//
// app.component('tas-update', require('./components/TaskUpdate').default)
//
// //app.mount('#app')
//
const echoBlock = document.querySelector('#echo');

Echo.private('task.' + echoBlock.getAttribute('data-task-id'))
    .listen('TaskUpdated', (data) => {
        window.location.reload();
    });

