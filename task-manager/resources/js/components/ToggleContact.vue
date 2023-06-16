<template>
  <div class="sticky">
    <input type="checkbox" id="drawer-toggle" class="relative sr-only peer" />
    <label
      for="drawer-toggle"
      class="absolute inline-flex text-center justify-center top-0 left-0 py-0 px-1 p-1 transition-all duration-500 hover:bg-blue-400 text-sm font-medium text-white shadow-sm bg-blue-600 rounded-lg peer-checked peer-checked:left-64"
    >
      <h3 class="text text-slate-100 text-center">Need Help</h3>

      <!--Mous svg-->
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59"
        />
      </svg>
    </label>
    <div
      class="fixed top-0 left-0 z-20 w-64 h-full transition-all duration-500 transform -translate-x-full bg-white shadow-lg peer-checked:translate-x-0"
    >
      <div class="px-0.5 py-9">
        <!--pofile_job_responsibilities_employee-->
        <div class="pofile_job_responsibilities_employee">
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
                <h1
                  class="hidden md:block font-bold text-sm md:text-xl text-center"
                >
                  Contact<span class="text-teal-600">.</span>
                </h1>

                <!--Task-Manager Profit -->
                <div id="profile" class="space-y-3">
                  <img
                    src="avatar.jpg"
                    alt="Avatar user"
                    class="w-10 md:w-16 rounded-full mx-auto"
                  />
                  <div>
                    <h2
                      class="font-medium text-s md:text-sm text-center text-teal-500"
                    >
                      Mikkel Christiansen
                    </h2>
                    <p class="text-s text-gray-500 text-center">Task-Manager</p>
                    <p class="text-s text-gray-500 text-center">
                      Tlf. (+45) 27 64 89 86
                    </p>
                  </div>
                </div>

                <!--Container-Manager Profit-->
                <div id="profile" class="space-y-3">
                  <img
                    src="jens.jpg"
                    alt="Avatar user"
                    class="w-10 md:w-16 rounded-full mx-auto"
                  />
                  <div>
                    <h2
                      class="font-medium text-s md:text-sm text-center text-teal-500"
                    >
                      Jens Madsen
                    </h2>
                    <p class="text-s text-gray-500 text-center">
                      Container-Manager
                    </p>
                    <p class="text-s text-gray-500 text-center">
                      Tlf. (+45) 32 56 78 72
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
.md\:w-16 {
    width: 6rem;
}
</style>
