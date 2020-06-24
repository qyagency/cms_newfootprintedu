var db = {
    //通过项目id获得任务数据，获取的是当前的正式版本
    getTasksByPid: function (pid, callback) {
        var url = "http://wktest.dev.x-w-t.com/api/getList";
        var tasks = null;
        $.ajax({
            type: "post",
            data: {
                pid: pid
            },
            url: url,
            success: function (data) {
                if (data.length) {
                    tasks = data[0];
                    console.log(data);
                } else {
                    //如果项目没有任务记录的话，创建一条空的记录
                    tasks = {
                        data: [{
                            'id': new Date().getTime(),
                            'start_date': today,
                            'duration': 1,
                            'planned_start': today,
                            'planned_end': new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1),
                            'progress': 0,
                            'text': $('#project-name').text(),
                            'user': '',
                            'parent': '',
                            'type': 'task'
                        }]
                    }
                }
                callback(tasks);
            }
        })

        /*
         返回数据格式
         [
         {
         create_time:"1535955091",
         data:[
         {
         'id':'',
         'start_date':'',
         'duration':'',
         'planned_start':'',
         'planned_end':'',
         'progress':0,
         'text':'',
         'user':'',
         'parent':'',
         'type':'task'
         }
         ],
         id:'',
         links:[
         {
         source: "1535955066976",
         target: "1535955066952",
         type: "1", id: 1535958489723
         }
         ],
         mid:'',
         pid:'',
         update_time:'',
         version:''
         }
         ]
         */
    },
    //提交
    setTasks: function (data, callback) {
        var url = "http://wktest.dev.x-w-t.com/api/upload";
        $.ajax({
            type: "post",
            url: url,
            data: data,
            success: function (data) {
                if (data.code == 200) {
                    callback();
                }
                ;
            }
        });
    },
    getLogin: function () {
        //保存登录用户状态
        return {
            'user_token': 'hasdenglu',//用户登录状态
            'id': '33333',//id
            'name': 'Leo Wang',//名字
            'department': '盈科网络',//部门
            'permission': 2,//项目操作权限，2为超级权限，1为限制权限，0为只读权限
            'join_projects': [
                {
                    'pid': 2,
                    'pname': '智选假日酒店官网',
                    'def_vis': ''
                },
                {
                    'pid': 5,
                    'pname': '莉莉丝h5',
                    'def_vis': ''
                },
                {
                    'pid': 4,
                    'pname': '法拉利',
                    'def_vis': ''
                }
            ]
        }
    },
    //通过pid获取项目的所有参与人员
    getUsersByPId: function (callback) {
        // var url="http://wktest.dev.x-w-t.com/api/upload";
        // $.ajax({
        //     type:"post",
        //     url:url,
        //     data:data,
        //     success:function(data){
        //         if(data.code==200){
        //             callback();
        //         };
        //     }
        // });
        var data = {
            'pro_users': [//项目的参与人
                {key: "", label: "选择一个执行者..."},
                {key: "John", label: "John", job: "设计师", pay: "100"},
                {key: "Mike", label: "Mike", job: "前端工程师", pay: "200"},
                {key: "Anna", label: "Anna", job: "php程序员", pay: "300"},
                {key: "leo", label: "leo", job: "前端工程师", pay: "500"}
            ]
        }
        callback(data)
    },
    //通过用户id查询所有正在进行中的项目，返回当前所有正式版本下的所有项目
    getTasksByUserId: function (userId) {

    },
    //通过uid，pid，vid查找
    getTasksByVison: function (uid, pid, vid) {

    }
}