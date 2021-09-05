<template>
    <div>
        <div v-if="hasUpdate">
            Задача была обновлена <button @click.prevent="reload()" class="btn btn-danger">Обновить страницу</button>
        </div>
    </div>
</template>

<script>

export default {

    props: ['taskId'],

    data() {
        return {
            hasUpdate: false
        }
    },

    mounted() {

        Echo.private('task.' + this.taskId)
            .listen('TaskUpdated', (data) => {
                this.hasUpdate = true
                alert(123)
            });
    },

    methods: {
        reload() {
            window.location.reload();
        }
    }
}
</script>
