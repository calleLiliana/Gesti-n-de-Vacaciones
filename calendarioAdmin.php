<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar.css">
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-7"> <div id="calendarioweb"></div> </div>
            <div class="col"></div>
        </div>
    </div>

    <form action="administrarVacaciones.php" method="post">
        <button type="submit">Volver Atras</button>
    </form>
<script>
    $(document).ready(function(){
        $('#calendarioweb').fullCalendar({
            header:{
                left:'month,basicWeek',
                center:'title',
                rigth:'today,prev,next'
            },
            selectable: true, // Habilitar la selección de días
            selectHelper: true, // Habilitar helper para la selección
            select: function(start, end) {
                $('#txtFecha').val(start.format()); // Establecer fecha de inicio
                $('#txtFechaFin').val(end.format()); // Establecer fecha de fin
                $('#ModalEventos').modal(); // Mostrar el modal
            },
            
            dayClick:function(date,jsEvent, view){
                                                     
                $('#txtFecha').val(date.format()); // obtener el valor de la fecha de forma automatica 
                $("#ModalEventos").modal(); // muestra el modal 
            }, 

            events:'http://localhost/Gestion_de_vacaciones/eventos.php', 

            eventClick: function(calEvent, jsEvent, view){
                $('#tituloEvento').html(calEvent.title); 
                // mostra la informacion del evento en los inputs 
                $('#txtDescripcion').val(calEvent.descripcion); 
                $('#txtId').val(calEvent.id); 
                $('#txtTitulo').val(calEvent.title); 
                $('#txtColor').val(calEvent.color); 

                FechaHora = calEvent.start._i.split(" ");
                $('#txtFecha').val(FechaHora[0]); // Establecer fecha de inicio
                $('#txtHora').val(FechaHora[1]); // Establecer hora

                if (calEvent.end) {
                    var endDateTime = calEvent.end._i.split(" ");
                    $('#txtFechaFin').val(endDateTime[0]); // Establecer fecha de fin
                }

                $("#ModalEventos").modal(); 
            }
        }); 
    }); 
</script>    



<!-- Modal(Agregar, Modificar, Eliminar) -->
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="eventForm">
                <div class="form-group">
                    <label for="txtId">Id:</label>
                    <input type="text" id="txtId" name="txtId" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="txtFecha">Fecha inicio:</label>
                    <input type="date" id="txtFecha" name="textFecha" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="txtFechaFin">Fecha fin:</label>
                    <input type="date" id="txtFechaFin" name="textFecha" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="txtTitulo">Título:</label>
                    <input type="text" id="txtTitulo" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="txtDescripcion">Descripción:</label>
                    <textarea id="txtDescripcion" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="txtColor">Color:</label>
                    <input type="color" value="#ff0000" id="txtColor" class="form-control" />
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
          <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
          <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div> 
  </div>

<!-- trabajar con los botones abm -->
<script>
var NuevoEvento;

$('#btnAgregar').click(function(){ // cuando el usuario presiona el boton se recolectan los valores, se deposita mediante el gui
    RecolectarDatosGUI(); 
    EnviarInformacion('agregar', NuevoEvento); 

}); 

$('#btnEliminar').click(function(){ // cuando el usuario presiona el boton se recolectan los valores, se deposita mediante el gui
    RecolectarDatosGUI(); 
    EnviarInformacion('eliminar', NuevoEvento); 

}); 

$('#btnModificar').click(function(){ // cuando el usuario presiona el boton se recolectan los valores, se deposita mediante el gui
    RecolectarDatosGUI(); 
    EnviarInformacion('modificar', NuevoEvento); 

}); 

function RecolectarDatosGUI(){
    NuevoEvento = {
        id: $('#txtId').val(),
        title: $('#txtTitulo').val(),
        start: $('#txtFecha').val() + " " + $('#txtHora').val(), 
        end: $('#txtFechaFin').val() + " " + $('#txtHora').val(), // Asignar fecha fin
        color: $('#txtColor').val(), 
        descripcion: $('#txtDescripcion').val(), 
        textColor: "#FFFFFF"
    }; 
}


function EnviarInformacion(accion, objEvento){
        $.ajax({
            type:'POST', 
            url:'eventos.php?accion='+accion,
            data: objEvento, 
            success:function(msg){ // cuando el envio e haga..
                if(msg){
                    $('#calendarioweb').fullCalendar('refetchEvents'); // agregarlo al fullcalendar (el calendario) & refresca los eventos 
                    $("#ModalEventos").modal('toggle'); //ocultar-cerrar el modal
                }
            }, 
            error: function(){
                alert("Hay un error .."); 
            }
        }); 
}

</script>

</body>
</html>