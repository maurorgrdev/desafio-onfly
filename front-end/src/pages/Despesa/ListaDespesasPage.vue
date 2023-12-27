<template>
    <!-- Dialog para deletar uma despesa -->
    <dialog-delete-component
        :show="showDialogDeletaDespesa"
        :titulo="titulo_dialog_delete"
        :descricao="descricao_dialog_delete"
        v-on:close-dialog="callBackCloseDeletaDespesa"
        v-on:confirm-dialog="callBackConfirmDeleteDespesa"
    >

    </dialog-delete-component>

    <!-- Dialog para editar uma despesa -->
    <edita-despesa-dialog-page
        :show="showDialogEditaDespesa"
        v-on:close-dialog="callBackCloseEditaDespesa" 
        v-on:create-success="callBackEditaDespesaSuccess"
        :despesa_original="despesa_selecionada_acao"
    />

    <!-- Dialog para cadastrar uma nova despesa -->
    <nova-despesa-dialog-page 
        :show="showDialogNovaDespesa"
        v-on:close-dialog="callBackCloseNovaDespesa" 
        v-on:create-success="callBackNovaDespesaSuccess"
    />

    <!-- Dialog para visualizar uma despesa -->
    <visualiza-despesa-dialog-page
        :show="showDialogVisualizaDespesa"
        v-on:close-dialog="callBackCloseVisualizaDespesa" 
        :despesa_original="despesa_selecionada_acao"
    />

    <!-- Contém tabela principal com as despesas dos usuários -->
    <q-page>   
        <div class="q-pa-xl">
            <q-table 
                flat 
                bordered 
                title="Treats" 
                :rows="despesaStore.getDespesasToTable" 
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
                            <q-btn color="blue-5" class="q-mr-md" size="sm" round icon="delete" @click="openDialogDeletaDespesa(props.row)"><q-tooltip> Deletar Despesa </q-tooltip></q-btn>

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
import useNotify from 'src/composables/UseNotify'
import EditaDespesaDialogPage from './EditaDespesaDialogPage.vue'
import NovaDespesaDialogPage from './NovaDespesaDialogPage.vue'
import VisualizaDespesaDialogPage from './VisualizaDespesaDialogPage.vue'
import DialogDeleteComponent from 'src/components/DialogDeleteComponent.vue'

export default {
    components: {
    EditaDespesaDialogPage,
    VisualizaDespesaDialogPage, 
    NovaDespesaDialogPage,
    DialogDeleteComponent
},

    setup() {
        const despesaStore = useDespesaStore();
        const notify = useNotify();

        return {
            despesaStore,
            notify
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

            despesa_selecionada_acao: {},

            showDialogEditaDespesa: false,
            showDialogNovaDespesa: false,
            showDialogVisualizaDespesa: false,
            showDialogDeletaDespesa: false,

            titulo_dialog_delete: '',
            descricao_dialog_delete: '',
        }
    },

    methods: {
        // Funções para gerenciar Dialog de editar despesa
        async openDialogEditaDespesa(despesa_edit){
            this.despesa_selecionada_acao = {
                ...despesa_edit    
            }

            this.showDialogEditaDespesa = true;
        },

        callBackCloseEditaDespesa()
        {
            this.showDialogEditaDespesa = false
        },

        async callBackEditaDespesaSuccess()
        {
            await this.despesaStore.loadDespesas();

            this.showDialogEditaDespesa = false
        },

        // Funções para gerenciar Dialog de deletar despesa
        openDialogDeletaDespesa(despesa){
            this.despesa_selecionada_acao = {...despesa}

            this.titulo_dialog_delete = 'Deletar Despesa'
            this.descricao_dialog_delete = "Deseja mesmo deletar esta despesa ?"

            this.showDialogDeletaDespesa = true
        },

        callBackCloseDeletaDespesa()
        {
            this.showDialogDeletaDespesa = false
        },

        async callBackConfirmDeleteDespesa()
        {
            await this.despesaStore.deleteDespesa(this.despesa_selecionada_acao.id);

            this.notify.notifySuccess();

            await this.despesaStore.loadDespesas();

            this.showDialogDeletaDespesa = false
        },

        // Funções para gerenciar Dialog de visualizar despesa
        openDialogVisualizaDespesa(despesa_show){
            this.despesa_selecionada_acao = {
                ...despesa_show    
            }

            this.showDialogVisualizaDespesa = true
        },

        callBackCloseVisualizaDespesa()
        {
            this.showDialogVisualizaDespesa = false
        },

        // Funções para gerenciar Dialog de cadastrar despesa
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