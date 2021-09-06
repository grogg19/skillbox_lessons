<template>
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
                this.reload()
            });
    },

    methods: {
        reload() {
            window.location.reload();
        }
    }
}
</script>
