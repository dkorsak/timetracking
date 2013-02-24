$.fn.extend({
    
    // create date picker for given element
    initializeDatePicker: function() {
        return $(this).datepicker({language: locale.substring(0, 2)}).on('changeDate', function(ev) {
            $(this).datepicker('hide');
            var date = moment(new Date(ev.date)).format("/YYYY/MM/DD");
            document.location.href= $(this).attr("href") + date;
            
            return false;
        });
    },
    
    createNewTaskEvent: function(options) {
        
        var $addTaskModal = $('#add-task-modal');
        
        // prepare add task ajax form
        $addTaskModal.find('form').ajaxForm({
            target: $addTaskModal.find('.modal-body'),
            url: options.submitUrl,
            beforeSubmit: function() {
                $addTaskModal.modal('loading');
            },
            success: function showResponse(responseText, statusText, xhr, $form) {
                if (xhr.getResponseHeader('Content-Type') == 'application/json') {
                    $addTaskModal.modal('hide');
                    $addTaskModal.find('.modal-body').html("");
                    options.callback(responseText);
                } else {
                    var taskList = $addTaskModal.find('.control-group-task').data("list");
                    var $selectTask = $addTaskModal.find('.modal-body .select-task');
                    var $selectProject = $addTaskModal.find('.modal-body select.select-project');
                    $selectTask.select2({
                        data: []
                    });
                    
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
                                data: taskList[v],
                                initSelection : function (element, callback) {
                                    var elemText = "";
                                    for (task in taskList[v]) {
                                        if (taskList[v][task].id == element.val()) {
                                            elemText = taskList[v][task].text;
                                            break;
                                        }
                                    }
                                    var data = {id: element.val(), text: elemText};
                                    callback(data);
                                }
                            });
                            $selectTask.select2("val", $selectTask.val());
                        }
                        
                    } else {
                        $selectTask.select2("disable");
                    }
                    $addTaskModal.modal('removeLoading');
                }
            }
        });
        
        return $(this).on('click', function() {
            $('body').modalmanager('loading');
            $addTaskModal.find('.modal-body').load(options.loadUrl, '', function() {
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
                $addTaskModal.find('.time-field').setMask();
                $addTaskModal.modal();
            });
            
            return false;
        });
    }
});