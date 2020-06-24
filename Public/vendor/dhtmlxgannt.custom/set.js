/*左侧栏目刻度配置**/
gantt.config.grid_width = 600;  //左侧栏目
gantt.config.add_column = true;// 自定义左侧

gantt.config.fit_tasks=true;//自适应任务的长度
gantt.config.drag_progress=false;//没有进度拖动

gantt.config.columns = [
    {name:"text", label:"任务名称", tree:true, width:'200'/*,template:columsTempFunc*/},
    {name:"progress", label:"进度", width:80, align: "center",width:'44',
        template: function(item) {
            if(isNaN(item.progress)){
                item.progress=0;
            }
            if (item.progress >= 1)
                return "完成";
            if (item.progress == 0)
                return "未开始";
            return Math.round(item.progress*100) + "%";
        }
    },
    {name:"user", label:"执行人", align: "center", width:80,
        template: function(item) {
            if (!item.user) return "--";
           // return item.users.join(", ");
           return item.user;
        }
    },
    {name:"end_date",label:"结束日期",align: "center", resize:true,width:'80' },
    {name:"duration",   label:"持续时间",   align: "center",width:60, template:function(task){
        return task.duration
    } },
    {name:"add",width:'44'},
];


/*顶部刻度配置参数*/
gantt.config.scale_height = 50;//刻度的高度
gantt.config.scale_unit = "month";//刻度按月分分割
gantt.config.date_scale = "%F";//刻度内容显示 为月份
gantt.config.subscales = [//子刻度内容
    {unit:"day", step:1, date:"%j, %D" },
    //{unit:"month", step:1, date:"%M" },
    //{unit:"year", step:1, date:"%Y" }
];

/*主体内容参数配置*/
gantt.config.work_time = false;//是否计算 周末 并修改样式
gantt.config.task_height = 20;
gantt.config.row_height = 50;

gantt.templates.scale_cell_class = function(date){

    if(date.getDay()==0||date.getDay()==6){
        return "weekend";
    }
};
gantt.templates.task_cell_class = function(item,date){

    if(date.getDay()==0||date.getDay()==6){
        return "weekend" ;
    }

};



/***其他扩展配置***/
var date_to_str = gantt.date.date_to_str(gantt.config.task_date);
var curr_day=new Date();
var today = new Date(curr_day.getFullYear(), curr_day.getMonth(), curr_day.getDate());//今日
gantt.addMarker({ //添加今日线条标志
    start_date: today,
    css: "today",
    text: "今日",
    title:"Today: "+ date_to_str(today)
});