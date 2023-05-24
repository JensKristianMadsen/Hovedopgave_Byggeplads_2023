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
        this.tasks = taskRes.data.map(task => ({ ...task,
          isEditing: false
        }));
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
      async updateTask(task) {
        try {
          await axios.put(`http://localhost:8000/api/tasks/${task.id}`, {
            description: task.description,
            tool_id: task.tool_id,
            employee_id: task.employee_id
          });
        } catch (error) {
          console.error(error.message);
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
          if (taskIndex > -1) {
            this.tasks = this.tasks.filter(t => t.id !== task.id);
          }
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