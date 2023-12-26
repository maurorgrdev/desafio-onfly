<template>
    <dialog-component :show="showDialog">
        <q-card-section>
            <q-form ref="myForm" class="q-gutter-md">
                <div class="row">
                    <div class="col-6 q-pa-sm">
                        <q-input disable dense outlined label="Data *" v-model="data" mask="##/##/####">
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
                            disable
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
                            disable
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
            <q-space />
            <q-btn @click="clickCancel()" outline style=" width: 150px; color: primary;" label="Voltar" />
          </q-card-actions>
    </dialog-component>
</template>

<script>

import DialogComponent from 'src/components/DialogTemplateComponent.vue'

export default {
    components: { DialogComponent },
    
    props: ['show', 'despesa_original'],

    emits: ['closeDialog'],

    data() {
        return {
            showDialog: false,

            codigo: '',
            data: '',
            descricao: '',
            valor: '',

            msgError: '',
        }
    },

    async updated() {
        this.showDialog = this.show
        
        this.codigo = this.despesa_original.id
        this.data = this.despesa_original.data
        this.descricao = this.despesa_original.descricao
        this.valor = this.despesa_original.valor
    },

    methods: {
        clickCancel()
        {
            this.showDialog = false
            this.$emit('closeDialog');
        },
    },
}
</script>