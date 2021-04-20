$(document).ready(function(){
    // on sélectionne tous les div avec la classe zoneTexteAfficherMasquer et on les parcourt
    $("div.CentreMessage").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.voirplusMessage").attr("id","voirplusMessage"+(i+1)).hide();
        $(this).find("span.messageClic").attr("id","messageClic"+(i+1)).html("<button class='button'><strong><i>Centre des messages</i></strong></button><br>").attr("statut","1").click(
        function(){
            $("#voirplusMessage"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#messageClic"+(i+1)).attr("statut")=="1"){
                $("#messageClic"+(i+1)).html("<button class='button'><strong><i>Centre des messages</i></strong></button><br>").attr("statut","0");
            }
            else{
                $("#messageClic"+(i+1)).html("<button class='button'><strong><i>Centre des messages</i></strong></button><br>").attr("statut","1");
            };
        });
    });
    //les annonces
    $("div.LesAnnonces").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.voirplusAnnonce").attr("id","voirplusAnnonce"+(i+1)).hide();
        $(this).find("span.annonceClic").attr("id","annonceClic"+(i+1)).html("<button class='button'><strong><i>Les annonces</i></strong></button>").attr("statut","1").click(
        function(){
            $("#voirplusAnnonce"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#annonceClic"+(i+1)).attr("statut")=="1"){
                $("#annonceClic"+(i+1)).html("<button class='button'><strong><i>Les annonces</i></strong></button>").attr("statut","0");
            }
            else{
                $("#annonceClic"+(i+1)).html("<button class='button'><strong><i>Les annonces</i></strong></button>").attr("statut","1");
            };
        });
    });
    //les comptes
     $("div.LesCompte").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.voirplusCompte").attr("id","voirplusCompte"+(i+1)).hide();
        $(this).find("span.compteClic").attr("id","compteClic"+(i+1)).html("<button class='button'><strong><i>Les comptes</i></strong></button>").attr("statut","1").click(
        function(){
            $("#voirplusCompte"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#compteClic"+(i+1)).attr("statut")=="1"){
                $("#compteClic"+(i+1)).html("<button class='button'><strong><i>Les comptes</i></strong></button>").attr("statut","0");
            }
            else{
                $("#compteClic"+(i+1)).html("<button class='button'><strong><i>Les comptes</i></strong></button>").attr("statut","1");
            };
        });
    });
    //zone de commente
     $("div.zonecommentaireMasquer").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.deposercommentaire").attr("id","deposercommentaire"+(i+1)).hide();
        $(this).find("span.Clic").attr("id","Clic"+(i+1)).html("<p style ='color:blue'>Commenter</p>").attr("statut","1").click(
        function(){
            $("#deposercommentaire"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#Clic"+(i+1)).attr("statut")=="1"){
                $("#Clic"+(i+1)).html("<p style ='color:blue'>Commenter</p>").attr("statut","0");
            }
            else{
                $("#Clic"+(i+1)).html("<p style ='color:blue'>Commenter</p>").attr("statut","1");
            };
        })
    });
    // afficher les commentaire
    $("div.zoneAfficheCommentaire").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.voircommentaire").attr("id","voircommentaire"+(i+1)).hide();
        $(this).find("span.ClicComment").attr("id","ClicComment"+(i+1)).html("<p style ='color:blue'>Voir les commentaires</p>").attr("statut","1").click(
        function(){
            $("#voircommentaire"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#ClicComment"+(i+1)).attr("statut")=="1"){
                $("#ClicComment"+(i+1)).html("<p style ='color:blue'>Voir les commentaires</p>").attr("statut","0");
            }
            else{
                $("#ClicComment"+(i+1)).html("<p style ='color:blue'>Voir les commentaires</p>").attr("statut","1");
            };
        })
    });
    // voir plus information
     $("div.zoneTexteAfficherMasquer").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.voirplus").attr("id","voirplus"+(i+1)).hide();
        $(this).find("span.inviteClic").attr("id","inviteClic"+(i+1)).html("<p style ='color:red'>Cliquer pour voir plus d'information</p>").attr("statut","1").click(
        function(){
            $("#voirplus"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#inviteClic"+(i+1)).attr("statut")=="1"){
                $("#inviteClic"+(i+1)).html("<p style ='color:red'>Cliquer pour voir moins d'information</p>").attr("statut","0");
            }
            else{
                $("#inviteClic"+(i+1)).html("<p style ='color:red'>Cliquer pour voir plus d'information</p>").attr("statut","1");
            };
        });
    });
    //autocpmplete
    $.getJSON('Scripts/ville.php' , function(data){
        console.log(data);
        $("#localisation").autocomplete({
            source:data,
            minLength:1
        });
    });
    //message
    $("div.zonemessage").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.deposercommentaire").attr("id","deposercommentaire"+(i+1)).hide();
        $(this).find("span.Clic").attr("id","Clic"+(i+1)).html("<p style ='color:blue'>Message non lu</p>").attr("statut","1").click(
        function(){
            $("#M"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#Clic"+(i+1)).attr("statut")=="1"){
                $("#Clic"+(i+1)).html("<p style ='color:blue'>Message lu</p>").attr("statut","0");
            }
            else{
                $("#Clic"+(i+1)).html("<p style ='color:blue'>Message non lu</p>").attr("statut","1");
            };
        });
    });
    
$('#password').keyup(function() 
{ 
$('#affichageMessage').html(checkStrength($('#password').val())) ;
}) 
function checkStrength(password) 
{ 
var strength = 0 
if (password.length < 6) { 
$('#affichageMessage').removeClass() 
$('#affichageMessage').addClass('short') 
return "<font color='red' size='3'>Trop court</font>" 
} 

if (password.length > 7) strength += 1 
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1 
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1 
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1 
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1 
if (strength < 2) 
{ 
$('#affichageMessage').removeClass() 
$('#affichageMessage').addClass('weak') 
return "<font color='red' size='3'>Faible</font>" 
} 
else if (strength == 2) 
{ 
$('#affichageMessage').removeClass() 
$('#affichageMessage').addClass('good') 
return "<font color='orange' size='3'>Bien</font>" 
} 
else 
{ 
$('#affichageMessage').removeClass() 
$('#affichageMessage').addClass('strong') 
return "<font color='green' size='3'>Fort</font>" 
} 
} ;
    
});


