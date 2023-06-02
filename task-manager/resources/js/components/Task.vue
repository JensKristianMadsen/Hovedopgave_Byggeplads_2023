
<template>

  <div class="mt-10 sm:mt-0 ">
    <div class="md:grid md:grid-cols-4 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-white">Personal Information</h3>
          <p class="mt-1 text-sm text-white">Use a permanent address where you can receive mail.</p>
        </div>
      </div>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form >
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
              <div class="grid grid-cols-3 gap-4">
          
                <div class="col-span-1 sm:col-span-1 lg:col-span-1">
                  <label for="taskDescription" class="block text-sm font-medium text-gray-700">Task Description</label>
                  <textarea  type="text" v-model="task.description" name="taskDescription" id="taskDescription" autocomplete="address-level2" maxlength="60"  class="mt-1 block w-full rounded-md  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" role="alert" required></textarea>
                </div>

                

  <!--
                <div class="col-span-1 sm:col-span-1 lg:col-span-1">
                  <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                  <input datepicker   type="date" autocomplete="address-level1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
-->

             
                <div  class="col-span-1 sm:col-span-1 lg:col-span-1">
                  <label for="tool" class="block text-sm font-medium text-gray-700">Tool</label>
                  <select v-model="task.tool_id" id="tool" name="tool" autocomplete="tool-item" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option disabled value="">Please select one</option>
                    <option v-for="tool in availableTools" :key="tool.id" :value="tool.id">{{ tool.item }}</option>
                  </select> 
                </div>

                <div  class="col-span-1 sm:col-span-1 lg:col-span-1">
                  <label for="employee" class="block text-sm font-medium text-gray-700">Employee</label>
                  <select v-model="task.employee_id" id="employee" name="employee" autocomplete="employee-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option disabled value="">Please select one</option>
                    <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
                  </select> 
                </div>
              </div>


            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
              <button type="submit"  @click="addTask"
                class="inline-flex justify-center rounded-md border border-transparent bg-gray-400 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  </template>





<script>
  import axios from 'axios';
  export default {
    data() {
      return {
        task: {
          description: '',
          tool_id: '',
          employee_id: '',
          is_completed: false
        },
        tasks: [],
        tools: [],
        employees: []
      };
    },
    computed:{
      availableTools() {

      const usedToolIds = this.tasks
        .filter(t => !t.is_completed)
        .map(t => t.tool_id);

      return this.tools.filter(tool => !usedToolIds.includes(tool.id));
    }

    },
    async mounted() {
      try {
        const resTasks = await axios.get('http://localhost:8000/api/tasks');
        const resTools = await axios.get('http://localhost:8000/api/tools');
        const resEmployees = await axios.get('http://localhost:8000/api/employees');
        this.tasks = resTasks.data;
        this.tools = resTools.data;
        this.employees = resEmployees.data;
      } catch (error) {
        console.error(error.message);
      }
    },
    methods: {
      async addTask(e) {
        e.preventDefault();
        if (!this.task.description || !this.task.tool_id || !this.task.employee_id) {
          alert('Task description, tool, and employee are required fill out');
          return;
        }
        try {
          const res = await axios.post('http://localhost:8000/api/tasks', this.task
          );
          if (res.status == 200) {
            console.log('Task created:', res.data);
          }
          this.task = {
            description: '',
            tool: '',
            employee: '',
            is_completed: false
          };
        } catch (error) {
          console.error(error.message);
        } finally {
          location.reload();
        }
      }
    }
  }
</script>

<style>



#app {
font-family: "Avenir", Helvetica, Arial, sans-serif;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
}


textarea{  
  padding:10px;

}
</style>