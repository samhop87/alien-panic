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

                    <timer @time="addToProgress" :countdown="gameProgress.timer"></timer>

                </div>
                <div class="w-1/3 container mx-auto flex flex-row justify-center items-center">
                    <p class="font-display">Score: {{ gameProgress.score }}</p>
                </div>
                <div class="w-1/3 container mx-auto flex flex-row justify-between items-center">
                    <p class="font-display">Username</p>
                    <img class="w-1/3" :src="userImage">
                </div>
            </div>

            <div>
                <ul id="v-for-object">
                    <li v-for="(key, value) in gameProgress.resources">
                        {{ key }} : {{ value }}
                    </li>
                </ul>
            </div>

            <div class="w-full flex justify-center my-4">
                <canvas class="border-solid border-gray-300 border-4 bg-green-200" id="gameCanvas"></canvas>
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
                    <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.title }}</strong> produces
                        <strong> {{ option.desc }}</strong></template>
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
                    {title: 'Quarry', desc: 'rocks', img: './images/testalien.jpg', alt: 'test'},
                    {title: 'Library', desc: 'magic', img: './images/testalien.jpg', alt: 'test'},
                    {
                        title: 'Defender',
                        desc: 'a better defence score',
                        img: './images/testalien.jpg',
                        alt: 'test'
                    },
                ],
                vueCanvas: null,
                construction: {
                    Quarry: [],
                    Library: [],
                    Defender: []
                },
                priceList: {
                    Quarry: {
                        rocks: 5,
                        magic: 0
                    },
                    Library: {
                        rocks: 10,
                        magic: 1
                    },
                    Defender: {
                        rocks: 0,
                        magic: 20
                    }
                },
                coordinateList: {
                    controlledY: 10,
                    x: [],
                    y: [],
                },
                userImage: './images/testalien.jpg',
                gameProgress: {
                    score: 0,
                    resources: {
                        rocks: 0,
                        magic: 0,
                        defenders: 0,
                    },
                    buildings: {
                        quarry: 0,
                        libraries: 0
                    },
                    timer: 5
                }
            }
        },
        mounted() {
            this.vueCanvas = document.getElementById("gameCanvas").getContext("2d");
        },
        watch: {},
        methods: {
            startGame() {
                // Start the timer
            },
            checkPrice(type) {
                // pay for the building with resources
                let rocksTotal = this.gameProgress.resources.rocks
                let magicTotal = this.gameProgress.resources.magic
                let totalCost = null;


                switch (type) {
                    case "Quarry":
                        totalCost = this.calculatePrice(this.priceList.Quarry)
                        if (totalCost[0] > rocksTotal || totalCost[1] > magicTotal) {
                            alert("You don't have enough resources to build any quarries")
                            return false;
                        } else {
                            this.gameProgress.resources.rocks = rocksTotal - totalCost[0]
                            this.gameProgress.resources.magic = magicTotal - totalCost[1]
                        }
                        break;
                    case "Library":
                        totalCost = this.calculatePrice(this.priceList.Library)
                        if (totalCost[0] > rocksTotal || totalCost[1] > magicTotal) {
                            alert("No one is going to build a library for free, brah")
                            return false;
                        } else {
                            this.gameProgress.resources.rocks = rocksTotal - totalCost[0]
                            this.gameProgress.resources.magic = magicTotal - totalCost[1]
                        }
                        break;
                    case "Defender":
                        totalCost = this.calculatePrice(this.priceList.Defender)
                        if (totalCost[0] > rocksTotal || totalCost[1] > magicTotal) {
                            alert("You don't have enough resources to train any defenders")
                            return false;
                        } else {
                            this.gameProgress.resources.rocks = rocksTotal - totalCost[0]
                            this.gameProgress.resources.magic = magicTotal - totalCost[1]
                        }
                        break;
                }
            },
            calculatePrice(price) {
                let rockPrice = 0;
                let magicPrice = 0;
                for (let [key, value] of Object.entries(price)) {
                    if (key == "rocks") {
                        rockPrice = value
                    }
                    if (key == "magic") {
                        magicPrice = value
                    }
                }
                return [rockPrice, magicPrice]
            },
            build() {
                let cw = document.getElementById("gameCanvas").width
                let ch = document.getElementById("gameCanvas").height

                let width = null;
                let height = null;
                let colour = null;
                let store = null;

                let type = this.value.title

                // We need to work out the cost/payment issue here, and adjust totals accordingly.
                if (this.checkPrice(type) === false) {
                    return;
                }

                switch (type) {
                    case "Quarry":
                        width = 10
                        height = 20
                        colour = 'grey'
                        store = this.construction.Quarry
                        this.gameProgress.buildings.quarry++
                        this.gameProgress.score++
                        break;
                    case "Library":
                        width = 30
                        height = 30
                        colour = 'red'
                        store = this.construction.Library
                        this.gameProgress.buildings.libraries++
                        this.gameProgress.score++
                        break;
                    case "Defender":
                        width = 5
                        height = 5
                        colour = 'blue'
                        store = this.construction.Defender
                        this.gameProgress.resources.defenders++
                        this.gameProgress.score += 10
                        break;
                    default:
                        width = 1
                        height = 1
                        colour = 'black'
                        store = this.construction.Quarry
                }

                // x must always be greater than calcLat
                // except if calcLat is off canvas.
                // then y must be greater than calcLong
                // and then back to checking x again.
                let x;
                let y;

                if (this.coordinateList.x.length === 0) {
                    x = 10;
                }

                y = this.coordinateList.controlledY;

                if (this.coordinateList.x.length !== 0) {
                    x = Math.max(...this.coordinateList.x) + 10;
                    // Clear the x coordinate array
                    if ((x + width) >= cw) {
                        // This only happens once...
                        // We need for it to adjust the value of Y for whole row.
                        y = Math.max(...this.coordinateList.y) + 10;
                        this.coordinateList.controlledY = y;
                        x = 10;
                        this.coordinateList.x = [];
                    }
                    if ((y + height >= ch)) {
                        this.coordinateList.y = [];
                        this.fireAlert("You have no more room left in your town!");
                        return;
                    }
                }

                let calcLong = y + height;
                let calcLat = x + width;

                // Add game object to canvas
                this.vueCanvas.beginPath();
                this.vueCanvas.fillStyle = colour;
                this.vueCanvas.fillRect(x, y, width, height);
                this.vueCanvas.stroke();

                // This stores the individual game objects in the construction array
                store.push({
                    type: type,
                    ax: x,
                    ay: y,
                    bx: calcLat, // top right
                    by: calcLong // bottom left
                })

                // Calculate used points and add to coordinate list array
                while (x <= calcLat) {
                    if (!this.coordinateList.x.includes(x)) {
                        this.coordinateList.x.push(x);
                    }
                    x++;
                }

                while (y <= calcLong) {
                    if (!this.coordinateList.y.includes(y)) {
                        this.coordinateList.y.push(y);
                    }
                    y++;
                }
            },
            fireAlert(msg) {
                alert(msg)
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
                // this is the number that the timer component reduces...
                this.timer = value
                console.log("this should hit every minute", this.timer, value)
                this.addResources()
                this.initiateRandomEvent()

                if (value === 2) {
                    this.alienWarning()
                }
                if (value === 0) {
                    this.alienAttack()
                    this.resetTimer()
                }

                // TODO: initiate new 'events' at certain periods. Eg. townspeople demanding something.
            },
            addResources() {
                // TODO: Refactor this to be extendable.
                // TODO: Right now generation is (1+n)/min, should it be?
                for (let i = 0; i <= this.gameProgress.buildings.libraries; i++) {
                    this.gameProgress.resources.magic += 1;
                }
                for (let i = 0; i <= this.gameProgress.buildings.quarry; i++) {
                    this.gameProgress.resources.rocks += 1;
                }
                // Add in defenders - the more defenders you have, the higher your score.
                // The alien attack should be on a sliding scale - if the aliens have a MUCH higher score,
                // it should destroy more buildings and defenders etc.
                // If the aliens only JUST win, it should be minimal destruction.
            },
            initiateRandomEvent() {
                let int = this.rollDice()
            },
            openingEvent() {
              // get this right, and you're rewarded with 5 rocks.
              // change the data for a v-if to true, displaying options
              // change new options array to match.
              // if the option chosen is right, reward. If wrong, display message.
            },
            alienWarning() {
                console.log("WARNING! Aliens are about to attack. It looks like X aliens are coming.")
                // TODO: Perform calculation to determine the results of an alien attack.
                console.log("Currently, your town may not survive.")
            },
            alienAttack() {
                console.log("the aliens have arrived")
                // TODO: Show an alien popup.
                // TODO: Some kind of animation to show a battle is taking place?
                // TODO: Calculate damage based on alien strength vs. score.
                // TODO: determine number of buildings to destroy. Then pick from the buildings in the construction
                //  array, and randomly destroy the number by using clearRect() on their coordinates.
            },
            resetTimer() {
              // TODO: Trigger event to reset 'timercount' in the child component.
                // the timer in this component is reset, but is not communicated to the timer child component.
                this.timer = 5
            },
            rollDice() {
                return Math.floor(Math.random() * (6 - 1 + 1)) + 1;
            },
            saveProgress() {
                axios.post('/game-progress', this.gameProgress).then(response => {
                    alert('Game saved!');
                });
            },
        }
    }
</script>
