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
    <tr v-for="task in tasks" :key="task.id" :class="{ 'completed': task.is_completed }">
                    <td><input type="checkbox" v-model="task.is_completed" @change="taskCompletionCheck(task)"/>
                    </td>
                    <td>{{ task.description }}  </td>
                    <td>{{ task.tool_id }}</td>
                    <td>{{  task.employee_id }}</td>
                    
                    <td v-if="task.isEditing">
      <select v-model="task.tool_id" @change="updateTask(task)">
        <option v-for="tool in tools" :key="tool.id" :value="tool.id">{{ tool.item }}</option>
      </select>
    </td>
    <td v-else>{{ task.tool_id }}</td>
    <td v-if="task.isEditing">
      <select v-model="task.employee_id" @change="updateTask(task)">
        <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
      </select>
    </td>
    <td v-else>{{ task.employee_id }}</td>
    <td>
     
      <button @click="task.isEditing = !task.isEditing">{{ task.isEditing ? 'Save' : 'Edit' }}</button>
    </td>
          
                    <td> <button @click="deleteTask(task)">Delete</button> </td>
    </tr>

  </tbody>

</table>



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
      async mounted() {
  try {
    const [taskRes, toolRes, employeeRes] = await Promise.all([
      axios.get('http://localhost:8000/api/tasks'),
      axios.get('http://localhost:8000/api/tools'),
      axios.get('http://localhost:8000/api/employees')
    ]);
    this.tools = toolRes.data;
    this.employees = employeeRes.data;
    this.tasks = taskRes.data.map(task => ({ ...task, isEditing: false }));
  } catch (error) {
    // handle the error
  }
},
      methods: {
        async taskCompletionCheck(task) {
          try {
            await axios.patch(`http://localhost:8000/api/tasks/${task.id}`, {
              is_completed: task.is_completed
            });
          } catch (error) {
            console.error(error.message);
            if (error.res) {
        console.error('Response data:', error.res.data);
    
      }
            task.is_completed = !task.is_completed;
          }
        },

        async updateTask(task) {
    try {
      await axios.put(`http://localhost:8000/api/tasks/${task.id}`, {
        tool_id: task.tool_id,
        employee_id: task.employee_id
      });
    } catch (error) {
      // handle the error
    }
    task.isEditing = false;
  },

async deleteTask(task) {
 if (!confirm(`Confirm to delete task ${task.description}?`)) {
return;
 }
  
  try {
await axios.delete(`http://localhost:8000/api/tasks/${task.id}`)

const taskIndex = this.tasks.indexOf(task);

    if (taskIndex > -1){
      this.tasks = this.tasks.filter(t => t.id !== task.id);
    }
  } catch (error) {
    console.error("error from delete task.id", error);
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