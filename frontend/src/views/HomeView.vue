<script setup>
import Post from '../components/Post.vue'
import Header from "../components/Header.vue";
</script>

<template>
  <Header title="Main page" />

  <main>
    <Post/>
    <br/>
    <CommentForm @comment-created-event="commentCreated($event)"/>
    <br/>
    <Comments :new-comment="newComment"/>
  </main>
</template>

<script>

import CommentForm from "../components/CommentForm.vue";
import Comments from "../components/Comments.vue";
export default {
  components: {CommentForm, Comments},
  name: "HomeView",
  data() {
    return {
      newComment: {}
    }
  },
  methods: {
    commentCreated(comment){
      this.newComment = comment;
    }
  },
}
</script>
