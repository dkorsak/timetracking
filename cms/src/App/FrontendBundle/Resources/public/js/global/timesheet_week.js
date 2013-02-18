$(function () {
    "use strict";
    
    var $dom = $("#timesheet-week-content");
    
    if ($dom.size() > 0) {
        
        var $datepicker = $dom.find('.change-date').initializeDatePicker();
        var currentYear = $datepicker.data("year");
        var currentWeek = $datepicker.data("week");
        var $addTaskModal = $('#add-task-modal');
        var handleBarTemplate;
        
        // show add task modal window
        $dom.find('a.add-new-task').on('click', function() {
            $('body').modalmanager('loading');
            $addTaskModal.find('.modal-body').load(Routing.generate('timesheet_week_new_task', {'year': currentYear, 'week': currentWeek}), '', function() {
                var taskList = $addTaskModal.find('.control-group-task').data("list");
                var $selectTask = $addTaskModal.find('.modal-body .select-task');
                $selectTask.select2({
                    data: []
                });
                $selectTask.select2("disable");
                $addTaskModal.find('.modal-body select.select-project').select2({
                    placeholder: "Select a project"
                }).on("change", function(e) {
                    if (taskList[e.val] === undefined) {
                        return false;
                    }
                    
                    $selectTask.select2({
                        data: taskList[e.val]
                    });
                    $selectTask.select2("data", {id: "", text: ""});
                    $selectTask.select2("enable");
                })
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
                    var taskList = $addTaskModal.find('.control-group-task').data("list");
                    var $selectTask = $addTaskModal.find('.modal-body .select-task');
                    var $selectProject = $addTaskModal.find('.modal-body select.select-project');
                    $selectTask.select2({
                        data: []
                    });
                    
                    // $selectTask.select2("disable");
                    $selectProject.select2({
                        placeholder: "Select a project"
                    }).on("change", function(e) {
                        if (taskList[e.val] === undefined) {
                            return false;
                        }
                        
                        $selectTask.select2({
                            data: taskList[e.val]
                        });
                        $selectTask.select2("data", {id: "", text: ""});
                        $selectTask.select2("enable");
                    })
                    var v = $selectProject.select2("val");
                    if (v != "") {
                        if (taskList[v] !== undefined) {
                            $selectTask.select2({
                                data: taskList[v]
                            });
                        }
                    } else {
                        $selectTask.select2("disable");
                    }
                    $addTaskModal.modal('removeLoading');
                }
            }
        });
        
        handleBarTemplate = Handlebars.compile($dom.find("#add-task-template").html());
        
        // format all input fields
        $dom.find('.timesheet-table input[type="text"]').setMask();
    }
})
