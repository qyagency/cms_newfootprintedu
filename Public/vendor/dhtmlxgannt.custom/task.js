gantt.addTaskLayer(function draw_planned(task) {
    if (task.planned_start && task.planned_end) {
        var sizes = gantt.getTaskPosition(task, task.planned_start, task.planned_end);
        var el = document.createElement('div');
        el.className = 'baseline';
        
        el.style.left = sizes.left + 'px';
        el.style.width = sizes.width + 'px';
        el.style.top = sizes.top + gantt.config.task_height + 13 + 'px';
        return el;
    }
    return false;
});

gantt.templates.rightside_text = function (start, end, task) {
    if(task.type=='project'){
        return '';
    }
    if (task.planned_end) {
        if (end.getTime() > task.planned_end.getTime()) {
            var overdue = Math.ceil(Math.abs((end.getTime() - task.planned_end.getTime()) / (24 * 60 * 60 * 1000)));
            var text = "<b>超出原定计划: " + overdue + " 天</b>";
            return text;
        }
    }
};

gantt.templates.leftside_text = function(start, end, task){//任务条左侧文本
    return "<span style='float:left;'>"+Math.round(task.progress*100)+ "% </span>";
};

gantt.templates.task_class = function (start, end, task) {
    if(task.type=='project'){
        var classes = [];
        classes.push('projcet_task');

        return classes.join(' ');
    }
    if (task.planned_end) {
        var classes = ['has-baseline'];
        if (end.getTime() > task.planned_end.getTime()) {
            classes.push('overdue');
        }else{
            if(task.progress == 1){
                classes.push('completed_task');
            }else if(start.getTime()+(end.getTime()-start.getTime())*task.progress<(new Date()).getTime()){
                classes.push('delayed_task');
            }
        }
        
        return classes.join(' ');
    }
};

//加载任务
gantt.attachEvent("onTaskLoading", function (task) {

    task.planned_start = gantt.date.parseDate(task.planned_start, "xml_date");
    task.planned_end = gantt.date.parseDate(task.planned_end, "xml_date");


    //修改process
    if(task.type!='project'){
        if(task.end_date<today){
            task.progress=1;
        }else if(task.start_date>=today){
            task.progress=0;
        }else{
            task.progress=(today-task.start_date)/(task.end_date-task.start_date);
        }
    }
    return true;
});

//在任务更新前
gantt.attachEvent("onBeforeTaskUpdate",function(id, item){

    //如果是超级权限的话，可以修改计划任务，如果不是不能修改
   if(login_config.permission==user_permiss.unlimit){
        item.planned_start=item.start_date;
        item.planned_end=item.end_date;
    }
    //修改process
    if(item.end_date<today){
        item.progress=1;
    }else if(item.start_date>=today){
        item.progress=0;
    }else{
        item.progress=(today-item.start_date)/(item.end_date-item.start_date);
    }

    //修改父任务的进度
    var pid=gantt.getParent(item.id);
    var chi=gantt.getChildren(pid);
    //console.log(id);
    //console.log(chi);
    gantt.getTask(pid).progress=util.setProcess(chi);

    console.log(item.start_date);
    //console.log(tasks);
    //console.log(111);
});
//在任务更新后
gantt.attachEvent("onAfterTaskUpdate",function(id, item){

    //console.log(item.progress);
    util.upDataPay(tasks);
    //console.log(tasks);
});

//在任务添加之前
gantt.attachEvent("onBeforeTaskAdd",function(id, item){
    //console.log('在任务添加之前');
    util.upDataPay(tasks);
});
//在任务添加之后
gantt.attachEvent("onAfterTaskAdd",function(id, item){
    
    var task=this.getTask(id);
    var par=this.getParent(id);
    var children = gantt.getChildren(par);

    if(login_config.permission!=user_permiss.none){
        task.planned_start=task.start_date;
        task.planned_end=task.end_date;
    }
    if(children.length<=1){
        controller.submitTasks(true);
    }
    //rerender_gantt(tasks);
    util.upDataPay(tasks);
});


var del_pid;
//在任务删除前
gantt.attachEvent("onBeforeTaskDelete", function(id, item){
    // var task=this.getTask(id);
    del_pid=this.getParent(id);


    for(var i=0;i<tasks.data.length;i++){
        if(tasks.data[i].id==id){
            if(login_config.permission==user_permiss.limit){
                if(tasks.data[i].start_date<today){
                    gantt.message({text:"已开始任务，不可删除", type:"error"});
                    return false;
                }
            }
            tasks.data.splice(i,1);
        }
    } 

});
//在任务删除后
gantt.attachEvent("onAfterTaskDelete",function(id, item){

    var children = gantt.getChildren(del_pid);
    if(children.length<=0){
        controller.submitTasks(true);
    }
    util.upDataPay(tasks);

});