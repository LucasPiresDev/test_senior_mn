<template>
	<div v-if="background">
		<app-page-header
			icon="fa fa-image"
			:title="'Editar Fundo de tela: ' + background.id"
			:breadcrumbs="[
				{ href: '/', title: 'Painel' },
				{ href: '/backgrounds', title: 'Fundos de tela' },
			]"
		></app-page-header>
		<div class="row">
			<div class="col-12">
				<div class="tile">
					<div class="tite-body">
						<form ref="form">
							<div class="row">
								<app-input
									placeholder="Descrição"
									label="Descrição"
									name="description"
									:minLength="2"
									:maxLength="100"
									:required="true"
									:value="background.description"
								></app-input>
								<app-file-input
									label="Thumb (melhor 132x165, limite 1024)"
									placeholder="Thumb"
									name="thumb"
									accept="image/png"
								></app-file-input>
								<app-file-input
									label="Imagem (melhor 390x600)"
									placeholder="Imagem"
									name="image"
									accept="image/png"
								></app-file-input>
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
	import FileInput from '../forms/FileInputComponent';
	import Button from '../forms/ButtonComponent';
	import Link from '../forms/LinkComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
			'app-input': Input,
			'app-file-input': FileInput,
			'app-button': Button,
			'app-link': Link,
		},
		data() {
			return {
				background: null
			}
		},
		props: {
			id: String,
			backUrl: String,
		},
		mounted() {
			this.load(this.id);
		},
		methods: {
			load(id) {
				axios.get(`/web/backgrounds/${id}`)
				.then(res => {
					this.background = res.data;
				})
				.catch(err => {});
			},
			onSubmit() {
				let data = new FormData(this.$refs.form);
				data.append('_method', 'PUT');

				let validate = this.validateForm(this.$refs.form);
				
				if (validate != '') {
					Flash('error', validate);
				} else {
					axios.post(`/web/backgrounds/${this.background.id}`, data)
						.then(res => {
							Swal.fire({
								title: 'Atualizado com sucesso!',
								type: 'success'
							})
							.then(result => {
								window.location.href = '/backgrounds';
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