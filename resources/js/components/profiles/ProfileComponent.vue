<template>
	<div>
		<app-page-header
			icon="fa fa-cog"
			title="Perfis"
			:breadcrumbs="[
				{ href: '/', title: 'Painel' }
			]"
		></app-page-header>

		<app-datatable
			entity="profiles"
			:allow-enable-multi="allows.enableMulti"
			:allow-disable-multi="allows.disableMulti"
			:allow-delete-multi="allows.deleteMulti"
			:options="{
				ajax: {
					url: '/web/profiles'
				},
				columns: this.columns
			}"
			:actions="{
				create: {
					allow: this.allows.create,
					url: '/profiles/create'
				},
				show: {
					allow: this.allows.show,
					url: '*',
					callback: onShow
				},
				edit: {
					allow: this.allows.edit,
					url: '/profiles/*/edit',
				},
				delete: {
					allow: this.allows.delete,
					url: '*'
				}
			}"
			:filters="[
				{
					name: 'active',
					type: 'select',
					label: 'Status',
					index: 5,
					options: status,
	        	}
			]"
		></app-datatable>

		<app-profile-show ref="profileShow"></app-profile-show>
	</div>
</template>

<script>
	import PageHeader from '../PageHeaderComponent';
	import DataTable from '../DataTableComponent';
	import ProfileShow from './ProfileShowComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
			'app-datatable': DataTable,
			'app-profile-show': ProfileShow
		},
		props: {
			allows: Object,
			columns: Array,
			status: Array,
		},
		methods: {
			onShow(id) {
				this.$refs.profileShow.open(id);
			}
		}
	}
</script>