<template>
    <q-dialog v-model="showDialog" persistent>
      <q-card
        style="width: 700px; max-width: 80vw;"
      >
          <slot></slot>
      </q-card>
    </q-dialog>
  </template>
  
  <script>
  
  export default {
  
    props: ['show'],
  
    data() {
      return {
        showDialog: false,
      }
    },
  
    updated() {
      this.showDialog = this.show;
    },
  }
  
  </script>