<template>
	<div>
		<app-page-header
			icon="fa fa-cog"
			title="Cadastrar Perfil"
			:breadcrumbs="[
				{ href: '/', title: 'Painel' },
				{ href: '/profiles', title: 'Perfis' },
			]"
		></app-page-header>
		<div class="row">
			<div class="col-12">
				<div class="tile">
					<div class="tite-body">
						<form ref="form">
							<div class="row">
								<app-input
									placeholder="Título"
									label="Título"
									name="title"
									:minLength="2"
									:maxLength="50"
									:required="true"
								></app-input>
								<app-input
									placeholder="Código"
									label="Código"
									name="code"
									:minLength="2"
									:maxLength="50"
									:required="true"
								></app-input>
								<app-select
									title="Grupo"
									label="Grupo"
									name="group"
									:required="true"
									:options="groups"
								></app-select>
							</div>
							<hr />
							<div class="row">
								<div class="col-12">
									<app-button
										type="save"
										:callback="onSubmit"
									></app-button>
									<app-link
										type="back"
										:url="backUrl"
									></app-link>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import PageHeader from '../PageHeaderComponent';
	import Input from '../forms/InputComponent';
	import Select from '../forms/SelectComponent';
	import Button from '../forms/ButtonComponent';
	import Link from '../forms/LinkComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
			'app-input': Input,
			'app-select': Select,
			'app-button': Button,
			'app-link': Link
		},
		data() {
			return {
				groups: []
			}
		},
		props: {
			backUrl: String,
		},
		mounted() {
			this.loadGroups();
		},
		methods: {
			loadGroups() {
				axios.get('/web/profile_groups')
					.then(res => {
						this.groups = res.data;
					})
					.catch(err => {});
			},
			async onSubmit() {
				let data = new FormData(this.$refs.form);

				let validate = this.validateForm(this.$refs.form);

				if (validate != '') {
					Flash('error', validate);
				} else {
					axios.post('/web/profiles', data)
						.then(res => {
							Swal.fire({
								title: 'Cadastrado com sucesso!',
								type: 'success'
							})
							.then(result => {
								window.location.href = '/profiles';
							});
						})
						.catch(err => {
							Flash('error', 'Erro ao tentar salvar registro!');
						});
				}
			},
			validate(form) {
				cash(form).find('input,select').removeClass('is-invalid');
				cash(form).find('input,select').removeClass('is-valid');

				let result = this.validateForm(form.elements);

				return result;
			}
		}
	}
</script>