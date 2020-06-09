<template>
  <div class="app-container">
    <el-table :data="posts" border style="width: 100%">
      <el-table-column type="index" label="ID" />
      <el-table-column prop="title" label="Post Title" />
      <el-table-column prop="description" label="Description" />
      <el-table-column prop="created_at" label="Created At" />
      <el-table-column prop="id" label="Editing">
        <template slot-scope="scope">
          <router-link :to="{ name: 'EditPost' , params: { id: scope.row.id} }">
            <el-button size="mini">Edit</el-button>
          </router-link>
        </template>
      </el-table-column>
      <el-table-column prop label="Deleting">
        <template slot-scope="scope">
          <el-button size="mini" type="danger" @click="deletePost(scope.$index, scope.row)">Delete</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      posts: [],
    };
  },
  created() {
    axios
      .get('get_posts')
      .then(res => {
        this.posts = res.data;
      })
      .catch(e => console.log(e));
  },
  methods: {
    deletePost(i, r) {
      this.$confirm('Are you want to permanently delete the post?', 'Warning', {
        confirmButtonText: 'Yes, Please',
        cancelButtonText: 'Cancel',
        type: 'error',
      })
        .then(() => {
          axios
            .post('delete_post', r)
            .then(resp => {
              this.posts.splice(i, 1);
              this.$notify({
                title: 'Success!',
                message: 'Post Deleted successfully.',
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
        })
        .catch(() => {
          this.$notify({
            title: 'Opps!!',
            type: 'info',
            message: 'Delete canceled.',
          });
        });
    },
  },
};
</script>
