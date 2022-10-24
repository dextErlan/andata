<template>
  <h2>Комментарии:</h2>
  <div class="comment" v-for="comment in comments">
    <div class="comment_title">{{comment.commentTitle}}</div>
    <div class="comment_text">{{comment.commentText}}</div>
    <div class="comment_author">{{comment.username}} ({{comment.email}}) - {{comment.created}}</div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Comments",
  props: ['newComment'],
  data() {
    return {
      comments: [],
    }
  },
  created() {
    this.getComments()
  },
  methods: {
    async getComments() {
      try {
        const res = await axios.get(`api/comment`);
        this.comments = res.data
      } catch (error) {
        console.log(error);
      }
    }
  },
  computed: {
    addComment() {
      if (this.newComment.hasOwnProperty('id')) {
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