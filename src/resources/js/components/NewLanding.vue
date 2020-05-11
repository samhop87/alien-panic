<template>
    <div class="flex flex-col justify-center align-center container mx-auto w-2/3 h-screen">
        <h4 class="font-bold font-display text-1xl text-center">Login</h4>

        <form class="flex flex-row flex-wrap container mx-auto w-full"
              @submit.prevent="process">

            <div class="flex flex-col flex-wrap container mx-auto w-full md:w-1/2">
                <div class="w-5/6 p-2 container mx-auto">
                    <input type="text" class="w-full p-2 rounded-lg
                    border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center"
                           name="email"
                           id="email"
                           placeholder="email"
                           v-model="fields.email"
                    />
                    <div v-if="errors && errors.email"
                         class="text-danger">
                        {{ errors.email[0] }}
                    </div>
                </div>

                <div class="w-5/6 p-2 container mx-auto">
                    <input type="password" class="p-2 w-full rounded-lg
                    border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center"
                           name="password"
                           id="password"
                           placeholder="password"
                           v-model="fields.password"/>
                    <div
                        v-if="errors && errors.password"
                        class="text-danger">{{ errors.password[0] }}
                    </div>
                    <div
                        v-if="errors && errors.status"
                        class="text-danger">{{ errors.user }}
                    </div>
                </div>
            </div>

            <div class="flex flex-row flex-wrap justify-between container mx-auto w-4/5">
                <button type="submit" class="
                w-2/5 rounded-lg cursor-pointer hover:text-white hover:bg-blue-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Login
                </button>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        props: {
            login: String
        },
        data() {
            return {
                fields: {},
                errors: {},
            }
        },
        methods: {
            process() {
                this.errors = {};
                axios.post(this.login, this.fields).then(response => {
                    if (response.data.status !== "error")
                    {
                        alert('Login attempt!');
                        window.location.href = '/'
                    } else {
                        alert("there was an error in the response")
                        this.errors = response.data
                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
        },
    }
</script>
