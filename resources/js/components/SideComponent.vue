<template>
	<aside class="app-sidebar">
		<div class="app-sidebar__user">
			<img src="/assets/img/user-default.png" class="app-sidebar__user-avatar">
			<div class="col-8 p-0">
				<p class="app-sidebar__user-name">Lucas Pires</p>
				<p class="app-sidebar__user-designation text-truncate">
					Manager
				</p>
			</div>
		</div>
		<app-menu></app-menu>
	</aside>
</template>

<script>
	import Menu from './MenuComponent';

	export default {
		components: {
			'app-menu': Menu
		}
	}
</script>