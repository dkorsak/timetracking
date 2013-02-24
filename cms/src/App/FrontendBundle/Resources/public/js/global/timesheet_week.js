$(function () {
    "use strict";
    
    var $dom = $("#timesheet-week-content");
    var callbackFunction;
    
    if ($dom.size() > 0) {
        
        var $datepicker = $dom.find('.change-date').initializeDatePicker();
        var currentYear = $datepicker.data("year");
        var currentWeek = $datepicker.data("week");
        
        callbackFunction = function(responseText) {
            var handleBarTemplate = Handlebars.compile($dom.find("#add-task-template").html());
        };
        
        $dom.find('a.add-new-task').createNewTaskEvent({
            loadUrl: Routing.generate('timesheet_week_new_task', {'year': currentYear, 'week': currentWeek}),
            submitUrl: Routing.generate('timesheet_week_create_task', {'year': currentYear, 'week': currentWeek}),
            callback: callbackFunction
        });
        // format all input fields
        $dom.find('.timesheet-table input[type="text"]').setMask();
    }
})
