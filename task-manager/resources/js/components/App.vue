<template>
  
  <ToggleContact />

  <div class="container w-100 m-auto text-center mt-3">
    <h1 class="text-danger">Create Task</h1>

    <Task />

    <TaskList />

    <TaskCompletedList />

  </div>

</template>

<script>

import ToggleContact from './ToggleContact.vue';
import Task from './Task.vue';
import TaskList from './TaskList.vue';
import TaskCompletedList from './TaskCompletedList.vue';



export default {

    name: 'App',

    components: {

      ToggleContact,
      Task,
      TaskList,
      TaskCompletedList
    },
};
</script>

<style scoped>
</style>
