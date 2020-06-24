<?php

namespace Newfootprintedu\Controller;

use Think\Controller;
use PHPExcel_IOFactory;
use PHPExcel;

/**
 * @controller 默认页
 * Class ApiController
 * @package Newfootprintedu\Controller
 */
class ApiController extends Controller {

    public function testAction(){
        echo "success";
    }

    public function _initialize() {
        $this->fmtPost();
    }

    /*
     *  用code换取小程序openid
     *  参数：code
     * */
    public function getOpenidAction() {

        $code = $this->params['code'];

        if (empty($code)){
            $rst['code'] = 201; //code为空
            $this->ajaxReturn($rst);
        }else{
            $keyUrl = $this->urlPrepare(C('JS_CODE_2_SESSION'), array('CODE' => $code));
            $keyRst = $this -> ReqGet($keyUrl);
      //      dump($keyUrl);
            $keyRst = json_decode($keyRst);
            $openid = $keyRst->openid;
            $unionid = $keyRst->unionid;
            $session_key = $keyRst->session_key;

            $map2['user_open_id'] = $openid;
            $find = M('user_session_key') -> where($map2) ->find();
            if(empty($find)){
                $add['user_open_id'] = $openid;
                $add['user_session_key'] = $session_key;
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                M('user_session_key') -> add($add);
            }else{
                $save['user_session_key'] = $session_key;
                $save['update_time'] = time();
                M('user_session_key') ->where($map2)-> save($save);
            }

            $map['del_flg'] = 0;
            $map['user_mini_open_id'] = $openid;
            $find = M('user_info')->where($map)->find();
            if(!empty($find)){
                $rst['code'] = 300;//原有用户
                $rst['user_mini_open_id'] = $openid;
                $rst['user_union_id'] = $unionid;
                $this->ajaxReturn($rst);
            }else{
                $rst['code'] = 200;//新用户
                $rst['user_mini_open_id'] = $openid;
                $rst['user_union_id'] = $unionid;

                //插入用户数据
                $add['user_mini_open_id'] = $openid;
                $add['user_union_id'] = $unionid;
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                M('user_info')->where($map)->add($add);

                $this->ajaxReturn($rst);
            }

        }
    }

    /*
         * 获取用户手机的信息
         * */
    public function getMobileAction() {

        Vendor('OpenWx.wxBizDataCrypt');
        $openid = $this->params['user_open_id'];
        if (empty($openid) || !$openid) {
            die();
        }

        $rst['code'] = 300;
        $encryptedData = $this->params['ed'];
        $iv = $this->params['iv'];

        $map['user_open_id'] = $openid;
        $find = M('user_session_key') -> where($map) ->find();
        $sessionKey =$find['user_session_key'];

        $pc = new \WXBizDataCrypt(C('APP_ID'), $sessionKey);
        //   $data ="";
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        if ($errCode == 0) {
            $userinfo = json_decode($data, true);
       //     dump($userinfo);
            $rst['user_mini_mobile'] = $userinfo['phoneNumber'];
            $map['user_mini_open_id'] = $openid;
            $map['del_flg'] = 0;
            $db = M('user_info');

            $find = $db->where($map)->find();
            if(!empty($find)){
                //插入用户数据
                $map2['user_mini_open_id'] = $openid;
                $save['user_mini_mobile'] = $userinfo['phoneNumber'];
                $save['update_time'] = time();
                $db->where($map2)->save($save);
            }else{
                //插入用户数据
                $add['user_mini_open_id'] = $openid;
                $add['user_mini_mobile'] = $userinfo['phoneNumber'];
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                $db->where($map)->add($add);
            }
            $rst['code'] = 200;
        }
        $this->ajaxReturn($rst);

    }

    /*
         * 获取用户unionid的信息
         * */
    public function getUnionIdAction() {

        Vendor('OpenWx.wxBizDataCrypt');
        $openid = $this->params['user_open_id'];
        if (empty($openid) || !$openid) {
            die();
        }

        $rst['code'] = 300;
        $encryptedData = $this->params['ed'];
        $iv = $this->params['iv'];

        $map['user_open_id'] = $openid;
        $find = M('user_session_key') -> where($map) ->find();
        $sessionKey =$find['user_session_key'];

        $pc = new \WXBizDataCrypt(C('APP_ID'), $sessionKey);
        //   $data ="";
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        if ($errCode == 0) {
            $userinfo = json_decode($data, true);
            //     dump($userinfo);
            $rst['user_union_id'] = $userinfo['unionId'];
            $map['user_mini_open_id'] = $openid;
            $map['del_flg'] = 0;
            $db = M('user_info');

            $find = $db->where($map)->find();
            if(!empty($find)){
                //插入用户数据
                $map2['user_mini_open_id'] = $openid;
                $save['user_union_id'] = $userinfo['unionId'];
                $save['update_time'] = time();
                $db->where($map2)->save($save);
            }else{
                //插入用户数据
                $add['user_mini_open_id'] = $openid;
                $add['user_union_id'] = $userinfo['unionId'];
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                $db->where($map)->add($add);
            }
            $rst['code'] = 200;
        }
        $this->ajaxReturn($rst);

    }

    /*
     * 提交学员信息
     * */
    public function submitUserInfoAction() {

        $map2['user_mini_open_id'] = $this->params['user_open_id'];
        $save['user_mobile'] =  $this->params['user_mobile'];
        $save['form_id'] =  "MINI001";
        $save['user_name'] =  $this->params['user_name'];
        $save['user_relation'] =  $this->params['user_relation'];
        $save['user_gender'] =  $this->params['user_gender'];
        $save['user_grade'] =  $this->params['user_grade'];
        $save['user_school'] =  $this->params['user_school'];
        $save['is_submit'] = 1;
        $save['submit_time'] = time();
        $save['create_time'] = time();
        $save['update_time'] = time();
        $save['del_flg'] = 0;
        M('user_info')->where($map2)->save($save);

        if(!empty($this->params['booking_date'])){
            $add['user_mini_open_id'] = $this->params['user_open_id'];
            $add['booking_date'] = $this->params['booking_date'];
            $add['booking_time'] = $this->params['booking_time'];
            $add['create_time'] = time();
            $add['update_time'] = time();
            $add['del_flg'] = 0;
            M('evaluation_booking')->add($add);
        }

        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }


    /*
     * 确认用户状态
     * */
    public function checkUserStatusAction() {

        $map2['user_mini_open_id'] = $this->params['user_open_id'];
        $map2['del_flg'] = 0;
        $find = M('user_info') -> where($map2) -> find();

        if(empty($find)){
            $rst['code'] = 201;  //新用户
            $rst['status'] = 1;  //状态为1
            $this->ajaxReturn($rst);
        }else{
            if($find['is_submit'] == 0){
                $rst['code'] = 202;  //未填写信息的用户
                $rst['status'] = 1;  //状态为1
                $this->ajaxReturn($rst);
            }else{
                     $find2 = M('evaluation_booking') -> where($map2)->order('id desc') ->find();
                     if(empty($find2)){
                         $rst['code'] = 203;  //未预约过客户、有信息
                         $rst['userInfo'] = $find;
                         $rst['status'] = 2;  //状态为2
                         $this->ajaxReturn($rst);
                     }else{
                        if(time()-$find['update_time'] > 15552000){
                            $rst['code'] = 204;  //上次预约超过180天的客户、有信息
                            $rst['status'] = 1;  //状态为1
                            $this->ajaxReturn($rst);
                        }else{
                            $rst['code'] = 205;  //预约过客户、有信息
                            $rst['status'] = 3;  //状态为3
                            $rst['userInfo'] = $find;
                            $this->ajaxReturn($rst);
                        }
                     }
            }

        }


        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    //获取客户信息下拉框内容
    public function getDropDownInfoAction() {
        $map['del_flg'] = 0;
        $map['is_submit'] = 1;
        $rst['channelList'] =  M('channel_info') ->distinct(true)-> where($map) -> getField('channel_name',true);
        $rst['activityList'] =  M('activity_info') ->distinct(true)-> where($map) -> getField('activity_name',true);
        $rst['formList'] =  M('user_info') ->distinct(true)-> where($map) -> getField('form_id',true);
        $rst['gradeList'] =  M('user_info') ->distinct(true)-> where($map) -> getField('user_grade',true);
        $rst['schoolList'] =  M('user_info') ->distinct(true)-> where($map) -> getField('user_school',true);
        $rst['relationList'] =  M('user_info') ->distinct(true)-> where($map) -> getField('user_relation',true);
        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    //获取筛选后客户信息
    public function getUserInfoByFiltAction(){
        //删除标志为0
        $map['del_flg'] = 0;
        $map['is_submit'] = 1;

        //  推广员工只能看到自己的数据
        if($_SESSION['groupName'] == "推广员工"){
            $clientMap['from_sales_id'] = $_SESSION['user']['id'];
            $clientMap['del_flg'] = 0;
            $clientList = M('user_subscribe')->where($clientMap)->getField('user_union_id',true);
            if(!empty($clientList)){
                $map['user_union_id'] = array('in',$clientList);
            }else{
                $map['user_union_id'] = "xx";
            }
        }

        //传入的筛选项
        $reg_start_time = strtotime($this->params['reg_start_time']);
        $reg_end_time = strtotime($this->params['reg_end_time']);
        $book_start_time = strtotime($this->params['book_start_time']);
        $book_end_time = strtotime($this->params['book_end_time']);
        $user_name = $this->params['user_name'];
        $user_gender = $this->params['user_gender'];
        $user_mobile = $this->params['user_mobile'];

        $channelList = $this->params['channel_name'];
        $activityList = $this->params['activity_name'];
        $formList = $this->params['form_id'];
        $gradeList = $this->params['user_grade'];
        $schoolList = $this->params['user_school'];
        $relationList = $this->params['user_relation'];

        if(!empty($channelList))
            $channelList = explode(",",$this->params['channel_name']) ;
        if(!empty($activityList))
            $activityList = explode(",",$this->params['activity_name']) ;
        if(!empty($formList))
            $formList = explode(",",$this->params['form_id']) ;
        if(!empty($gradeList))
            $gradeList = explode(",",$this->params['user_grade']) ;
        if(!empty($schoolList))
            $schoolList = explode(",",$this->params['user_school']) ;
        if(!empty($relationList))
            $relationList = explode(",",$this->params['user_relation']) ;

//        if(!empty($reg_start_time))
//            $map['submit_time'] = array('between',$reg_start_time);
//        if(!empty($reg_end_time))
//            $map['submit_time'] = array('lt',$reg_end_time);
        if(!empty($reg_start_time))
            $map['submit_time'] = array(array('gt',$reg_start_time),array('lt',$reg_end_time+86400));
        if(!empty($formList))
            $map['form_id'] = array('in',$formList);
        if(!empty($user_name))
            $map['user_name'] = array('like',"%$user_name%");
        if(!empty($user_gender))
            $map['user_gender'] = $user_gender;
        if(!empty($gradeList))
            $map['user_grade'] = array('in',$gradeList);
        if(!empty($schoolList))
            $map['user_school'] = array('in',$schoolList);
        if(!empty($user_mobile))
            $map['user_mobile'] = $user_mobile;
        if(!empty($relationList))
            $map['user_relation'] = array('in',$relationList);

        $Model = M('user_info');
        $list = $Model->where($map)->order('id desc')->select();

        foreach ($list as $k=>$v){
            //获取是否重复、预约时间
            $map2['user_mini_open_id'] = $v['user_mini_open_id'];
            $map2['del_flg'] = 0;
            $find2 = M('evaluation_booking') -> where($map2)->order('id desc') ->select();
            if(count($find2) == 0){
                $list[$k]['booking_time'] = "-";
                $list[$k]['is_repeat'] = '否';
            }else if(count($find2) > 1){
                $list[$k]['booking_time'] = $find2[0]['booking_date']." ".$find2[0]['booking_time'];
                $list[$k]['book_time'] = strtotime($find2[0]['booking_date']) ;
                $list[$k]['is_repeat'] = '是';
            }else{
                $list[$k]['booking_time'] = $find2[0]['booking_date']." ".$find2[0]['booking_time'];
                $list[$k]['book_time'] = strtotime($find2[0]['booking_date']) ;
                $list[$k]['is_repeat'] = '否';
            }
            $list[$k]['submit_date'] = date('Y-m-d',$v['submit_time']);
            //获取其它信息
            $map3['user_union_id'] =  $v['user_union_id'];
            $map3['del_flg'] = 0;

            if(!empty($channelList))
                $map3['channel_name'] = array('in',$channelList);
            if(!empty($activityList))
                $map3['activity_name'] = array('in',$activityList);

            $find3 = M('v_subscribe_info')->where($map3)->find();
          //  dump($map3['user_union_id']);
          //  dump($find3['activity_name']);
            $list[$k]['channel_name'] = $find3['channel_name'];
            $list[$k]['activity_name'] = $find3['activity_name'];
            $list[$k]['sales_name'] = $find3['nickname'];
            $list[$k]['area_name'] = $find3['area_name'];
            $list[$k]['store_name'] = $find3['store_name'];
        }


        if(!empty($book_start_time)){
            //预定开始时间
            $newList = array();
            $i = 0;
            foreach ($list as $key =>$value){
                if(!empty($value['book_time'])){
                    if($book_start_time <= $value['book_time']){
                        $newList[$i] = $list[$key];
                        $i = $i+1;
                    }
                }
            }
            if(!empty($newList)){
                $list = $newList;
            }else{
                $list = array();
            }
        }



        if(!empty($book_end_time)){

            //预定结束时间
            $newList = array();
            $i = 0;
            foreach ($list as $key =>$value){
                if(!empty($value['book_time'])){
                    if($book_end_time+86400 >= $value['book_time']){
                        $newList[$i] = $list[$key];
                        $i = $i+1;
                    }
                }
            }
            if(!empty($newList)){
                $list = $newList;
            }else{
                $list = array();
            }
        }



        if(!empty($channelList)){
            //channelList
            $newList = array();
            $i = 0;
            foreach ($list as $key =>$value){
                if(!empty($value['channel_name'])){
                    $newList[$i] = $list[$key];
                    $i = $i+1;
                }
            }
            if(!empty($newList)){
                $list = $newList;
            }else{
                $list = array();
            }
        }



        if(!empty($activityList)){

            //activityList
            $newList = array();
            $i = 0;
            foreach ($list as $key =>$value){

                if(!empty($value['activity_name'])){

                    $newList[$i] = $list[$key];
                    $i = $i+1;
                }
            }
            if(!empty($newList)){
                $list = $newList;
            }else{
                $list = array();
            }
        }



        // report sessiondata
        // Session配置
        session('excelData', $list);
        foreach ($list as $key=>$value){
            if(empty($value['sales_name']))
                $list[$key]['sales_name'] = "-";
            if(empty($value['area_name']))
                $list[$key]['area_name'] = "-";
            if(empty($value['store_name']))
                $list[$key]['store_name'] = "-";
            if(empty($value['channel_name']))
                $list[$key]['channel_name'] = "-";
            if(empty($value['activity_name']))
                $list[$key]['activity_name'] = "-";
        }
        $rst['code'] = 200;
        $rst['user_info'] = $list;
        $this->ajaxReturn($rst);


    }

    /**
     *
     *  导出报表
     */
    public function exportExcelForUserInfoAction() {

        //导出
        vendor("PHPExcel.PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.Writer.IWriter");
        vendor("PHPExcel.PHPExcel.Writer.Abstract");
        vendor("PHPExcel.PHPExcel.Writer.Excel5");
        vendor("PHPExcel.PHPExcel.Writer.Excel2007");
        vendor("PHPExcel.PHPExcel.IOFactory");
        vendor("PHPExcel.PHPExcel.Cell.DataType");
        $objPHPExcel = new \PHPExcel();
        $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);


        // 实例化完了之后就先把数据库里面的数据查出来
        $sql = $_SESSION['excelData'];

        $letter = [
            'A','B','C','D','E','F','G','H','I','J','K','L','M',
            'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
            'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
        ];

        // 设置表头信息
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '学员姓名')
            ->setCellValue('C1', '联系电话')
            ->setCellValue('D1', '所属关系')
            ->setCellValue('E1', '学员性别')
            ->setCellValue('F1', '注册时间')
//            ->setCellValue('F1', '是否重复')
//            ->setCellValue('G1', '表单编号')
            ->setCellValue('G1', '活动渠道')
            ->setCellValue('H1', '活动名称')
      //      ->setCellValue('J1', 'openid')
            ->setCellValue('I1', '预约时间')
            ->setCellValue('J1', '学员年级')
            ->setCellValue('K1', '学员学校')
            ->setCellValue('L1', '评级')
            ->setCellValue('M1', '备注')
            ->setCellValue('N1', '员工姓名')
            ->setCellValue('O1', '所在地区')
            ->setCellValue('P1', '所属门店');


        $obj_color = "63B8FF" ;
        $objPHPExcel->getActiveSheet()->getStyle("A1:P1")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($obj_color);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);#设置单元格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);#设置单元格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);#设置单元格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);#设置单元格宽度
        /*--------------开始从数据库提取信息插入Excel表中------------------*/
        $i=2;
        $count = count($sql);  //计算有多少条数据
        for ($i = 2; $i <= $count+1; $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $sql[$i-2]['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $sql[$i-2]['user_name']);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $i, " ".$sql[$i-2]['user_mobile'],"s");
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $sql[$i-2]['user_relation']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $sql[$i-2]['user_gender']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $sql[$i-2]['submit_date']);
//            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $sql[$i-2]['is_repeat']);
//            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $sql[$i-2]['form_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $sql[$i-2]['channel_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $sql[$i-2]['activity_name']);
    //        $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $sql[$i-2]['user_union_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $sql[$i-2]['booking_time']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $sql[$i-2]['user_grade']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $sql[$i-2]['user_school']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $sql[$i-2]['user_rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $sql[$i-2]['remark']);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $sql[$i-2]['sales_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $sql[$i-2]['area_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $sql[$i-2]['store_name']);


        }



        /*--------------下面是设置其他信息------------------*/
        ob_end_clean();

        ob_start();
        $objPHPExcel->getActiveSheet()->setTitle('客户信息');      //设置sheet的名称
        $objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
        //     $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来

        $PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");

        $filename = "ClientInfo_".date('YmdHis').".xlsx";
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Cache-Control: max-age=0');


        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
exit;
        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    /**
     *
     *  导出报表
     */
    public function exportExcelForUserInfo2Action() {

        //导出
        vendor("PHPExcel.PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.Writer.IWriter");
        vendor("PHPExcel.PHPExcel.Writer.Abstract");
        vendor("PHPExcel.PHPExcel.Writer.Excel5");
        vendor("PHPExcel.PHPExcel.Writer.Excel2007");
        vendor("PHPExcel.PHPExcel.IOFactory");
        vendor("PHPExcel.PHPExcel.Cell.DataType");

        /*读取excel文件，并进行相应处理*/
        $fileName = getcwd()."/Public/upload/excel/template.xlsx";

        if (!file_exists($fileName)) {
            exit("文件".$fileName."不存在");
        }

        $objPHPExcel = PHPExcel_IOFactory::load($fileName);
        //默认选中sheet0表
        $sheetSelected = 0;$objPHPExcel->setActiveSheetIndex($sheetSelected);

        // 实例化完了之后就先把数据库里面的数据查出来
        $sql = $_SESSION['excelData'];

        /*--------------开始从数据库提取信息插入Excel表中------------------*/
        $count = count($sql);  //计算有多少条数据
        for ($i = 6; $i <= $count+5; $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $sql[$i-6]['user_name']);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $i, " ".$sql[$i-6]['user_mobile'],"s");
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $sql[$i-6]['user_relation']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $sql[$i-6]['user_gender']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, "来电");
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, "?");

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $sql[$i-6]['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $sql[$i-6]['user_name']);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('C' . $i, " ".$sql[$i-2]['user_mobile'],"s");
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $sql[$i-6]['user_relation']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $sql[$i-6]['user_gender']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $sql[$i-6]['is_repeat']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $sql[$i-6]['form_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $sql[$i-6]['channel_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $sql[$i-6]['activity_name']);
          //  $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $sql[$i-6]['user_union_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $sql[$i-6]['booking_time']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $sql[$i-6]['user_grade']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $sql[$i-2]['user_school']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $sql[$i-2]['user_rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $sql[$i-2]['remark']);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $sql[$i-2]['sales_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $sql[$i-2]['area_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $sql[$i-2]['store_name']);


        }



        /*--------------下面是设置其他信息------------------*/
        ob_end_clean();

        ob_start();
        $objPHPExcel->getActiveSheet()->setTitle('客户信息');      //设置sheet的名称
        $objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
        //     $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来

        $PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");

        $filename = "ClientInfo_".date('YmdHis').".xlsx";
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Cache-Control: max-age=0');


        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
        exit;
        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    //更新rate
    public function updateUserRateAction() {
        $map['id'] = $this->params['id'];
        $save['user_rate'] = $this->params['user_rate'];
        M('user_info')->where($map)->save($save);
        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    //更新Remark
    public function updateUserRemarkAction() {
        $map['id'] = $this->params['id'];
        $save['remark'] = $this->params['remark'];
        M('user_info')->where($map)->save($save);
        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    /*
     * 获取参数二维码
     * */
    public function getQrCodeAction($activity_id){
        Vendor('phpqrcode.phpqrcode');

        $msgdata = "activity_id=".$activity_id;


        //拿token
        $access_token = $this->GetAccessToken();


        //生成二维码
        $newUrl="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;

        $row_2 = array('scene_str' => "$msgdata");
        $row_1 = array('scene' => $row_2);
        $row = array( "action_name"=> "QR_LIMIT_STR_SCENE","action_info" => $row_1);
        $qr_data = json_encode($row);
        $data2 = $this->ReqPost($newUrl,$qr_data);
        $data2 = json_decode($data2,true);
        $qrurl=$data2["url"];


//        //显示二维码
//        $qrTicket=$data2["ticket"];
//        $qrImgUrl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$qrTicket;

        $errorCorrectionLevel = 'L';//容错级别
        $matrixPointSize = 6;//生成图片大小
        $qr_name = time().rand(1000);

        $filepath = getcwd().'/Public/upload/qrcode/'.$qr_name.'.png';
        $qrcode = new \QRcode();
        $qrcode->png($qrurl, $filepath, $errorCorrectionLevel, $matrixPointSize, 2);

        //保存图片路径到数据库
        $map['id'] = $activity_id;
        M('activity_info')->where($map)->setField('qr_url','https://www.curioo.com.cn/Public/upload/qrcode/'.$qr_name.'.png');
        $rst['code'] = 200;
        $this->ajaxReturn($rst);

    }

    /*
     * 获取参数二维码
     * */
    public function updateUserQrcodeAction(){
        Vendor('phpqrcode.phpqrcode');
        $activity_id = I('post.activity_id');
        $sales_id = I('post.sales_id');
        $msgdata = "activity_id=".$activity_id."|sales_id=".$sales_id;


        //拿token
        $access_token = $this->GetAccessToken();


        //生成二维码
        $newUrl="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;

        $row_2 = array('scene_str' => "$msgdata");
        $row_1 = array('scene' => $row_2);
        $row = array( "action_name"=> "QR_LIMIT_STR_SCENE","action_info" => $row_1);
        $qr_data = json_encode($row);
        $data2 = $this->ReqPost($newUrl,$qr_data);
        $data2 = json_decode($data2,true);
        $qrurl=$data2["url"];


//        //显示二维码
//        $qrTicket=$data2["ticket"];
//        $qrImgUrl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$qrTicket;

        $errorCorrectionLevel = 'L';//容错级别
        $matrixPointSize = 6;//生成图片大小
        $qr_name = time().rand(1000);

        $filepath = getcwd().'/Public/upload/qrcode/'.$qr_name.'.png';
        $qrcode = new \QRcode();
        $qrcode->png($qrurl, $filepath, $errorCorrectionLevel, $matrixPointSize, 2);

        //保存图片路径到数据库
        $map['id'] = $sales_id;
        $save['qr_url'] = 'https://www.curioo.com.cn/Public/upload/qrcode/'.$qr_name.'.png';
        $map2['id'] = $activity_id;
        $find = M('activity_info')->where($map2)->find();
        $save['activity_id'] = $find['channel_name']." ".$find['activity_name'];;
        M('user')->where($map)->save($save);
        $rst['code'] = 200;
        $this->ajaxReturn($rst);

    }

    //第三方微信平台
    public function getFeedbackAction(){
        Vendor('wxThird.wxBizMsgCrypt');

//以下三个变量，自己去开放平台上管理中心根据实际情况填写。
        $encodingAesKey = "CuriookidsWechat123456789012345678901234567";
        $token = "CuriookidsWechat";
        $appId = "wx06020ae02016d2dd";

        $timeStamp  = empty($_GET['timestamp'])     ? ""    : trim($_GET['timestamp']) ;
        $nonce      = empty($_GET['nonce'])     ? ""    : trim($_GET['nonce']) ;
        $msg_sign   = empty($_GET['msg_signature']) ? ""    : trim($_GET['msg_signature']) ;
        $encryptMsg = file_get_contents('php://input');
        $pc = new \WXBizMsgCrypt($token, $encodingAesKey, $appId);

        $xml_tree = new \DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $encrypt = $array_e->item(0)->nodeValue;


        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);
        $this-> logResult('/form.log', $from_xml);
// 第三方收到公众号平台发送的消息
        $msg = '';



        $errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);

        if ($errCode == 0) {
            //print("解密后: " . $msg . "\n");
            $xml = new \DOMDocument();
            $xml->loadXML($msg);
            $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
            $component_verify_ticket = $array_e->item(0)->nodeValue;
            file_put_contents(LOGPATH.'/ticket.log', $component_verify_ticket);
            $this->logResult('/msgmsg.log','解密后的component_verify_ticket是：'.$component_verify_ticket);
            $add['component_verify_ticket'] = $component_verify_ticket;
            M('thirdwx_verify')->where('id=1')->save($add);
           // mysql_query("update web_map set bei='$component_verify_ticket' where Id=4");//把获取到的component_verify_ticket存入数据库

            echo 'success';

        } else {
            $this->logResult('/error.log','解密后失败：'.$errCode);
            print($errCode . "\n");
        }

        die();
    }

    //第三方平台接收信息
    public function getFeedback2Action(){
        Vendor('wxThird.wxBizMsgCrypt');
        //encodingAesKey和token均为申请三方平台是所填写的内容
        $encodingAesKey = "CuriookidsWechat123456789012345678901234567";
        $token = "CuriookidsWechat";
        $appId = "wx06020ae02016d2dd";


        $timeStamp  = empty($_GET['timestamp'])     ? ""    : trim($_GET['timestamp']) ;
        $nonce      = empty($_GET['nonce'])     ? ""    : trim($_GET['nonce']) ;
        $msg_sign   = empty($_GET['msg_signature']) ? ""    : trim($_GET['msg_signature']) ;
        $encryptMsg = file_get_contents('php://input');
        $pc = new \WXBizMsgCrypt($token, $encodingAesKey, $appId);

        $xml_tree = new \DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $encrypt = $array_e->item(0)->nodeValue;


        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);
        $this-> logResult('/form.log', $from_xml);
// 第三方收到公众号平台发送的消息
        $msg = '';



        $errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);

        if($errCode == 0){
            $postObj =simplexml_load_string($msg,'SimpleXMLElement',LIBXML_NOCDATA);

        if (strtolower($postObj -> MsgType) == 'event'){
            //如果是关注subscribe事件
            if(strtolower($postObj->Event) == 'subscribe'){
                $user_open_id = strval($postObj->FromUserName);
                $event_key = strval($postObj->EventKey);
                $map['del_flg'] = 0;
                $map['user_open_id'] = $user_open_id;
                $find = M('user_subscribe')->where($map)->find();
                if(empty($find)){
                    if(!empty($event_key)){
                        $keyList = explode("|",$event_key);
                        $add['from_activity_id'] = explode("=",$keyList[0])[1];
                        if(!empty($keyList[1])){
                            $add['from_sales_id'] = explode("=",$keyList[1])[1];
                        }
                    }

                    $userList = $this->GetUserWxInfo($user_open_id);

                    $add['user_open_id'] = $userList['openid'];
                    $add['user_union_id'] = $userList['unionid'];
                    $add['user_headimg'] = $userList['headimgurl'];
                    $add['user_nickname'] = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $userList['nickname']);

                    M('user_subscribe')->add($add);
                }else{
                    $needUpdate = $this->NeedUpdateSubScribe($user_open_id);
                    if($needUpdate == 1){
                        $map2['id'] = $find['id'];
                        if(!empty($event_key)){
                            $keyList = explode("|",$event_key);
                            $save['from_activity_id'] = explode("=",$keyList[0])[1];
                            if(!empty($keyList[1])){
                                $save['from_sales_id'] = explode("=",$keyList[1])[1];
                            }
                        }
                        M('user_subscribe')->where($map2)->save($save);
                    }
                }

//                $content ="关注成功！！！！！！";
//               $this-> responseText($postObj,$content);
                //回复用户消息
                $this->responseUrl($postObj);

            }

            if(strtolower($postObj->Event) == 'scan'){
                $user_open_id = strval($postObj->FromUserName);
                $event_key = strval($postObj->EventKey);
                $map['del_flg'] = 0;
                $map['user_open_id'] = $user_open_id;
                $find = M('user_subscribe')->where($map)->find();
                $needUpdate = $this->NeedUpdateSubScribe($user_open_id);
                if($needUpdate == 1){
                    $map2['id'] = $find['id'];
                    if(!empty($event_key)){
                        $keyList = explode("|",$event_key);
                        $save['from_activity_id'] = explode("=",$keyList[0])[1];
                        if(!empty($keyList[1])){
                            $save['from_sales_id'] = explode("=",$keyList[1])[1];
                        }
                    }
                    M('user_subscribe')->where($map2)->save($save);
                }
                //回复用户消息
                $this->responseUrl($postObj);

//                $content ="关注成功！！！！！！";
//                $this-> responseText($postObj,$content);
            }
        }

            if(strtolower($postObj -> MsgType) == 'text' &&trim($postObj->Content)=='图文'){
                $content ="关注成功！！！！！！";
                $this-> responseText($postObj,$content);
            }


        }
    }

    //判断是否需要更新关注关联信息
    private function NeedUpdateSubScribe($user_open_id){
        $userList = $this->GetUserWxInfo($user_open_id);
        $user_union_id = $userList['unionid'];
        $map['del_flg'] = 0;
        $map['user_union_id'] = $user_union_id;
        $find = M('user_info')->where($map)->find();
        if(empty($find)){
            $needUpdate = 1;
        }else{
            if(time()-$find['update_time'] > 15552000){
                $needUpdate = 1;
            }else{
                $needUpdate = 0;
            }
        }
        return $needUpdate;
    }

    private function GetUserWxInfo($fromUsername){

        $access_token = $this->GetAccessToken();
        $newUrl="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$fromUsername";

        $data = null;
        $url2 = $newUrl;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        $result2 = $output;
        $jsoninfo2 = json_decode($result2, true);

        return $jsoninfo2;
    }

    private function responseNews($postObj,$arr){
        $toUser     = $postObj -> FromUserName;
        $fromUser   = $postObj -> ToUserName;
        $template  ="<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <ArticleCount>".count($arr)."</ArticleCount>
            <Articles>";
        foreach($arr as $k=>$v){
            $template.="<item>
            <Title><![CDATA[".$v['title']."]]></Title>
            <Description><![CDATA[".$v['description']."]]></Description>
            <PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>
            <Url><![CDATA[".$v['url']."]]></Url>
            </item>";
        }
        $template.="</Articles>
            </xml>";
        $time     = time();
        $msgType  = 'news';
        $res =sprintf($template,$toUser,$fromUser,$time,$msgType);
        $encodingAesKey = '公众号消息加解密Key';
        $token ='公众号消息校验Token';
        $appId = '三方平台appid';
        $pc = new \WXBizMsgCrypt ($token, $encodingAesKey, $appId );
        $encryptMsg = '';
        $errCode =$pc->encryptMsg($res,$_GET ['timestamp'], $_GET ['nonce'], $encryptMsg);
        if($errCode ==0){
            $res = $encryptMsg;
        }
        echo $res;
    }

    private function responseText($postObj,$content){
        $template ="<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>";
        $fromUser = $postObj ->ToUserName;
        $toUser   = $postObj -> FromUserName;
        $time     = time();
        $msgType  = 'text';
        $res =sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
        $encodingAesKey = "CuriookidsWechat123456789012345678901234567";
        $token = "CuriookidsWechat";
        $appId = "wx06020ae02016d2dd";
        $pc = new \WXBizMsgCrypt ($token, $encodingAesKey, $appId );
        $encryptMsg = '';
        $errCode =$pc->encryptMsg($res,$_GET ['timestamp'], $_GET ['nonce'], $encryptMsg);
        if($errCode ==0){
            $res = $encryptMsg;
        }
        echo $res;
    }

    private function responseUrl($postObj){
        Vendor('wxThird.wxBizMsgCrypt');
        $accesstoken =$this->GetAccessToken();
        $data['touser'] = strval($postObj->FromUserName);
        $data['msgtype'] = "miniprogrampage";
        $text = array();
        $text['title'] = "Curiookids";
        $text['appid'] = "wx383f7822c4bc1067";
        $text['pagepath'] = "pages/index?activity_id=3&sales_id=2";
        $text['thumb_media_id'] = "-53x8aDZucsyFosmNlrkuwUJTObC7Fo7LbosT1ZJSv4";
        $data['miniprogrampage'] = $text;
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$accesstoken";

        $returnData = $this->ReqPost($url,json_encode($data));
//        $returnData = json_decode($returnData);
//        $save['user_source'] = json_encode($data);
//        M('user_subscribe')->add($save);
       // dump($returnData);
        echo "success";
        exit;

    }

    private function https_request($url ='' , $path = '') {
        $curl = curl_init();
        if (class_exists('\CURLFile')){
            curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
            $data = array('media' => new \CURLFile($path));//
        }
        else
        {
            curl_setopt($curl,CURLOPT_SAFE_UPLOAD,false);
            $data = array('media'=>'@'.$path);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1 );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT,"TEST");
        $result = curl_exec($curl);
        dump(json_decode($result,true));
        if($result === false) {
            echo "error:".curl_errno($curl);
            exit;
        }
        $res=json_decode($result,true);
        return $res;
    }

    public function responseUrlAction(){


//        Vendor('wxThird.wxBizMsgCrypt');
//        $accesstoken =$this->GetAccessToken();
//        $data['touser'] = "o6P7Dwlv0TUDt-h3N1juQ1Y5bfyI";
//        $data['msgtype'] = "miniprogrampage";
//        $text = array();
//        $text['title'] = "Curiookids";
//        $text['appid'] = "wx383f7822c4bc1067";
//        $text['pagepath'] = "pages/index?activity_id=3&sales_id=2";
//        $text['thumb_media_id'] = "XQkce9H_Bx6tyWCHqG9KbdDQAm7RUunPiji0R4h4GbUECSp9WQaMCnfK_qzCqo1e";
//        $data['miniprogrampage'] = $text;
//        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$accesstoken";
//
//        $returnData = $this->ReqPost($url,json_encode($data));
////        $returnData = json_decode($returnData);
////        $save['user_source'] = json_encode($data);
////        M('user_subscribe')->add($save);
//         dump($returnData);
//        echo "success";
//        exit;


        $access_token=$this->GetAccessToken();
        $type = "image";
        $filepath = '/data/wwwroot/www.curioo.com.cn/Public/upload/qrcode/curiookids.png';
        $filedata = array (
            "media" =>$filepath
        );
        $url = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token.'&type='.$type;
        $result=$this->https_request($url,$filepath);
        dump($result);
        return $result;
exit;
    }


    //第三方微信平台授权
    public function getAuthAction(){
        $returnData = $this->GetAuthCode();
        $component_access_token = $returnData['api_component_token'];
        $authorization_code = $returnData['pre_auth_code'];
//        $auth_url = "https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token=$component_access_token";
//        $data['component_appid'] = "wx06020ae02016d2dd";
//        $data['authorization_code'] = $authorization_code;
//        $rst = $this->ReqPost($auth_url,json_encode($data));
//        dump($rst);
        $uri = "https://www.curioo.com.cn/Public/about.html";
        $auth_url = "https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid=wx06020ae02016d2dd&pre_auth_code=$authorization_code&redirect_uri=$uri";
        dump($auth_url);
        Header("Location: $auth_url");

    }

    //第三方微信平台授权信息
    public function getAuthInfoAction(){
        $save['remark'] = $_POST;
        M('thirdwx_verify')->where('id=1')->save($save);
    }

    //获取pre_auth_code
    private function GetAuthCode(){

        $expires_time = M('thirdwx_verify')->where('id=1')->getField('expires_time');
        if($expires_time - time() < 0){
            $data['component_appid'] = "wx06020ae02016d2dd";
            $data['component_appsecret'] = "0cc44f04d9545205924044a29c3e6517";
            $data['component_verify_ticket'] = M('thirdwx_verify') ->order('id desc')->getField('component_verify_ticket');
            $url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";

            $returnData = $this->ReqPost($url,json_encode($data));
            $returnData = json_decode($returnData);
            $save['api_component_token'] = $returnData->component_access_token;
            $save['expires_time'] = time() + 6000;
            M('thirdwx_verify')->where('id=1')->save($save);

            $api_component_token =  M('thirdwx_verify')->where('id=1')->getField('api_component_token');
            $url2 = "https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token=$api_component_token";
            $data2['component_appid'] = "wx06020ae02016d2dd";
            $returnData2 = $this->ReqPost($url2,json_encode($data2));
            $returnData2 = json_decode($returnData2);
            $save2['pre_auth_code'] = $returnData2->pre_auth_code;
            M('thirdwx_verify')->where('id=1')->save($save2);

        }
        $rst['api_component_token'] = M('thirdwx_verify')->where('id=1')->getField('api_component_token');
        $rst['pre_auth_code'] = M('thirdwx_verify')->where('id=1')->getField('pre_auth_code');
        return $rst;
    }


    private function logResult($path,$data){
        file_put_contents(LOGPATH.$path, '['.date('Y-m-d : h:i:sa',time()).']'.$data."\r\n",FILE_APPEND);
    }

    //获取AccessToken
    private function GetAccessToken(){
        $map['appid'] = C('WX_APP_ID');
        $find = M('admin_access_token') -> where($map) -> find();
        if(empty($find)){
            //没有数据
            $access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".C('WX_APP_ID')."&secret=".C('WX_APP_SECRET');
            $keyRst = $this -> ReqGet($access_url);
            $keyRst = json_decode($keyRst);
            $access_token = $keyRst->access_token;

            $add['appid'] = C('WX_APP_ID');
            $add['access_token'] = $access_token;
            $add['update_time'] = date('Y-m-d H:i:s');
            $add['expire_time'] = time() + 5000;
            M('admin_access_token') -> add($add);
            return $access_token;
        }else{
            $nowTime = time();
            if($find['expire_time'] < $nowTime){
                //过期了
                $access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".C('WX_APP_ID')."&secret=".C('WX_APP_SECRET');
                $keyRst = $this -> ReqGet($access_url);
                $keyRst = json_decode($keyRst);
                $access_token = $keyRst->access_token;

                $save['access_token'] = $access_token;
                $save['update_time'] = date('Y-m-d H:i:s');
                $save['expire_time'] = time() + 5000;
                M('admin_access_token') -> where($map) -> save($save);
                return $access_token;
            }else{
                return $find['access_token'];
            }
        }
    }

    /**
     * 接受小程序post过来的数据
     * @return mixed
     */
    private function fmtPost() {

        $data = $_POST;

        if ($data) {
            $this->params = $data;
        } else {
            $this->params = [];
        }
    }

    /**
     * 发送post请求
     * @param string $url
     * @param string $param
     * @return bool|mixed
     */
    protected function ReqPost($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);
        return $data;
    }

    private function post_check($post) {

        $pattern = "/(&amp;|&quot;|&lt;|&gt;|=|<|>|')+/";

        $is_match = preg_match($pattern, $post);

        if($is_match){
            // 输入的内容中含有非法字符
            $rst["code"] = 501;
            $this->ajaxReturn($rst);
            die();
        }else{
            return $post;
        }
    }

    /**
     * 发送get请求
     * @param string $url
     * @return bool|mixed
     */
    protected function ReqGet($url = '') {
        if (empty($url)) {
            return false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * 格式化API URL（替换变量）
     * @param $url
     * @param null $params
     * @return mixed
     */
    protected function urlPrepare($url, $params = null) {
        // 替换APP_ID和APP_SECRET
        $url = str_replace('{{APP_ID}}', C('APP_ID'), $url);
        $url = str_replace('{{APP_SECRET}}', C('APP_SECRET'), $url);
        // 替换参数
        if ($params)
            foreach ($params as $k => $v) {
                $url = str_replace('{{' . $k . '}}', $v, $url);
            }
        return $url;
    }
}