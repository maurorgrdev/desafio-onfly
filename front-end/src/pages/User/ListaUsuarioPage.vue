<template>
     <!-- Dialog para deletar uma despesa -->
     <dialog-delete-component
        :show="showDialogDeletaUsuario"
        :titulo="titulo_dialog_delete"
        :descricao="descricao_dialog_delete"
        v-on:close-dialog="callBackCloseDeletaUsuario"
        v-on:confirm-dialog="callBackConfirmDeleteUsuario"
    >

    </dialog-delete-component>

    <!-- Dialog para visualizar um usuário -->
    <visualiza-usuario-dialog-page
        :show="showDialogVisualizaUsuario"
        v-on:close-dialog="callBackCloseVisualizaUsuario" 
        :usuario_original="usuario_selecionado_acao"
    />

    <!-- Dialog para cadastrar uma novo usuário -->
    <novo-usuario-dialog-page
        :show="showDialogNovoUsuario"
        v-on:close-dialog="callBackCloseNovoUsuario" 
        v-on:create-success="callBackNovoUsuarioSuccess"
    />

    <q-page>   
        <div class="q-pa-xl">
            <q-table 
                flat 
                bordered 
                title="Treats" 
                :rows="userStore.getUsuarios" 
                :columns="columns" 
                row-key="id"    
                table-header-class="bg-blue-5 text-white"
            >
                <template v-slot:body="props">
                    <q-tr :props="props">
                        <q-td key="id" :props="props">
                            {{ props.row.id }}
                        </q-td>
                        <q-td key="name" :props="props">
                            {{ props.row.name }}
                        </q-td>
                        <q-td key="email" :props="props">
                            {{ props.row.email }}
                        </q-td>
                        <q-td key="actions" :props="props">
                            <q-btn color="blue-5" class="q-mr-md" size="sm" round icon="visibility" @click="openDialogVisualizaUsuario(props.row)"><q-tooltip> Visualizar Usuário </q-tooltip></q-btn>
                            <q-btn color="blue-5" class="q-mr-md" size="sm" round icon="delete" @click="openDialogDeletaUsuario(props.row)"><q-tooltip> Deletar Usuário </q-tooltip></q-btn>
                        </q-td>
                    </q-tr>
                </template>
                <template v-slot:top>
                    <q-space />
                    <q-btn color="primary" label="NOVO USUÁRIO"  @click="openDialogNovoUsuario"/>
                </template>
            </q-table>
    </div>
    </q-page>

</template>

<script>
import { useUsuarioStore } from 'src/stores/user'
import useNotify from 'src/composables/UseNotify'
import NovoUsuarioDialogPage from './NovoUsuarioDialogPage.vue'
import VisualizaUsuarioDialogPage from './VisualizaUsuarioDialogPage.vue'
import DialogDeleteComponent from 'src/components/DialogDeleteComponent.vue'

export default {
    components: {
        NovoUsuarioDialogPage,
        VisualizaUsuarioDialogPage,
        DialogDeleteComponent,
    },

    setup() {
        const userStore = useUsuarioStore();
        const notify = useNotify();

        return {
            userStore,
            notify
        }
    },

    async mounted() {
        await this.userStore.loadUsuarios();
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
                { name: 'name', align: 'center', label: 'Nome', field: 'Nome', sortable: true },
                { name: 'email', align: 'center', label: 'Email', field: 'Email', sortable: true },
                { name: 'actions', align: 'center', label: 'Ações'},
            ],

            usuario_selecionado_acao: {},

            titulo_dialog_delete: '',
            descricao_dialog_delete: '',

            showDialogNovoUsuario: false,
            showDialogVisualizaUsuario: false,
            showDialogDeletaUsuario: false,
        }
    },

    methods: {
        // Funções para gerenciar Dialog de deletar usuario
        openDialogDeletaUsuario(usuario){
            this.usuario_selecionado_acao = {...usuario}

            this.titulo_dialog_delete = 'Deletar usuário'
            this.descricao_dialog_delete = "Deseja mesmo deletar este usuário ?"

            this.showDialogDeletaUsuario = true
        },

        callBackCloseDeletaUsuario()
        {
            this.showDialogDeletaUsuario = false
        },

        async callBackConfirmDeleteUsuario()
        {
            await this.userStore.deleteUsuario(this.usuario_selecionado_acao.id);

            this.notify.notifySuccess();
            
            await this.userStore.loadUsuarios();

            this.showDialogDeletaUsuario = false            
        },

        // Funções para gerenciar Dialog de visualizar usuario
        openDialogVisualizaUsuario(usuario_show){
            this.usuario_selecionado_acao = {
                ...usuario_show    
            }

            this.showDialogVisualizaUsuario = true
        },

        callBackCloseVisualizaUsuario()
        {
            this.showDialogVisualizaUsuario = false
        },

        // Funções para gerenciar Dialog de cadastrar usuario
        openDialogNovoUsuario(){
            this.showDialogNovoUsuario = true;
        },

        callBackCloseNovoUsuario()
        {
            this.showDialogNovoUsuario = false
        },

        async callBackNovoUsuarioSuccess()
        {
            await this.userStore.loadUsuarios();

            this.showDialogNovoUsuario = false
        },
    }
}
</script>