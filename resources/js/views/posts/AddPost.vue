<template>
  <div class="app-container">
    <el-form ref="form" label-width="120px">
      <el-form-item label="Post Title">
        <el-input v-model="data.title" />
      </el-form-item>
      <el-form-item label="Description">
        <el-input v-model="data.description" type="textarea" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addPost">Add Post</el-button>
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
      data: {
        title: '',
        description: '',
      },
    };
  },
  methods: {
    addPost() {
      if (this.data.title.trim() === '') {
        this.$notify({
          title: 'Opps!',
          message: 'Title cannot be empty.',
          type: 'error',
        });
      } else if (this.data.description.trim() === '') {
        this.$notify({
          title: 'Opps!',
          message: 'Description cannot be empty.',
          type: 'error',
        });
      } else {
        axios
          .post('create_post', this.data)
          .then(resp => {
            window.location.href = '/#/post/all-posts';
            this.$notify({
              title: 'Success!',
              message: 'Post added successfully.',
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
      }
    },
  },
};
</script>

<style scoped>
.line {
  text-align: center;
}
</style>

