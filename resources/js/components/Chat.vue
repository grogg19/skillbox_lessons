<template>
    <div class="chat-popup">
        <h2>Чат</h2>
        <div class="chat-messages">
            <p v-for="message in messages">{{ message }}</p>
        </div>
            <div class="chat-typing">
                <transition name="fade">
                    <span v-if="typing">{{ typing }}</span>
                </transition>
            </div>
        <input name="message" class="form-control" v-model="message" v-on:keydown.enter="sendMessage" @keydown.passive="whisperTyping" placeholder="Сообщение...">
        <button class="btn btn-primary" @click.prevent="sendMessage">Отправить</button>
    </div>
</template>

<style>
    .chat-popup {
        display: block;
        -webkit-box-shadow: 7px 7px 20px 0px rgba(50, 50, 50, 0.75);
        -moz-box-shadow:    7px 7px 20px 0px rgba(50, 50, 50, 0.75);
        box-shadow:         7px 7px 20px 0px rgba(50, 50, 50, 0.75);
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 300px;
        height: 330px;
        padding: 10px;
        background-color: #ffffff;
        border: 1px solid #cdcdcd;
        border-radius: 10px;
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

    .chat-typing {
        font-size: 10px;
        height: 10px;
        margin-bottom:10px;
    }

    .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
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
            users: null,
            name: null,
            typing: null,
            notifySound: new Audio('/js/sounds/appleNotify.mp3') // path to file
        }
    },

    mounted() {
        this.channel = Echo.join('chat');

            this.channel.listen('ChatMessage', (data) => {
                this.name = data.user.name;
                this.addMessage(data.user.name + ': ' + data.message)
                this.notifySound.play();
            })
            .here((users) => {
                this.users = users;
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
                this.typing = data.name + ' печатает...';
                setTimeout( () => {
                    this.typing = null
                }, 3000)
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
            setTimeout( () => {
                this.scrollToElement();
            }, 300)
        },

        whisperTyping() {
            if (this.users.length > 0) {
                this.users.forEach(user => {
                    if (this.uId == user.id) {
                        this.name = user.name ;
                    }
                })
            } else {
                this.name = 'Кто-то'
            }
            this.channel.whisper('typing', {name: this.name})
        },

        scrollToElement() {
            let chatMessages = this.$el.querySelector(".chat-messages");
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }


    }
}
</script>
