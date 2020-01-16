<template>
	<div id="dash">
		<table id="costumer-table">
			<tr>
				<th>ID</th>
                <th>status</th>
			</tr>
			<table-component v-for="table in tables" v-bind="table" :key="table.id"></table-component>
		</table>
	</div>
</template>
<script>

	function Table({status, id}) {
		this.status = status;
		this.id = id;
	}
	import TableComponent from './tableComponent.vue';

	export default {
		data() {
			return {
				tables: [],
				working: false
			}
		},
		methods: {
			read() {
				window.axios.get('/api/costumers').then(({data}) => {
					data.forEach(table => {
						this.tables.push(new Table(table));
					});
				});
			},
			update(id, status){

			}
		},
		mounted() {
			this.read();
            this.interval = setInterval(function () {
                this.read();
            }.bind(this), 36000);

		},

		components: {
			TableComponent
		}
	}

</script>
