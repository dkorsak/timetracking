$(function () {
    "use strict";
    
    var $dom = $("#timesheet-week-content");
    var $datepicker = $dom.find('.change-date');
    var $addTaskModal = $('#add-task-modal');
    
    if ($dom.size() > 0) {
        
        // datepicker
        $datepicker.datepicker({language: locale.substring(0, 2)}).on('changeDate', function(ev) {
            $datepicker.datepicker('hide');
            var date = moment(new Date(ev.date)).format("/YYYY/MM/DD");
            document.location.href= $datepicker.attr("href") + date;
            
            return false;
        });
        
        // show add task modal window
        $dom.find('a.add-new-task').on('click', function() {
            $('body').modalmanager('loading');
            var year = moment($datepicker.data("date")).format('YYYY');
            var month = moment($datepicker.data("date")).format('MM');
            $addTaskModal.find('.modal-body').load(Routing.generate('timesheet_week_new_task', {'year': year, 'month': month}), '', function() {
                $addTaskModal.find('.modal-body select').select2();
                $addTaskModal.modal();
            });
            
            return false;
        });

        // prepare add task ajax form
        $addTaskModal.find('form').ajaxForm({
            target: $addTaskModal.find('.modal-body'),
            beforeSubmit: function() {
                $addTaskModal.modal('loading');
            },
            success: function showResponse(responseText, statusText, xhr, $form) {
                //var response = $.parseJSON(responseText);
                if (xhr.getResponseHeader('Content-Type') == 'application/json') {
                    $addTaskModal.modal('hide');
                    $addTaskModal.find('.modal-body').html("");
                }
                $addTaskModal.modal('removeLoading')
            }
        });
        
        // format all input fields
        $dom.find('.timesheet-table input[type="text"]').setMask();
    }
})
