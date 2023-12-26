<template>
    <q-layout view="hHh lpR fFf">
        <q-page-container>
            <q-page>
                <div class="row justify-center" style="padding-top: 20px;">
                    <q-card class="my-card" flat bordered>
                        <div class="q-pa-md" style="max-width: 400px">
                            <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
                                <q-input outlined v-model="email" label="Seu email *" type="email" hint="Email" />

                                <q-input outlined v-model="password" label="Sua senha *" hint="senha" />
            
                                <div class="row text-primary">
                                    <q-btn outline style=" width: 100px; color: blue-10;" label="Limpar" type="reset" class="q-ml-sm" />
                                    <q-space />
                                    <q-btn label="Entrar" style=" width: 100px;" type="submit" color="primary"/>
                                </div>
                            </q-form>
                        </div>
                    </q-card>
                </div>
            </q-page>
        </q-page-container>
    </q-layout>
</template>

<script>

import { ref } from 'vue'
import { useUsuarioStore } from 'stores/user'
import useNotify from 'src/composables/UseNotify'

export default {
    data() {
        return {
            email: '',
            password: '',
            msgError: '',
        }
    },
    setup () {
        const usuarioStore = useUsuarioStore()
        const notify = useNotify()

        return {
            usuarioStore,
            notify,
        }
    },

    methods: {
        async onSubmit () 
        {
            if(await this.validationLogin()){
                const response = await this.usuarioStore.login({
                    email: this.email,
                    password: this.password,
                });

                if(response.status === 200){
                    this.notify.notifySuccess('Login efetuado com sucesso!');

                    this.$router.push('/despesa');
                } else {
                    this.notify.notifyError(this.msgError);
                }
            } else {
                this.notify.notifyError(this.msgError);
            }
        },

        async validationLogin(){
            if((this.email === '') || this.email === null || this.email.length <= 0){
                this.msgError = 'Informe um email';
                return false;
            }

            if((this.password === '') || this.password === null || this.password.length <= 0){
                this.msgError = 'Informe uma senha';
                return false;
            }

            return true;
        },

        async onReset(){
            this.email = ''
            this.password = ''
        },

        
    },
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 350px
</style>