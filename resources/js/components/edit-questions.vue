<template>
    <div>
        <div >
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
            <form action="">
                <div v-if="errors.length" v-model="errors" class="vue-modal">
                    <b>Please correct the following error(s):</b>
                    <div v-for="(error, index) in errors" class="alert-danger">
                        <header class="vue-modal-header">
                            {{error}} <span class="btn fa fa-window-close" @click="closeError(index)"></span>
                        </header>

                    </div>
                </div>
                <select class="form-control"  v-on:change="changeSubject($event)">
                    <option v-for="(sub, k) in subjects" :key="k" v-bind:selected="subject === sub.name" v-bind:value="sub.id" >
                        {{sub.name}}
                    </option>
                </select>
                <select class="form-control" v-on:change=changeForm($event)>
                    <option v-for="(formm, k) in forms" :key="k" v-bind:selected="form === formm.name" v-bind:value="formm.id">
                        {{formm.name}}
                    </option>
                </select>
                <input type="text" v-model="duration" class="form-control">
                <div v-for="(question, k) in inputs" :key="k">
                Question {{k + 1}} <input type="text" v-model="question.question" v-on:change="changeQuestion()" class="form-control">
               <div class="form-group row">

                        <div class="col">
                        <label>Option 1</label><input type="radio" v-on:change="changeAnswer(k,$event)" v-bind:value="question.option1" v-bind:name="k" :checked="question.option1 === question.answer">
                        <input type="text" class="form-control" v-model="question.option1"  name="option1" v-on:change="changeOption(k,$event)">
                        </div>
                        <div class="col">
                        <label>Option 2</label><input type="radio" v-on:change="changeAnswer(k,$event)" v-bind:name="k"  v-bind:value="question.option2"  :checked="question.option2 === question.answer">
                        <input type="text" class="form-control" v-model="question.option2"  name="option2" v-on:change="changeOption(k,$event)">
                        </div>
                   <div class="col">
                        <label>Option 3</label><input class="form-checkbox" v-on:change="changeAnswer(k,$event)" v-bind:value="question.option3" v-bind:name="k" type="radio"  v-bind:checked="question.option3 === question.answer">
                        <input type="text" class="form-control" v-model="question.option3"  name="option3" v-on:change="changeOption(k,$event)">
                   </div>
                   <div class="col">
                        <label>Option 4</label><input type="radio" v-on:change="changeAnswer(k,$event)" v-bind:value="question.option2" v-bind:name="k" v-bind:checked="question.option4 === question.answer">
                        <input type="text" class="form-control" v-model="question.option4" name="option4" v-on:change="changeOption(k,$event)">
                    </div>
               </div>
                <span>
                        <i class="fa fa-plus-circle" @click="add()" v-show="k == inputs.length-1">
                            Add field
                        </i>
                        <i class="fa fa-minus-circle" @click="remove(k)" v-show="k == inputs.length || (k && inputs.length > 1)">
                               Remove field
                        </i>
                    </span>

                <div>
                </div>
                </div>

                <button type="button" class="btn btn-success" @click="submit">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['questions','exams','forms','subjects'],
        mounted() {
            console.log('Component mounted.');
        },
        data: function(){
            return{
            inputs: [],
            isModalVisible: false,
            message:'',
            errors:[],
            subject:'',
            form:'',
            duration:'',
            removed:[],
            subject_id:'',
            form_id:'',
            test_id:'',
            }
        },
        methods:{
            followUser(){
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        console.log(response.data);
                    });
            },
            changeAnswer(k,event){
                this.inputs[k].answer = event.target.value;
                console.log(this.inputs[k].answer);
            },
            changeQuestion(){
               console.log(this.inputs[0])
                // this.inputs[k].question = event.target.value;
                //console.log(this.inputs[k].question);
            },
            changeOption(k,event){
              let optionType = event.target.name;
              this.inputs[k].optionType = event.target.value;
                console.log(this.inputs[k].optionType);
            },
            changeSubject(event){
                this.subject_id = event.target.value;
                console.log(this.subject_id);
            },
            changeForm(event){
                this.form_id = event.target.value;
                console.log(this.form_id);
            },
            add() {
                this.inputs.push({
                    id:'',
                    question: '',
                    option1: '',
                    option2: '',
                    option3: '',
                    option4: '',
                    answer: '',
                });
                console.log(this.inputs.length);

            },
            remove(index) {
                if(this.inputs[index].id === ''){
                    console.log("empty");
                }else{
                    this.removed.push(this.inputs[index].id);
                    console.log("not empty");
                }
                this.inputs.splice(index, 1)
            },
            showModal(){
                this.isModalVisible = true;
            },
            closeModal(){
                this.isModalVisible = false;
            },
            closeError(index){
                this.errors.splice(index, 1)
            },
            submit(){
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
                    axios.post('/update-test/'+ this.test_id + '/' + this.subject_id + '/' + this.form_id + '/' + this.duration + '/', {my_props: JSON.stringify(this.inputs),del: JSON.stringify(this.removed)})
                        .catch(error =>{
                            console.log(error);
                        }).then(response => {
                        this.message = response.data.message;
                        this.showModal();
                        //console.log(response.data.message);
                    })
                }
                else {

                }
            }
        },
        created(){
            this.inputs = this.questions;
            for(let index = 0; index < this.exams.length;index++){
                this.form =this.exams[index].form.name;
                this.test_id = this.exams[index].id;
                this.subject = this.exams[index].subject.name;
                this.subject_id = this.exams[index].subject.id;
                this.form_id = this.exams[index].form.id;
                const duration =new Date(this.exams[index].duration);
                this.duration = duration.getMinutes();
            }
            //this.exams.forEach(element => this.subject=element.subject.name);


        },

        computed:{
            buttonText(){
                return (this.status) ? 'unfollow' : 'follow';
            },
        },

    }
</script>
