<template>
    <q-dialog v-model="showDialog" persistent>
      <q-card
        style="width: 700px; max-width: 80vw;"
      >
        <q-card class="bg-negative text-white">
            <q-card-section>
                <div class="text-h6">{{ descricao }}</div>
            </q-card-section>

            <q-card-actions class="row text-negative bg-white"  style="padding-left: 15px; padding-right: 15px;">
                <q-space />
                <q-btn @click="clickCancel()" outline style=" width: 150px; color: negative;" label="Cancelar" />
                <q-btn @click="clickConfirm()" style=" width: 150px;" color="negative" label="confirmar" />
            </q-card-actions>
        </q-card>
      </q-card>
    </q-dialog>
  </template>
  
  <script>
  
  export default {
  
    props: ['show', 'titulo', 'descricao'],

    emits: ['closeDialog', 'confirmDialog'],
  
    data() {
      return {
        showDialog: false,
      }
    },
  
    updated() {
      this.showDialog = this.show;
    },

    methods: {
        clickConfirm(){
            this.showDialog = false
            this.$emit('confirmDialog');
        },

        clickCancel(){
            this.showDialog = false
            this.$emit('closeDialog');
        },
    },
  }
  
  </script>