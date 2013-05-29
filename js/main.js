$(document).ready(function() {
    
    $("#filter").on('change',function(){
    	window.location.replace("http://www.jmcdesignstudios.com/task_app/?filter="+$('#filter').val());
    });
    
    $("#register").validate();

});