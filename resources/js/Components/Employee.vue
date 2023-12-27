<script>
export default {
	emits: ["remove"],
	props: {
		name: String,
		salary: Number,
		age: Number,
		id: Number
	},
}
</script>

<template>
	<tr>
		<th>{{ name }}</th>
		<th>{{ salary }}</th>
		<th>{{ age }}</th>
		<th><button @click="$emit('remove', id)">Удалить</button></th>
	</tr>
</template>

<style scoped>

</style>
