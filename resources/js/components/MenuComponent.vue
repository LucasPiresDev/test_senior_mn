<template>
	<ul class="app-menu">
		<li class="p-2">
			<a href="/home" class="p-3"> 
				Home
			</a>
		</li>
		<li class="p-2">
			<a href="/states" class="p-3">
				Estados
			</a>
		</li>
		<li class="p-2">
			<a href="/cities" class="p-3">
				Cidades
			</a>
		</li>
		<li class="p-2">
			<a href="/addresses" class="p-3">
				Endereços
			</a>
		</li>
		<li class="p-2">
			<a href="/users" class="p-3">
				Usuários
			</a>
		</li>
		<li v-for="item in items" v-bind:class="{ treeview: (item instanceof Array) }">
			<a
				v-if="(item instanceof Array)"
				href="#"
				class="app-menu__item"
				data-toggle="treeview"
				v-on:click="onTreeViewClick"
			>
				<i v-bind:class="'app-menu__icon fa fa-' + item[0].icon"></i>
				<span class="app-menu__label">{{ item[0].group_name }}</span>
				<i class="treeview-indicator fa fa-angle-right"></i>
			</a>
			<ul v-if="(item instanceof Array)" class="treeview-menu">
				<li v-for="itemGroup in item">
					<a
						:href="'/' + itemGroup.controller + '/' + getAction(itemGroup.action)"
						class="app-menu__item"
					>
						<i class="app-menu__icon fa fa-circle-o"></i>
						<span class="app-menu__label">{{ itemGroup.title }}</span>
					</a>
				</li>
			</ul>
			<a
				v-if="!(item instanceof Array)"
				:href="'/' + item.controller"
				class="app-menu__item"
			>
				<i v-bind:class="'app-menu__icon fa fa-' + item.icon"></i>
				<span class="app-menu__label">{{ item.title }}</span>
			</a>
		</li>
	</ul>
</template>

<script>
	export default {
		data: (e) => {
			return {
				items: []
			}
		},
		created() {},
		mounted() {
			cash("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');
		},
		methods: {
			getAction(action) {
				return (action != 'index') ? action : '';
			},
			onTreeViewClick: (e) => {
				e.preventDefault();
				var treeviewMenu = cash('.app-menu');

				if (!cash(e.currentTarget).parent().hasClass('is-expanded')) {
					treeviewMenu.find("[data-toggle='treeview']")
						.parent()
						.removeClass('is-expanded');
				}

				cash(e.currentTarget).parent().toggleClass('is-expanded');
			}
		}
	}
</script>