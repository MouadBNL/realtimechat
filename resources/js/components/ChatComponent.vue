<template>
    <div>
        <div class="row bg-white shadow rounded chat-component border p-0">
            <div class="col-md-9 p-0 border-right">
                <MessageLog class="message-log p-2" :messages="messages"></MessageLog>
                <MessageComposer class="message-composer border-top" v-on:sendmessage="addMessage"></MessageComposer>
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
            messages: [
                {
                    content: 'test vue',
                    user: 'Mouadbn',
                },
                {
                    content: 'another on',
                    user: 'Mr. test',
                },
            ],
            connectedusers:[
                'Mr. test', 'Mouadbn'
            ],
        }
    },
    methods: {
        addMessage(msg) {
            this.messages.push({
                content: msg.content,
                user: this.user,
            })
        }
    },
}
</script>

<style scoped>
.chat-component{
    min-height: 500px;
}
.message-log{
    height: 92%;
    background: rgb(250, 250, 250);
}
</style>