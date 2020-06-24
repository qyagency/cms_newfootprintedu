/*弹出对话框配置**/
gantt.locale.labels["section_priority"] = "Priority";
gantt.locale.labels["section_progress"] = "Progress";
gantt.locale.labels["section_user"] = "执行者";
gantt.locale.labels["section_plan"] = "计划时间";
gantt.locale.labels["section_time"] = "任务时间";
// gantt.locale.labels["complete_button"] = "完成";
gantt.locale.labels["stop_button"] = "暂停";

gantt.config.buttons_left=["dhx_save_btn","dhx_cancel_btn","stop_button"];


var start_time;
var is_furture=false;
//在弹出框显示之前 如果已经完成 阻止弹出
gantt.attachEvent("onBeforeLightbox", function(id) {
    var task=this.getTask(id);

    if(task.type=="project"){
        return false;
    }
    if(login_config.permission==user_permiss.none){
        //没有修改权限的话
        //gantt.message({text:"不可修改", type:"error"});
        return false;
    }else
    if(login_config.permission==user_permiss.limit){
        //限制级权限
        if(task.$new){//如果是新建的任务，弹出对话框
            if(task.start_date<today){
                task.start_date=today;
            }
            return true;
        }else{
            //编辑
            if(task.end_date<today){
                gantt.message({text:"已结束的任务", type:"error"});
                return false;
            }else {
                if(task.start_date<today){
                    //进行一半的任务
                    gantt.message({text:"开始的任务只能修改天数", type:"error"});
                    start_time=task.start_date;
                }else{
                    //未开始的任务
                    console.log('未开始的任务~~~');
                    is_furture=true;
                    start_time=today;
                }
            }
            return true;
        }
    }else
    if(login_config.permission==user_permiss.unlimit){
        //超级权限
        return true;
    }
    
});
gantt.attachEvent("onLightbox", function(id) {
    var task=this.getTask(id);

    if(login_config.permission==user_permiss.limit){
        if(task.start_date<today){
            //gantt.message({text:"请拖动修改任务天数", type:"error"});
            $('.gantt_time_selects select').attr('disabled','disabled');
            //return true;
        }
    }
});
gantt.attachEvent("onAfterLightbox", function(id) {
    $('.gantt_time_selects select').removeAttr('disabled');
})
gantt.attachEvent("onLightboxButton", function(button_id, node, e){//弹出框 点击立即完成任务按钮
    if(button_id == "complete_button"){
        var id = gantt.getState().lightbox;
        gantt.getTask(id).progress = 1;
        gantt.updateTask(id);
        gantt.hideLightbox();
    }
    if(button_id == "stop_button"){
        var id = gantt.getState().lightbox;
        var task=gantt.getTask(id);
        var is_start=today.getTime()-task.start_date.getTime();
        var day_mint=24*60*60*1000;
        if(is_start<=0){
            gantt.message({text:"未开始的项目不可暂定，请删除", type:"error"});
            return false;
        }else{
            task.duration=(is_start+day_mint)/day_mint;
            task.end_date=new Date(curr_day.getFullYear(), curr_day.getMonth(), curr_day.getDate());

            task.progress='1';
            gantt.updateTask(task.id);
            gantt.hideLightbox();
        }
        
    }
});


gantt.attachEvent("onLightboxSave", function(id, item){//弹出框，点击保存按钮

    //console.log(item);
    var lightbox_stat_date;
    var m_year,m_month,m_day;

    if(!item.text){
        gantt.message({type:"error", text:"请输入任务内容"});
        return false;
    }

    $('.gantt_time_selects select').each(function(index){

        if(index==0){
            m_day=$(this).val();
        }
        if(index==1){
            m_month=$(this).val();
        }
        if(index==2){
            m_year=$(this).val();
        }

    });

    lightbox_stat_date=new Date(m_year,m_month,m_day);

    // console.log(lightbox_stat_date);

    //判断是否当前任务是否存在，如果不存在则 push 进任务数组，否则不做处理
    is_exit=false;

    for(var i=0;i<tasks.data.length;i++){
        if(tasks.data[i].id==item.id){
            is_exit=true;
        }
    }

    if(!is_exit){
        item.planned_start=item.end_date;
        item.planned_end=item.start_date;
        //添加
        tasks.data.push(item);
        //controller.submitTasks();

    }else{
        //编辑
        if(login_config.permission==user_permiss.limit){
            //有限权限
            if(lightbox_stat_date.getTime()<today.getTime()&&is_furture){
                gantt.message({type:"error", text:"开始时间不能是已过去的时间"});
                item.start_date=today
                is_furture=false;
            }
            
        }
    }

    // console.log(item);
    return true;
    
});