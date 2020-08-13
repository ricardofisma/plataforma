<?php 
require('conect.php');
session_start();


$event=mysqli_query($link, "SELECT * FROM events WHERE idcurso='".$_SESSION['clave']."' AND idusuario = '".$_SESSION['user']."'");
$events=mysqli_fetch_assoc($event);
//echo $events['title'];

  
  if(isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])){
    $_SESSION['clave']=$_REQUEST['clave'];
  }


?>

<?php include('first.php');?><?php include('margin.php'); ?>
<html>
	<head>
			<link rel="stylesheet" type="text/css" href="./css_c/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css_c/bootstrap-datepicker.min.css">
		<link rel="stylesheet" type="text/css" href="./css_c/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="./css_c/bootstrap-year-calendar.min.css">
		<link rel="stylesheet" type="text/css" href="./css_c/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="./css_c/style.css">
		
		<script src="./js_c/respond.min.js"></script>
		<script src="./js_c/jquery-1.10.2.min.js"></script>
		<script src="./js_c/bootstrap.min.js"></script>
		<script src="./js_c/bootstrap-datepicker.min.js"></script>
		<script src="./js_c/bootstrap-year-calendar.js"></script>
		<script src="./js_c/bootstrap-popover.js"></script>
		<script src="./js_c/scripts.js"></script>
		
		


<div class="modal modal-fade" id="event-modal2" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title">Eliminar evento</h4>
			</div>



			<div class="modal-body">
				
				<form class="form-horizontal" action="Event_delete.php" method="post">
				<input type="hidden" name="event-index" value="">

				
					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Evento</label>
						<div class="col-sm-7">
							<input name="event-name" type="text" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Lugar</label>
						<div class="col-sm-7">
							<input name="event-location" type="text" class="form-control">
						</div>
					</div>
					
					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Color</label>
						<div class="col-sm-7">
							<input name="event-color" type="color" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Fecha </label>
						<div class="col-sm-7">
							<div class="input-group input-daterange" data-provide="datepicker">
								<input name="event-start-date" type="text" class="form-control" value="2012-04-05">
								<span class="input-group-addon">hasta</span>
								<input name="event-end-date" type="text" class="form-control" value="2012-04-19">
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary" id="save-event">Eliminar</button>
			</div>
				</form>


		</div>
	</div>
</div>



<div class="modal modal-fade" id="event-modal1" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title">Actualizar evento</h4>
			</div>



			<div class="modal-body">
				
				<form class="form-horizontal" action="Event_edit.php" method="post">
				<input type="hidden" name="event-index" value="">

					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Evento</label>
						<div class="col-sm-7">
							<input name="event-name" type="text" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Lugar</label>
						<div class="col-sm-7">
							<input name="event-location" type="text" class="form-control">
						</div>
					</div>
					
					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Color</label>
						<div class="col-sm-7">
							<input name="event-color" type="color" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Fecha </label>
						<div class="col-sm-7">
							<div class="input-group input-daterange" data-provide="datepicker">
								<input name="event-start-date" type="text" class="form-control" value="2012-04-05">
								<span class="input-group-addon">hasta</span>
								<input name="event-end-date" type="text" class="form-control" value="2012-04-19">
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary" id="save-event">Actualizar</button>
			</div>
				</form>


		</div>
	</div>
</div>


<div class="modal modal-fade" id="event-modal" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Agregar evento</h4>
			</div>



			<div class="modal-body">
				<input type="hidden" name="event-index" value="">


				<form class="form-horizontal" action="Event_add.php" method="post">
<input type="hidden" name="event-curso" value="<?php echo $_SESSION['clave'];?>">
				<input type="hidden" name="event-user" value="<?php echo $_SESSION['user'];?>">
					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Evento</label>
						<div class="col-sm-7">
							<input name="event-name" type="text" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Lugar</label>
						<div class="col-sm-7">
							<input name="event-location" type="text" class="form-control">
						</div>
					</div>
					
					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Color</label>
						<div class="col-sm-7">
							<input name="event-color" type="color" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label for="min-date" class="col-sm-4 control-label">Fecha </label>
						<div class="col-sm-7">
							<div class="input-group input-daterange" data-provide="datepicker">
								<input name="event-start-date" type="text" class="form-control" value="2012-04-05">
								<span class="input-group-addon">hasta</span>
								<input name="event-end-date" type="text" class="form-control" value="2012-04-19">
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary" id="save-event">Agregar</button>
			</div>
				</form>


		</div>
	</div>
</div>


<style>
.event-tooltip-content:not(:last-child) {
	border-bottom:1px solid #ddd;
	padding-bottom:5px;
	margin-bottom:5px;
}

.event-tooltip-content .event-title {
	font-size:18px;
}

.event-tooltip-content .event-location {
	font-size:12px;
}
.glyphicon{
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.glyphicon-chevron-left:before{
    content:"\f053"
}
.glyphicon-chevron-right:before{
    content:"\f054"
}
</style>








<h1>Calendario-agenda</h1>


<article>
	
	
	<div id="calendar"></div>
	
</article>











<script>
 function editEvent(event) {
	 $.fn.datepicker.defaults.format = 'yyyy-mm-dd';
     $('#event-modal input[name="event-index"]').val(event ? event.id : '');
     $('#event-modal input[name="event-name"]').val(event ? event.name : '');
     $('#event-modal input[name="event-location"]').val(event ? event.location : '');
     $('#event-modal input[name="event-color"]').val(event ? event.color : '');
     $('#event-modal input[name="event-start-date"]').datepicker('update', event ? event.startDate : '');
     $('#event-modal input[name="event-end-date"]').datepicker('update', event ? event.endDate : '');
     $('#event-modal').modal();
 }
 function edittEvent(event) {
	 $.fn.datepicker.defaults.format = 'yyyy-mm-dd';
     $('#event-modal1 input[name="event-index"]').val(event ? event.id : '');
     $('#event-modal1 input[name="event-name"]').val(event ? event.name : '');
     $('#event-modal1 input[name="event-location"]').val(event ? event.location : '');
     $('#event-modal1 input[name="event-color"]').val(event ? event.color : '');
     $('#event-modal1 input[name="event-start-date"]').datepicker('update', event ? event.startDate : '');
     $('#event-modal1 input[name="event-end-date"]').datepicker('update', event ? event.endDate : '');
     $('#event-modal1').modal();
 }
function deleteEvent(event) {
 $.fn.datepicker.defaults.format = 'yyyy-mm-dd';
     $('#event-modal2 input[name="event-index"]').val(event ? event.id : '');
     $('#event-modal2 input[name="event-name"]').val(event ? event.name : '');
     $('#event-modal2 input[name="event-location"]').val(event ? event.location : '');
     $('#event-modal2 input[name="event-color"]').val(event ? event.color : '');
     $('#event-modal2 input[name="event-start-date"]').datepicker('update', event ? event.startDate : '');
     $('#event-modal2 input[name="event-end-date"]').datepicker('update', event ? event.endDate : '');
     $('#event-modal2').modal();
}
//function saveEvent() {
//    var event = {
//        id: $('#event-modal input[name="event-index"]').val(),
//        name: $('#event-modal input[name="event-name"]').val(),
//        location: $('#event-modal input[name="event-location"]').val(),
//        startDate: $('#event-modal input[name="event-start-date"]').datepicker('getDate'),
//        endDate: $('#event-modal input[name="event-end-date"]').datepicker('getDate')
//    }
//    
//    var dataSource = $('#calendar').data('calendar').getDataSource();
//
//    if(event.id) {
//        for(var i in dataSource) {
//            if(dataSource[i].id == event.id) {
//                dataSource[i].name = event.name;
//                dataSource[i].location = event.location;
//                dataSource[i].startDate = event.startDate;
//                dataSource[i].endDate = event.endDate;
//            }
//        }
//    }
//    else
//    {
//        var newId = 0;
//        for(var i in dataSource) {
//            if(dataSource[i].id > newId) {
//                newId = dataSource[i].id;
//            }
//        }
//        
//        newId++;
//        event.id = newId;
//    
//        dataSource.push(event);
//    }
//    
//    $('#calendar').data('calendar').setDataSource(dataSource);
//    $('#event-modal	').modal('hide');
//}

$(function() {
    var currentYear = new Date().getFullYear();

    $('#calendar').calendar({
        enableContextMenu: true,
        enableRangeSelection: true,
        contextMenuItems:[
            {
                text: 'Editar',
                click: edittEvent
            },
            {
                text: 'Eliminar',
                click: deleteEvent
            }
        ], 
        selectRange: function(e) {
			editEvent({ startDate: e.startDate, endDate: e.endDate });
			deleteEvent
		},
		clickEvent: function(e) {
			alert("wwwwwwwwwww");
//			$("#event-modal").modal("show");
		},
        mouseOnDay: function(e) {
            if(e.events.length > 0.01) {
                var content = '';
                
                for(var i in e.events) {
                    content += '<div class="event-tooltip-content">'
                                    + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
                                    + '<div class="event-location">' + e.events[i].location + '</div>'
                                + '</div>';
                }
            
                $(e.element).popover({
                    trigger: 'manual',
                    container: 'body',
                    html:true,
                    content: content
                });
                
                $(e.element).popover('show');
            }
        },
        mouseOutDay: function(e) {
            if(e.events.length > 0.1) {
                $(e.element).popover('hide');
            }
        },
        dayContextMenu: function(e) {
            $(e.element).popover('hide');
		},
		
	
        dataSource: [
		
<?php foreach($event as $fila){ ?>
			
	    {
					id: <?php echo $fila['id']; ?>,
					name: '<?php echo $fila['title']; ?>',
					color: '<?php echo $fila['color']; ?>',
					location: '<?php echo $fila['lugar']; ?>',
					startDate: new Date(<?php echo date("Y", strtotime($fila['start'])); ?>, <?php echo date("m", strtotime($fila['start']))-1; ?>, <?php echo date("d", strtotime($fila['start'])); ?>),
					endDate: new Date(<?php echo date("Y", strtotime($fila['end'])); ?>, <?php echo date("m", strtotime($fila['end']))-1; ?>, <?php echo date("d", strtotime($fila['end'])); ?>)
		},	
	<?php }?>
	
        ]
    });
    
//    $('#save-event').click(function() {
//        saveEvent();
//    });
});
</script>


<?php include('footer.php'); ?>













