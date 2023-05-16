<template>
    <div>
  <TaskList />
    </div>
</template>

<script>
import TaskList from './TaskList.vue';
import axios from 'axios';
export default {
    name: 'App',
    components: {
        TaskList
    },
      data() {
        return {
          tasks: []
        };
      },
      async mounted() {
        try {
          const res = await axios.get('http://localhost:8000/api/tasks');
          this.tasks = res.data;
        } catch (error) {
          console.error(error);
        }
      },
};
</script>

<style scoped>
</style>
