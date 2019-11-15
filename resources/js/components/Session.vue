<template>
    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">{{ sessionName }}</h2>
            </div>
        </div>
        <div class="p-5">
            <div class="d-flex flex-row justify-content-center" style="font-size: 1.2rem">
                <span class="mr-auto mb-auto d-flex align-items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <vue-countdown-timer
                            @start_callback="startCallBack('event started')"
                            @end_callback="endCallBack('event ended')"
                            :start-time="startTime"
                            :end-time="endTime"
                            :showZero="false"
                            :interval="1000"
                            label-position="begin"
                            :end-text="'Time is up!'">

                        <template slot="countdown" slot-scope="scope">
                            <div class="align-self-center" style="font-weight: 500">
                                    <span>{{scope.props.minutes}}:{{scope.props.seconds}}</span>
                            </div>
                        </template>

                    </vue-countdown-timer>
                    <i class="fas fa-list ml-4"></i>
                    <span class="ml-2">{{ index+1 }}/{{ numberOfQuestions }}</span>
                    <i class="fas fa-info ml-4"></i>
                    <span class="ml-2">{{ interactiveCaseName }}</span>
                </span>
                <button type="button" data-toggle="modal" data-target="#exampleModal2" @click="end" class="btn btn-danger" href="#"><i class="fas fa-times mr-2"></i>End</button>
            </div>
            <div class="d-flex justify-content-center my-4">
                <img :src="'/' + patientCharacterPath" alt="Patient image goes here.." style="width: 30%;"/>
            </div>
            <div class="row text-center">
                <div class="col-12 jumbotron py-2" style="padding: 0;width: 100%">
                    <p class="m-0" style="font-size: 1rem">{{ currentQuestion['patientAnswer'] }}</p>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column justify-content-center">
                <div class="form-group p-2" style="font-size: 1.3rem">
                    <label for="exampleFormControlTextarea1">Answer</label>
                    <textarea v-model="studentAnswer" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write the answer.."></textarea>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <button style="width: 15%;" @click="previous" :disabled="index === 0" class="btn btn-dark"><i class="fa fa-angle-left mr-2 font-weight-bolder"></i>Previous</button>
                <button style="width: 15%;" @click="next" :hidden="index >= numberOfQuestions-1" class="btn btn-dark">Next <span v-if="index < numberOfQuestions-1"><i class="fa fa-angle-right ml-2 font-weight-bolder"></i></span></button>
                <button
                        type="button"
                        data-toggle="modal" data-target="#exampleModal2"
                        style="width: 15%;"
                        @click="finish"
                        v-if="index === numberOfQuestions-1"
                        class="btn btn-primary">Finish <span v-if="index === numberOfQuestions-1"><i class="fa fa-check ml-2 font-weight-bolder"></i></span></button>
            </div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Result</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>Your result is</h3>
                        <p class="lead" style="color: dodgerblue; font-weight: 500;">{{score}} points</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                        <button type="button" class="btn btn-primary" @click="" data-dismiss="modal">Redo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Vue from 'vue';
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    // Init plugin
    Vue.use(Loading);

    //import myRuleBased from '../ScriptRuleBased.js';
    let myRuleBased = require('../ScriptRuleBased');

    export default {
        name: "Session",
        props: ["sessionId", "sessionName", "interactiveCaseId"],
        data() {
            return {
                axiosResponse: false,

                interactiveCaseName: '',
                patientGender: '',
                patientAge: 0,
                patientCharacterPath: '/assets/male/healthy.png',
                numberOfQuestions: 0,
                time: 0,
                questions: {},
                studentAnswers: [],
                startTime: '',
                endTime: '',

                index: 0, // index of current question
                currentQuestion: {},
                studentAnswer: '',

                score: 0
            }
        },
        beforeMount() { // make the api call before mounting the component.

            // show a spinner while fetching data from the server
            let loader = this.$loading.show({
                // Optional parameters
                container: null,
                color: 'dodgerblue',
                zIndex: 999,
                loader: 'spinner',
            });
            // make the api call.
            this.axios.get("/interactive-case/"+ this.interactiveCaseId)
                .then(response => {
                    this.interactiveCaseName = response.data.interactiveCaseName;
                    this.patientGender = response.data.patientGender;
                    this.patientAge = response.data.patientAge;
                    this.patientCharacterPath = response.data.patientCharacterPath;
                    this.numberOfQuestions = response.data.numberOfQuestions;
                    this.time = response.data.time;
                    let questionsString = response.data.questions;
                    this.questions = JSON.parse(questionsString);
                    this.axiosResponse = true;
                })
                .catch(e => {
                    console.error(e);
                });

            // hide the spinner.
            setTimeout(() => {
                loader.hide()
            },1000);
        },
        mounted() {

        },
        methods: {
            startCallBack: function (x) {
                console.log(x)
            },
            endCallBack: function (x) {
                console.log(x)
            },
            next() {
                // show a spinner while fetching data from the server
                let loader = this.$loading.show({
                    // Optional parameters
                    container: null,
                    color: 'dodgerblue',
                    zIndex: 999,
                    loader: 'spinner',
                });
                if (this.index < (this.numberOfQuestions-1)) {
                    this.index++;
                }

                // hide the spinner.
                setTimeout(() => {
                    loader.hide()
                },500);

                window.scroll(0, 0);
            },
            previous() {
                // show a spinner while fetching data from the server
                let loader = this.$loading.show({
                    // Optional parameters
                    container: null,
                    color: 'dodgerblue',
                    zIndex: 999,
                    loader: 'spinner',
                });

                if (this.index > 0) {
                    this.index--;
                }

                // hide the spinner.
                setTimeout(() => {
                    loader.hide()
                },500);

                window.scroll(0, 0);
            },
            finish: function () {
                this.calculateScore();
                window.scroll(0, 0);
            },
            end: function() {
                this.calculateScore();
                window.scroll(0, 0);
            },
            calculateScore() {
                this.score = myRuleBased.getScore(this.studentAnswers, this.questions);
            }
        },
        watch: {
            axiosResponse() {
                let today = new Date();
                let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                this.startTime = date + ' ' + time;
                if (today.getMinutes()+this.time >= 60) {
                    this.endTime = date + ' ' + Math.floor(today.getHours()+((today.getMinutes() + this.time)/60)).toString()+ ":" + (((today.getMinutes() + this.time)%60))+ ":" + today.getSeconds();
                } else {
                    this.endTime = date + ' ' + today.getHours()+ ":" + ((today.getMinutes()+this.time)) + ":" + today.getSeconds();
                }

                // set current question
                this.currentQuestion = this.questions[this.index];
            },
            index() {
                this.currentQuestion = this.questions[this.index];
                this.studentAnswer = this.studentAnswers[this.index];
            },
            studentAnswer() {
                this.studentAnswers[this.index] = this.studentAnswer;
            }
        }
    }
</script>

<style scoped>

</style>
