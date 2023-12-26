<template>

    <!-- <edita-despesa-dialog-page :show="showDialogEditaDespesa">

    </edita-despesa-dialog-page> -->

    <nova-despesa-dialog-page 
        :show="showDialogNovaDespesa"
        v-on:close-dialog="callBackCloseNovaDespesa" 
        v-on:create-success="callBackNovaDespesaSuccess"
    />

    <!-- <visualiza-despesa-dialog-page :show="showDialogVisualizaDespesa">

    </visualiza-despesa-dialog-page> -->

    <q-page>   
        <div class="q-pa-xl">
            <q-table 
                flat 
                bordered 
                title="Treats" 
                :rows="despesaStore.getDespesas" 
                :columns="columns" 
                row-key="id"    
                table-header-class="bg-blue-5 text-white"
            >
                <template v-slot:body="props">
                    <q-tr :props="props">
                        <q-td key="id" :props="props">
                            {{ props.row.id }}
                        </q-td>
                        <q-td key="descricao" :props="props">
                            {{ props.row.descricao }}
                        </q-td>
                        <q-td key="data" :props="props">
                            {{ props.row.data }}
                        </q-td>
                        <q-td key="valor" :props="props">
                            {{ props.row.valor }}
                        </q-td>
                        <q-td key="actions" :props="props">
                            <q-btn color="blue-5" class="q-mr-md" size="sm" round icon="mode_edit" @click="openDialogEditaDespesa(props.row)"><q-tooltip> Editar Despesa </q-tooltip></q-btn>
                            <q-btn color="blue-5" class="q-mr-md" size="sm" round icon="visibility" @click="openDialogVisualizaDespesa(props.row)"><q-tooltip> Visualizar Despesa </q-tooltip></q-btn>
                            <q-btn color="blue-5" class="q-mr-md" size="sm" round icon="delete" @click="openDialogDeleteUsuario(props.row)"><q-tooltip> Deletar Despesa </q-tooltip></q-btn>

                        </q-td>
                    </q-tr>
                </template>
                <template v-slot:top>
                    <q-space />
                    <q-btn color="primary" label="NOVA DESPESA"  @click="openDialogNovaDespesa"/>
                </template>
            </q-table>
    </div>
    </q-page>

</template>

<script>
import { useDespesaStore } from 'src/stores/despesa'
// import EditaDespesaDialogPage from './EditaDespesaDialogPage.vue'
import NovaDespesaDialogPage from './NovaDespesaDialogPage.vue'
// import VisualizaDespesaDialogPage from './VisualizaDespesaDialogPage.vue'

export default {
    components: {
        // EditaDespesaDialogPage, 
        // VisualizaDespesaDialogPage, 
        NovaDespesaDialogPage
    },

    setup() {
        const despesaStore = useDespesaStore();

        return {
            despesaStore,
        }
    },

    async mounted() {
        await this.despesaStore.loadDespesas();
        console.log('mdsssss');
    },

    data() {
        return {
            columns: [
                {
                    name: 'id',
                    label: 'Código',
                    align: 'center',
                    field: 'Código',
                    sortable: true
                },
                { name: 'descricao', align: 'center', label: 'Descrição', field: 'Descrição', sortable: true },
                { name: 'data', align: 'center', label: 'Data', field: 'Data', sortable: true },
                { name: 'valor', align: 'center', label: 'Valor', field: 'Valor', sortable: true },
                { name: 'actions', align: 'center', label: 'Ações'},
            ],

            showDialogEditaDespesa: false,
            showDialogNovaDespesa: false,
            showDialogVisualizaDespesa: false,
        }
    },

    methods: {
        openDialogEditaDespesa(){

        },

        openDialogDeletaDespesa(){

        },

        openDialogVisualizaDespesa(){

        },

        // Funções para gerenciar Dialog de cadastrar despesas
        openDialogNovaDespesa(){
            this.showDialogNovaDespesa = true;
        },

        callBackCloseNovaDespesa()
        {
            this.showDialogNovaDespesa = false
        },

        async callBackNovaDespesaSuccess()
        {
            await this.despesaStore.loadDespesas();

            this.showDialogNovaDespesa = false
        },

    },
}
</script>