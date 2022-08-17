<template>
	<header class="app-header">
		<a
			class="app-sidebar__toggle"
			href="javascript:"
			data-toggle="sidebar"
			aria-label="Hide Sidebar"
			v-on:click="onToggleSideBar"
		></a>
		<ul class="app-nav">
			<li class="dropdown">
				<a
					class="app-nav__item"
					href="javascript:" 
					title="Sair"
					v-on:click="onLogout"
				>
					<i class="fa fa-sign-out fa-lg"></i>
				</a>
			</li>
		</ul>
	</header>
</template>

<script>

	export default {
		props: {
			title: String
		},
		methods: {
			onLogout: () => {
				axios.post('/logout')
					.then(res => {
						window.location.href = '/';
					})
					.catch(err => {
						Flash('error', 'Não foi possível sair do sistema, tente novamente!');
					});
			},
			onToggleSideBar: () => {
				if (cash('.sidenav-toggled').length) {
					localStorage.setItem('menuState', 'show');
				} else {
					localStorage.setItem('menuState', 'hide');
				}
			}
		}
	}
</script>