<template>
  <h2>Написать комментарий</h2>
  <div>
    <label for="username">Имя пользователя</label>
    <input id="username" v-model="username" placeholder="username" @change="validateUsername">
    <span class="input-error" v-if="usernameError">{{usernameError}}</span>
  </div>

  <div>
    <label for="email">Email</label>
    <input id="email" v-model="email" placeholder="email@example.com" @change="validateEmail">
    <span class="input-error" v-if="emailError">{{emailError}}</span>
  </div>

  <div>
    <label for="commentTitle">Заголовок комментария</label>
    <input id="commentTitle" v-model="commentTitle" placeholder="title" @change="validateCommentTitle">
    <span class="input-error" v-if="commentTitleError">{{commentTitleError}}</span>
  </div>

  <div>
    <label>Текст комментария</label>
    <textarea id="commentText" v-model="commentText" @change="validateCommentText"></textarea>
    <span class="input-error" v-if="commentTextError">{{commentTextError}}</span>
  </div>

  <button id="create-btn" @click="createComment">Отправить</button>
</template>

<script>
import axios from "axios";
export default {
  name: "CommentForm",
  emits: ['commentCreatedEvent'],
  data() {
    return {
      username: '',
      email: '',
      commentTitle: '',
      commentText: '',
      usernameError: '',
      emailError: '',
      commentTitleError: '',
      commentTextError: '',
    }
  },
  methods: {
    async createComment() {
      if (!this.isValidForm()) {
        return;
      }
      try {
        const res = await axios.post(`/api/comment`, {
          username: this.username,
          email: this.email,
          commentTitle: this.commentTitle,
          commentText: this.commentText,
        });
        this.commentCreated(res.data);
        this.clearForm();
      } catch (error) {
        console.error(error);
      }
    },
    clearForm() {
      this.username = ''
      this.email = ''
      this.commentTitle = ''
      this.commentText = ''
    },
    commentCreated(comment) {
      this.$emit('commentCreatedEvent', comment)
    },
    validateUsername(){
      if (this.username === '') {
        this.usernameError = 'Поле не должно быть пустым!';
      } else {
        this.usernameError = '';
      }
    },
    validateEmail() {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
        this.emailError = '';
      } else {
        this.emailError = 'Не верный email';
      }
    },
    validateCommentTitle(){
      if (this.commentTitle === '') {
        this.commentTitleError = 'Поле не должно быть пустым!';
      } else {
        this.commentTitleError = '';
      }
    },
    validateCommentText(){
      if (this.commentText === '') {
        this.commentTextError = 'Поле не должно быть пустым!';
      } else {
        this.commentTextError = '';
      }
    },
    isValidForm()
    {
      this.validateUsername();
      this.validateEmail();
      this.validateCommentTitle();
      this.validateCommentText();

      return (this.usernameError === '' || this.emailError === '' || this.commentTitleError === '' || this.commentTextError === '');
    }
  }
}
</script>

<style scoped>
label {
  width: 200px;
  text-align: right;
  display: inline-block;
  margin-right: 10px;
}
#create-btn {
  margin-left: 180px;
}

.input-error {
  margin-left: 10px;
  color: red;
}
</style>