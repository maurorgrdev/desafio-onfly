<template>
    <dialog-component :show="showDialog">
        <q-card-section>
            <q-form ref="myForm" class="q-gutter-md">
                <div class="row">
                    <div class="col-6 q-pa-sm">
                        <q-input dense outlined label="Data *" v-model="data" mask="##/##/####">
                            <template v-slot:append>
                                <q-icon name="event" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-date v-model="data" mask="DD/MM/YYYY">
                                    <div class="row items-center justify-end">
                                        <q-btn v-close-popup label="Fechar" color="primary" flat />
                                    </div>
                                    </q-date>
                                </q-popup-proxy>
                                </q-icon>
                            </template>
                        </q-input>      
                    </div>
                    <div class="col-6 q-pa-sm">
                        <q-input
                            v-model.number="valor"
                            type="number"
                            dense
                            outlined
                            label="Valor *"
                        />
                    </div>
            
                </div>
                <div class="row">
                    <div class="col-12 q-pa-xs">
                        <q-input
                            label="Descrição *"
                            v-model="descricao"
                            outlined
                            type="textarea"
                            :rules="[ 
                                val => val && val.length > 0 || 
                                'Obrigatório'
                            ]"
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
import { useDespesaStore } from 'src/stores/despesa'
import useNotify from 'src/composables/UseNotify'

export default 
{
    components: { DialogComponent },

    props: ['show'],

    emits: ['closeDialog', 'createSuccess'],

    setup() {
        const despesaStore = useDespesaStore()
        const notify = useNotify()

        return {
            despesaStore,
            notify
        }
    },

    data() {
        return {
            showDialog: false,

            data: '',
            descricao: '',
            valor: '',

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
                descricao: this.descricao,
                valor: this.valor,
                data: this.data,
            }

            const result = await this.despesaStore.addDespesa(data);

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
            if(!(typeof errors.descricao === "undefined")){
                errors.descricao.forEach(erro => {
                    this.notify.notifyError(erro)
                });
            }

            if(!(typeof errors.valor === "undefined")){
                errors.valor.forEach(erro => {
                    this.notify.notifyError(erro)
                });
            }

            if(!(typeof errors.data === "undefined")){
                errors.data.forEach(erro => {
                    this.notify.notifyError(erro)
                });
            }

            if(!(typeof errors.user_id === "undefined")){
                errors.user_id.forEach(erro => {
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