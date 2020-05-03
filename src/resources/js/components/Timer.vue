<template>
    <div>
        <p class="font-display">{{ timerCount }}</p>
    </div>
</template>

<script>

    export default {
        props: {
            reset: Boolean
        },
        data() {
            return {
                timerCount: 5
            }
        },

        watch: {

            timerCount: {
                handler(value) {

                    if (this.reset) {
                        this.timerCount = 5
                        this.$emit('reset')
                    }

                    if (value > 0) {
                        setTimeout(() => {
                            this.timerCount--;
                            this.$emit('time', this.timerCount)
                        }, 60000);
                    }
                },
                immediate: true // This ensures the watcher is triggered upon creation
            },
            // resetClock: {
            //     handler(value) {
            //         console.log("the reset clock handler is hit")
            //         console.log("this is the value for the reset clock handler", value)
            //         if (value === true) {
            //             console.log("gets inside the if inside the reset clock handler")
            //             this.timerCount = 5
            //             this.$emit('reset', this.timerCount)
            //         }
            //     },
            //     immediate: true // This ensures the watcher is triggered upon creation
            // }

        }
    }

</script>
