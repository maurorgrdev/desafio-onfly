<template>
    <dialog-component :show="showDialog">
        <q-card-section>
            <q-form ref="myForm" class="q-gutter-md">
                <div class="row">
                    <div class="col-6 q-pa-sm">
                        <q-input
                            v-model="name"
                            dense
                            disabled
                            outlined
                            label="Nome *"
                        />
                    </div>
                    <div class="col-6 q-pa-sm">
                        <q-input
                            v-model="email"
                            dense
                            disabled
                            outlined
                            label="Email *"
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
    
    props: ['show', 'usuario_original'],

    emits: ['closeDialog'],

    data() {
        return {
            showDialog: false,

            name: '',
            email: '',

            msgError: '',
        }
    },

    async updated() {
        this.showDialog = this.show
        
        this.id = this.usuario_original.id
        this.name = this.usuario_original.name
        this.email = this.usuario_original.email
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