/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const postsRoutes = {
  path: '/post',
  component: Layout,
  redirect: 'noredirect',
  name: 'Posts',
  meta: {
    title: 'Posts',
    icon: 'education',
  },
  children: [
    {
      path: 'all-posts',
      component: () => import('@/views/posts/AllPosts'),
      name: 'AllPosts',
      meta: { title: 'All Posts', icon: 'list' },
    },
    {
      path: 'add-new-post',
      component: () => import('@/views/posts/AddPost'),
      name: 'AddPost',
      meta: { title: 'Add New Post', icon: 'form' },
    },
    {
      path: 'edit-post/:id',
      component: () => import('@/views/posts/EditPost'),
      name: 'EditPost',
      meta: { title: 'Edit Post', icon: 'edit' },
      hidden: true,
    },
  ],
};

export default postsRoutes;
