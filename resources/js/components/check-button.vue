<template>
    <div class="container">
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
        <h2>{{minutes | formatTime}} : {{seconds | formatTime}}</h2>
        <form>
        <div v-for="(ques,k) in questions" :key="k" class="row justify-content-center">
            <div class="col-8">
                <h3 style="text-indent: 5px">
                   {{k + 1}} <label v-bind:for="ques.id">{{ques.question}}
                    </label>
                </h3>
                    <ol type="A">
                        <li><input type="radio" v-bind:name="ques.id" v-bind:value="ques.option1" v-model="picked" v-on:change="handler($event,k)" :checked="1===0">{{ques.option1}}</li>
                        <li><input type="radio" v-bind:name="ques.id" v-bind:value="ques.option2" v-model="picked" v-on:change="handler($event,k)" :checked="1===0">{{ques.option2}}</li>
                        <li><input type="radio" v-bind:name="ques.id" v-bind:value="ques.option3" v-model="picked" v-on:change="handler($event,k)" :checked="1===0">{{ques.option3}}</li>
                        <li><input style="display: flow " type="radio" v-bind:name="ques.id" v-bind:value="ques.option4" v-model="picked" v-on:change="handler($event,k)">{{ques.option4}}</li>
                    </ol>
            </div>


        </div>
        <div class="col-8 justify-content-center">
        <button @click="submit" type="button" class="text-center">SUBMIT</button>
        </div>
        </form>
    </div>


</template>

<script>
    export default {
        props: ['question','test','userId'],
        mounted() {
            console.log('Component mounted.');
            console.log(this.minutes);
            this.startTimer();

        },
        data(){
            return{
                questions:[],
                pagination:{},
                picked:[],
                optionPicked:[],
                answeredQuestions:[],
                answers:[{
                    ques_id:'',
                    ques:'',
                    answer:'',
                    realAnswer:'',
                    remark:'',
                }],
                index:'',
                message:'',
                score:0,
                currentTime: this.test.duration,
                speed:{
                  type:Number,
                  default: 1000,
                },
                duration:'',
                hours:'',
                minutes:'',
                seconds:'',
                interval:'',
                isModalVisible: false,

            }
        },
        created(){
          //this.fetchQuestions();
          this.questions = this.question;
          this.duration = this.test.duration;
          let t = new Date(this.duration);
          this.seconds = t.getSeconds();
          this.minutes = t.getMinutes();
          this.hours = t.getHours();

        },
        watch:{
            seconds(){
                if(this.minutes >= 0 && this.seconds === -1){
                    this.seconds = 59;
                    return this.minutes--;
                }
                if(this.seconds > 10){
                    return '0' + this.seconds
                }
                if(this.minutes === 0 && this.seconds === 0){
                    clearInterval(this.interval);
                    this.submit();
                }
            },
            minutes(){
                if (this.minutes === -1){
                    axios.post('/submit/' + this.userId + '/' +this.test.id + '/' +this.test.subject_id + '/' + this.score + '/', {my_props: JSON.stringify(this.answers)})
                        .then(() => {
                            window.location.replace('/result?answers='+ encodeURIComponent(JSON.stringify(this.answers)))
                        });
                }
            }
        },
        filters:{
          formatTime(value){
              if(value < 10){
                  return "0" + value;
              }
              return value;
          }
        },
        methods:{
            startTimer(){
                if (this.minutes >= 0 && this.seconds === 0 ){
                    this.seconds = 59;
                    this.minutes -= 1;
                  this.interval =  setInterval(()=> ((this.seconds) --),1000);
                }
            },
            showModal(){
                this.isModalVisible = true;
            },
            closeModal(){
                this.isModalVisible = false;
            },
            handler(event,k){

                let optionText = event.target.value;
                let id = event.target.name;
                console.log(id);
                this.picked=[];
                if(!this.answers[k]){
                    if(this.questions[k].answer === optionText){
                        this.answers.splice(k,0,{ques_id:id,ques:this.questions[k],answer:optionText,realAnswer:this.questions[k].answer,remark:'correct'});
                        this.score++;
                        console.log(this.score);
                    }
                    else {
                        this.answers.splice(k,0,{ques_id:id,ques:this.questions[k],answer:optionText,realAnswer:this.questions[k].answer,remark:'incorrect'});
                        console.log(this.score);
                    }

                }
                else{
                    if(this.answers[k].remark === 'incorrect' && this.questions[k].answer === optionText){
                        this.answers.splice(k,1,{ques_id:id,ques:this.questions[k],question, answer:optionText,realAnswer:this.questions[k].answer,remark:'correct'});
                        this.score++;
                        console.log(this.score);
                    }
                    if(this.answers[k].remark === 'correct' && this.questions[k].answer !== optionText){
                        this.answers.splice(k,1,{ques_id:id,ques:this.questions[k],answer:optionText,realAnswer:this.questions[k].answer,remark:'incorrect'});
                        this.score--;
                        console.log(this.score)
                    }
                }
            },
            submit(){
                if(this.questions.length != this.answers.length){
                    alert("You have not answer all the question")
                    let retVal = confirm("Are you sure you want to submit?");
                    if (retVal == true){
                        axios.post('/submit/' + this.userId + '/' +this.test.id + '/' +this.test.subject_id + '/' + this.score + '/', {my_props: JSON.stringify(this.answers)})
                            .then(() => {
                                window.location.replace('/result?answers='+ encodeURIComponent(JSON.stringify(this.answers)))
                            });
                    }
                    else{

                    }
                }
                else{
                    if(this.minutes >= 0){
                        let retVal = confirm( "Are you sure you want to submit. You still have some time left");
                        if(retVal == true){
                            axios.post('/submit/' + this.userId + '/' +this.test.id + '/' +this.test.subject_id + '/' + this.score + '/', {my_props: JSON.stringify(this.answers)})
                                .then(() => {
                                    window.location.replace('/result?answers='+ encodeURIComponent(JSON.stringify(this.answers)))
                                });
                        }

                        else{

                        }

                    }
                    else{
                        axios.post('/submit/' + this.userId + '/' +this.test.id + '/' +this.test.subject_id + '/' + this.score + '/', {my_props: JSON.stringify(this.answers)})
                            .then(() => {
                                window.location.replace('/result?answers='+ encodeURIComponent(JSON.stringify(this.answers)))
                            });
                    }

                }

            },
        },

    }
</script>
