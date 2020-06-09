<template>
  <div class="app-container">
    <el-form ref="form" label-width="120px">
      <el-form-item label="Post Title">
        <el-input v-model="post.title" />
      </el-form-item>
      <el-form-item label="Description">
        <el-input v-model="post.description" type="textarea" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="updatePost">Update Post</el-button>
        <router-link :to="{ name: 'AllPosts' }">
          <el-button>Back to all posts</el-button>
        </router-link>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      post: {},
    };
  },
  created() {
    const id = this.$route.params.id;
    axios
      .get(`get_post/${id}`)
      .then(res => (this.post = res.data))
      .catch(e => console.log(e));
  },
  methods: {
    updatePost() {
      axios
        .post('edit_post', this.post)
        .then(resp => {
          window.location.href = '/#/post/all-posts';
          this.$notify({
            title: 'Success!',
            message: 'Post updated successfully.',
            type: 'success',
          });
        })
        .catch(e => {
          this.$notify({
            title: 'Opps!!',
            message: 'Something went wrong, please try again later.',
            type: 'warning',
          });
        });
    },
  },
};
</script>
