<template>

  <!--Navbar-->
  <nav class="relative w-full flex flex-wrap items-center justify-between py-3 bg-gray-100 text-gray-500 hover:text-gray-700 focus:text-gray-700 shadow-lg">
    <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
        <div class="container-fluid">
            <a class="text-xl text-black font-semibold" href="#">Navbar</a> 
        </div>
    </div>
</nav>
<!--Navbar-->
<div class="container w-100 m-auto text-center mt-3">
    <h1 class="text-danger">Create Task</h1>
<!--AddTaskForm-->
<Task />
<!--AddTaskForm-->

<!--TaskList-->
<TaskList />
<!--TaskList-->
<!--TaskCompletedList -->
<TaskCompletedList />
<!--TaskCompletedList -->


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
