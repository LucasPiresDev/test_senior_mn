<template>
	<div>
		<app-page-header
			icon="fa fa-user-circle-o"
			title="Preview"
			:breadcrumbs="[
				{ href: '/', title: 'Painel' }
			]"
		></app-page-header>
		<div class="stage">
			<div id="stage"></div>
			<!-- <a class="bt-close">
				<img src="/assets/img/icon-close.png">
			</a> -->
		</div>
	</div>
</template>

<script>
	import PageHeader from '../PageHeaderComponent';

	export default {
		components: {
			'app-page-header': PageHeader,
		},
		data: (e) => {
			return {
				player: null
			}
		},
		mounted() {
			this.play();
		},
		methods: {
			play() {
				let script = document.createElement('script');
				script.id = 'script';
				script.src = `/storage/player/avatar.js`;
				document.getElementById('stage').appendChild(script);
				script.onload = (e) => {
					$('.stage').addClass('on');
					$('.bt-close').addClass('on');
					$('.bt-close').on('click', this.destroy.bind(this));

					this.player = new AvatarPlayer.Main({
						user: { level: 5, year: 5 },
						gender: 1,
						baseUrl: 'http://localhost:8000/api',
						token: '',
						onClose: this.destroy.bind(this),
					});
				};
			},
			destroy() {
				if (this.player && this.player.script4.stage) {
					if (this.player.script4.stage.children[0].children[0].destroyAll) {
						this.player.script4.stage.children[0].children[0].destroyAll();
					} else {
						this.player.script4.stage.game.cache = 
							new Phaser.Cache(this.player.script4.stage.game);
						this.player.script4.stage.game.load.reset();
						this.player.script4.stage.game.load.removeAll();
					}
				}

				this.player = null;

			    $('#script').remove();
				$('#stage').empty();
				$('.stage').removeClass('on');
				$('.bt-close').removeClass('on');
				$('.bt-close').off('click', this.destroy.bind(this));
			}
		}
	}
</script>