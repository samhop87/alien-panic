<template>
    <transition mode="out-in" name="fade">

    <game-screen
        :username="username"
        :logout="logout"
    ></game-screen>

        <alert-modal
            :username="username"
        ></alert-modal>
        
    </transition>
</template>
<script>
    export default {
        props: {
            username: String,
            logout: String
        },
        data() {
            return {}
        },
        methods: {}
    }
</script>
