<!--dsdsa-->


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
          <p v-if="!tasksNotCompleted.length">
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
  
      <button @click="task.isEditing ? updateTask(task) : task.isEditing = !task.isEditing">
            
        <div v-if="task.isEditing">
          <!--Save Icone-->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
</svg>

        </div>
          
        <div v-else>
           <!--Edit Icone-->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
</svg>

      </div>
    
      </button>
        </td>
        <td>
           
           <button>  
    
    <div class="btn-danger ml-3" @click="deleteTask(task)">
    <!--Delete Icone-->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-500 hover:text-slate-900 hover:cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
          </svg>                      
                   
    </div>
</button>
        </td>
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



<template>


  <!--Task completed list-->
  <div v-if="tasksIsCompleted.length > 0" class="list-group-item-completed">
    <div
      class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300"
    >
      <div class="flex flex-row justify-between items-center">
        <div>
          <h1 class="text-3xl font-medium">CompletedTasks list</h1>
        </div>
        <div class="inline-flex space-x-2 items-center">
            <!--Urgent-->
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
          <!--Latest-->
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
          <!--All remove completed tems-->
          <a
            href="#"
            @click="removeCompletedItems" 
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
            <span class="text-sm hidden md:block">All</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4  text-red-500 hover:text-slate-900 hover:cursor-pointer">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>                      
          </a>
        </div>
      </div>
      <p class="text-slate-500">Greetings! I am pleased to inform you that your latest tasks have been completed.</p>

      <div id="tasks" class="my-5">
        <div
          id="task"
          class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-transparent"
        >
          <div class="inline-flex items-center space-x-2">
            <p v-if="items.length === 0 ">
              Nice job! You've bought all your todolist
            </p>
            
            <div>
              <tbody>
      <tr v-for="task in tasksIsCompleted" :key="task.id" :class="{ 'completed': task.is_completed }">
        <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
  <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
</svg></td>

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
    
  </div>



</template>


<!--org-->
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
      <tr v-for="task in tasksIsCompleted" :key="task.id" :class="{ 'completed': task.is_completed }">
        <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
  <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
</svg></td>

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
<!--org-->

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
          <p v-if="!tasksNotCompleted.length">
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
  
      <button @click="task.isEditing ? updateTask(task) : task.isEditing = !task.isEditing">
            
        <div v-if="task.isEditing">
          <!--Save Icone-->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
</svg>

        </div>
          
        <div v-else>
           <!--Edit Icone-->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
</svg>

      </div>
    
      </button>
        </td>
        <td>
           
           <button>  
    
    <div class="btn-danger ml-3" @click="deleteTask(task)">
    <!--Delete Icone-->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-500 hover:text-slate-900 hover:cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
          </svg>                      
                   
    </div>
</button>
        </td>
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



