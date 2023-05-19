<template>
  <form>
  <div class="mb-3">
    <label for="taskDescription" class="form-label">Task Description</label>
    <input type="text" class="form-control" id="taskDescription" v-model="task.description"  required>
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
            description: ''
        }
    };
    
    },
    methods: {

        async addTask(e) {
            e.preventDefault();

            if (!this.task.description) {
            alert('Task description is required');
            return;
        }


            try {
            const res = await axios.post('http://localhost:8000/api/tasks', {
            description: this.task.description
            });
            if(res.status == 200){
                console.log('Task created:', res.data);
            }
            this.task.description = '';
             } catch (error) {
                console.error(error)
              }

        }


      
    }
}

</script>
im
<style>

</style>