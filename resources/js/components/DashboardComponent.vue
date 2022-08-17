<template>
	<div class="row">
		<app-jumbotron
			:user-name="userName"
			:date="date"
		></app-jumbotron>

        <div class="col-12 col-xl-3 col-md-6 mb-4" >
            <div class="widget-small secondary coloured-icon mb-0">
                <i class="icon fa fa-users"></i>
                <div class="info">
                    <h4>Usuários ({{counts.totalUsers}})</h4>
                </div>
            </div>
            <div class="widget-small-footer bg-secondary">
                -
            </div>
        </div>
		<div class="col-12 col-xl-3 col-md-6 mb-4">
            <div class="widget-small success coloured-icon mb-0">
                <i class="icon fa fa-university"></i>
                <div class="info">
                    <h4>Estados ({{counts.totalStates}})</h4>
                </div>
            </div>
            <div class="widget-small-footer bg-success">
                -
            </div>
        </div>
        <div class="col-12 col-xl-3 col-md-6 mb-4">
            <div class="widget-small warning coloured-icon mb-0">
                <i class="icon fa fa-building"></i>
                <div class="info">
                    <h4>Cidades ({{counts.totalCities}})</h4>
                </div>
            </div>
            <div class="widget-small-footer bg-warning">
                -
            </div>
        </div>
        <div class="col-12 col-xl-3 col-md-6 mb-4">
            <div class="widget-small danger coloured-icon mb-0">
                <i class="icon fa fa-road"></i>
                <div class="info">
                    <h4>Endereços ({{counts.totalAddresses}})</h4>
                </div>
            </div>
            <div class="widget-small-footer bg-danger">
                -
            </div>
        </div>
	</div>
</template>

<script>
	import Jumbotron from './JumbotronComponent';

	export default {
        components: {
			'app-jumbotron': Jumbotron
		},
		data() {
			return {
                items: Object,
				purchases: Object,
				sales: Object,
				exchanges: Object,
				auctions: Object,
				wishes: Object
			};
		},
		props: {
			userName: String,
			date: String,
            counts: Object,
		},
	}
</script>