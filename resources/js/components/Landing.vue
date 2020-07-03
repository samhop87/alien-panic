<template>
    <div class="text-white bg-black">
        <transition mode="out-in" name="fade">

            <welcome
                v-if="!create && !showGame && !showLogin"
                @clicked="createUser"
                @present="presentLogin"
            ></welcome>

            <login
                :forgot="forgot"
                :login="login"
                :username="username"
                v-if="showLogin"
                @clicked="goBack"
                @signin="startGame"
            ></login>

            <user-store
                :register="register"
                v-if="create"
                @clicked="goBack"
                @begin="startGame"
            ></user-store>
        </transition>
    </div>
</template>

<script>
    import UserStore from "./UserStore"
    import Welcome from "./Welcome"
    // import GameScreen from "./GameScreen"
    import Login from "./Login"

    export default {
        mixins: [],
        props: {
            username: String,
            login: String,
            register: String,
            forgot: String,
            logout: String
        },
        components: {
            UserStore,
            Welcome,
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
                this.showLogin = false;
            },
            goHome(value) {
                this.create = false;
                this.showGame = false;
            },
            startGame(value) {
                this.showGame = true;
                this.create = false;
                this.showLogin = false;
            },
            presentLogin(value) {
                this.showLogin = true;
            }
        }
    }
</script>
