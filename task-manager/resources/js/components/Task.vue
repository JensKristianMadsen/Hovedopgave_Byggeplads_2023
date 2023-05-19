<template>
  <form>
  <div class="mb-3">
    <label for="taskDescription" class="form-label">Task Description</label>
    <input type="text" class="form-control" id="taskDescription" v-model="task.description"  required>
  </div>

  <div class="mb-3">
      <label for="toolr" class="form-label">Tool</label>
      <select class="form-control" id="tool" v-model="task.tool_id" required>
        <option v-for="tool in tools" :key="tool.id" :value="tool.id">{{ tool.item }}</option>
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
            tool_id: ''
        },
        tools: []
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