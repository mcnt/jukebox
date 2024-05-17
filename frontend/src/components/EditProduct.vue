<template>
  <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-4">Adicionar Produto</h1>
    <form @submit.prevent="updateDados">
      <div class="mb-4">
        <label for="title" class="block mb-2">Titulo:</label>
        <input type="text" id="title" v-model="dados.title" required class="w-full px-3 py-2 border rounded-lg">
      </div>
      <div class="mb-4">
        <label for="description" class="block mb-2">Descrição:</label>
        <input type="text" id="description" v-model="dados.description" required class="w-full px-3 py-2 border rounded-lg">
      </div>
      <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-lg">Adicionar</button>
    </form>
  </div>
</template>
  
  <script>
  import IndexService from '../services/index'
  
  export default {
    props: ['id'],
    data() {
      return {
        dados: {
          title: '',
          description: '',
          user_id: this.id
        }
      }
    },
    mounted() {
      this.fetchDados()
    },
    methods: {
      fetchDados() {
        IndexService.getId(this.id)
          .then(response => {
            this.dados = response.data
          })
          .catch(error => {
            console.error('Erro ao buscar dados:', error)
          })
      },
      updateDados() {
        IndexService.update(this.id, this.dados)
          .then(() => {
            console.log('Atualizado com sucesso!')
            this.$router.push('/')
          })
          .catch(error => {
            console.error('Erro ao atualizar:', error)
          })
      }
    }
  }
  </script>
  