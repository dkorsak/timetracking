$(function () {
    "use strict";
    var $dom = $("#timesheet-day-content");
    
    if ($dom.size() > 0) {
        var $datepicker = $dom.find('.change-date').initializeDatePicker();
    }
})
