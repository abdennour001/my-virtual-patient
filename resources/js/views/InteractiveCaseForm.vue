<template>
    <div>
        <form class="p-5">
            <div class="form-group row">
                <label for="numberOfQuestions" class="col-sm-4 col-form-label">Number of questions</label>
                <div class="col-sm-8">
                    <input v-model="numberOfQuestions" type="number" class="form-control" id="numberOfQuestions" placeholder="Enter number of questions..">
                </div>
            </div>
            <div class="form-group row">
                <label for="time" class="col-sm-4 col-form-label">Time</label>
                <div class="col-sm-8">
                    <input v-model="time" type="number" class="form-control" id="time" placeholder="Enter time in minutes..">
                </div>
            </div>

            <div>
                <interactive-case-question
                        v-for="question in parseInt(numberOfQuestions)"
                        v-bind:questionIndex="question"
                        v-bind:key="question"
                        class="mb-4"
                ></interactive-case-question>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                numberOfQuestions: this.$cookies.isKey('patientCookie@numberOfQuestion') ? this.$cookies.get('patientCookie@numberOfQuestion') : 1,
                time: this.$cookies.isKey('patientCookie@time') ? this.$cookies.get('patientCookie@time') : 30,
            }
        },
        watch: {
            numberOfQuestions: function(newValue) {
                this.$cookies.set('patientCookie@numberOfQuestion', newValue);
            },
            time: function (newValue) {
                this.$cookies.set('patientCookie@time', newValue);
            }
        }
    }
</script>
