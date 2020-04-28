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
                <multiselect v-model="value"
                             deselect-label="Can't remove this value"
                             track-by="title"
                             label="title"
                             placeholder="Select one"
                             :options="options"
                             :searchable="false"
                             :allow-empty="false">
                    <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.title }}</strong> produces <strong>  {{ option.desc }}</strong></template>
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
                    { title: 'Quarry', desc: 'rocks', img: './images/testalien.jpg', alt: 'test'},
                    { title: 'Library', desc: 'magic', img: './images/testalien.jpg', alt: 'test' },
                    { title: 'Defender', desc: 'a better defence score', img: './images/testalien.jpg', alt: 'test' },
                ],
                vueCanvas: null,
                construction: [],
                coordinateList: [],
                userImage: './images/testalien.jpg',
                score: null,
                gameProgress: {
                    resources: {
                        rocks: null,
                        magic: null,
                        defenders: null,
                    },
                    buildings: {
                        quarry: null,
                        libraries: null
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
            pay() {
              // pay for the building with resources
            },
            build() {
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

                // Determine coordinates for new game object
                // These coordinates must be defined here.
                // Which means check on coordinate list must occur prior.
                let latStart; // top left
                let longStart; // bottom left
                let calcLat; // top right
                let calcLong; // bottom right


                // Add game object to canvas
                this.vueCanvas.beginPath();
                this.vueCanvas.rect(latStart, longStart, width, height);
                this.vueCanvas.strokeStyle = colour
                this.vueCanvas.stroke();

                this.construction.push({
                    type: this.value.title,
                    ax: latStart,
                    ay: longStart,
                    bx: calcLat,
                    by: calcLong
                })

                // Calculate used points and add to coordinate list array
                // Get range between latStart and calcLat (this is x coordinates used)
                // Get range between longStart and calcLong (this is y coordinates used)

                this.coordinateList.push()
            },
            goHome() {
                // Save game with axios.
                this.saveProgress()

                // Take user back to home screen
                // TODO: Send back clearing argument; clear current progress and logout user.
                // this.vueCanvas.clearRect(0, 0, 400, 200);

                this.$emit('clicked', 'test')
            },
            addToProgress(value) {
                this.timer = value

                // TODO: initiate new 'events' at certain periods. Eg. townspeople demanding something.
                // TODO: Add to resources depending on what resource production there is.
            },
            saveProgress() {
                axios.post('/game-progress', this.gameProgress).then(response => {
                    alert('Game saved!');
                });
            },
        }
    }
</script>
