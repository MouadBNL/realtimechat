<template>
    <div class="message-main-log" v-chat-scroll>
        <div v-for="msg in messages" :key="msg.id">
            <small>{{ msg.user }}</small>
            <p>{{ msg.content }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'messages'
    ],
}
</script>

<style scoped>
.message-main-log {
    height: 405px;
    overflow-y: scroll;
}
</style>