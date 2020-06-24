var util={
    cost:{
        actual:0,
        plan:0
    },
    getLocalHost:function(url){
        var url=url?url:window.location.href;
        var pra_arr=url.split('?');
        return pra_arr[0];
    },
    getParameter:function(url){
            var pragrams={};
            var url=url?url:window.location.href;
            var pra_arr=url.split('?');
            if(pra_arr.length>1){
                var paragrams=pra_arr[1];
                var pars_arr=paragrams.split('&');
                
                for(var i=0;i<pars_arr.length;i++){
                    var key_value_arr=pars_arr[i].split('=');
                    pragrams[key_value_arr[0]]=key_value_arr[1];
                }
            }else{
                pragrams=null;
            }
            return pragrams;
    },
    upDataPay:function(tasks){
        var actual=0;
        var plan=0;

        for(var i=0;i<tasks.data.length;i++){
            //console.log(tasks.data[i]['type']);
            if(tasks.data[i]['type']!='project'){
                var user=projectUsers.getUserDateBykey(tasks.data[i].user);
                var duration=tasks.data[i].duration;

                var plan_duration=0;
                if(gantt.config.work_time){
                    plan_duration=util.getWorkDays(tasks.data[i].planned_start,tasks.data[i].planned_end.getTime());
                }else{
                    plan_duration=(tasks.data[i].planned_end.getTime()-tasks.data[i].planned_start.getTime())/(24*60*60*1000);
                }
                //console.log(getWorkDays(tasks.data[i].planned_start,tasks.data[i].planned_end));
                
                if(user!=null&&user.pay!=undefined){
                    actual+=parseInt(user.pay)*duration;
                    plan+=parseInt(user.pay)*plan_duration;
                };
            }else{
                //计算项目的进度
                var chi=gantt.getChildren(tasks.data[i].id);
                tasks.data[i].progress=util.setProcess(chi);
                //console.log(tasks.data[i].progress);
            }
        }

        $('#costactual').text(actual);
        $('#costplan').text(plan);

    },
    setProcess:function(task_ids){
        //修改进度
        var mstart_date=0;
        var mend_date=0;
        var progress=0;
        for(var i=0;i<task_ids.length;i++){
            var task=gantt.getTask(task_ids[i]);
            //console.log(task.start_date);
            if(i==0){
                mstart_date=task.start_date;
                mend_date=task.end_date;
            }else{
                if(mstart_date>task.start_date){
                    mstart_date=task.start_date;
                }
                if(mend_date<task.end_date){
                    mend_date=task.end_date;
                }
            }
        }
        progress=(today-mstart_date)/(mend_date-mstart_date);
        if(progress<0){
            progress=0;
        }else if(progress>1){
            progress=1;
        }
        return progress;
    },
    getWorkDays:function(begin,end){
        var beginDate = new Date(begin);
        //结束日期
        var endDate = new Date(end);
        //日期差值,即包含周六日、以天为单位的工时，86400000=1000*60*60*24.
        var workDayVal = (endDate - beginDate)/86400000;
        // console.log(workDayVal);
        //工时的余数
        var remainder = workDayVal % 7;
        //工时向下取整的除数
        var divisor = Math.floor(workDayVal / 7);
        var weekendDay = 2 * divisor;

        //起始日期的星期，星期取值有（1,2,3,4,5,6,0）
        var nextDay = beginDate.getDay();
        //从起始日期的星期开始 遍历remainder天
        for(var tempDay = remainder; tempDay>=1; tempDay--) {
            //第一天不用加1
            if(tempDay == remainder) {
                nextDay = nextDay + 0;
            } else if(tempDay != remainder) {
                nextDay = nextDay + 1;
            }
            //周日，变更为0
            if(nextDay == 7) {
                nextDay = 0;
            }

            //周六日
            if(nextDay == 0 || nextDay == 6) {
                weekendDay = weekendDay + 1;
            }
        }
        //实际工时（天） = 起止日期差 - 周六日数目。
        workDayVal = workDayVal - weekendDay;
        return workDayVal;
    },
    getMsgList:function(tasks){

        var msg={
            
        }

        // msg["2018-09-06"]=[
        //     {
        //         uid:'1111',
        //         uname:'',
        //         pid:'1111',
        //         pname:'项目名称',
        //         tid:'111',
        //         tname:'任务名称',
        //         start:'',
        //         end:''
        //         // type:''//0参与项目  //1项目开始前通知   //2项目结束前通知   //3项目完成通知
        //     },
        //     {
        //         uid:'1111',
        //         uname:'',
        //         pid:'1111',
        //         pname:'项目名称',
        //         tid:'111',
        //         tname:'任务名称',
        //         start:'',
        //         end:''
        //         // type:''//0参与项目  //1项目开始前通知   //2项目结束前通知   //3项目完成通知
        //     }
        // ]
        for(var i=0;i<tasks.data.length;i++){
            var task=tasks.data[i];
            var key=task.start_date.toJSON();
            if(task.type!='project'){
                var obj={
                    'uid':'1111',
                    'uname':'',
                    'pid':PID,
                    'pname':'项目名称',
                    'tid':task.id,
                    'tname':task.text,
                    'start':task.start_date,
                    'end':task.end_date,
                    'type':'start'
                }
                if(msg[key]==undefined){
                    msg[key]=[];
                    msg[key].push(obj);
                }else{
                    msg[key].push(obj);
                }
            }
        }
        return msg;
    }
}

Date.prototype.format = function(fmt) {
    var o = {
        "M+" : this.getMonth()+1,                 //月份 
        "d+" : this.getDate(),                    //日 
        "h+" : this.getHours(),                   //小时 
        "m+" : this.getMinutes(),                 //分 
        "s+" : this.getSeconds(),                 //秒 
        "q+" : Math.floor((this.getMonth()+3)/3), //季度 
        "S"  : this.getMilliseconds()             //毫秒 
    };

    if(/(y+)/.test(fmt)) {
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    }

    for(var k in o) {
        if(new RegExp("("+ k +")").test(fmt)){
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
        }
    }

    return fmt;
}
/* 
* 重写时间的toJSON方法，因为在调用JSON.stringify的时候，时间转换就调用的toJSON，这样会导致少8个小时，所以重写它的toJSON方法
*/
Date.prototype.toJSON = function () {
    return this.format("dd-MM-yyyy"); // util.formatDate是自定义的个时间格式化函数
}