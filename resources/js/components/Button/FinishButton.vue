<template>
    <div>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal2">
            <i class="fas fa-check mr-2"></i>
            Finish
        </button>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Submit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure that you want to submit?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="submit" data-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="success" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header" style="background: dodgerblue; color: #fff;">
                        <h5 class="modal-title">Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        You added the interactive case successfully.
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

    export default {
        name: "FinishButton",
        data() {
            return {

            }
        },
        methods: {
            submit() {
                let data = new FormData();

                // Add information to data

                // Get general data
                /* From PatientForm.vue */
                data.append('interactiveCaseName', this.$cookies.get('patientCookie@name'));
                data.append('patientGender', this.$cookies.get('patientCookie@gender'));
                data.append('patientAge', this.$cookies.get('patientCookie@age'));
                data.append('patientCharacterPath', this.$cookies.get('patientCookie@virtualCharacter'));
                /* From InteractiveCaseForm.vue */
                data.append('numberOfQuestions', this.$cookies.get('patientCookie@numberOfQuestion'));
                data.append('time', this.$cookies.get('patientCookie@time'));
                /* From InteractiveCaseForm.vue */
                // Get numberOfQuestions
                let numberOfQuestions = this.$cookies.get('patientCookie@numberOfQuestion');

                // For each question, we take information
                for (let i = 1; i <= numberOfQuestions; i++) {
                    // Get patient Answer
                    data.append('patientAnswer' + i, this.$cookies.get('patientCookie@patientAnswer' + i));
                    // Get primary question
                    data.append('primaryQuestion' + i, this.$cookies.get('patientCookie@question' + i));
                    // Get primary question keywords
                    data.append('primaryKeywords' + i, this.$cookies.get('patientCookie@keywords' + i));
                    // Get the related questions
                    data.append('relatedQuestions' + i, this.$cookies.get('patientCookie@relatedQuestions' + i));
                }

                let loader = this.$loading.show({
                    // Optional parameters
                    container: null,
                });

                // make the ajax call
                this.axios.post("/create-interactive-case/add", data)
                    .then(async response => {
                        setTimeout(() => {
                            loader.hide()
                        },500);
                        if (response.data === 'OK.') {
                            console.log('OK.');
                            $('#success').modal('show');
                        } else {
                            console.error('Error:', response.data);
                        }
                    })
                    .catch(e => {
                        console.error(e);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
