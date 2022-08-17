<template>
	<div>
		<app-page-header
			icon="fa fa-image"
			title="Fundos de tela"
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
								v-for="background in backgrounds"
								class="col-12 col-xl-2 col-md-3 col-sm-6 mb-3"
							>
								<div class="card d-flex align-items-center shadow">
									<a
										href="javascript:"
										class="btn btn-circle btn-circle-xsm btn-configs"
										title="Editar"
										@click="edit(background.id)"
									>
										<i class="fa fa-pencil fa-lg"></i>
									</a>
									<div
										class="d-flex align-items-center justify-content-center"
										style="height:180px;"
									>
										<img
											:src="background.thumb"
											class="img-fluid"
											:data-original="background.image"
											data-action="zoom"
											@click="toggleZoom"
										>
									</div>
									<div class="card-body p-0 w-100">
										<input
											type="text"
											name="description" 
											maxlength="100"
											class="form-control text-center border-0 rounded-0"
											readonly
											:value="background.description"
											@dblclick="onEdit($event, background.id)"
											@change="save($event, background.id)"
										>
									</div>
								</div>
							</div>
						</div>
						<hr />
						<app-pagination
							ref="pagination"
							:isAjax="true"
							:callback="loadBackgrounds"
						></app-pagination>
					</div>
				</div>
			</div>
			<app-link
				v-if="allowCreate"
				type="create"
				url="/backgrounds/create"
			></app-link>
		</div>
	</div>
</template>

<script>
	import PageHeader from '../PageHeaderComponent';
	import Select from '../forms/SelectComponent';
	import Input from '../forms/InputComponent';
	import SideFilter from '../SideFilterComponent';
	import Pagination from '../PaginationComponent';
	import Link from '../forms/LinkComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
			'app-select': Select,
			'app-input': Input,
			'app-side-filter': SideFilter,
			'app-pagination': Pagination,
			'app-link': Link
		},
		data() {
			return {
				limit: 12,
				search: '',
				filterParams: [],
				backgrounds: [],
				zoomEnabled: false
			};
		},
		props: {
			limits: Array,
			allowCreate: Boolean,
		},
		mounted() {
			this.loadBackgrounds();
		},
		methods: {
			onChangeSideFilter(data) {
				this.filterParams = data;
				this.loadBackgrounds();
			},
			onChangeLimit(val) {
				this.limit = val;
				this.loadBackgrounds();
			},
			onChangeSearch(val) {
				this.search = val;
				this.loadBackgrounds();
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
			loadBackgrounds(page = 1) {
				$('.bg-overlay').toggleClass('bg-overlay-show');

				axios.get(`/web/backgrounds?${this.getParams()}&page=${page}`)
					.then(res => {
						this.backgrounds = res.data.data;
						this.$refs.pagination.onInit(res.data);
						$('.bg-overlay').toggleClass('bg-overlay-show');
					})
					.catch(err => {});
			},
			onEdit(e, id) {
				let o = $(e.target);

				o.attr('readonly', false);
				o.focusout(_ => {
					o.attr('readonly', true);
					o.off();
				});
			},
			save(e, id) {
				let o = $(e.target);
				let value = o.val();

				let data = {};
				data[o.attr('name')] = value;
				
				axios.patch(`/web/backgrounds/${id}`, data)
					.then(res => {
						Flash('success', 'Atualizado com sucesso!');
					})
					.catch(err => {
						Flash('error', 'Erro ao tentar atualizar registro!');
					});
			},
			toggleZoom(e) {
				let o = $(e.target);
				let thumb = o.attr('src');
				let image = o.data('original') || o.attr('src');
				o.attr('src', image);
				this.zoomEnabled = true;

				$(document).on('click', removeZoom.bind(this));

				function removeZoom(e) {
					event.stopPropagation();
					event.preventDefault();

					if (this.zoomEnabled) {
						this.zoomEnabled = false;
						o.attr('src', thumb);
						$(document).off();
					}
				}
			},
			edit(id) {
				document.location.href = `/backgrounds/${id}/edit`;
			}
		}
	}
</script>