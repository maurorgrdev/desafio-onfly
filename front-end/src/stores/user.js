import { defineStore } from 'pinia'
import { api } from 'boot/axios'

export const useUsuarioStore = defineStore("usuario", {
    persist: true,

    state: () => ({
        usuario: {},
        usuarios: [],
    }),

    getters: {
        getUsuario(state){
          return state.usuario
        },

        getUsuarios(state){
            return state.usuarios;
        },
    },

    actions: {
        async login(data){
            try {
                const response = await api.post('/login', data);

                console.log(response.data);
                this.usuario = response.data.data.user;
                
                await localStorage.setItem("token", response.data.data.token);

                return response;
            } catch (error) {
                localStorage.setItem("token", '');
                this.usuario = {};

                return error.response;
            }
        },

        async loadUsuarios(){
            try {
                const result = await api.get('/user')

                this.usuarios = result.data.data

                return true;
            } catch (error) {

                return false;
            }
        },

        async addUsuario(data){
            try {
              const response = await api.post('/user', data);
    
              return response;
    
            } catch (error) {
              
              return error.response;
            }
          },

          async deleteUsuario(id_user){
            try {
              const response = await api.delete(`/user/${id_user}`);
    
              return response;
    
            } catch (error) {
              
              return error.response;
            }
          },

        async logout(){
            try {
                this.usuario = {};
                this.usuarios = [];
                
                localStorage.setItem("token", '');

                router.push('/login');
                
            } catch (error) {
                return false;
            }
        },
    },
  });