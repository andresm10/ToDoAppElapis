<template>
	<div>
		<div class="row">
			<div class="col-4">
				<input type="text" placeholder="Agregar y/o Buscar" class="form-control" v-model="queryString" v-on:keyup="getActividades()" name="actividad" required autocomplete="off">
			</div>
			<div class="col-4">
				<button type="submit" class="btn btn-success">Agregar</button>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="panel-footer" style="position:absolute;"  v-if="actividades.length">
					<ul class="list-group">
						<li style="cursor:pointer;" class="list-group-item" v-on:click="editarActividad(actividad.id)" v-for="actividad in actividades">{{ actividad.actividad }}</li>
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
				actividades: [],
				user_id:''
			}
		},
		methods:{
			getActividades(){
				this.actividades= [];
				this.user_id=document.getElementById('userId').value;
				axios.get('/api/buscarActividades', {params: {queryString: this.queryString, user_id:this.user_id}}).then(response => {
					response.data.actividades.forEach((actividad)=>{
						this.actividades.push(actividad)
					})
				});
			},
			editarActividad(id){
				location.href="/cargar_actividad/"+id;
			}
		}
	}
</script>