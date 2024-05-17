<template>
    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold">Login</h1>
            <form class="space-y-4 md:space-y-6" @submit.prevent="handleSubmit">
              <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input 
                  type="email" 
                  name="email" 
                  id="email" 
                  v-model="email" 
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                  placeholder="name@company.com">
              </div>
              <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                <input 
                  type="password" 
                  name="password" 
                  id="password" 
                  v-model="password" 
                  placeholder="••••••••" 
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5">
              </div>
              <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>

  export default {
    
    data() {
      return {
        email: '',
        password: ''
      };
    },
    methods: {
      handleSubmit() {
        // Lógica de validação ou autenticação pode ser adicionada aqui
        // Após a validação, redirecionar para a rota /list
        this.$router.push('/list');
      }
    }
  };
  </script>
  