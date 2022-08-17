<template>
	<div ref="modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fa fa-cog"></i>
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
				<div class="modal-body">
					<div class="row content">
						<div v-if="loading" class="col-12 text-center">
							<img src="/assets/img/loading.svg">
						</div>
						<div v-if="!loading" class="col-12">
							<div class="row">
								<div class="col-12 col-xl-3 col-md-6">
									<p><strong>Título</strong></p>
									<p>{{ data.profile.title }}</p>
								</div>
								<div class="col-12 col-xl-3 col-md-6">
									<p><strong>Grupo</strong></p>
									<p>{{ data.profile.group_text }}</p>
								</div>
								<div class="col-12 col-xl-3 col-md-6">
									<p><strong>Status</strong></p>
									<p>{{ data.profile.active_text }}</p>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<h5>Permissões</h5><hr/>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<h6>Menu</h6><hr/>
								</div>
								<div class="col-12 col-xl-6">
									<div v-for="menu in data.menus" class="col-12 col-xl-6">
										<p>
											<b>{{ menu[1][0].group_name }}</b> - (
												{{ menu[1].map(x => x.title).join(', ') }}
											)
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<h6>Acessos</h6><hr/>
								</div>
								<div v-for="resource in data.resources" class="col-12 col-xl-6">
									<p>
										<b>{{ resource[1][0].controller }}</b> - (
											{{ resource[1].map(x => x.action).join(', ') }}
										)
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				modal: HTMLElement,
				title: '',
				loading: true,
				data: {}
			}
		},
		props: {
			defaultTitle: { type: String, default: 'Perfil' }
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

				axios.get(`/web/profiles/${id}`)
					.then(res => {
						res.data.menus = Object.entries(res.data.menus);
						res.data.resources = Object.entries(res.data.resources);

						this.loading = false;
						this.data = res.data;
						this.title = `${this.defaultTitle}: ${this.data.profile.title}`;
					})
					.catch(err => {});
			},
			onClose() {
				this.modal.modal('hide');
			}
		}
	}
</script>