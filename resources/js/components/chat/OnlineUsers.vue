<template>
    <div>
        <div class="col-12 border-bottom p-0">
            <h3 class="h5 text-center my-2">Online users</h3>
        </div>
        <div>
            <p class="border-bottom p-2 m-0" v-for="user in users" :key="user.id">
                {{ user }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['users'],
}
</script>

<style>

</style>