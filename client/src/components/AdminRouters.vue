<template>
<div>
    <v-data-table :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :loading="dataTableLoading" :no-data-text="$t('dataTable.NO_DATA')" :no-results-text="$t('dataTable.NO_RESULTS')" :headers="headers" :items="items" :options.sync="pagination" :items-per-page="5" :server-items-length="totalItems" class="elevation-1" :footer-props="{
        'items-per-page-text': $t('dataTable.ROWS_PER_PAGE'),
        'items-per-page-options': [5, 10, 25]
      }">
        <template v-slot:top>
            <v-layout wrap>
                <v-flex xs12 sm12 md4 mt-3 pl-4>
                    <div class="text-left">
                        <!-- <v-toolbar-title>{{ $t('routers.TITLE') }}</v-toolbar-title>
                        <v-btn color="primary" @click="nextSort">
                            Sort next column
                        </v-btn>
                        <v-btn color="primary" class="mr-2" @click="sortDesc = !sortDesc">
                            Toggle sort order
                        </v-btn> -->
                    </div>
                </v-flex>
                <v-flex xs12 sm6 md4 px-3>
                    <v-text-field v-model="search" append-icon="mdi-magnify" :label="$t('dataTable.SEARCH')" id="search" single-line hide-details clearable clear-icon="mdi-close"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4 text-xs-right mb-2 mt-2 pr-2>
                    <ValidationObserver ref="observer" v-slot="{ invalid }" tag="form" @submit.prevent="submit()">
                        <v-dialog v-model="dialog" max-width="800px" content-class="dlgNewEditItem">
                            <template v-slot:activator="{ on }">
                                <div class="text-right">
                                    <v-btn color="secondary" v-on="on" class="btnNewItem pr-4">
                                        <v-icon class="mr-2">mdi-plus</v-icon>
                                        {{ $t('dataTable.NEW_ITEM') }}
                                    </v-btn>
                                </div>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container grid-list-md>
                                        <v-layout wrap>
                                            <template v-if="editedItem.id">
                                                <v-flex xs12 md4>
                                                    <label for="createdAt">
                                                        {{ $t('common.CREATED')}}</label>
                                                    <div name="createdAt">
                                                        {{ getFormat(editedItem.created_at) }}
                                                    </div>
                                                </v-flex>
                                                <v-flex xs12 md4>
                                                    <label for="updatedAt">
                                                        {{$t('common.UPDATED')}}
                                                    </label>
                                                    <div name="updatedAt">
                                                        {{ getFormat(editedItem.updated_at) }}
                                                    </div>
                                                </v-flex>
                                            </template>
                                            <v-flex xs12 md6>
                                                <ValidationProvider rules="required|min:10" v-slot="{ errors }">
                                                    <v-text-field id="sap_id" name="sap_id" v-model="editedItem.sap_id" :label="$t('routers.headers.SAPID')" :error="errors.length > 0" :error-messages="errors[0]" autocomplete="off"></v-text-field>
                                                </ValidationProvider>
                                            </v-flex>
                                            <v-flex xs12 md6>
                                                <ValidationProvider rules="required|url" v-slot="{ errors }">
                                                    <v-text-field id="hostname" name="hostname" type="url" v-model="editedItem.hostname" :label="$t('routers.headers.HOSTNAME')" :error="errors.length > 0" :error-messages="errors[0]" autocomplete="off"></v-text-field>
                                                </ValidationProvider>
                                            </v-flex>
                                            <v-flex xs12 md6>
                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                    <v-text-field id="loopback" name="loopback" type="text" v-model="editedItem.loopback" :label="$t('routers.headers.LOOPBACK')" :error="errors.length > 0" :error-messages="errors[0]" autocomplete="off"></v-text-field>
                                                </ValidationProvider>
                                            </v-flex>
                                            <v-flex xs12 md6>
                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                    <v-text-field id="mac_address" name="mac_address" type="text" v-model="editedItem.mac_address" :label="$t('routers.headers.MACADDRESS')" :error="errors.length > 0" :error-messages="errors[0]" autocomplete="off"></v-text-field>
                                                </ValidationProvider>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="red lighten3" text @click="close" class="btnCancel">{{ $t('dataTable.CANCEL') }}</v-btn>
                                    <v-btn color="green" text @click="save" :disabled="invalid" class="btnSave">{{ $t('dataTable.SAVE') }}</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </ValidationObserver>
                </v-flex>
            </v-layout>
        </template>
        <template v-slot:items="props">
            <td>{{ props.item.id }}</td>
            <td>{{ props.item.sap_id }}</td>
            <td>{{ props.item.hostname }}</td>
            <td>{{ props.item.loopback }}</td>
            <td>{{ props.item.mac_address }}</td>
        </template>
        <template v-slot:[`item._id`]="{ item }">
            <td class="fill-height px-0">
                <v-layout class="justify-center">
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn id="edit" icon class="mx-0" v-on="on" @click="editItem(item)">
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                        </template>
                        <span>{{ $t('dataTable.EDIT') }}</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn id="delete" icon class="mx-0" v-on="on" @click="deleteItem(item)">
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <span>{{ $t('dataTable.DELETE') }}</span>
                    </v-tooltip>
                </v-layout>
            </td>
        </template>
        <template v-slot:[`item.createdAt`]="{ item }">
            {{ getFormat(item.created_at) }}
        </template>
        <template v-slot:[`item.updatedAt`]="{ item }">
            {{ getFormat(item.updated_at) }}
        </template>
        <template v-slot:[`footer.page-text`]="{ pageStart, pageStop, itemsLength }">
            {{ pageStart }} - {{ pageStop }}
            {{ $t('dataTable.OF') }}
            {{ itemsLength }}
        </template>
        <template v-slot:no-data>{{ $t('dataTable.NO_DATA') }}</template>
        <template v-slot:no-results>{{ $t('dataTable.NO_RESULTS') }}</template>
    </v-data-table>
    <ErrorMessage />
    <SuccessMessage />
</div>
</template>

<script>
import {
    mapActions
} from 'vuex'
import {
    getFormat,
    buildPayloadPagination
} from '@/utils/utils.js'

export default {
    metaInfo() {
        return {
            title: this.$store.getters.appTitle,
            titleTemplate: `${this.$t('routers.TITLE')} - %s`
        }
    },
    data() {
        return {
            sortBy: this.$i18n.t('routers.headers.HOSTNAME'),
            sortDesc: false,
            searchInput: '',
            dataTableLoading: true,
            delayTimer: null,
            dialog: false,
            search: '',
            pagination: {},
            editedItem: {},
            defaultItem: {},
            fieldsToSearch: ['sap_id', 'hostname', 'mac_address', 'loopback']
        }
    },
    computed: {
        roles() {
            return [{
                    name: this.$t('roles.ADMIN'),
                    value: 'admin'
                },
                {
                    name: this.$t('roles.USER'),
                    value: 'user'
                }
            ]
        },
        allCities() {
            return this.$store.state.cities.allCities
        },
        formTitle() {
            return this.editedItem._id ?
                this.$t('dataTable.EDIT_ITEM') :
                this.$t('dataTable.NEW_ITEM')
        },
        headers() {
            return [{
                    text: this.$i18n.t('dataTable.ACTIONS'),
                    value: '_id',
                    sortable: false,
                    width: 100
                },
                {
                    text: 'ID',
                    align: 'left',
                    sortable: true,
                    value: 'id'
                },
                {
                    text: this.$i18n.t('routers.headers.SAPID'),
                    align: 'left',
                    sortable: true,
                    value: 'sap_id'
                },
                {
                    text: this.$i18n.t('routers.headers.HOSTNAME'),
                    align: 'left',
                    sortable: true,
                    value: 'hostname'
                },
                {
                    text: this.$i18n.t('routers.headers.LOOPBACK'),
                    align: 'left',
                    sortable: true,
                    value: 'loopback'
                },
                {
                    text: this.$i18n.t('routers.headers.MACADDRESS'),
                    align: 'left',
                    sortable: true,
                    value: 'mac_address'
                },
                {
                    text: this.$i18n.t('common.CREATED'),
                    align: 'left',
                    sortable: true,
                    value: 'createdAt'
                },
                {
                    text: this.$i18n.t('common.UPDATED'),
                    align: 'left',
                    sortable: true,
                    value: 'updatedAt'
                }
            ]
        },
        items() {
            return this.$store.state.adminRouters.routers
        },
        totalItems() {
            return this.$store.state.adminRouters.totalRouters
        },
        sortHeader() {
            return this.headers.filter(h => h.text != this.$i18n.t('dataTable.ACTIONS'))
        }
    },
    watch: {
        dialog(value) {
            return value ? true : this.close()
        },
        pagination: {
            async handler() {
                try {
                    this.dataTableLoading = true
                    await this.getRouterFilters(
                        buildPayloadPagination(this.pagination, this.buildSearch())
                    )
                    this.dataTableLoading = false
                    // eslint-disable-next-line no-unused-vars
                } catch (error) {
                    this.dataTableLoading = false
                }
            },
            deep: true
        },
        search() {
            clearTimeout(this.delayTimer)
            this.delayTimer = setTimeout(() => {
                this.doSearch()
            }, 400)
        }
    },
    methods: {
        ...mapActions([
            'getRouters',
            'getRouterFilters',
            'editRouter',
            'saveRouter',
            'deleteRouter'
        ]),
        getFormat(date) {
            window.__localeId__ = this.$store.getters.locale
            return getFormat(date, 'MMMM d yyyy, h:mm a')
        },
        roleName(value) {
            return value === 'admin' ? this.$t('roles.ADMIN') : this.$t('roles.USER')
        },
        trueFalse(value) {
            return value ?
                '<i aria-hidden="true" class="v-icon mdi mdi-check green--text" style="font-size: 16px;"></i>' :
                '<i aria-hidden="true" class="v-icon mdi mdi-close red--text" style="font-size: 16px;"></i>'
        },
        async doSearch() {
            try {
                this.dataTableLoading = true
                await this.getRouterFilters(
                    buildPayloadPagination(this.pagination, this.buildSearch())
                )
                this.dataTableLoading = false
                // eslint-disable-next-line no-unused-vars
            } catch (error) {
                this.dataTableLoading = false
            }
        },
        buildSearch() {
            return this.search ? {
                query: this.search,
                fields: this.fieldsToSearch
            } : {}
        },
        editItem(item) {
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },
        async deleteItem(item) {
            try {
                const response = await this.$confirm(
                    this.$t('common.DO_YOU_REALLY_WANT_TO_DELETE_THIS_ITEM'), {
                        title: this.$t('common.WARNING'),
                        buttonTrueText: this.$t('common.DELETE'),
                        buttonFalseText: this.$t('common.CANCEL'),
                        buttonTrueColor: 'red lighten3',
                        buttonFalseColor: 'yellow'
                    }
                )
                if (response) {
                    this.dataTableLoading = true
                    await this.deleteRouter(item.id)
                    await this.getRouterFilters(
                        buildPayloadPagination(this.pagination, this.buildSearch())
                    )
                    this.dataTableLoading = false
                }
                // eslint-disable-next-line no-unused-vars
            } catch (error) {
                this.dataTableLoading = false
            }
        },
        close() {
            this.dialog = false
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
            }, 300)
        },
        async save() {
            try {
                this.dataTableLoading = true
                // Updating item
                if (this.editedItem.id) {
                    await this.editRouter(this.editedItem)
                    await this.getRouterFilters(
                        buildPayloadPagination(this.pagination, this.buildSearch())
                    )
                    this.dataTableLoading = false
                } else {
                    // Creating new item
                    await this.saveRouter({
                        sap_id: this.editedItem.sap_id,
                        hostname: this.editedItem.hostname,
                        loopback: this.editedItem.loopback,
                        mac_address: this.editedItem.mac_address,
                    })
                    await this.getRouterFilters(
                        buildPayloadPagination(this.pagination, this.buildSearch())
                    )
                    this.dataTableLoading = false
                }
                this.close()
                return
                // eslint-disable-next-line no-unused-vars
            } catch (error) {
                this.dataTableLoading = false
                this.close()
            }
        },
        nextSort() {
            let index = this.sortHeader.findIndex(h => h.value === this.sortBy)
            index = (index + 1) % this.sortHeader.length
            this.sortBy = this.sortHeader[index].value
            console.log(this.sortBy);
        },
    },

}
</script>

<style>
table.v-table {
    max-width: none;
}
</style>
