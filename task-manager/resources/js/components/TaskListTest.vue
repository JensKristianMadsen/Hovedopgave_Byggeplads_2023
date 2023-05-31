

<template>
  <div
    class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300"
  >
    <div class="flex flex-row justify-between items-center">
      <div>
        <h1 class="text-3xl font-medium">Tasks list</h1>
      </div>
      <div class="inline-flex space-x-2 items-center">
        <a
          href="#"
          @click="urgent"
          class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center text-indigo-200 hover:text-white bg-indigo-600 hover:bg-indigo-500"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-4 h-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
          <span class="text-sm font-medium hidden md:block">Urgent</span>
        </a>
        <a
          href="#"
          @click="latest"
          class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center hover:bg-slate-200"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-4 h-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
            />
          </svg>
          <span class="text-sm hidden md:block">Latest</span>
        </a>
      </div>
    </div>
    <p class="text-slate-500">Hello, here are your latest tasks</p>

    <div id="tasks" class="my-5">
      <div
        id="task"
        class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-transparent"
      >
        <div class="inline-flex items-center space-x-2">
          <p v-if="!tasksNotCompleted().length">
            Nice job! You've bought all your todolist
          </p>

          <div>
            <tbody>
      <tr v-for="task in tasksNotCompleted" :key="task.id" :class="{ 'completed': task.is_completed }">
        <td><input type="checkbox" v-model="task.is_completed" @change="taskCompletionCheck(task)" /> </td>

        <td v-if="task.isEditing">
          <input type="text" v-model="task.description" />
        </td>
        <td v-else>{{ task.description }}</td>

        <td v-if="task.isEditing">
          <select v-model="task.tool_id" @change="updateTask(task)">
            <option v-for="tool in tools" :key="tool.id" :value="tool.id">{{ tool.item }}</option>
          </select>
        </td>
        <td v-else>{{ getToolItem(task.tool_id) }}</td>
        
        <td v-if="task.isEditing">
          <select v-model="task.employee_id" @change="updateTask(task)">
            <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
          </select>
        </td>
        <td v-else>{{ getEmployeeName(task.employee_id) }}</td>
        <td>
          <button @click="task.isEditing ? updateTask(task) : task.isEditing = !task.isEditing">{{ task.isEditing ? 'Save' : 'Edit' }}</button>
        </td>
        <td> <button @click="deleteTask(task)">Delete</button> </td>
      </tr>
    </tbody>
          </div>
        </div>
      </div>
    </div>
    <p class="text-xs text-slate-500 text-center">
      {Last updated 12 minutes ago}
    </p>
  </div>
</template>






<!---->
<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Completed</th>
        <th scope="col">Description</th>
        <th scope="col">Tool</th>
        <th scope="col">Employee</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="task in tasksNotCompleted" :key="task.id" :class="{ 'completed': task.is_completed }">
        <td><input type="checkbox" v-model="task.is_completed" @change="taskCompletionCheck(task)" /> </td>

        <td v-if="task.isEditing">
          <input type="text" v-model="task.description" />
        </td>
        <td v-else>{{ task.description }}</td>

        <td v-if="task.isEditing">
          <select v-model="task.tool_id" @change="updateTask(task)">
            <option v-for="tool in tools" :key="tool.id" :value="tool.id">{{ tool.item }}</option>
          </select>
        </td>
        <td v-else>{{ getToolItem(task.tool_id) }}</td>
        
        <td v-if="task.isEditing">
          <select v-model="task.employee_id" @change="updateTask(task)">
            <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
          </select>
        </td>
        <td v-else>{{ getEmployeeName(task.employee_id) }}</td>
        <td>
          <button @click="task.isEditing ? updateTask(task) : task.isEditing = !task.isEditing">{{ task.isEditing ? 'Save' : 'Edit' }}</button>
        </td>
        <td> <button @click="deleteTask(task)">Delete</button> </td>
      </tr>
    </tbody>
  </table>
</template>
    

<!---->

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