$(function () {
    "use strict";
    var $dom = $("#timesheet-day-content");
    var callbackFunction;
    
    if ($dom.size() > 0) {
        var $datepicker = $dom.find('.change-date').initializeDatePicker();
        var currentYear = $datepicker.data("year");
        var currentWeek = $datepicker.data("week");
        var currentWeekDay = $datepicker.data("weekday");
        
        callbackFunction = function(responseText) {
            alert('x');
            var handleBarTemplate = Handlebars.compile($dom.find("#add-task-template").html());
        };
        
        $dom.find('a.add-new-task').createNewTaskEvent({
            loadUrl: Routing.generate('timesheet_day_new_task', {'year': currentYear, 'week': currentWeek, 'weekDay': currentWeekDay}),
            submitUrl: Routing.generate('timesheet_day_create_task', {'year': currentYear, 'week': currentWeek, 'weekDay': currentWeekDay}),
            callback: callbackFunction
        });
    }
})
