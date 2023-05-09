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
    <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.is_completed }}</td>
                    <td>{{ task.description }}</td>
                    <td>{{ task.tool_id }}</td>
                    <td>{{  task.employee_id }}</td>
                  
                </tr>

  </tbody>


  
</table>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Tool</th>
                    <th>Employee</th>
                    <th>Completed</th>
               
                </tr>
            </thead>
            <tbody>
                <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.description }}</td>
                    <td>{{ task.tool_id }}</td>
                    <td>{{  task.employee_id }}</td>
                    <td>{{ task.is_completed }}</td>
                </tr>
            </tbody>
        </table>
    </div>
      
    </template>
    
    <script>
    import axios from 'axios';
    export default {
      data() {
        return {
          tasks: []
        };
      },
      async mounted() {
        try {
          const res = await axios.get('http://localhost:8000/api/tasks');
          this.tasks = res.data;
        } catch (error) {
          console.error(error);
        }
      }
    
    }
    </script>
    
    <style>
    
    </style>