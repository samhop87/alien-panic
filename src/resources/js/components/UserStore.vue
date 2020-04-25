<template>
    <div class="flex flex-col justify-around align-center container mx-auto w-1/2 h-screen">
        <h4 class="font-bold font-display text-1xl text-center">Create your user</h4>
        <form class="flex flex-row flex-wrap container mx-auto w-full"
              @submit.prevent="submit">
            <div>
                <input type="text" class="rounded-lg
                    p-2 w-5/6 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center" name="name" id="name" placholder="name" v-model="fields.name"/>
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>

            <div>
                <input type="email" class="rounded-lg
                    p-2 w-5/6 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center" name="email" id="email" v-model="fields.email"/>
                <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
            </div>

            <div>
                <textarea class="rounded-lg
                    p-2 w-5/6 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center" id="message" name="message" rows="5" v-model="fields.message"></textarea>
                <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
            </div>
            <div class="w-4/5 container mx-auto rounded-lg
                    p-2 w-5/6 border-4 border-gray-400 border-solid
                     my-2">x</div>


            <button type="submit" class="w-full btn btn-primary">Send message</button>
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
            submit() {
                this.errors = {};
                axios.post('/submit', this.fields).then(response => {
                    alert('Message sent!');
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
        },
    }
</script>
