<template>
	<div>
		<div class="row">
			<div class="col-4">
				<input type="text" class="form-control" v-model="queryString" v-on:keyup="getCategorias()" name="categoria_nombre" required  autocomplete="off">
			</div>
			<div class="col-4">
				<button type="submit" class="btn btn-success">Agregar</button>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="panel-footer" style="position:absolute;"  v-if="categorias.length">
					<ul class="list-group">
						<li style="cursor:pointer;" class="list-group-item" v-on:click="editarCategoria(categoria.id)" v-for="categoria in categorias">{{ categoria.nombre }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				queryString:'',
				categorias: [],
				user_id:''
			}
		},
		methods:{
			getCategorias(){
				this.categorias= [];
				this.user_id=document.getElementById('userId').value;
				axios.get('/api/buscarCategorias', {params: {queryString: this.queryString, user_id:this.user_id}}).then(response => {
					response.data.categorias.forEach((categoria)=>{
						this.categorias.push(categoria)
					})
				});
			},
			editarCategoria(id){
				location.href="/cargar_categoria/"+id;
			}
		}
	}
</script>