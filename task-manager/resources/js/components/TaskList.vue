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
                    <td>{{ task.description }}</td>
                    <td>{{ task.tool_id }}</td>
                    <td>{{  task.employee_id }}</td>
          
                    <td>
  <button @click="deleteTask(task)">Delete</button>
</td>
                </tr>

  </tbody>

</table>



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
      },
      methods: {
        async taskCompletionCheck(task) {
          try {
            await axios.patch(`http://localhost:8000/api/tasks/${task.id}`, {
              is_completed: task.is_completed
            });
          } catch (error) {
            console.error(error);
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