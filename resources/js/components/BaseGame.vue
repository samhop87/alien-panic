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
            details: String,
            buildings: String,
        },
        data() {
            return {
                showModal: false,
                savedGame: null,
            }
        },
        beforeMount() {
            if (this.details) {
                this.savedGame = JSON.parse(this.details)
            }
            if (this.details && this.buildings) {
                this.savedGame.construction = JSON.parse(this.buildings)
            }
        },
        methods: {
            alert() {
                this.showModal = !this.showModal
            }
        }
    }
</script>
