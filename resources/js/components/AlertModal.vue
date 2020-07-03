<template>
    <div>
        <h1>TEST</h1>
        <h2>{{this.username}}</h2>
        <button type="button" v-on:click="test" class="
                w-full rounded-lg cursor-pointer hover:text-white hover:bg-yellow-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">go back
        </button>
    </div>
</template>

<script>
export default {
    props: {
        username: String
    },
    data() {
        return {
        }
    },
    methods: {
        test() {
            this.$emit('alert')
        }
    }
}
</script>
