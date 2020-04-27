<template>
    <div class="h-screen">
        <div class="container mx-auto w-3/4 flex flex-col h-full py-1 justify-center items-center">

            <div class="flex flex-row container w-full justify-around">
                <button type="button" v-on:click="startGame" class="
                w-1/3 rounded-lg cursor-pointer hover:text-white hover:bg-red-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Start Game
                </button>

                <button type="button" v-on:click="goHome" class="
                w-1/3 rounded-lg cursor-pointer hover:text-white hover:bg-red-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Save and Quit
                </button>
            </div>

            <div class="container mx-auto w-full flex flex-row py-2">
                <div class="w-1/3 container mx-auto flex flex-row justify-between items-center">
                    <p class="font-display">Alien attack in: </p>
                    <timer></timer>
                </div>
                <div class="w-1/3 container mx-auto flex flex-row justify-center items-center">
                    <p class="font-display">Score: **</p>
                </div>
                <div class="w-1/3 container mx-auto flex flex-row justify-between items-center">
                    <p class="font-display">Username</p>
                    <img class="w-1/3" :src="userImage">
                </div>
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
    </div>
</template>

<script>
    export default {
        props: ['time'],
        data() {
            return {
                vueCanvas: null,
                rectWidth: 200,
                userImage: './images/testalien.jpg',
                score: null,
                gameProgress: {
                    resources: {
                        rocks: null,
                        magic: null,
                    },
                    buildings: {
                        quarry: null,
                        books: null
                    },
                    timer: null,
                }
            }
        },
        mounted() {
            this.vueCanvas = document.getElementById("gameCanvas").getContext("2d");
        },
        methods: {
            startGame() {
                // Start the timer
            },
            drawRect() {
                // clear canvas
                this.vueCanvas.clearRect(0, 0, 400, 200);

                // draw rect
                this.vueCanvas.beginPath();
                this.vueCanvas.rect(20, 20, this.rectWidth, 100);
                this.vueCanvas.stroke();
            },
            goHome() {
                // Save game with axios.
                axios.post('/game-progress', this.gameProgress).then(response => {
                    alert('Game saved!');
                });

                // Take user back to home screen
                this.$emit('clicked', 'test')
            },
        }
    }
</script>
