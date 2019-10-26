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
                    <input type="text" class="form-control" :id="'standardQuestion' + questionIndex" placeholder="Enter the question..">
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
                                                <div class="d-flex align-items-center keyword-show">
                                                    {{ keyword.text }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button v-on:click.prevent="removeRelatedQuestion(index)"
                                            class="btn"
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
                patientAnswer: '',
                newKeyword: '',
                keywords: [],
                nextKeyword: 0,
                newKeywordRelated: '',
                keywordsRelated: [],
                nextKeywordRelated: 0,
                newRelatedQuestion: '',
                relatedQuestions: [],
                nextQuestion: 0,
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
            }
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
        border: 2px dashed dodgerblue;
        border-radius: 5px;
        padding-left: 1rem;
        padding-bottom: .5rem;
        margin-top: .4rem;
        margin-bottom: .4rem;
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
