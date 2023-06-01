<template>


<div class="flex ">
    <input type="checkbox" id="drawer-toggle" class="relative sr-only peer">
    <label for="drawer-toggle" class="absolute inline-flex justify-center top-0 left-0 py-2 px-4 p-4 transition-all duration-500  hover:bg-indigo-700 text-sm font-medium text-white shadow-sm bg-indigo-600 rounded-lg peer-checked peer-checked:left-64">
    <p>Need Help ?</p> 

    
    </label>
    <div class="fixed top-0 left-0 z-20 w-64 h-full transition-all duration-500 transform -translate-x-full bg-white shadow-lg peer-checked:translate-x-0">
      <div class="px-0.5 py-9">
       

<!--pofile_job_responsibilities_employee-->
<div class="pofile_job_responsibilities_employee" >
    <div
      id="view"
      class="h-full w-screen flex flex-row"
      x-data="{ sidenav: flas }"
    >
     
      <div
        id="sidebar"
        class="bg-white h-screen md:block shadow-xl px-3 w-30 md:w-60 lg:w-60 overflow-x-hidden transition-transform duration-300 ease-in-out"

      >
        <div class="space-y-6 md:space-y-10 mt-10">
          <h1 class="font-bold text-4xl text-center md:hidden">
            D<span class="text-teal-600">.</span>
          </h1>
          <h1 class="hidden md:block font-bold text-sm md:text-xl text-center">
            Dashwind<span class="text-teal-600">.</span>
          </h1>
          <div id="profile" class="space-y-3">
            <img
              src="https://images.unsplash.com/photo-1628157588553-5eeea00af15c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
              alt="Avatar user"
              class="w-10 md:w-16 rounded-full mx-auto"
            />
            <div>
              <h2
                class="font-medium text-xs md:text-sm text-center text-teal-500"
              >
                Mikkel Christiansen
              </h2>
              <p class="text-xs text-gray-500 text-center">Task-Manager</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!--pofile_job_responsibilities_employee-->

        <p class="text-gray-500">phone number</p>
      </div>
    </div>
  </div>



</template>

<script>
export default {

}
</script>
<style>
.w-screen {
    width: auto;
}

</style>
