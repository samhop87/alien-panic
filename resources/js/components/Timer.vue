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
                // TODO: This needs refactoring. Perhaps this would actually be better as part of main component?
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
        }
    }

</script>
