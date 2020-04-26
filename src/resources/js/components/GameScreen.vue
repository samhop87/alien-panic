<template>
<div>
    <button type="button" v-on:click="goHome" class="
                w-2/5 rounded-lg cursor-pointer hover:text-white hover:bg-red-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Go back to home screen</button></div>
</template>

<script>
    export default {
        methods: {
            goHome() {
                this.$emit('clicked', 'test')
            },
        }
    }
</script>
