<template>
    <div>
        <div class="row bg-white shadow rounded chat-component border p-0">
            <div class="col-md-9 p-0 border-right">
                <MessageLog class="message-log p-2" :messages="messages"></MessageLog>
                <MessageComposer
                    class="message-composer border-top"
                    v-chat-scroll
                    v-on:sendmessage="addMessage"
                    v-on:sendTypingEvent="sendTypingEvent">
                </MessageComposer>
            </div>
            <div class="col-md-3  p-0">
                <OnlineUsers :users="connectedusers"></OnlineUsers>
            </div>
        </div>
    </div>
</template>

<script>

import MessageComposer from './chat/MessageComposer'
import MessageLog from './chat/MessageLog'
import OnlineUsers from './chat/OnlineUsers'
export default {
    props: ['user'],
    components: {
        MessageComposer, MessageLog, OnlineUsers
    },
    data() {
        return {
            connectedusers: [],
            messages: [],
            connectedusers:[],
        }
    },
    methods: {
        addMessage(msg) {
            axios.post('/chat/api/store', {
                content: msg.content
            })
            .then(response => {
                this.messages.push(response.data);
            });
        },
        sendTypingEvent(){
            Echo.join('chatroom')
                .whisper('typing', this.user)
        }
    },
    created () {
        axios.get('/chat/api/fetch')
            .then(response => {
                this.messages = response.data;
            });
        
        Echo.join('chatroom')
            .here(users => {
                users.forEach(u => {
                    u.istyping = false;
                });
                console.log(users);
                this.connectedusers = users
            })
            .joining((user) => {
                user.istyping = false;
                this.connectedusers.push(user);
            })
            .leaving((user) => {
                this.connectedusers = this.connectedusers.filter(u => u.id != user.id);
            })
            .listen('MessageSent', (e) => {
                this.messages.push(e)
            })
            .listenForWhisper('typing', (user) => {
                this.connectedusers.forEach(u => {
                    if(user.id == u.id){
                        u.istyping = true;
                        setTimeout(() => {
                            u.istyping = false;
                        }, 3000);
                    }
                });
            });
    },
}
</script>

<style scoped>
.message-log{
    background: rgb(250, 250, 250);
}
</style>