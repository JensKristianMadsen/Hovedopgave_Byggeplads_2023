<template>
  
<!--ToggleContact-->

  <ToggleContact />

  <!--ToggleContact-->

<div class="container w-100 m-auto text-center mt-3">
    <h1 class="text-danger">Create Task</h1>
<!--AddTaskForm-->
<Task />
<!--AddTaskForm-->

<!--TaskList-->
<TaskList />
<!--askCompletedList -->
<TaskCompletedList />


</div>


</template>




<script>
import ToggleContact from './ToggleContact.vue';
import TaskCompletedList from './TaskCompletedList.vue';
import TaskList from './TaskList.vue';
import Task from './Task.vue';

export default {
    name: 'App',
    components: {
      ToggleContact,
        TaskCompletedList,
        TaskList,
        Task
    },
      
    
};
</script>

<style scoped>
</style>
