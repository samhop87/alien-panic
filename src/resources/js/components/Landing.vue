<template>
    <div>
        <transition mode="out-in" name="fade">

            <welcome
                v-if="!create && !showGame && !showLogin"
                @clicked="createUser"
                @present="presentLogin"
            ></welcome>

            <login
                v-if="showLogin"
                @clicked="goBack"
            ></login>

            <user-store
                v-if="create"
                @clicked="goBack"
                @begin="startGame"
            ></user-store>

            <game-screen
                v-if="showGame"
                @clicked="goHome"
            ></game-screen>

        </transition>
    </div>
</template>

<script>
    import UserStore from "./UserStore"
    import Welcome from "./Welcome"
    import GameScreen from "./GameScreen"
    import Login from "./Login"

    export default {
        mixins: [],
        props: ['time'],
        components: {
            UserStore,
            Welcome,
            GameScreen,
            Login
        },
        data() {
            return {
                create: false,
                showGame: false,
                showLogin: false
            }
        },
        methods: {
            createUser(value) {
                this.create = true;
            },
            goBack(value) {
                this.create = false;
            },
            goHome(value) {
                this.create = false;
                this.showGame = false;
            },
            startGame(value) {
                this.showGame = true;
                this.create = false;
            },
            presentLogin(value) {
                this.showLogin = true;
            }
        }
    }
</script>
