<template>
	<div v-if="profile">
		<app-page-header
			icon="fa fa-cog"
			:title="'Editar Perfil: ' + profile.id"
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
							<input type="hidden" name="group" :value="profile.group" />
							<div class="row">
								<app-input
									placeholder="Título"
									label="Título"
									name="title"
									:minLength="2"
									:maxLength="50"
									:required="true"
									:value="profile.title"
								></app-input>
								<app-input
									placeholder="Código"
									label="Código"
									name="code"
									:minLength="2"
									:maxLength="50"
									:required="true"
									:value="profile.code"
								></app-input>
								<app-toggle
									label="Status"
									name="active"
									:value="Boolean(profile.active)"
								></app-toggle>
							</div>
							<h5 class="h5">Permissões</h5>
							<hr />
							<div class="row">
								<div id="accordion" class="accordion col-12">
									<div class="card">
										<div class="card-header" id="headingMenu">
											<button
												type="button"
												class="btn btn-outline-secondary"
												data-toggle="collapse"
												data-target="#menu"
												aria-expanded="true"
												aria-controls="menu"
											>
												Menu
											</button>
										</div>
										<div 
											id="menu"
											class="collapse show"
											aria-labelledby="headingMenu"
											data-parent="#accordion"
										>
											<div class="card-body" v-if="menus">
												<app-checkbox-group
													name="menus"
													:list="menus"
													:checkeds="profile.menus"
												></app-checkbox-group>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header" id="headingResources">
											<button
												type="button"
												class="btn btn-outline-secondary"
												data-toggle="collapse"
												data-target="#resources"
												aria-expanded="false"
												aria-controls="resources"
											>
												Recursos
											</button>
										</div>
										<div
											id="resources"
											class="collapse"
											aria-labelledby="headingResources"
											data-parent="#accordion"
										>
											<div class="card-body" v-if="resources">
												<app-checkbox-group
													name="resources"
													:list="resources"
													:checkeds="profile.resources"
												></app-checkbox-group>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr />
							<div class="row">
								<div class="col-12">
									<app-button
										type="update"
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
	import Toggle from '../forms/ToggleComponent';
	import CheckboxGroup from '../forms/CheckboxGroupComponent';
	import Button from '../forms/ButtonComponent';
	import Link from '../forms/LinkComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
			'app-input': Input,
			'app-toggle': Toggle,
			'app-checkbox-group': CheckboxGroup,
			'app-button': Button,
			'app-link': Link
		},
		data() {
			return {
				profile: null,
				menus: [],
				resources: [],
			}
		},
		props: {
			id: String,
			backUrl: String,
		},
		mounted() {
			this.load(this.id);
			this.loadMenus();
			this.loadResources();
		},
		methods: {
			load(id) {
				axios.get(`/web/profiles/${id}`)
					.then(res => {
						this.profile = res.data.profile;
					})
					.catch(err => {});
			},
			loadMenus() {
				axios.get('/web/menus/grouped')
					.then(res => {
						this.menus = res.data;
					})
					.catch(err => {});
			},
			loadResources() {
				axios.get('/web/resources/grouped')
					.then(res => {
						this.resources = res.data;
					})
					.catch(err => {});
			},
			onSubmit() {
				let data = new FormData(this.$refs.form);
				data.append('_method', 'PATCH');

				let validate = this.validateForm(this.$refs.form);

				if (validate != '') {
					Flash('error', validate);
				} else {
					axios.post(`/web/profiles/${this.profile.id}`, data)
						.then(res => {
							Swal.fire({
								title: 'Atualizado com sucesso!',
								type: 'success'
							})
							.then(result => {
								window.location.href = '/profiles';
							});
						})
						.catch(err => {
							Flash('error', 'Erro ao tentar atualizar registro!');
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