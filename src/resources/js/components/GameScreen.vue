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
                    <timer @time="addToProgress"></timer>
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

            <div class="border-4 border-solid border-red-300">
            <multiselect
                :options="options"
                v-model="value"
                deselect-label="Can't remove this value"
                track-by="name"
                label="name"
                placeholder="Select one"
                :searchable="false"
                :allow-empty="false"
            >
                <template slot="singleLabel" slot-scope="props"><img class="option__image" :src="props.option.img" alt="No Man’s Sky"><span class="option__desc"><span class="option__title">{{ props.option.title }}</span></span></template>
                <template slot="option" slot-scope="props"><img class="option__image" :src="props.option.img" alt="No Man’s Sky">
                    <div class="option__desc"><span class="option__title">{{ props.option.title }}</span><span class="option__small">{{ props.option.desc }}</span></div>
                </template>
            </multiselect>
            </div>

            <div>
                <button type="button" v-on:click="build" class="
                w-full rounded-lg cursor-pointer hover:text-white hover:bg-yellow-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Build it!
                </button>
            </div>

        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        components: {Multiselect},
        props: [],
        data() {
            return {
                value: null,
                options: [
                    { title: 'Quarry', desc: 'Produces rocks', img: './images/testalien.jpg' },
                    { title: 'Library', desc: 'Produces magic', img: './images/testalien.jpg' },
                    { title: 'Defender', desc: 'Adds to defence score', img: './images/testalien.jpg' },
                ],
                vueCanvas: null,
                // rectWidth: 200,
                construction: null,
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
        watch: {

        },
        methods: {
            startGame() {
                // Start the timer
            },
            build() {
                // clear canvas
                console.log(this.value.title)
                let width;
                let height;
                let colour;

                switch(this.value.title) {
                    case "Quarry":
                        width = 10
                        height = 20
                        colour = 'grey'
                        break;
                    case "Library":
                        width = 30
                        height = 30
                        colour = 'red'
                        break;
                    case "Defender":
                        width = 5
                        height = 5
                        colour = 'blue'
                        break;
                    default:
                        width = 1
                        height = 1
                        colour = 'black'
                }
                // this.vueCanvas.clearRect(0, 0, 400, 200);

                // draw rect
                this.vueCanvas.beginPath();
                this.vueCanvas.rect(20, 20, width, height);
                this.vueCanvas.strokeStyle = colour
                this.vueCanvas.stroke();
            },
            goHome() {
                // Save game with axios.
                this.saveProgress()

                // Take user back to home screen
                this.$emit('clicked', 'test')
            },
            addToProgress(value) {
                this.timer = value
            },
            saveProgress() {
                axios.post('/game-progress', this.gameProgress).then(response => {
                    alert('Game saved!');
                });
            },
            customLabel ({ title, desc }) {
                return `${title} – ${desc}`
            }
        }
    }
</script>
