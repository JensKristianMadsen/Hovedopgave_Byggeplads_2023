<template>

  <!--Navbar-->
      <!--Navbar
    <nav class="relative w-full flex flex-wrap items-center justify-between py-3 bg-gray-100 text-gray-500 hover:text-gray-700 focus:text-gray-700 shadow-lg">
    <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
        <div class="container-fluid">
            <a class="text-xl text-black font-semibold" href="#">Navbar Mikkel: tlf. +45 27 64 88 89 or on tlf. +45 32 65 68 88</a> 
        </div>
    </div>
</nav>
Navbar-->
  <Navbar />
<!--Navbar-->


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
import Navbar from './Navbar.vue';
import TaskCompletedList from './TaskCompletedList.vue';
import TaskList from './TaskList.vue';
import Task from './Task.vue';

export default {
    name: 'App',
    components: {
      Navbar,
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
