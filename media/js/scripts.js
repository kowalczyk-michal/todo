$(function() {
   $('.task').on('click', function() {
       $(this).find(".task_description").toggle('slow');
   });
});