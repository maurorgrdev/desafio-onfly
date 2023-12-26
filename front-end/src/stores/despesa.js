import { defineStore } from 'pinia'
import { api } from 'boot/axios'
import moment from 'moment';
import { useUsuarioStore }  from './user'

export const useDespesaStore = defineStore("despesa", {
    state: () => ({
        despesas: [],
        despesa: {},
    }),

    getters: {
      getDespesa(state){
        return state.despesa
      },
      
      getDespesas(state){
        return state.despesas;
      },

      getDespesasToTable(state){
        const despesaTemp = state.despesas.map((despesa) => {
            return  {
                ...despesa,
                data: moment(despesa.data, 'YYYY-MM-DD').format('DD/MM/YYYY'),
            }
        });
        
        return despesaTemp;
      }
    },

    actions: {
      async loadDespesa(id){
        try {
          const data = await api.get(`/despesa/${id}`)
          this.despesa = {...data.data}
        }
          catch (error) {
            alert(error)
            
        }
      },

      async loadDespesas() {
        try {
          const result = await api.get('/despesa')
          
          this.despesas = result.data.data
        }
          catch (error) {
            alert(error)
        }
      },

      async addDespesa(dados){
        try {
          const user = useUsuarioStore()

          let despesa ={
            ...dados,
            data: moment(dados.data, 'DD/MM/YYYY').format('YYYY-MM-DD'),
            user_id: user.usuario.id
          }
          
          const response = await api.post('/despesa', despesa);

          return response;

        } catch (error) {
          
          return error.response;
        }
      },

      async editDespesa(despesa, codigo){
        try {
          const user = useUsuarioStore()

          let dados ={
            ...despesa,
            data: moment(despesa.data, 'DD/MM/YYYY').format('YYYY-MM-DD'),
            user_id: user.usuario.id
          }

          const response = await api.put(`/despesa/${codigo}`, dados);

          return response;
        
        } catch (error) {
          
          return error.response;
        
        }
      },

      async deleteDespesa(codigo){
        try {

          const response = await api.delete(`/despesa/${codigo}`);

          return response;
        
        } catch (error) {
          
          return error.response;
        
        }
      }
    },
  });