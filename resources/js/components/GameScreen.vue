<template>
    <div class="h-screen bg-black text-white">
        <div class="container mx-auto w-3/4 flex flex-col h-full py-1 justify-center items-center">

            <div class="flex flex-row container mx-auto w-full">
                <h1 class="font-display text-xs">The next alien attack will take place in:</h1>
                <timer
                    @time="addToProgress"
                    :reset="gameProgress.resetClock"
                    @reset="resetTimer"
                ></timer>
            </div>
            <div class="container mx-auto w-full flex flex-row py-2">

                <div class="font-display text-xs w-1/3 container mx-auto flex flex-col justify-around items-center">
                    <div>
                        <ul id="v-for-object">
                            <li v-for="(key, value) in gameProgress.resources">
                                {{ value }} : {{ key }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-1/3 container mx-auto flex flex-row justify-center items-center">
                    <p class="text-xs font-display">Score: {{ gameProgress.score }}</p>
                </div>
                <div class="w-1/3 container mx-auto flex flex-row justify-around items-center">
                    <p class="text-xs font-display">{{ username }}</p>
                    <img class="w-1/3" :src="userImage">
                </div>
            </div>

            <div class="flex flex-row justify-between w-full">
                <div>
                    <div v-show="value">

                    </div>
                </div>
                <div class="flex justify-center my-4">
                    <canvas class="border-solid border-gray-300 border-4 bg-green-200"
                            id="gameCanvas"></canvas>
                </div>
            </div>

            <div class="w-3/4 container mx-auto cursor-pointer border-4 border-solid border-red-300">
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

            <div class="flex flex-row w-full justify-between">
                <button type="button" v-on:click="build" class="
                w-1/4 rounded-lg cursor-pointer hover:text-white hover:bg-yellow-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Build it!
                </button>

                <button type="button" v-on:click="saveProgress" class="
                w-1/4 rounded-lg cursor-pointer hover:text-white hover:bg-red-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Save and Quit
                </button>

                <button type="button" v-on:click="startGame" class="
                w-1/4 rounded-lg cursor-pointer hover:text-white hover:bg-yellow-500
                    p-2 border-4 border-gray-400 border-solid
                     my-2 flex justify-center align-center
                      content-center">Modal Test
                </button>
            </div>

        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        components: {Multiselect},
        props: {
            username: String,
            logout: String,
            savedGame: Object,
            buildings: Object
        },
        data() {
            return {
                userImage: './images/testalien.jpg',
                value: null,
                vueCanvas: null,

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
                information: {
                    Quarry: {
                        rocks: 2,
                        magic: 0,
                        color: 'grey',
                        width: 10,
                        height: 20,
                    },
                    Library: {
                        rocks: 5,
                        magic: 1,
                        color: 'red',
                        width: 30,
                        height: 30,
                    },
                    Defender: {
                        rocks: 0,
                        magic: 10,
                        color: 'blue',
                        width: 5,
                        height: 5,
                    }
                },
                coordinateList: {
                    controlledY: 10,
                    x: [],
                    y: [],
                },
                gameProgress: {
                    score: 0,
                    attacksSurvived: 0,
                    resources: {
                        rocks: 0,
                        magic: 0,
                    },
                    buildings: {
                        quarry: 0,
                        libraries: 0,
                        defenders: 0,
                    },
                    construction: [],
                    timer: null,
                    resetClock: false
                }
            }
        },
        beforeMount() {
            if (this.savedGame) {
                this.gameProgress.timer = this.savedGame.timeRemaining
                this.gameProgress.buildings.libraries = this.savedGame.libraries
                this.gameProgress.buildings.quarry = this.savedGame.quarries
                this.gameProgress.buildings.defenders = this.savedGame.defenders
                this.gameProgress.resources.rocks = this.savedGame.rocks
                this.gameProgress.resources.magic = this.savedGame.magic
                this.gameProgress.score = this.savedGame.score
                this.gameProgress.attacksSurvived = this.savedGame.attacksSurvived
                this.gameProgress.construction = this.savedGame.construction
            }
        },
        mounted() {
            this.vueCanvas = document.getElementById("gameCanvas").getContext("2d");
            this.rebuildProgress()
        },
        watch: {},
        methods: {
            startGame() {
                // Start the timer

                // TODO: THIS IS A TEST FUNCTION.
                // TODO: MOVE IT SO THAT IT DISPLAYS AS PART OF THE PROGRESS FUNCTION.
                this.$emit('alert', 'test')

            },
            rebuildProgress() {
                // this.gameProgress.buildings.quarry = this.savedGame.quarries

                if (this.savedGame && this.savedGame.construction) {
                    for (let i = 0; i < this.savedGame.construction.length; i++) {
                        console.log("it gets inside here correctly")
                        console.log('each type', this.savedGame.construction[i].type)
                        switch (this.savedGame.construction[i].type) {
                            case 1:
                            this.vueCanvas.beginPath();
                            this.vueCanvas.fillStyle = this.information.Quarry.color
                            this.vueCanvas.fillRect(
                                this.savedGame.construction[i].x,
                                this.savedGame.construction[i].y,
                                this.information.Quarry.width,
                                this.information.Quarry.height
                            );
                            this.vueCanvas.stroke();
                            break;
                            case 2:
                                this.vueCanvas.beginPath();
                                this.vueCanvas.fillStyle = this.information.Library.color
                                this.vueCanvas.fillRect(
                                    this.savedGame.construction[i].x,
                                    this.savedGame.construction[i].y,
                                    this.information.Library.width,
                                    this.information.Library.height
                                );
                                this.vueCanvas.stroke();
                                break;
                            case 3:
                                this.vueCanvas.beginPath();
                                this.vueCanvas.fillStyle = this.information.Defender.color
                                this.vueCanvas.fillRect(
                                    this.savedGame.construction[i].x,
                                    this.savedGame.construction[i].y,
                                    this.information.Defender.width,
                                    this.information.Defender.height
                                );
                                this.vueCanvas.stroke();
                                break;
                        }
                    }
                }
            },
            checkPrice(type) {
                // pay for the building with resources
                let rocksTotal = this.gameProgress.resources.rocks
                let magicTotal = this.gameProgress.resources.magic
                let totalCost = null;

                switch (type) {
                    case "Quarry":
                        totalCost = this.calculatePrice(this.information.Quarry)
                        if (totalCost[0] > rocksTotal || totalCost[1] > magicTotal) {
                            alert("You don't have enough resources to build any quarries")
                            return false;
                        } else {
                            this.gameProgress.resources.rocks = rocksTotal - totalCost[0]
                            this.gameProgress.resources.magic = magicTotal - totalCost[1]
                        }
                        break;
                    case "Library":
                        totalCost = this.calculatePrice(this.information.Library)
                        if (totalCost[0] > rocksTotal || totalCost[1] > magicTotal) {
                            alert("No one is going to build a library for free, brah")
                            return false;
                        } else {
                            this.gameProgress.resources.rocks = rocksTotal - totalCost[0]
                            this.gameProgress.resources.magic = magicTotal - totalCost[1]
                        }
                        break;
                    case "Defender":
                        totalCost = this.calculatePrice(this.information.Defender)
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

                // TODO: Fix this so there's a better default value.
                let type = this.value.title ? this.value.title : "test"

                // We need to work out the cost/payment issue here, and adjust totals accordingly.
                if (this.checkPrice(type) === false) {
                    return;
                }

                switch (type) {
                    case "Quarry":
                        width = 10
                        height = 20
                        colour = this.information.Quarry.color
                        this.gameProgress.buildings.quarry++
                        this.gameProgress.score++
                        break;
                    case "Library":
                        width = 30
                        height = 30
                        colour = this.information.Library.color
                            this.gameProgress.buildings.libraries++
                        this.gameProgress.score++
                        break;
                    case "Defender":
                        width = 5
                        height = 5
                        colour = this.information.Defender.color
                        this.gameProgress.buildings.defenders++
                        this.gameProgress.score += 10
                        break;
                    default:
                        width = 1
                        height = 1
                        colour = 'black'
                }

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
                // TODO: Make sure these are stored correctly, since they'll be used when
                // TODO: the game restarts to map the elements back on the canvas.
                this.gameProgress.construction.push({
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
                this.$emit('clicked')
            },
            addToProgress(value) {
                this.timer = value
                this.addResources()
                this.initiateRandomEvent()

                if (value === 4) {
                    this.preventGameClock()
                }

                if (value === 2) {
                    this.alienWarning()
                }
                if (value === 0) {
                    this.alienAttack()
                    this.resetTimer()
                }
            },
            preventGameClock() {
                this.gameProgress.resetClock = false
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
                // TODO: initiate new 'events' at certain periods. Eg. townspeople demanding something.
            },
            openingEvent() {
                // TODO: Like the random event, but takes place at the start of the game (if a new game!)
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
                // If the town survives:
                this.gameProgress.attacksSurvived++
            },
            resetTimer(value) {
                this.gameProgress.resetClock = true
            },
            rollDice() {
                return Math.floor(Math.random() * (6 - 1 + 1)) + 1;
            },
            saveProgress() {
                axios.post('/game-progress', this.gameProgress).then(response => {
                    alert('Game saved!');
                });
                this.logoff()
            },
            logoff() {
                axios.post(this.logout).then(response => {
                    window.location.href = '/login'
                })
            }
        }
    }
</script>
