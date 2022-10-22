<script setup>
const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;
</script>

<template>
  <h2>Комментарии:</h2>
  <div class="comment" v-for="comment in comments">
    <div class="comment_title">{{comment.commentTitle}}</div>
    <div class="comment_text">{{comment.commentText}}</div>
    <div class="comment_author">{{comment.username}} ({{comment.email}}) - {{comment.createdAt}}</div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Comments",
  props: ['newComment'],
  data() {
    return {
      comments: [
        {
          'username': 'me',
          'email': 'ss@fd.fd',
          'commentTitle': 'tit1',
          'commentText': 'com1',
          'createdAt': '2022-10-11 12:21:32'
        },
        {
          'username': 'you',
          'email': 'sww@fd.fd',
          'commentTitle': 'ti2',
          'commentText': 'com2',
          'createdAt': '2022-10-11 14:21:32'
        },
      ],
    }
  },
  created() {
    this.getComments()
  },
  methods: {
    async getComments() {
      try {
        const res = axios.get(BACKEND_URL + `/comment`);
      } catch (error) {
        console.log(error);
      }
    }
  },
  computed: {
    addComment() {
      if (this.newComment.has('id')) {
        this.comments.push(this.newComment)
      }
    },
  }
}
</script>

<style scoped>
.comment {
  margin: 20px 0;
}

.comment_title {
  font-weight: bold;
}

.comment_author {
  font-style: italic;
}
</style>