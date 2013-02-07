$(function () {
    "use strict";
    
    var $dom = $("#timesheet-day-content");
    var $datepicker = $dom.find('.change-date');
    
    if ($dom.size() > 0) {
        
        // datepicker
        $datepicker.datepicker({language: locale.substring(0, 2)}).on('changeDate', function(ev) {
            $datepicker.datepicker('hide');
            var date = moment(new Date(ev.date)).format("/YYYY/MM/DD");
            document.location.href= $datepicker.attr("href") + date;
            return false;
        });
        
    }
})
