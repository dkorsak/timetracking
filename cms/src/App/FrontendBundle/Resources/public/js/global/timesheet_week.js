$(function () {
    "use strict";
    
    var $dom = $("#timesheet-week-content");
    var $datepicker = $dom.find('.change-date');
    var $addTaskModal = $('#add-task-modal');
    var handleBarTemplate;
    
    if ($dom.size() > 0) {
        
        var currentYear = $datepicker.data("year");
        var currentWeek = $datepicker.data("week");
        var taskList = [];

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
            $addTaskModal.find('.modal-body').load(Routing.generate('timesheet_week_new_task', {'year': currentYear, 'week': currentWeek}), '', function() {
                taskList = $addTaskModal.find('.control-group-task').data("list");
                $addTaskModal.find('.modal-body select.select-project').select2({
                    placeholder: "Select a project"
                }).on("change", function(e) {
                    $addTaskModal.find('.modal-body .select-task').select2({
                        placeholder: "Select a task",
                        data: taskList[e.val]
                    });
                })
                $addTaskModal.find('.modal-body .select-task').select2({
                    data: []
                });
                $addTaskModal.modal();
            });
            
            return false;
        });

        // prepare add task ajax form
        $addTaskModal.find('form').ajaxForm({
            target: $addTaskModal.find('.modal-body'),
            url: Routing.generate('timesheet_week_create_task', {'year': currentYear, 'week': currentWeek}),
            beforeSubmit: function() {
                $addTaskModal.modal('loading');
            },
            success: function showResponse(responseText, statusText, xhr, $form) {
                if (xhr.getResponseHeader('Content-Type') == 'application/json') {
                    $addTaskModal.modal('hide');
                    $addTaskModal.find('.modal-body').html("");
                    //TODO handlebar and show row
                } else {
                    $addTaskModal.find('.modal-body select.select-project').select2({
                        placeholder: "Select a project"
                    }).on("change", function(e) {
                        $addTaskModal.find('.modal-body .select-task').select2({
                            data: [{id: 0, text: 'stoaaaary'},{id: 1, text: 'buaaaaaaag'},{id: 2, text: 'taaaaaaaaaask'}]
                        });
                    })
                    $addTaskModal.find('.modal-body .select-task').select2({
                        data: []
                    });
                    $addTaskModal.modal('removeLoading');
                }
            }
        });
        
        handleBarTemplate = Handlebars.compile($dom.find("#add-task-template").html());
        
        // format all input fields
        $dom.find('.timesheet-table input[type="text"]').setMask();
    }
})
