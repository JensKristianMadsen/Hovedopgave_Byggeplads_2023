




<template>
  <form>
    <div class="mb-3">
      <label for="taskDescription" class="form-label">Task Description</label>
      <input type="text" class="form-control" id="taskDescription" v-model="task.description" required>
    </div>
    <div class="mb-3">
      <label for="tool" class="form-label">Tool</label>
      <select class="form-control" id="tool" v-model="task.tool_id" required>
          <option v-for="tool in availableTools" :key="tool.id" :value="tool.id">{{ tool.item }}</option>
        </select>
    </div>
    <div class="mb-3">
      <label for="employee" class="form-label">Employee</label>
      <select class="form-control" id="employee" v-model="task.employee_id" required>
          <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" @click="addTask">Submit</button>
  </form>
</template>


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
    <h1 class="text-danger">Laravel vue todo list</h1>
<!--AddTaskForm-->
<Task />
<!--AddTaskForm-->

<!--TaskList-->
<TaskList />
<!--askCompletedList -->
<TaskCompletedList />


</div>


</template>