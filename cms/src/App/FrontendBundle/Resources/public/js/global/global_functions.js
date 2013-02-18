$.fn.extend({
    
    // create date picker for given element
    initializeDatePicker: function() {
        return $(this).datepicker({language: locale.substring(0, 2)}).on('changeDate', function(ev) {
            $(this).datepicker('hide');
            var date = moment(new Date(ev.date)).format("/YYYY/MM/DD");
            document.location.href= $(this).attr("href") + date;
            
            return false;
        });
    }
});