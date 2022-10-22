<script setup>
import Post from '../components/Post.vue'
import Header from "../components/Header.vue";
import CommentForm from "../components/CommentForm.vue";
import Comments from "../components/Comments.vue";
</script>

<template>
  <Header title="Main page" />

  <main>
    <Post/>
    <br/>
    <CommentForm/>
    <br/>
    <Comments :new-comment="newComment"/>
  </main>
</template>

<script>
export default {
  name: "HomeView",
  data() {
    return {
      newComment: {}
    }
  }
}
</script>
