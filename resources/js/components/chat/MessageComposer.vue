<template>
    <div class="row col-12 p-0 m-0">
        <div class="col-10">
            <input :class="inputClasses" v-model="messageContent" type="text" @keydown.enter="sendMessage"/>
        </div>
        <div class="col-2 p-0">
            <button class="btn col-12 btn-primary" @click="sendMessage">Send</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            messageContent: '',
            inputClasses: ['form-control']
        }
    },
    methods: {
        sendMessage() {
            if (/\S/.test(this.messageContent)) {
                this.inputClasses = ['form-control'];
                this.$emit('sendmessage', {
                    content: this.messageContent,
                })
                this.messageContent = '';
            }
            else{
                this.inputClasses.push('is-invalid');
            }
        }
    },
}
</script>

<style scoped>
input {
    background-color:transparent;
    border: 0px solid;
}
button {
    margin: 2px 0;
    padding: auto;
    height: 80%;
}
</style>