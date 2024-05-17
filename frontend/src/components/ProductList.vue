<template>
    <div>
        <div class="flex justify-center items-center space-x-4 mb-4">
        <h1 class="text-2xl font-bold">Lista de Produtos</h1>
        <button
          class="text-white bg-primary-600 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
          @click="addDados()"
        >
          Adicionar dados
        </button>
      </div>

      <ul>
        <li v-for="product in products" :key="product.id">
          {{ product.name }} - {{ product.price }}
          <button @click="editDados(product.id)">Editar</button>
          <button @click="deleteDados(product.id)">Excluir</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import IndexService from '../services/index'
  
  export default {
    data() {
      return {
        dados: []
      }
    },
    mounted() {
      this.fetchDados()
    },
    methods: {
      fetchDados() {
        IndexService.get()
          .then(response => {
            this.dados = response.data
          })
          .catch(error => {
            console.error('Erro ao buscar dados:', error)
          })
      },
      addDados() {
        this.$router.push('/add')
      },
      editDados(id) {
        this.$router.push(`/edit/${id}`)
      },
      deleteDados(id) {
        IndexService.delete(id)
          .then(() => {
            this.fetchDados()
            console.log('Excluído com sucesso!')
          })
          .catch(error => {
            console.error('Erro ao excluir:', error)
          })
      }
    }
  }
</script>
  