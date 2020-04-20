<?php
session_start();

// Condition: Si on est pas connecté à un compte la page est bloqué
if(!isset($_SESSION['user'])){
    die("Vous n'etes pas conecté !!!");
    exit;
}else {

// Sinon connexion à la base de donnée
require_once('bdd.php');

// Selectionne les informations concernant les events de l'utilisateur connecté, comme le nom, le date de début et de fin ainsi que le commentaire
$sql = "SELECT id_events, name, begining, ending, comment, id_user, color FROM events WHERE id_user=".$_SESSION['user']['id_user'];

// Récupère les données basés sur le SELECT si-dessus
$req = $bdd->prepare($sql); 
//  Appel de la procédure stocké
$req->execute();
// Récupération de toutes les events de l'utilisateur
$events = $req->fetchAll();}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DYSY Agenda - Mon Agenda</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png">

        <!-- Bootstrap Core CSS -->
        <link href="../../css/css_bootstrapv3/bootstrap.min.css" rel="stylesheet">
        
        <!-- FullCalendar -->
        <link href='../../css/css_bootstrapv3/fullcalendar.css' rel='stylesheet'>

        <!-- Police importer de google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <!-- jQuery Version 1.11.1 -->
        <script src="../../js/js_bootstrapv3/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/js_bootstrapv3/bootstrap.min.js"></script>
        
        <!-- FullCalendar -->
        <script src='../../js/js_bootstrapv3/moment.min.js'></script>
        <script src='../../js/js_bootstrapv3/fullcalendar.min.js'></script>

        <style>
            body {
                padding-top: 70px;
            }
            #calendar {
                max-width: 800px;
            }
            .col-centered{
                float: none;
                margin: 0 auto;
            }
            .container , .modal-title{
                font-family: 'Montserrat', sans-serif;
            }

            .title {
                font-family: 'Montserrat', sans-serif;
                font-size: 40px;
            }
            .fc-center h2 {
                font-family: 'Montserrat', sans-serif;
                font-size: 30px;

            }
            .button-add{
                margin-top : 40px;
            }
        </style>
    </head>
    <body>
        <?php require 'NavBar.php'; ?>
        <!-- Page Content -->
        <div class="container">
            <button type="button" class="btn btn-primary button-add" data-toggle="modal" data-target="#ModalAdd">Ajouter un évènement</button>
            <div class="row">
                <div class="col-lg-14 text-center"><br>
                    <h1 class="title"><?php echo "Bonjour ".($_SESSION['user']['firstname']." ".$_SESSION['user']['name'].",");?></h1><br><br>
                    <div id="calendar" class="col-centered"></div>
                </div>
            </div>
            <!-- /.row -->
            
            <!-- Modal pour creer un evenement -->
            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="addEvent.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Ajouter un évènement</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titre</label>
                                <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Titre" required="required" data-message="Veuillez indiquer le titre de l'évènement">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Couleur</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color" placeholder="Choisir" required="required">
                                        <option value="">Choisir</option>
                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Divers</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Travail</option>
                                        <option style="color:#008000;" value="#008000">&#9724; Cours</option>                         
                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Loisir</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Vacances</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Important</option>
                                        <option style="color:#000;" value="#000">&#9724; Privé</option>   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Date de début</label>
                                <div class="col-sm-10">
                                <input type="datetime-local" name="start" class="form-control" id="start" required="required" data-message="Veuillez chosir une date de début">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">Date de fin</label>
                                <div class="col-sm-10">
                                <input type="datetime-local" name="end" class="form-control" id="end" required="required" data-message="Veuillez chosir une date de fin">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="comment" class="col-sm-2 control-label">Commentaire</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="comment" class="form-control" id="comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- bouton du formulaire -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="save">Create Event</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
                
            <!-- Modal pour modifier ou supprimer un evenement-->
            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="editEventTitle.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modifier un évènement</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titre</label>
                                <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Couleur</label>
                                <div class="col-sm-10">
                                <select name="color" class="form-control" id="color">
                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Divers</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Travail</option>
                                    <option style="color:#008000;" value="#008000">&#9724; Cours</option>                         
                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Loisir</option>
                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Vacances</option>
                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Important</option>
                                    <option style="color:#000;" value="#000">&#9724; Privé</option>
                                </select>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="comment" class="col-sm-2 control-label">Commentaire</label>
                                <div class="col-sm-10">
                                <textarea type="text" name="comment" class="form-control" id="comment" placeholder="Pas de commentaire"></textarea>
                                </div>
                            </div>
                        
                            <input type="hidden" name="id" class="form-control" id="id">
                        
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" name="delete" id="delete">Delete</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
        
        <script>
        $(document).ready(function() {
            // Appel de FullCalendar
            $('#calendar').fullCalendar({
                monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
                monthNamesShort: ['Janv','Fevr','Mars','Avr','Mai','Juin','Jul','Aout','Sept','Oct','Nov','Dec'],
                dayNames: ['Dimanche','Lundi', 'Mardi','Mercredi','Jeudi', 'Vendredi','Samedi'],
                dayNamesShort: ['Dim', 'Lun', 'Mar','Mer','Jeu', 'Ven','Sam'],
                // Bouton pour se deplacer et modifier la vue 
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                // Par defaut samedi et dimanche sont grisés de 9-17h
                businessHours: {
                    daysOfWeek: [ 1, 2, 3, 4, 5 ], 
                    // Lundi-Vendredi de 8-20h
                    startTime: '08:00', 
                    endTime: '20:00', 
                },
                // Pouvoir editer un event
                editable: true,
                // Lorsqu'il y a trop d'event, apparition d'un lien 
                eventLimit: true, 
                // Pouvoir sélectionner plusierus cases
                selectable: true,
                selectHelper: true,
                // Fonction selectionne une  date
                select: function(start, end) {
                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },
                // Lorsque l'on double-clique sur un event, la fonction affiche les différents champs (ci-dessous)
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        $('#ModalEdit #comment').val(event.comment);
                        $('#ModalEdit').modal('show');
                    });
                },
                // Si changement de position d'un event, appel à la fonction edit qui se situe plus bas dans le code source  
                eventDrop: function(event, delta, revertFunc) { 
                    edit(event);
                },
                // Si changement de longueur d'un event, appel à la fonction edit qui se situe plus bas dans le code source  
                eventResize: function(event,dayDelta,minuteDelta,revertFunc) { 
                    edit(event);
                },
                // Objet events pour y stocker les informations à propos d'un event
                events: [
                //boucle pour chaque event
                <?php foreach($events as $event): 
                
                    $start = explode(" ", $event['begining']);
                    $end = explode(" ", $event['ending']);
                    if($start[1] == '00:00:00'){
                        $start = $start[0];
                    }else{
                        $start = $event['begining'];
                    }
                    if($end[1] == '00:00:00'){
                        $end = $end[0];
                    }else{
                        $end = $event['ending'];
                    }
                ?>
                    {
                        id: '<?php echo $event['id_events']; ?>',
                        title: '<?php echo $event['name']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
                        color: '<?php echo $event['color']; ?>',
                        comment: '<?php echo $event['comment']; ?>',
                    },
                <?php endforeach; ?>
                ]
            });
            // Fonction qui reçoit un event dont la date a été modifiée, prend en paramètre un event
            function edit(event){
                // start prend la valeur de start de event
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                // Si la date de fin de event existe alors end prend alors cette valeur
                if(event.end){
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                // Sinon end prend la valeur de start 
                }else{
                    end = start;
                }
                
                // id prend la valuer de l'id de event
                id =  event.id;
                
                // Event un tableau qui contient l'id, le début et la fin de l'event modifié
                Event = [];
                Event[0] = id;
                Event[1] = start;
                Event[2] = end;
                
                // Que l'on envoie sous forme de requete ajax
                $.ajax({
                url: 'editEventDate.php',
                type: "POST",
                data: {Event:Event},
                // Si l'envoi est réussi tout se passe bien sinon message d'erreur
                success: function(rep) {
                        if(rep == 'OK'){
                            alert('Modification sauvegardée !');
                        }else{
                            alert('Sauvegarde impossible, Veuillez réessayez !'); 
                        }
                    }
                });
            } 
        });
        </script>
    </body>
</html>

<?php
require 'Footer.php';
?>

