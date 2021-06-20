<template>
    <div>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="vue-modal-backdrop" v-show="isModalVisible">
            <div class="vue-modal" role="dialog" aria-labelledby="modalTitle">
                <header class="vue-modal-header">
                    Message
                    <span class="btn fa fa-window-close" @click="closeModal"></span>
                </header>
                <div class="vue-modal-body" v-if="message === 'success'">
                    Submitted successfully
                </div>
                <div class="vue-modal-body" v-if="message === 'failed'">
                    Something went wrong please try again
                </div>
                <section class="vue-modal-footer">
                   <div class="float-right">
                       <button type="button" @click="closeModal" CLASS="btn-close">Close</button>
                   </div>
                </section>
            </div>
        </div>
        <button type="button"@click="error()"> Show </button>

        <form v-on:submit.prevent="check()">
            <div v-if="errors.length" v-model="errors" class="vue-modal">
                <b>Please correct the following error(s):</b>
                <div v-for="(error, index) in errors" class="alert-danger">
                    <header class="vue-modal-header">
                        {{error}} <span class="btn fa fa-window-close" @click="closeError(index)"></span>
                    </header>

                </div>
            </div>

        <div class="form-group">
            <label v-bind:for="subject">Subject</label>
            <select v-model="subject" class="form-control">
                <option v-for="(subject,k) in subjects" :key="k">
                    {{subject.name}}
                </option>
            </select>
            <label>Class</label>
            <select v-model="form" class="form-control">
                <option v-for="(form,k) in subjects" :key="k">
                    {{form.form_id}}
                </option>
            </select>

            <label class="col-form-label"> Duration</label>
            <input class="form-control" v-model="duration" type="text">

        </div>
        <h3 class="justify-content-center"> Questions</h3>
        <div class="form-group" v-for="(input,k)  in inputs" :key="k">

            <label>Question{{k + 1}}</label><input type="text" class="form-control" v-model="input.question">
                <div class="row">
                    <div class="col">
                    <label>Option 1</label><input type="radio" v-bind:value="input.option1"  v-model="input.answer" v-bind:name=k><input type="text" class="form-control" v-model="input.option1">
                    </div>
                    <div class="col">
                    <label>Option 2</label><input type="radio" v-bind:value="input.option2" v-model="input.answer" v-bind:name=k><input type="text" class="form-control" v-model="input.option2">
                    </div>
                    <div class="col">
                    <label>Option 3</label><input class="form-checkbox" type="radio" v-bind:value="input.option3" v-model="input.answer" v-bind:name=k><input type="text" class="form-control" v-model="input.option3">
                    </div>
                    <div class="col">
                    <label>Option 4</label><input type="radio"  v-bind:value="input.option4" v-model="input.answer" v-bind:name=k ><input type="text" class="form-control" v-model="input.option4">
                    </div>
                </div>
                <div>
                        <span>
                            <i class="fa fa-plus-circle" @click="add()" v-show="k == inputs.length-1">
                                Add field
                            </i>
                            <i class="fa fa-minus-circle" @click="remove(k)" v-show="k == inputs.length || (k && inputs.length > 1)">
                               Remove field
                            </i>
                        </span>
        </div>
            </div>
        <button class="btn-primary ml-3 align-content-center justify-content-center"  v-on:submit.prevent="check()">Submit</button>

        </form>
    </div>
</template>

<script>
    export default {
        props: {
            subjects: {},
        },
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {

                inputs: [{
                    question: '',
                    option1: '',
                    option2: '',
                    option3: '',
                    option4: '',
                    answer: '',
                }],
                message:'',
                isModalVisible: false,

                subject: '',
                form: '',
                duration: '',
                errors: [],
                i: [],

            }
        },
        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        console.log(response.data);
                    });
            },
            add() {
                this.inputs.push({
                    question: '',
                    option1: '',
                    option2: '',
                    option3: '',
                    option4: '',
                    answer: '',
                })

            },
            remove(index) {
                this.inputs.splice(index, 1)
            },
            submit(e) {


            },
            close(){
                this.$emit('close')
            },
            showModal(){
                this.isModalVisible = true;
            },
            closeModal(){
                this.isModalVisible = false;
            },
            error(){
                this.errors.push("Invalid error");
            },
            closeError(index){
                this.errors.splice(index, 1)
            },
            check() {

                let response = this.inputs;

                this.errors = [];
                if (!this.subject) {
                    this.errors.push(" subject fields empty")
                }
                if (!this.form) {
                    this.errors.push(" form fields empty");
                }
                if (!this.duration) {
                    this.errors.push(" duration fields empty")
                }


                if (response.length) {
                    let i = 0;
                    for (let data in this.inputs) {
                        if (!response[data].question) {

                            this.errors.push("Question" + " " + parseInt(i + 1) + " " + "number is not filled");

                        }
                        if (!response[data].option1) {

                            this.errors.push("Option 1" + " " + parseInt(i + 1) + " " + "number is not filled");

                        }
                        if (!response[data].option2) {

                            this.errors.push("Option 2" + " " + parseInt(i + 1) + " " + "number is not filled");

                        }
                        if (!response[data].option3) {

                            this.errors.push("Option 3" + " " + parseInt(i + 1) + " " + "number is not filled");

                        }
                        if (!response[data].option4) {

                            this.errors.push("Option 4" + " " + parseInt(i + 1) + " " + "number is not filled");

                        }
                        if (!response[data].answer) {

                            this.errors.push("Answer for Question number  " + " " + parseInt(i + 1) + " " + "not choosen");

                        }

                        i++
                    }
                }

                if (this.errors.length === 0) {
                    axios.post('/create-test/' + this.subject + '/' + this.form + '/' + this.duration + '/', {my_props: JSON.stringify(this.inputs)})
                        .catch(error =>{
                            console.log(error);
                        }).then(response => {
                            this.message = response.data.message;
                            this.showModal();
                        })
                }
                else {

                }

            },

        },
    }
</script>
<style>

</style>