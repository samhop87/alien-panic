<template>
    <div class="container mx-auto w-3/4 flex flex-col h-screen justify-center items-center">

        <div>
            <button type="button" v-on:click="goHome" class="
                w-full rounded-lg cursor-pointer hover:text-white hover:bg-red-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Go back to home screen
            </button>
        </div>

        <div class="w-full">
            <canvas class="w-full border-solid border-gray-300 border-4" id="gameCanvas"></canvas>
        </div>

        <div>
            <button type="button" v-on:click="drawRect" class="
                w-full rounded-lg cursor-pointer hover:text-white hover:bg-yellow-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Draw rectangle
            </button>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                vueCanvas: null,
                rectWidth: 200
            }
        },
        mounted() {
            this.vueCanvas = document.getElementById("gameCanvas").getContext("2d");
        },
        methods: {
            drawRect() {
                // clear canvas
                this.vueCanvas.clearRect(0, 0, 400, 200);

                // draw rect
                this.vueCanvas.beginPath();
                this.vueCanvas.rect(20, 20, this.rectWidth, 100);
                this.vueCanvas.stroke();
            },
            goHome() {
                this.$emit('clicked', 'test')
            },
        }
    }
</script>
