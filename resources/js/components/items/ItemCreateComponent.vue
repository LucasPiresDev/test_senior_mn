<template>
	<div>
		<app-page-header
			icon="fa fa-archive"
			title="Cadastrar Item"
			:breadcrumbs="[
				{ href: '/', title: 'Painel' },
				{ href: '/items', title: 'Itens' },
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
								></app-input>
								<app-input
									type="number"
									placeholder="Valor"
									label="Valor"
									name="value"
									:min="0"
									:max="100000"
									:maxLength="6"
									step="0,01"
									:required="true"
									:callback="onChangeValue"
								></app-input>
								<app-select
									title="Gênero"
									label="Gênero"
									name="gender"
									:options="genders"
									:required="true"
								></app-select>
								<app-select
									title="Categoria"
									label="Categoria"
									name="category"
									:options="categories"
									:required="true"
								></app-select>
								<app-select
									title="Nível"
									label="Nível"
									name="level_id"
									:options="levels"
									:required="true"
								></app-select>
								<app-select
									title="Grupo"
									label="Grupo"
									name="group"
									:required="true"
									:options="groups"
									:callback="loadType"
								></app-select>
								<app-select
									title="Tipo"
									label="Tipo"
									name="item_type_id"
									:required="true"
									:options="itemTypes"
								></app-select>
								<app-file-input
									label="Thumb (melhor 132x132, limite 1024)"
									name="thumb"
									accept="image/png"
									placeholder="Thumb"
									:required="true"
								></app-file-input>
								<app-toggle
									label="Editável"
									name="editable"
								></app-toggle>
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
	import Toggle from '../forms/ToggleComponent';
	import Button from '../forms/ButtonComponent';
	import Link from '../forms/LinkComponent';
	import FileInput from '../forms/FileInputComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
			'app-input': Input,
			'app-toggle': Toggle,
			'app-select': Select,
			'app-button': Button,
			'app-link': Link,
			'app-file-input': FileInput
		},
		data() {
			return {
				genders: [],
				categories: [],
				levels: [],
				groups: [],
				itemTypes: [],
			};
		},
		props: {
			backUrl: String,
		},
		mounted() {
			this.loadGenders();
			this.loadCategories();
			this.loadLevels();
			this.loadGroups();
		},
		methods: {
			onChangeValue(val, e) {
				let o = $(e.target);
				let value = Number(val).toFixed(2);
				o.val(value);
			},
			loadGenders() {
				axios.get('/web/genders')
					.then(res => {
						this.genders = res.data;
					})
					.catch(err => {});
			},
			loadCategories() {
				axios.get('/web/categories')
					.then(res => {
						this.categories = res.data;
					})
					.catch(err => {});
			},
			loadLevels() {
				axios.get('/web/levels')
					.then(res => {
						this.levels = res.data;
					})
					.catch(err => {});
			},
			loadGroups() {
				axios.get('/web/item_groups')
					.then(res => {
						this.groups = res.data;
					})
					.catch(err => {});
			},
			loadType(item_group_id) {
				axios.get('/web/item_types', { params: { item_group_id }})
					.then(res => {
						this.itemTypes = res.data;
					})
					.catch(err => {});
			},			
			onSubmit() {
				let data = new FormData(this.$refs.form);

				let validate = this.validateForm(this.$refs.form);
				
				if (validate != '') {
					Flash('error', validate);
				} else {
					axios.post('/web/items', data)
						.then(res => {
							Swal.fire({
								title: 'Cadastrado com sucesso!',
								type: 'success'
							})
							.then(result => {
								window.location.href = '/items';
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
