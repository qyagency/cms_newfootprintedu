var controller = {
    submitTasks: function (is_reload) {
        var task_version = $('.task_version').val();//版本名称
        var submit_tasks = [];//准备提交的任务对象

        //从构tasks数据
        for (var i = 0; i < tasks.data.length; i++) {
            var crr_task = tasks.data[i];
            var pur_task;

            //如果有子项目的话，证明这个是一个项目类型的数据
            if (gantt._has_children(crr_task['id'])) {
                pur_task = {
                    'id': crr_task['id'],
                    'text': crr_task['text'],
                    'open': 'true',
                    'type': 'project',
                    'parent': crr_task['parent'],
                    'progress': crr_task['progress']
                }
            } else {

                //正常的数据
                pur_task = {
                    'id': crr_task['id'],
                    'start_date': crr_task['start_date'],
                    'duration': crr_task['duration'],
                    'planned_start': crr_task['planned_start'],
                    'planned_end': crr_task['planned_end'],
                    'progress': crr_task['progress'],
                    'text': crr_task['text'],
                    'user': crr_task['user'],
                    'parent': crr_task['parent'],
                    'type': 'task'
                }

                //从project 类型恢复到task类型的数据
            }
            submit_tasks.push(pur_task);
        }
        //console.log(submit_tasks);
        if (is_reload) {

            rerender_gantt({
                pid: tasks.pid,
                data: submit_tasks,
                links: gantt._links,
                version: task_version
            });

        }else{

            console.log(util.getMsgList(tasks));

            var data = {
                pid: PID,
                data: JSON.stringify(submit_tasks),
                links: JSON.stringify(gantt._links),
                version: task_version,
                msg:JSON.stringify(util.getMsgList(tasks))
            }

            // console.log(data);
            db.setTasks(data, function () {
                gantt.message({text: "提交成功~", type: "completed"});
            });

        }
    }
}
