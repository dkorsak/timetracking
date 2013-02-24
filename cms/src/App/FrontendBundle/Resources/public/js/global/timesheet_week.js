$(function () {
    "use strict";

    var $dom = $("#timesheet-week-content");
    var callbackFunction;

    if ($dom.size() > 0) {
        
        var $datepicker = $dom.find('.change-date').initializeDatePicker();
        var currentYear = $datepicker.data("year");
        var currentWeek = $datepicker.data("week");

        callbackFunction = function(responseText) {
            var template = Handlebars.compile($dom.find("#add-task-template").html());
            var html    = template(responseText);
            var $tbody = $dom.find('table.timesheet-table tbody');
            $tbody.append(html);
            $tbody.find('tr:last').fadeIn();
            $tbody.find('tr:last input[type="text"]').setMask();
        };

        $dom.find('a.add-new-task').createNewTaskEvent({
            loadUrl: Routing.generate('timesheet_week_new_task', {'year': currentYear, 'week': currentWeek}),
            submitUrl: Routing.generate('timesheet_week_create_task', {'year': currentYear, 'week': currentWeek}),
            callback: callbackFunction
        });

        $dom.find('table.timesheet-table').delegate('a.action-remove', 'click', function(){
            var id = $(this).data("id");
            var tr = $(this).parent().parent();
            var url = Routing.generate('timesheet_week_remove_task', {id: id});
            $('body').modalmanager('loading');
            $.post(url).done(function(data) {
                $(tr).fadeOut();
            }).always(function() { 
                $('body').modalmanager('removeLoading');
            }).fail(function() { 
                
            });
        });
        // format all input fields
        $dom.find('.timesheet-table input[type="text"]').setMask();
        
        $dom.find('a.action-remove').popover({
            content: 'dddd'
        })
    }
})
