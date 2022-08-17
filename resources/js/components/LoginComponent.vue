<template>
	<section class="login-content">
		<div class="logo">
	        <h1>
	            <a href="/" :title="title">
	                <img src="/assets/img/logo.png" :alt="title">
	            </a>
	        </h1>
	    </div>
	    <div class="login-box">
	    	<form class="login-form" method="POST" ref="form" autocomplete="off">
	    		<h3 class="login-head font-weight-normal">PAINEL - {{ title }}</h3>
	    		<input
	                type="text"
	                name="login"
	                class="form-control"
	                autofocus
	                minlength="2"
	                maxlength="40"
	                placeholder="Usuário"
	                required
	                @keyup="onSubmit"
	            >
	            <input
	                type="password"
	                name="password"
	                class="form-control"
	                minlength="4"
	                maxlength="40"
	                required
	                placeholder="Senha"
	                @keyup="onSubmit"
	            >
	            <!-- ADD RECAPTCHA HERE -->
	            <button
	            	type="button"
	            	class="btn btn-danger btn-block my-5 align-center justify-content-center py-3"
	            	@click="onSubmit"
	            	:disabled="logging"
            	>
            		<span
            			v-if="logging"
            			class="spinner-border spinner-border-sm"
            			role="status"
            			aria-hidden="true"
        			></span>
            		<span v-if="!logging">Entrar</span>
            	</button>
	    	</form>
	    </div>
	</section>
</template>

<script>
	export default {
		data() {
			return {
				logging: false
			}
		},
		props: {
			title: String,
			router: String,
		},
		methods: {
			onSubmit(e = null) {
				if (e instanceof Event && e.keyCode != 13 && e.type != 'click') return;

				this.logging = true;
				let data = new FormData(this.$refs.form);

				let validate = this.validateForm(this.$refs.form);

				if (validate != '') {
					this.logging = false;
					Flash('error', validate);
				} else {
					axios.post('/login', data)
						.then(res => {
							this.logging = false;
							window.location.href = '/';
						})
						.catch(err => {
							Flash('error', 'Usuário ou senha inválidos!');
							this.logging = false;
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
