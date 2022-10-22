<script setup>
const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;
</script>

<template>
  <h2>Написать комментарий</h2>
  <div>
    <label for="username">Имя пользователя</label>
    <input id="username" v-model="username" placeholder="username">
  </div>

  <div>
    <label for="email">Email</label>
    <input id="email" v-model="email" placeholder="email@example.com">
  </div>

  <div>
    <label for="commentTitle">Заголовок комментария</label>
    <input id="commentTitle" v-model="commentTitle" placeholder="title">
  </div>

  <div>
    <label>Текст комментария</label>
    <textarea id="commentText" :value="commentText"></textarea>
  </div>
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
    }
  },
  methods: {
    async createComment() {
      try {
        const res = await axios.post(BACKEND_URL + `/comment`, {
          username: this.username,
          email: this.email,
          commentTitle: this.commentTitle,
          commentText: this.commentText,
        });
        this.commentCreated(res);
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
</style>