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
                        <button type="button" class="btn btn-primary" @click="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FinishButton",
        methods: {
            submit() {
                let data = new FormData();

                // Add information to data

                // Get general data
                /* From PatientForm.vue */
                data.append('interactiveCaseName', this.$cookies.get('patientCookie@name'));
                data.append('patientGender', this.$cookies.get('patientCookie@gender'));
                data.append('patientAge', this.$cookies.get('patientCookie@age'));
                /* From InteractiveCaseForm.vue */
                data.append('numberOfQuestions', this.$cookies.get('patientCookie@numberOfQuestion'));
                data.append('time', this.$cookies.get('patientCookie@time'));
                /* From InteractiveCaseForm.vue */
                // Get numberOfQuestions
                let numberOfQuestions = this.$cookies.get('patientCookie@numberOfPatient');

                // Get patient Answer
                data.append('patientAnswer', this.$cookies.get('patientCookie@patientAnswer'));
                // Get primary question
                data.append('primaryQuestion', this.$cookies.get('patientCookie@question'));
                // Get primary question keywords
                data.append('primaryKeywords', JSON.parse(this.$cookies.get('patientCookie@keywords')));

                // For each question, we take information
                for (let i = 1; i <= numberOfQuestions; i++) {
                    data.append('relatedQuestion' + i, JSON.parse(this.$cookies.get('patientCookie@relatedQuestions')));
                }

                // make the ajax call
                this.axios.post("/create-interactive-case/add", data)
                    .then(async response => {
                        console.log(response);
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
