<template>
            <div class="flex flex-col justify-center align-center container mx-auto w-4/5 h-screen">
                <h1 class="font-bold font-display text-3xl text-center">Welcome to Alien Panic!</h1>
                <p class="text-center mb-4">A building and defence game.</p>

                <div class="flex flex-col justify-around align-center items-center container mx-auto w-4/5 text-center">

                    <div v-on:click="fireLog" class="rounded-lg cursor-pointer hover:text-white hover:bg-blue-500
                    p-2 w-1/2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center"><a class="font-semibold">Continue Game</a>
                    </div>

                    <div v-on:click="createUser" class="rounded-lg cursor-pointer hover:text-white hover:bg-green-500
                    p-2 w-1/2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center content-center">
                        <a class="font-semibold">Create User</a>
                    </div>

                </div>
            </div>
</template>
<script>
    export default {
        methods: {
            createUser (event) {
                this.$emit('clicked', 'test')
            },
            fireLog (event) {
                this.$emit('present')
            }
        }
    }</script>
