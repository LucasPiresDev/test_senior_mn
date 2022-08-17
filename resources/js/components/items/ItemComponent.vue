<template>
	<div>
		<app-page-header
			icon="fa fa-archive"
			title="Itens"
			:breadcrumbs="[
				{ href: '/', title: 'Painel' }
			]"
		></app-page-header>
		<div class="row">
			<div class="col-12">
				<div class="tile">
					<div class="tile-body">
						<form ref="form">
							<div class="row">
								<app-select
									containerClass="col-4 col-xl-2 col-md-3"
									:options="limits"
									:value="limit"
									empty="false"
									:callback="onChangeLimit"
								></app-select>
								<app-input
									containerClass="col-6 col-xl-4 offset-xl-5 col-md-6 offset-md-1 pr-xs-0"
									placeholder="Pesquisar"
									:value="search"
									:callback="onChangeSearch"
								></app-input>
								<div class="col-2 col-xl-1 pl-0 text-right">
									<a
										href="javascript:"
										data-toggle="filter-sidebar" 
										class="btn btn-outline-secondary btn-sm btn-circle
											btn-circle-sm btn-table btn-circle-title"
										title="Filtrar"
									>
										<i class="fa fa-filter"></i>
										<span class="d-none d-lg-inline-block">Filtrar</span>
									</a>
								</div>
							</div>
							<app-side-filter
								ref="filter"
								:onChangeCallback="onChangeSideFilter"
							></app-side-filter>
						</form>
						<div class="row">
							<div
								v-for="item in items"
								class="col-12 col-xl-2 col-md-3 col-sm-6 mb-3"
							>
								<div class="card d-flex align-items-center shadow">
									<div class="d-flex position-absolute w-100">
										<div
											class="pl-2 pt-1 font-weight-bold text-muted"
										>
											{{ item.id }}
										</div>
									</div>
									<a
										href="javascript:"
										class="btn btn-circle btn-circle-xsm btn-configs"
										title="Editar outras informações"
										@click="onShow(item.id)"
									>
										<i class="fa fa-pencil fa-lg"></i>
									</a>
									<div
										class="d-flex align-items-center justify-content-center"
										style="height:152px;"
									>
										<img :src="item.thumb" class="img-fluid">
									</div>
									<div class="card-body p-0 w-100">
										<input
											type="text"
											name="description" 
											maxlength="100"
											class="form-control text-center border-0 rounded-0"
											readonly
											:value="item.description"
											@dblclick="onEdit($event, item.id, item.category)"
											@change="save($event, item.id)"
										>
										<select
											name="level_id"
											class="form-control border-0 rounded-0 text-center"
											@dblclick="onEdit($event, item.id, item.category)"
											readonly
											@mousedown="avoidSelect"
											@change="save($event, item.id)"
										>
											<option class="text-muted" value="">Sem Nível</option>
											<option
												v-for="level in levels"
												:value="level.value"
												:selected="level.value == item.level_id"
											>
												{{ level.label }}
											</option>
										</select>
									</div>
									<div class="card-footer p-0 w-100">
										<input
											class="form-control border-0 rounded-0 rounded-bottom text-right" 
											type="number"
											min="0"
											max="100000"
											maxlength="6"
											step="0,01"
											name="value"
											readonly
											:value="item.value"
											@dblclick="onEdit($event, item.id, item.category)"
											@change="save($event, item.id)"
										>
									</div>
									<input
										type="text"
										name="color"
										maxlength="100"
										class="form-control text-center border-0 rounded-0"
										readonly
										:value="item.color"
										@dblclick="onEdit($event, item.id, item.color)"
										@change="save($event, item.id)"
										:disabled="!item.editable"
									>
								</div>
							</div>
						</div>
						<hr />
						<app-pagination
							ref="pagination"
							:isAjax="true"
							:callback="loadItems"
						></app-pagination>
					</div>
				</div>
			</div>
			<app-link
				v-if="allowCreate"
				type="create"
				url="/items/create"
			></app-link>
		</div>
		<app-item-show ref="itemShow"></app-item-show>
	</div>
</template>

<script>
	import PageHeader from '../PageHeaderComponent';
	import Select from '../forms/SelectComponent';
	import Input from '../forms/InputComponent';
	import SideFilter from '../SideFilterComponent';
	import ItemShow from './ItemShowComponent';
	import Pagination from '../PaginationComponent';
	import Link from '../forms/LinkComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
			'app-select': Select,
			'app-input': Input,
			'app-side-filter': SideFilter,
			'app-item-show': ItemShow,
			'app-pagination': Pagination,
			'app-link': Link
		},
		data() {
			return {
				limit: 12,
				search: '',
				filterParams: [],
				items: [],
				levels: [],
			}
		},
		props: {
			limits: Array,
			allowCreate: Boolean,
		},
		mounted() {
			this.loadItemTypes();
			this.loadLevels();
			this.loadItems();

			$(document).on('keyup keypress', (e) => {
				if (e.keyCode === 13) {
					e.preventDefault();
				}
			});
		},
		methods: {
			onChangeSideFilter(data) {
				this.filterParams = data;
				this.loadItems(1);
			},
			onChangeLimit(val) {
				this.limit = val;
				this.loadItems(1);
			},
			onChangeSearch(val) {
				this.search = val;
				this.loadItems(1);
			},
			getParams() {
				let params = `limit=${this.limit}`;

				if (this.search.length > 0) {
					params += `&search=${this.search}`;
				}

				for (let filter of this.filterParams) {
					params += `&${filter.name}=${filter.value}`;
				}
				
				return params;
			},
			loadItems(page = 1) {
				$('.bg-overlay').toggleClass('bg-overlay-show');

				axios.get(`/web/items?${this.getParams()}&page=${page}`)
					.then(res => {
						this.items = res.data.data;
						this.$refs.pagination.onInit(res.data);
						$('.bg-overlay').toggleClass('bg-overlay-show');
					})
					.catch(err => {});
			},
			loadLevels() {
				axios.get('/web/levels')
					.then(res => {
						this.levels = res.data;
						this.$refs.filter.add({
							name: 'level_id',
							type: 'select',
							label: 'Nível',
							options: this.levels
						});
					})
					.catch(err => {});
			},
			loadItemTypes() {
				axios.get('/web/item_types')
					.then(res => {
						this.$refs.filter.add({
							name: 'item_type_id',
							type: 'select',
							label: 'Tipo',
							options: res.data
						});
					})
					.catch(err => {});
			},
			onShow(id) {
				this.$refs.itemShow.open(id);
			},
			avoidSelect(e) {
				let o = $(e.target);
				o.focus();

				if (!o.data('activate')) {
					e.preventDefault();
				}
			},
			onEdit(e, id, category) {
				let o = $(e.target);

				if (category != 1 && o.attr('name') == 'value') {
					Flash('error', 'Não disponível para venda!');
					return;
				}

				if (o.is('select')) {
					o.data('activate', true);
				}

				o.data('old', o.val());

				o.attr('readonly', false);
				o.focusout(_ => {
					o.attr('readonly', true);
					o.off();

					if (o.is('select')) {
						o.data('activate', false);
					}
				});
			},
			save(e, id) {
				let o = $(e.target);
				let value = o.val();
				
				if (o.attr('name') == 'value') {
					if (Number(o.val()) >  Number(o.attr('max'))) {
						Flash('error', 'Limite excedido!');
						o.val(o.data('old'));
						return;
					}

					value = Number(o.val()).toFixed(2);
				}

				o.val(value);

				let data = {};
				data[o.attr('name')] = value;
				
				axios.patch(`/web/items/${id}`, data)
					.then(res => {
						Flash('success', 'Atualizado com sucesso!');
					})
					.catch(err => {
						Flash('error', 'Erro ao tentar atualizar registro!');
					});
			}
		}
	}
</script>