<?php
/**
 * Created by PhpStorm.
 * User: vtm2k7
 * Date: 16/2/6
 * Time: 下午2:35
 */

const START_TIME = 1451491200; // strtotime('2015-12-31')
const A_DAY = 86400;

const PARAM_ERROR = '参数错误';

function getDbGuid() {
    $Guid = M('Guid');
    $guid = $Guid->where('id=1')->lock(true)->find();
    $guid['value'] = $guid['value'] + 1;
    $Guid->save($guid);
    return $guid['value'];
}

/**
 * 生成随机码
 * @param type $length
 * @return string
 */
function getDiscountCode($length = 8) {
    // 密码字符集，可任意添加你需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $random .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
        $random .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    $cnt = M('Package')->where('code="' . $random . '"')->count();
    if ($cnt > 0) {
        $random = getDiscountCode($length);
    }
    return $random;
}

/**
 * 获取指定日期的ID值（距离2016-1-1的天数）
 * @param string YYYY-MM-DD
 * @return int 日期ID
 */
function date_to_id($dateStr) {
    return (strtotime($dateStr) - START_TIME) / A_DAY;
}

/**
 * 获取指定ID的日期（距离的天数）
 * @param int 日期ID
 * @return string YYYY-MM-DD
 */
function id_to_date($id) {
    return date('Y-m-d', START_TIME + $id * A_DAY);
}

/**
 * 格式化天数
 * @param int 天数
 * @return string 几天 几月 几年
 */
function fmtDay($num) {
    $y = intval($num / 365);
    $m = intval(($num - $y * 365) / 30);
    $d = intval($num - $y * 365 - $m * 30);
    $str = $d . 'd';
    if ($m > 0)
        $str = $m . 'm' . $str;
    if ($y > 0)
        $str = $y . 'Y' . $str;
    if ($num == 0)
        $str = '';
    return $str;
}

/**
 * 格式化天数
 * @param int 金额
 * @return string 几千 几百万
 */
function fmtAmount($num) {
    if ($num > 1000000) {
        $rst = round($num / 1000000, 2) . 'M';
    } else {
        $rst = round($num / 1000, 1) . 'K';
    }
    return $rst;
}

/**
 * 获取目录下的文件
 * @param string 目录
 * @return array 文件名列表
 */
function getfiles($path) {
    if (!is_dir($path))
        return null;
    $handle = opendir($path);
    $files = array();
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $path2 = $path . '/' . $file;
            if (!is_dir($path2)) {
                array_push($files, $file);
            }
        }
    }
    return $files;
}

/**
 * 路由配置转换数组
 * @param string 字符串
 * @return array 数组
 */
function route_menu($setting) {
    $routes = explode(C('SPLIT'), $setting);
    $menus = C('MENU');
    foreach ($menus as $k => $v) {
        foreach ($v as $kk => $vv) {
            $controller = $kk;
            foreach ($vv as $index => $action) {
                $route = $controller . '.' . $action;
                if (!in_array($route, $routes)) {
                    unset($menus[$k][$kk][$index]);
                }
            }

        }
    }
    // 移除空数组
    route_menu_clean($menus);
    return $menus;
}

/**
 * 路由配置转换数组 空权限菜单清理函数
 * @param array 数组
 */
function route_menu_clean(&$menus) {
    foreach ($menus as $k => $v) {
        foreach ($v as $kk => $vv) {
            if (count($vv) == 0)
                unset($menus[$k][$kk]);
        }
    }
    foreach ($menus as $k => $v) {
        if (count($v) == 0)
            unset($menus[$k]);
    }
}

/**
 * KV数组转字符串定义
 * @param array 数组
 * @return string 字符串
 */
function array_define($array) {
    $rst = 'array(';
    foreach ($array as $k => $v) {
        if (is_array($v)) {
            $rst .= "'" . $k . "'=>" . array_define($v) . ',';
        } else {
            $rst .= "'" . $k . "'=>'" . $v . "',";
        }
    }
    $rst .= ')';
    return $rst;
}


/**
 * 对二维数组进行排序
 * @param $array
 * @param $keyid 排序的键值
 * @param $order 排序方式 'asc':升序 'desc':降序
 * @param $type  键值类型 'number':数字 'string':字符串
 */
function sort_array(&$array, $keyid, $order = 'asc', $type = 'number') {
    if (is_array($array)) {
        foreach ($array as $val) {
            $order_arr[] = $val[$keyid];
        }
        $order = ($order == 'asc') ? SORT_ASC : SORT_DESC;
        $type = ($type == 'number') ? SORT_NUMERIC : SORT_STRING;
        array_multisort($order_arr, $order, $type, $array);
    }
}

function User() {
    return session('user');
}


/**
 * 邮件发送函数
 */
function sendMail($to, $title, $content) {

    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = C('MAIL_HOST');
    $mail->SMTPAuth = C('MAIL_SMTPAUTH');
    $mail->Username = C('MAIL_USERNAME');
    $mail->Password = C('MAIL_PASSWORD');
    $mail->From = C('MAIL_FROM');
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->AddAddress($to, "尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet = C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject = $title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return ($mail->Send());
}

function fmtMailContent(&$content, $custom, $order) {
    // 消费者
    $content = str_replace('[custom]', $custom['name'], $content);
    // 客服
    $content = str_replace('[user]', User()['nickname'], $content);
    // 订单

    // 通用
    $content = str_replace('[date]', date('Y-m-d', time()), $content);
}

/**
 * 导出报表
 */
function exportExcel($expTitle, $expCellName, $expTableData) {

    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
    $fileName = $_SESSION['account'] . date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
    $cellNum = count($expCellName);
    $dataNum = count($expTableData);
    vendor("PHPExcel.PHPExcel");

    $objPHPExcel = new PHPExcel();
    $cellName = array(
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z',
        'AA',
        'AB',
        'AC',
        'AD',
        'AE',
        'AF',
        'AG',
        'AH',
        'AI',
        'AJ',
        'AK',
        'AL',
        'AM',
        'AN',
        'AO',
        'AP',
        'AQ',
        'AR',
        'AS',
        'AT',
        'AU',
        'AV',
        'AW',
        'AX',
        'AY',
        'AZ'
    );

    $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');//合并单元格
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle . '  Export time:' . date('Y-m-d H:i:s'));
    for ($i = 0; $i < $cellNum; $i++) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
    }

    // Miscellaneous glyphs, UTF-8
    for ($i = 0; $i < $dataNum; $i++) {
        for ($j = 0; $j < $cellNum; $j++) {
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), $expTableData[$i][$expCellName[$j][0]]);
        }
    }

    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
    header("Content-Disposition:attachment;filename=$xlsTitle.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

/**
 * 导入数据
 **/
function importExcel($expFileName, $expCellName, $firstRow = 2) {
    vendor("PHPExcel.PHPExcel");
    $fn = $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . '/Public/Uploads/' . $expFileName;
    $objReader = \PHPExcel_IOFactory::createReader('Excel5');
    $objPHPExcel = $objReader->load($fn, $encode = 'utf-8');
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    //$highestColumn = $sheet->getHighestColumn();
    for ($i = $firstRow; $i <= $highestRow; $i++) {
        foreach ($expCellName as $cell => $field) {
            $data[$field] = $objPHPExcel->getActiveSheet()->getCell($cell . $i)->getValue();
        }
        $dataList[] = $data;
    }
    return $dataList;
}

/**
 * 上传到阿里OSS
 */
function upload_file_oss($data) {
    $access_id = C('OSS_ID');
    $access_key = C('OSS_KEY');;
    $hostname = C('OSS_HOST');;
    $bucket = C('OSS_BUCKET');;

    import("Org.Alioss.alioss");
    $oss = new ALIOSS($access_id, $access_key, $hostname, $security_token = NULL);
    //要上传的文件服务器地址
    $file_path = $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . '/Public/Uploads/' . $data;
    $res = $oss->upload_file_by_file($bucket, $data, $file_path);
    $array = (array)$res;
    switch ($array['status']) {
        case '200':
            return true;
            break;
        default:
            return false;
            break;
    }
}

/*
 * 驼峰转下划线
 */
function fmtVar($str) {
    return strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_', $str));
}

/*
 * UTF8 -> UNICODE
 */
function utf8_unicode($name) {
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2) {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0) {   //两个字节的文字
            $str .= '\u' . base_convert(ord($c), 10, 16) . str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
            //$str .= base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
        } else {
            $str .= '\u' . str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
            //$str .= str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
        }
    }
    $str = strtoupper($str);//转换为大写
    return $str;
}