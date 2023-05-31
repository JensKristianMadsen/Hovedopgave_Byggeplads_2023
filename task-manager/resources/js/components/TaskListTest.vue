




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


