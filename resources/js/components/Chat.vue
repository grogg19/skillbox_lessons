<template>
    <div class="chat-popup">
        <h1>Чат</h1>
        <div class="chat-messages">
            <p v-for="message in messages">{{ message }}</p>
        </div>
        <input name="message" class="form-control" v-model="message" v-on:keydown.enter="sendMessage" @keydown="whisperTyping" placeholder="Сообщение...">
        <button class="btn btn-primary" @click.prevent="sendMessage">Отправить</button>
    </div>
</template>

<style>
    .chat-popup {
        display: block;
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 300px;
        height: 330px;
        padding: 10px;
        background-color: #ffffff;
        border: 3px solid #f1f1f1;
        z-index: 10;
    }

    .chat-popup .chat-messages {
        height: 150px;
        margin-bottom: 10px;
        overflow-y: scroll;
    }

    .chat-popup input {
        margin-bottom: 10px;
    }
</style>

<script>
export default {

    props: ['uId'],

    data() {
        return {
            messages: [],
            message: '',
            channel: null,
            name: null
        }
    },

    mounted() {
        this.channel = Echo.join('chat');

            this.channel.listen('ChatMessage', (data) => {
                this.name = data.user.name;
                this.addMessage(data.user.name + ': ' + data.message)
            })
            .here((users) => {
                this.addMessage('В чате ' + users.length + ' участников');
            })
            .joining((user) => {
                this.addMessage('Пользователь ' + user.name + ' подключился к чату');
            })
            .leaving((user) => {
                this.addMessage('Пользователь ' + user.name + ' покинул чат');
            })
        ;
            this.channel.listenForWhisper('typing', (data) => {
                this.addMessage(data.name + ' печатает...');
            });
    },

    methods: {
        sendMessage() {
            if (this.message.length > 0) {

                let message = this.message;
                this.message = '';
                this.addMessage('Я: ' + message);

                axios({
                    method: 'post',
                    url: '/chat',
                    data: {
                        message: message
                    },
                    headers: {
                        "X-Socket-Id": Echo.socketId(),
                    }
                })
            }
        },
        addMessage(message) {
            this.messages.push(message)
        },

        whisperTyping() {

            this.channel.whisper('typing', {name: 'Кто то'})
        }
    }
}
</script>
