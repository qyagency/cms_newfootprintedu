//用户所有权限对比
var user_permiss = {
    // 超级
    unlimit: 2,
    // 半自由，只能操作将来的
    limit: 1,
    // 只读权限
    none: 0
}

var login_config = {
    id: '',
    token: '',
    name: '',
    permission: 2,
    edit_plan: true,
    setPermission: function (per) {
        this.permission = per;
    },
    setLoginUser: function (name) {
        this.name = name;
    },
    setToken: function (token) {
        this.token = token;
    },
    getToken: function () {
        return this.token;
    },
    setUid: function (id) {
        this.id = id;
    }
}

var projectUsers = {
    data: [],
    getUserDateBykey: function (key) {
        var user = null;
        for (var i = 0; i < this.data.length; i++) {
            if (this.data[i].key == key) {
                user = this.data[i];
            }
        }

        return user;
    },
    setUsers: function (data) {
        this.data = data;
    },
    getUsers: function () {
        return this.data;
    }
}