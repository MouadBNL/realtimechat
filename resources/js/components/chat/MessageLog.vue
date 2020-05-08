<template>
    <div>
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

<style>

</style>