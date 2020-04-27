<template>
    <div>
        <transition mode="out-in" name="fade">

            <welcome
                v-if="!create && !showGame"
                @clicked="createUser"
            ></welcome>

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

    export default {
        mixins: [],
        props: ['time'],
        components: {
            UserStore,
            Welcome,
            GameScreen
        },
        data() {
            return {
                create: false,
                showGame: false,
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
                console.log("hits the parent")
                this.showGame = true;
                this.create = false;
            }
        }
    }
</script>
