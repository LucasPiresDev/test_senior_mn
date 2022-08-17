<template>
	<div class="row">
		<div
			v-for="group in list"
			class="col-12 col-xl-3 col-md-4 px-1"
		>
			<div class="list-group mb-2 px-0">
				<div class="list-group-item list-group-item-secondary">
					<span v-if="name == 'menus'">
						<span v-if="group.value[0].group_name">
							{{ group.value[0].group_name }}
						</span>
						<span v-if="!group.value[0].group_name">-</span>
					</span>
					<span v-if="name != 'menus'">{{ group.value[0].controller }}</span>
				</div>
				<div class="list-group-item">
					<div
						v-for="item in group.value"
						class="animated-checkbox"
					>
						<label :title="item.controller">
							<input
								type="checkbox"
								:name="name + '[]'"
								:value="item.id"
								:checked="isChecked(item.id)"
							>
							<span v-if="name == 'menus'" class="label-text">{{ item.title }}</span>
							<span v-if="name != 'menus'" class="label-text">{{ item.action }}</span>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			name: String,
			list: Array,
			checkeds: Array,
		},
		methods: {
			isChecked(id) {
				for (let o of this.checkeds) {
					if (o.id == id) {
						return true;
					}
				}

				return false;
			}
		}
	}
</script>