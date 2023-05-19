<template>
  <form>
  <div class="mb-3">
    <label for="taskDescription" class="form-label">Task Description</label>
    <input type="text" class="form-control" id="taskDescription" v-model="task.description"  required>
  </div>

  <div class="mb-3">
      <label for="tool" class="form-label">Tool</label>
      <select class="form-control" id="tool" v-model="task.tool_id" required>
        <option v-for="tool in tools" :key="tool.id" :value="tool.id">{{ tool.item }}</option>
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

<script>
import axios from 'axios';


export default {
data(){
    return {
        task: {
            description: '',
            tool_id: '',
            employee_id: ''
        },
        tools: [],
        employees: []
    };
    
    },

    async mounted() {
    try {
      const res = await axios.get('http://localhost:8000/api/tools');
      this.tools = res.data;
    } catch (error) {
      console.error(error);
    }
  },
  async mounted() {
    try {
      const res = await axios.get('http://localhost:8000/api/employees');
      this.employees = res.data;
    } catch (error) {
      console.error(error);
    }
  },
    

    methods: {

        async addTask(e) {
            e.preventDefault();

            if (!this.task.description) {
            alert('Task description is required');
            return;
        }


            try {
            const res = await axios.post('http://localhost:8000/api/tasks', this.task 
           
            );
            if(res.status == 200){
                console.log('Task created:', res.data);
            }

            this.task = {
                description: '',
                tool_id: ''
            };
             } catch (error) {
                console.error(error)
              }

        }


      
    }
}

</script>

<style>

</style>