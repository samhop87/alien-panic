<template>
    <div>
        <transition mode="out-in" name="fade">
        <welcome
        v-if="!create"
        @clicked="createUser"
    ></welcome>
    <user-store
        v-if="create"
        @clicked="goBack"
    ></user-store>
        </transition>
    </div>
</template>

<script>
    import UserStore from "./UserStore"
    import Welcome from "./Welcome";

    export default {
        mixins: [],
        props: {},
        components: {
            UserStore,
            Welcome
        },
        data() {
            return {
                create: false
            }
        },
        methods: {
            createUser (value) {
                this.create = true;
            },
            goBack (value) {
                this.create = false;
            }
        }
    }
</script>
