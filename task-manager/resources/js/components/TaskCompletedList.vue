<template>
  <div v-if="tasksIsCompleted.length > 0" class="task-completed-list">
    <div
      class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300"
    >
      <div class="flex flex-row justify-between items-center">
        <div>
          <h1 class="text-3xl font-medium">CompletedTasks list</h1>
        </div>
        <div class="inline-flex space-x-2 items-center">
          <a
            href="#"
            class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center hover:bg-slate-200"
          >

          <!--Hous svg-->

            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
              />
            </svg>

          <!--Tre line svg-->

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
          </a>

          <!--Delete all completed Task-->

          <a
            href="#"
            @click="deleteAllCompletedTask"
            class="p-2 border border-slate-200 rounded-md inline-flex space-x-1 items-center hover:bg-slate-200 hover:text-red-500"
          >

          <!--Tre line svg-->

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

            <!--Trash svg-->

            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-4 h-4 text-slate-500 hover:text-red-500 hover:cursor-pointer"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
              />
            </svg>

          </a>
        </div>
      </div>
      <p class="text-slate-500">Nice job!, here are your completed tasks</p>

      <div id="tasks" class="my-5">
        <div
          id="task"
          class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-transparent"
        >
          <div class="inline-flex items-center space-x-2">
            <p v-if="!tasksIsCompleted.length">
              Nice job! You've bought all your todolist
            </p>

             <!--Completed task List-->

            <div>
              <tbody>
                <tr
                  v-for="task in tasksIsCompleted"
                  :key="task.id"
                  :class="{ 'completed': task.is_completed }"
                >
                  <td>
                    <input
                      type="checkbox"
                      v-model="task.is_completed"
                      @change="taskCompletionCheck(task)"
                    />
                  </td>

                  <td>T({{ task.id }}):</td>
                  <td>{{ task.description }},</td>
                  <td>{{ getToolItem(task.tool_id) }},</td>
                  <td>{{ getEmployeeName(task.employee_id) }}</td>

                  <td>

                    <!--Delete one task-->

                    <button>
                      <div class="btn-danger ml-3" @click="deleteTask(task)">

                        <!--Trash svg -->
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="w-4 h-4 text-slate-500 hover:text-red-500 hover:cursor-pointer"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                          />
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
      <p class="text-xs text-slate-500 text-center">Completede tasks Today!</p>
    </div>
  </div>
</template>


<script>

import axios from 'axios';

export default {

    data() {

      return {

        tasks: [],
        tools: [],
        employees: []
      };
    },

    computed:{

      tasksIsCompleted() {
      return this.tasks.filter(task => task.is_completed);
      }
    },

    async mounted() {

      try {

        const [taskRes, toolRes, employeeRes] = await Promise.all([

          axios.get('http://localhost:8000/api/tasks'),
          axios.get('http://localhost:8000/api/tools'),
          axios.get('http://localhost:8000/api/employees')
        ]);

        this.tools = toolRes.data;
        this.employees = employeeRes.data;
        this.tasks = taskRes.data.map(task => ({ ...task, isEditing: false}));

      } catch (error) {
        console.error(error.message);
      }
    },

    methods: {

      getEmployeeName(id) {
  
      const employee = this.employees.find(employee => employee.id === id);
      return employee ? employee.name : 'Unknown';
      },

      getToolItem(id) {

      const tool = this.tools.find(tool => tool.id === id);
      return tool ? tool.item : 'Unknown';
      },

      async taskCompletionCheck(task) {

        try {

          await axios.patch(`http://localhost:8000/api/tasks/${task.id}`, {
            is_completed: task.is_completed
          });

        } catch (error) {
          console.error(error.message);
          task.is_completed = !task.is_completed;
        }
      },
     
      async deleteTask(task) {

        if (!confirm(`Confirm to delete task ${task.description}?`)) {
          return;
        }

        try {

          await axios.delete(`http://localhost:8000/api/tasks/${task.id}`)
          const taskIndex = this.tasks.indexOf(task);

          if (taskIndex > -1) {
            this.tasks = this.tasks.filter(t => t.id !== task.id);
          }

        } catch (error) {
          console.error(error.message);
        }
      },
 
    async deleteAllCompletedTask() {

      if (!confirm(`Confirm to Delete All completed Task!`)) {
          return;
        }

        const completedTasks = this.tasks.filter(task => task.is_completed);

        const deleteRequests = completedTasks.map(task =>
            axios.delete(`http://localhost:8000/api/tasks/${task.id}`)
        );
        
        try {

            await Promise.all(deleteRequests);
            this.tasks = this.tasks.filter(task => !task.is_completed);

        } catch (error) {
            console.error(error.message);
        }
    }
  }
}
  
</script>
    
<style>
  .completed {
    text-decoration: line-through;
    color: gray;
  }
</style>