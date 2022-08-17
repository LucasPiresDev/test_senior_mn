<template>
	<div>
		<app-page-header
			:icon="'fa fa-cog'"
			:title="`${this.title}`"
			:breadcrumbs="[
				{ href: '/home', title: 'Painel' },
				{ href: this.url, title: this.title },
			]"
		></app-page-header>
		<div class="row">
			<div class="col-12">
				<div class="tile">
					<div class="tite-body">
						<form ref="form">
							<div class="row">
                                <app-input v-for="input in inputs" v-bind:key="input.key"
                                    :placeholder="input.placeholder"
                                    :label="input.label"
                                    :name="input.name"
                                    :type="input.type"
                                    :value="input.value"
                                    :minLength="input.minLength"
                                    :maxLength="input.maxLength"
                                    :required="input.required"
                                ></app-input>
								
								<app-select v-for="select in selects" v-bind:key="select.key"
									:title="select.title"
									:label="select.label"
									:name="select.name"
                                    :value="select.value"
									:required="select.required"
									:options="select.options"
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
										:url="this.url"
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
	import PageHeader from './PageHeaderComponent';
	import Input from './forms/InputComponent';
	import Select from './forms/SelectComponent';
	import Button from './forms/ButtonComponent';
	import Link from './forms/LinkComponent';

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
			url: String,
            title: String,
            inputs: Array,
            selects: Array,
            url_submit: String,
		},
		mounted() {
            console.log(this.selects)
		},
		methods: {
			async onSubmit() {
				let data = new FormData(this.$refs.form);
                let validate = this.validateForm(this.$refs.form);
                
				if (validate != '') {
					Flash('error', validate);
				} else {
                    axios.post(this.url_submit, data)
						.then(res => {
							Swal.fire({
								title: 'Cadastrado com sucesso!',
								type: 'success'
							})
							.then(result => {
								window.location.href = this.url;
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