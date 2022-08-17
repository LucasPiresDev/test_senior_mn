<template>
	<div class="row">
		<div
			class="col-12 col-xl-6 text-center text-xl-left pagination-text"
		></div>
		<div class="col-12 col-xl-6">
			<nav id="pagination" class="text-right"></nav>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				amountBts: 0
			};
		},
		props: {
			isAjax: { type: Boolean, default: false },
			callback: { type: Function, default: null }
		},
		methods: {
			onInit(data) {
				$(window).on('init.bs.breakpoint', this.onBreakpoint);
		        $(window).on('new.bs.breakpoint', this.onBreakpoint);
		        bsBreakpoints.init();

		        this.create(data, this.amountBts);
			},
			onBreakpoint(e) {
				this.amountBts = 12;

				switch(e.breakpoint) {
		            case 'xSmall': this.amountBts = 3; break;
		            case 'small': this.amountBts = 4; break;
		            case 'medium': this.amountBts = 8; break;
		            case 'large': this.amountBts = 10; break;
		        }
			},
			create(data, amountBts) {
				let init = (parseInt(data.per_page) * (data.current_page - 1) + 1);
		        let until = (data) ? init + parseInt(data.per_page) - 1 : 0;
		        let total = (data) ? parseInt(data.total) : 0;

		        $('.pagination-text').html(
		        	`Mostrando de ${init} até ${until} de ${total} registros`
	        	);

	        	$('#pagination').bootstrapPaginator({
		            tooltipTitles: () => { return ''; },
		            numberOfPages: amountBts,
		            currentPage: parseInt(data.current_page),
		            totalPages: parseInt(data.last_page),
		            itemTexts: (type, page, current) => {
		                switch(type) {
		                    case 'first': return 'Primeira';
		                    case 'prev': return 'Anterior';
		                    case 'next': return 'Próxima';
		                    case 'last': return 'Última';
		                    case 'page': return page;
		                }
		            },
		            pageUrl: (type, page, current) => {
		                if (this.isAjax) { return null; }

		                let lastChar = data.path.substr(data.path.length - 1);
		                let prefix = (data.path.indexOf('?') != -1) ? '&' : '?';

		                if (lastChar == '?') { prefix = ''; }

		                return data.path + prefix + 'page=' + page;
		            },
		            onPageClicked: (e, originalEvent, type, page) => {
		                if (this.isAjax) {
		                    e.stopImmediatePropagation();

		                    let current = $(e.currentTarget)
		                    	.bootstrapPaginator('getPages')
		                    	.current;

		                    if (current != page) {
		                        this.callback(page);
		                    }
		                }
		            }
		        });
			}
		}
	}
</script>