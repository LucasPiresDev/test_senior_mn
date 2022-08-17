<template>
	<div
		:id="containerId"
		:class="containerClass"
	>
		<div class="form-group" :class="{ 'required' : required }">
			<label v-if="label" :for="name">
				{{ label }}
				<a
					v-if="help"
					:id="id"
					tabindex="0"
					class="btn btn-outline-info btn-circle btn-circle-xsm mb-1"
					data-toggle="popover"
					data-trigger="focus"
					role="button"
					:data-content="help.text"
				>
					<i class="fa fa-question"></i>
				</a>
			</label>
			<div class="custom-file">
				<input
					type="file"
					:name="name"
					:class="[{ 'is-invalid' : error }, className]"
					:title="title"
					:required="required"
					:placeholder="placeholder"
					:accept="accept"
					:value="value"
					@change="onChange"
				>
				<label
					class="custom-file-label"
					:for="name"
					data-browse="Escolher Arquivo"
				>
					Nenhum arquivo selecionado!
				</label>
				<div v-if="error" class="invalid-feedback">
					{{ error }}
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			id: String,
			placeholder: String,
			className: { type: String, default: 'custom-file-input' },
			label: String,
			name: String,
			accept: String,
			value: String,
			title: String,
			required: Boolean,
			containerId: String,
			containerClass: { type: String, default: 'col-12 col-xl-3 col-md-6' },
			help: Object,
			error: String,
			callback: Function
		},
		methods: {
			onChange(e) {
				let fileName = $(e.target).val().replace('C:\\fakepath\\', '');
				$($(e.target).parent().children('.custom-file-label')).html(fileName);

				if (this.callback) {
					this.callback(e.target.files[0]);
				}
			}
		}
	}
</script>