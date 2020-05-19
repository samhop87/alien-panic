<template>
    <div>
        <transition mode="out-in" name="fade">

            <game-screen
                v-if="!showModal"
                :username="username"
                :logout="logout"
                :savedGame="savedGame"
                @alert="alert"
            ></game-screen>

            <alert-modal
                v-if="showModal"
                :username="username"
                @alert="alert"
            ></alert-modal>
        </transition>

    </div>
</template>
<script>
    export default {
        props: {
            username: String,
            logout: String,
            details: String
        },
        data() {
            return {
                showModal: false,
                savedGame: null
            }
        },
        beforeMount() {
            if (this.details) {
                this.savedGame = JSON.parse(this.details)
            }
        },
        methods: {
            alert() {
                this.showModal = !this.showModal
            }
        }
    }
</script>
