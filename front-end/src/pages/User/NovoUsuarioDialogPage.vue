<template>
    <dialog-component :show="showDialog">
        <q-card-section>
            <q-form ref="myForm" class="q-gutter-md">
                <div class="row">
                    <div class="col-6 q-pa-sm">
                        <q-input
                            v-model="name"
                            dense
                            outlined
                            label="Nome *"
                        />
                    </div>
                    <div class="col-6 q-pa-sm">
                        <q-input
                            v-model="email"
                            dense
                            outlined
                            label="Email *"
                        />
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-6 q-pa-sm">
                        <q-input
                            v-model="password"
                            dense
                            outlined
                            label="Senha *"
                        />
                    </div>
                </div>
            </q-form>
        </q-card-section>
        <q-card-actions class="row text-primary" style="padding-left: 15px; padding-right: 15px;">
            <q-btn @click="clickCancel()" outline style=" width: 150px; color: primary;" label="Cancelar" />
            <q-space />
            <q-btn @click="clickSubmit()" style=" width: 150px;" color="primary" label="Salvar" />
          </q-card-actions>
    </dialog-component>
</template>

<script>

import DialogComponent from 'src/components/DialogTemplateComponent.vue'
import { useUsuarioStore } from 'src/stores/user'
import useNotify from 'src/composables/UseNotify'

export default 
{
    components: { DialogComponent },

    props: ['show'],

    emits: ['closeDialog', 'createSuccess'],

    setup() {
        const usuarioStore = useUsuarioStore()
        const notify = useNotify()

        return {
            usuarioStore,
            notify
        }
    },

    data() {
        return {
            showDialog: false,

            name: '',
            email: '',
            password: '',

            msgError: '',
        }
    },

    updated() {
        this.showDialog = this.show
        
        this.data = ''
        this.descricao =''
        this.valor =''
    },

    methods: {
        clickCancel()
        {
            this.showDialog = false
            this.$emit('closeDialog');
        },

        async clickSubmit()
        {
            const data = {
                name: this.name,
                email: this.email,
                password: this.password,
            }

            const result = await this.usuarioStore.addUsuario(data);

            if(result.status === 201){
                this.notify.notifySuccess();

                this.$emit('createSuccess');
            }

            if(result.status === 422){
                this.getError(result.data.errors);
            }

            if(result.status === 400){
                this.notify.notifyError(result.data.message);
            }
            
        },

        getError(errors){
            if(!(typeof errors.name === "undefined")){
                errors.descricao.forEach(erro => {
                    this.notify.notifyError(erro)
                });
            }

            if(!(typeof errors.email === "undefined")){
                errors.valor.forEach(erro => {
                    this.notify.notifyError(erro)
                });
            }

            if(!(typeof errors.password === "undefined")){
                errors.data.forEach(erro => {
                    this.notify.notifyError(erro)
                });
            }
        },

        // Caso a validação venha ocorre no front-end também
        validationForm()
        {
            return true
        }
    },
}
</script>