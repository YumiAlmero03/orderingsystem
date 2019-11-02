<template>
	<tr>
		<td>{{status}}</td>
		<td><button @change="update" :value="status">{{status}}</button></td>
	</tr>
</template>
<script >
	export default{
		props:['status', 'id'],
		methods:{
			update(val){
				this.$emit('update', this.id, val.value)
			}
		}
	}
</script>