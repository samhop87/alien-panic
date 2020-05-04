<template>
    <div class="flex flex-col justify-around align-center container mx-auto w-2/3 h-screen">
        <h4 class="font-bold font-display text-1xl text-center">Create your user</h4>

        <button type="button" v-on:click="startGame" class="
                w-2/5 rounded-lg cursor-pointer hover:text-white hover:bg-red-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Proceed</button>

        <form class="flex flex-row flex-wrap container mx-auto w-full"
              @submit.prevent="submit">

            <div class="flex flex-col flex-wrap container mx-auto w-full md:w-1/2">
                <div class="w-5/6 p-2 container mx-auto">
                    <input type="text" class="w-full p-2 rounded-lg
                    border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center" name="username" id="username" placeholder="username" v-model="fields.username"/>
                    <div v-if="errors && errors.username" class="text-danger">{{ errors.username[0] }}</div>
                </div>

                <div class="w-5/6 p-2 container mx-auto">
                    <input type="email" class="p-2 w-full rounded-lg
                    border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center" name="email" id="email" placeholder="valid email address" v-model="fields.email"/>
                    <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                </div>

                <div class="w-5/6 p-2 container mx-auto">
                <textarea class="w-full p-2 rounded-lg
                    border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center" id="message" name="message" rows="5" v-model="fields.message"></textarea>
                    <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
                </div>

            </div>
            <div class="flex container mx-auto w-full md:w-1/2">
                <div class="flex h-full w-5/6 container mx-auto p-2">
                    <div class="w-full p-2 rounded-lg
                    border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">
                        <p>x</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-row flex-wrap justify-between container mx-auto w-4/5">
                <button type="button" v-on:click="goBack" class="
                w-2/5 rounded-lg cursor-pointer hover:text-white hover:bg-red-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Go back</button>
                <button type="submit" class="
                w-2/5 rounded-lg cursor-pointer hover:text-white hover:bg-blue-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Save
                </button>
            </div>
        </form>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                fields: {},
                errors: {},
            }
        },
        methods: {
            goBack() {
                this.$emit('clicked', 'test')
            },
            startGame() {
                this.$emit('begin')
            },
            submit() {
                this.errors = {};
                axios.post('/submit', this.fields).then(response => {
                    alert('Message sent!');
                    this.startGame();
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
        },
    }
</script>
