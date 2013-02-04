$(function () {
    "use strict";
    
    var $dom = $("#timesheet-week-content");
    var $datepicker = $dom.find('.change-date');
    
    if ($dom.size() > 0) {
        
        // datepicker
        $datepicker.datepicker().on('changeDate', function(ev) {
            $datepicker.datepicker('hide');
            var date = moment(new Date(ev.date)).format("/YYYY/MM/DD");
            document.location.href= $datepicker.attr("href") + date;
            return false;
        });
        
        // format all input fields
        $dom.find('.week-table input[type="text"]').setMask();
    }
})
