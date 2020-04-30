<template>
    <div>
        <p class="font-display">{{ timerCount }}</p>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                timerCount: 5
            }
        },

        watch: {

            timerCount: {
                handler(value) {

                    if (value > 0) {
                        setTimeout(() => {
                            this.timerCount--;
                            this.$emit('time', this.timerCount)
                        }, 60000);
                    }

                },
                immediate: true // This ensures the watcher is triggered upon creation
            }

        }
    }

</script>
