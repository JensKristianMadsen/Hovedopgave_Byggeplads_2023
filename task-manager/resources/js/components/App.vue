<template>
    <div>
        <Task />
    </div>
    <div>
  <TaskList />
    </div>
    <div>
<TaskCompletedList />
    </div>
</template>

<script>
import TaskCompletedList from './TaskCompletedList.vue';
import TaskList from './TaskList.vue';
import Task from './Task.vue';
export default {
    name: 'App',
    components: {
        TaskCompletedList,
        TaskList,
        Task
    },
      data() {
        return {
          tasks: []
        };
      },
    
};
</script>

<style scoped>
</style>
