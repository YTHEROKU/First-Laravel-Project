<template>
	<div>
        <div class = "container">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    Employee Data
                    <el-row class="float-right">
                        <a href="/add-employee">
                            <el-button type="success">Add Employee</el-button>
                        </a>
                        <a href="/download-pdf">
                            <el-button type="primary">Download</el-button>
                        </a>
                    </el-row>
                </div>
                <div>
                    <el-table
                        :data="tableData"
                        style="width: 100%" :border="true" height="500">
                            <el-table-column v-for="column in tableColumns" 
                                :key="column.label" 
                                :label="column.label" 
                                :prop="column.prop" 
                                :column-key="column.prop"
                                :min-width="column.minWidth"
                                :sortable="column.sortable"
                                :align="column.align"
                                :header-align="column.align"
                                >
                            </el-table-column>
                            <el-table-column align=right min-width="150">
                                <template slot="header" slot-scope="scope">
                                    <el-input v-model="search" size="mini" placeholder="Search Here" />
                                </template>
                                <template slot-scope="scope">
                                    <el-button size="mini" type="info" @click="showEmployee(scope.$index, scope.row)">Show
                                    </el-button>
                                    <el-button size="mini" type="success" @click="editEmployee(scope.$index, scope.row)">Edit
                                    </el-button>
                                    <el-button size="mini" type="danger" @click="deleteEmployee(scope.$index, scope.row)">Delete</el-button>
                                </template>
                            </el-table-column>
                    </el-table>
                </div>
            </el-card>
        </div>
	</div>	
</template>
<script>
    import * as vuex from 'vuex';
	export default{
		name:'employee-form',
        props:{
            scope:String,
            id:Number,
        },
        mounted(){
            const loading = this.$loading({
                lock:true,
                text: 'loading...',
                spinner: 'el-icon-loading',
                background: 'rgba(255,255,255,0.85)',
            });

            this.$store.dispatch('getEmployeesData', {searchQuery: this.search});

            loading.close();
        },
        watch: {
            search: function(keyword) {
                this.$store.dispatch('getEmployeesData', {searchQuery: this.search});
            }
        },
        computed:{
			...vuex.mapGetters({
				tableData: "tableData"
			})
		},
		data(){
			return{
                search:null,
				form:{
					name:null,
					department:null,
					section:null,
					email:null,
				},
                tableColumns: [
                    {
                        prop: 'name',
                        label: 'Name',
                        minWidth: 100,
                        sortable: true,
                        hidden: true,
                        align: "center",
                        fixed: true,
                    },
                    {
                        prop: 'department',
                        label: 'Department',
                        minWidth: 100,
                        sortable: true,
                        hidden: true,
                        align: "center",
                        fixed: true,
                    },
                    {
                        prop: 'section',
                        label: 'Section',
                        minWidth: 100,
                        sortable: true,
                        hidden: true,
                        align: "center",
                        fixed: true,
                    },
                    {
                        prop: 'email',
                        label: 'Email',
                        minWidth: 100,
                        sortable: false,
                        hidden: true,
                        align: "center",
                        fixed: true,
                    }
                ]
			}
		},
		methods:{
            editEmployee(index, row) {
                window.location.href="/edit-employee/" + row.id + "/edit";
            },
            showEmployee(index, row){
                window.location.href="/show-employee/" + row.id;
            },
            deleteEmployee(index, row) {
                this.$confirm('Do you want to delete this employee', 'Warning', {
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                }).then(() => {

                    this.$store.dispatch('deleteEmployee', {
                        id:row.id
                    });

                    this.$store.dispatch('getEmployeesData');

                    this.$message({
                        type: 'success',
                        message: 'Delete completed'
                    });
                }).catch(() => {
                    this.$message({
                    type: 'info',
                    message: 'Delete canceled'
                    });          
                });
            }
	    }
    }
</script>
<style scoped>
    .float-right{
        float:right;
    }
</style>