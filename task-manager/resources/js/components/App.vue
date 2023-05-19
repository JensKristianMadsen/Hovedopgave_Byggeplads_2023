<template>
    <div>
        <Task />
    </div>
    <div>
  <TaskList />
    </div>
</template>

<script>
import TaskList from './TaskList.vue';
import Task from './Task.vue';
import axios from 'axios';
export default {
    name: 'App',
    components: {
        TaskList,
        Task
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
                console.error(error.message);
                if (error.res) {
        console.error('Response data:', error.res.data);
    
      }
              }
      },
};
</script>

<style scoped>
</style>
