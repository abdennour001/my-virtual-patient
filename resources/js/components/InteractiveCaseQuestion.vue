<template>
    <div class="card">
        <div class="row text-center mt-4">
            <div class="col-12">
                <h4 style="color: dodgerblue;">Question {{ questionIndex }}</h4>
            </div>
        </div>
        <div class="px-5">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Patient answer</label>
                <textarea v-model="patientAnswer" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write the patient answer.."></textarea>
            </div>

<!--        Standard Question    -->

            <div class="pb-2">
                <h5 style="color: dodgerblue;">Standard question:</h5>
            </div>
            <div class="form-group row">
                <label :for="'standardQuestion' + questionIndex" class="col-sm-4 col-form-label">Question</label>
                <div class="col-sm-8">
                    <input v-model="question" type="text" class="form-control" :id="'standardQuestion' + questionIndex" placeholder="Enter the question..">
                </div>
            </div>
            <form v-on:submit.prevent="addNewKeyword">
                <div class="form-group row">
                    <label :for="'new-keyword' + questionIndex" class="col-4 col-sm-4 col-form-label">Keywords</label>
                    <div class="col-6 col-sm-6">
                        <input
                                class="form-control"
                                v-model="newKeyword"
                                :id="'new-keyword' + questionIndex"
                                placeholder="Add new Keyword"
                        >
                    </div>
                    <div class="col-2 text-right">
                        <button class="btn btn-add-keyword"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="col-8 offset-4 mt-2">
                        <div class="d-flex">
                            <div
                                    v-for="(keyword, index) in keywords"
                                    v-bind:key="keyword.id"
                            >
                                <div class="d-flex align-items-center keyword">
                                    {{ keyword.text }}
                                    <button v-on:click.prevent="removeKeyword(index)"
                                            class="btn"
                                            style="color: white;"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <hr>

<!--        Related Questions        -->

           <div class="d-flex justify-content-between align-items-baseline pb-2 mb-2">
               <div>
                   <h5 style="color: dodgerblue;">Related questions:</h5>
               </div>
               <button class="btn btn-add" @click.prevent="addNewRelatedQuestion"><i class="fas fa-plus mr-2"></i>Add new related question</button>
           </div>
            <div class="form-group row">
                <label :for="'relatedQuestion' + questionIndex" class="col-sm-4 col-form-label">Question</label>
                <div class="col-sm-8">
                    <input v-model="newRelatedQuestion" type="text" class="form-control" :id="'relatedQuestion' + questionIndex" placeholder="Enter the question..">
                </div>
            </div>
            <form v-on:submit.prevent="addNewKeywordRelated">
                <div class="form-group row">
                    <label :for="'new-keyword-related' + questionIndex" class="col-4 col-sm-4 col-form-label">Keywords</label>
                    <div class="col-6 col-sm-6">
                        <input
                                class="form-control"
                                v-model="newKeywordRelated"
                                :id="'new-keyword-related' + questionIndex"
                                placeholder="Add new Keyword"
                        >
                    </div>
                    <div class="col-2 text-right">
                        <button class="btn btn-add-keyword"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="col-8 offset-4 mt-2">
                        <div class="d-flex">
                            <div
                                    v-for="(keyword, index) in keywordsRelated"
                                    v-bind:key="keyword.id"
                            >
                                <div class="d-flex align-items-center keyword">
                                    {{ keyword.text }}
                                    <button v-on:click.prevent="removeKeywordRelated(index)"
                                            class="btn"
                                            style="color: white;"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="d-flex flex-column">
                            <div
                                    v-for="(relatedQuestion, index) in relatedQuestions"
                                    v-bind:key="relatedQuestion.id"
                            >
                                <div class="d-flex justify-content-between align-items-center related-question">
                                    <div class="d-flex flex-column align-items-baseline justify-content-center">
                                        <p class="lead m-0">{{ relatedQuestion.question }}</p>
                                        <div class="d-flex">
                                            <div
                                                    v-for="keyword in relatedQuestion.keywords"
                                                    v-bind:key="keyword.id"
                                            >
                                                <div class="d-flex align-items-center keyword-show mt-2">
                                                    {{ keyword.text }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button v-on:click.prevent="removeRelatedQuestion(index)"
                                            class="btn align-self-start"
                                            style="color: dodgerblue;"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InteractiveCaseQuestion",
        data() {
            return {
                componentToken: this.questionIndex,
                patientAnswer: this.$cookies.isKey("patientCookie@patientAnswer" + this.questionIndex) ? this.$cookies.get("patientCookie@patientAnswer" + this.questionIndex) : '',
                question: this.$cookies.isKey('patientCookie@question' + this.questionIndex) ? this.$cookies.get('patientCookie@question' + this.questionIndex) : '',
                newKeyword: this.$cookies.isKey('patientCookie@newKeyword' + this.questionIndex) ? this.$cookies.get('patientCookie@newKeyword' + this.questionIndex) : '',
                keywords: this.$cookies.isKey('patientCookie@keywords' + this.questionIndex) ? JSON.parse(this.$cookies.get('patientCookie@keywords' + this.questionIndex)) : [],
                nextKeyword: this.$cookies.isKey('patientCookie@nextKeyword' + this.questionIndex) ? this.$cookies.get('patientCookie@nextKeyword' + this.questionIndex) : 0,
                newKeywordRelated: this.$cookies.isKey('patientCookie@newKeywordRelated' + this.questionIndex) ? this.$cookies.get('patientCookie@newKeywordRelated' + this.questionIndex) : '',
                keywordsRelated: this.$cookies.isKey('patientCookie@keywordsRelated' + this.questionIndex) ? JSON.parse(this.$cookies.get('patientCookie@keywordsRelated' + this.questionIndex)) : [],
                nextKeywordRelated: this.$cookies.isKey('patientCookie@nextKeywordRelated' + this.questionIndex) ? this.$cookies.get('patientCookie@nextKeywordRelated' + this.questionIndex) : 0,
                newRelatedQuestion: this.$cookies.isKey('patientCookie@newRelatedQuestion' + this.questionIndex) ? this.$cookies.get('patientCookie@newRelatedQuestion' + this.questionIndex) : '',
                relatedQuestions: this.$cookies.isKey('patientCookie@relatedQuestions' + this.questionIndex) ? JSON.parse(this.$cookies.get('patientCookie@relatedQuestions' + this.questionIndex)) : [],
                nextQuestion: this.$cookies.isKey('patientCookie@nextQuestion' + this.questionIndex) ? this.$cookies.get('patientCookie@nextQuestion' + this.questionIndex) : 0,
            }
        },
        props: ['questionIndex'],
        mounted() {

        },
        methods: {
            addNewKeyword: function () {
                if (this.newKeyword !== '') {
                    this.keywords.push({
                        id: this.nextKeyword++,
                        text: this.newKeyword
                    });
                    this.newKeyword = ''
                }
            },
            removeKeyword: function(index) {
                this.keywords.splice(index, 1)
            },
            addNewKeywordRelated: function () {
                if (this.newKeywordRelated !== '') {
                    this.keywordsRelated.push({
                        id: this.nextKeywordRelated++,
                        text: this.newKeywordRelated
                    });
                    this.newKeywordRelated = ''
                }
            },
            removeKeywordRelated: function(index) {
                this.keywordsRelated.splice(index, 1)
            },
            addNewRelatedQuestion: function() {
                if (this.newRelatedQuestion !== '') {
                    this.relatedQuestions.push({
                        id: this.nextQuestion++,
                        question: this.newRelatedQuestion,
                        keywords: this.keywordsRelated
                    });
                    this.newRelatedQuestion = '';
                    this.keywordsRelated = []
                }
            },
            removeRelatedQuestion: function (index) {
                this.relatedQuestions.splice(index, 1);
            },
            clearCookies() {
                this.$cookies.remove("patientCookie@patientAnswer" + this.componentToken);
                this.$cookies.remove("patientCookie@question" + this.componentToken);
                this.$cookies.remove("patientCookie@newKeyword" + this.componentToken);
                this.$cookies.remove("patientCookie@keywords" + this.componentToken);
                this.$cookies.remove("patientCookie@nextKeyword" + this.componentToken);
                this.$cookies.remove("patientCookie@newKeywordRelated" + this.componentToken);
                this.$cookies.remove("patientCookie@keywordsRelated" + this.componentToken);
                this.$cookies.remove("patientCookie@nextKeywordRelated" + this.componentToken);
                this.$cookies.remove("patientCookie@newRelatedQuestion" + this.componentToken);
                this.$cookies.remove("patientCookie@relatedQuestions" + this.componentToken);
                this.$cookies.remove("patientCookie@nextQuestion" + this.componentToken);
            }
        },
        watch: {
            patientAnswer: function(newValue) {
                this.$cookies.set('patientCookie@patientAnswer' + this.componentToken, newValue);
            },
            question: function(newValue) {
                this.$cookies.set('patientCookie@question' + this.componentToken, newValue);
            },
            newKeyword: function(newValue) {
                this.$cookies.set('patientCookie@newKeyword' + this.componentToken, newValue);
            },
            keywords: {
                handler: function(newValue, oldValue) {
                        this.$cookies.set('patientCookie@keywords' + this.componentToken, JSON.stringify(this.keywords));
                },
                deep: true
            },
            nextKeyword: function(newValue) {
                this.$cookies.set('patientCookie@nextKeyword' + this.componentToken, newValue);
            },
            newKeywordRelated: function(newValue) {
                this.$cookies.set('patientCookie@newKeywordRelated' + this.componentToken, newValue);
            },
            keywordsRelated: function(newValue) {
                this.$cookies.set('patientCookie@keywordsRelated' + this.componentToken, JSON.stringify(this.keywordsRelated));
            },
            nextKeywordRelated: function(newValue) {
                this.$cookies.set('patientCookie@nextKeywordRelated' + this.componentToken, newValue);
            },
            newRelatedQuestion: function(newValue) {
                this.$cookies.set('patientCookie@newRelatedQuestion' + this.componentToken, newValue);
            },
            relatedQuestions: function(newValue) {
                this.$cookies.set('patientCookie@relatedQuestions' + this.componentToken, JSON.stringify(this.relatedQuestions));
            },
            nextQuestion: function(newValue) {
                this.$cookies.set('patientCookie@nextQuestion' + this.componentToken, newValue);
            }
        },
        destroyed() {
            this.clearCookies();
        }
    }
</script>

<style scoped>

    .keyword {
        color: white;
        background: #23272b;
        padding-left: .5rem;
        margin: .2rem;
        border-radius: 5px;
    }
    .keyword-show {
        color: white;
        background: #23272b;
        padding: .3rem;
        border-radius: 5px;
        margin-right: .2rem;
        margin-top: .2rem;
    }
    .related-question {
        color: #000;
        /*border: 2px dashed dodgerblue;*/
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        padding-left: 1rem;
        padding-bottom: .5rem;
        margin-top: .4rem;
        margin-bottom: .4rem;
        transition: 0.5s ease;
    }
    .related-question:hover {
        cursor: pointer;
        box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.3);
    }
    .btn-add {
        color: dodgerblue;
        background: transparent;
        border: 1px solid dodgerblue;
        transition: 0.5s ease;
    }
    .btn-add:hover {
        color: white;
        background: dodgerblue;
        border: 1px solid dodgerblue;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    }
    .btn-add:active {
        background: #1d79e2;
    }
    .btn-add-keyword {
        color: white;
        background: dodgerblue;
        border: 1px solid dodgerblue;
        transition: 0.5s ease;
    }
    .btn-add-keyword:hover {
        background: #1f79e4;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    }
    .btn-add-keyword:active {
        background: #1e6bd4;
    }

</style>
