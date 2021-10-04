function finalizarActividad(id){
   let estado;
  if(document.getElementById(`actividad${id}`).checked){
    estado=1;
  }else{
    estado=0;
  }
  $.post("/api/cambiar_estado_actividad",
  {
    estado: estado,
    id: id
  },
  function(data, status){
    console.log("exito")
  });
}