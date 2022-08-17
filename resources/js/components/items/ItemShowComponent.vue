<template>
	<div ref="modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fa fa-archive"></i>
						{{ title }}
					</h5>
					<button
						type="button"
						class="close"
						data-dismiss="modal"
						aria-label="Close"
						@click="onClose"
					>
			         	<span aria-hidden="true">&times;</span>
			        </button>
				</div>
				<form ref="form">
					<div class="modal-body">
						<div class="row content">
							<div v-if="loading" class="col-12 text-center">
								<img src="/assets/img/loading.svg">
							</div>
							<div v-if="!loading" class="col-12">
								<div class="row">
									<div class="col-md-3">
										<img :src="item.thumb" class="p-3">
									</div>
									<app-file-input
										label="Thumb (melhor 132x132, limite 1024)"
										name="thumb"
										accept="image/png"
										placeholder="Thumb"
									></app-file-input>
									<app-select
										title="Tipo"
										label="Tipo"
										name="item_type_id"
										:required="true"
										:options="itemTypes"
										:value="item.item_type_id"
									></app-select>
									<app-select
										title="Gênero"
										label="Gênero"
										name="gender"
										:options="genders"
										:required="true"
										:value="item.gender"
									></app-select>
									<app-select
										title="Categoria"
										label="Categoria"
										name="category"
										:options="categories"
										:required="true"
										:value="item.category"
									></app-select>
									<app-toggle
										label="Editável"
										name="editable"
										:value="item.editable"
									></app-toggle>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<app-button
							type="update"
							:callback="onSubmit"
						></app-button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import Select from '../forms/SelectComponent';
	import Toggle from '../forms/ToggleComponent';
	import FileInput from '../forms/FileInputComponent';
	import Button from '../forms/ButtonComponent';

	export default {
		components: {
			'app-select': Select,
			'app-toggle': Toggle,
			'app-button': Button,
			'app-file-input': FileInput
		},
		data() {
			return {
				modal: HTMLElement,
				id: Number,
				title: '',
				loading: true,
				item: Object,
				itemTypes: [],
				genders: [],
				categories: [],
			};
		},
		props: {
			defaultTitle: { type: String, default: 'Item' },
		},
		mounted() {
			this.title = this.defaultTitle;
		},
		methods: {
			open(id) {
				this.loading = true;
				this.modal = $(this.$refs.modal);
				this.title = 'Carregando...';
				this.modal.modal('show');

				axios.get(`/web/items/${id}`)
					.then(res => {
						this.loading = false;
						this.item = res.data;
						this.title = `${this.defaultTitle}: ${this.item.description}`;
						this.loadType();
						this.loadGenders();
						this.loadCategories();
					})
					.catch(err => {});
			},
			onClose() {
				this.modal.modal('hide');
			},
			loadType() {
				axios.get('/web/item_types')
					.then(res => {
						this.itemTypes = res.data;
					})
					.catch(err => {});
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
			onSubmit() {
				let data = new FormData(this.$refs.form);
				data.append('_method', 'PUT');

				let validate = this.validateForm(this.$refs.form);

				if (validate != '') {
					Flash('error', validate);
				} else {
					axios.post(`/web/items/${this.item.id}`, data)
						.then(res => {
							Swal.fire({
								title: 'Atualizado com sucesso!',
								type: 'success'
							})
							.then(result => {
								window.location.href = '/items';
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