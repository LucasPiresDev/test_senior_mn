<template>
	<div class="col-12">
		<div class="jumbotron">
			<h1 class="h3 font-weight-light">
				Olá {{ userName }}
			</h1>
			<p class="lead">
				{{ 'Hoje é ' + date }}
			</p>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			userName: String,
			date: String
		}
	}
</script>