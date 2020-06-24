<?php
/**
 * Created by PhpStorm.
 * User: vtm2k7
 * Date: 16/3/5
 * Time: 下午6:57
 */

namespace Admin\TagLib;

use Think\Template\TagLib;

/**
 * Cps标签库解析类
 */
class Cps extends TagLib {

    // 标签定义
    protected $tags = array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'oneInput' => array('attr' => 'label,target,required,max,remark', 'close' => 0),
        'oneSelect' => array('attr' => 'label,target,source,required,multiple,size,defs', 'close' => 0),
        'oneSelect2' => array('attr' => 'label,target,source,required,multiple,size,defs,class', 'close' => 0),
        'oneUpload' => array('attr' => 'label,target,required,remark', 'close' => 0),
        'oneArea' => array('attr' => 'id,label,target,required', 'close' => 0),
        'oneDate' => array('attr' => 'label,target,required', 'close' => 0),
        'spinner' => array('attr' => 'label,target,required,min,max', 'close' => 0),
        'switch' => array('attr' => 'label,target,required', 'close' => 0),
    );

    public function _oneArea($tag, $content) {
        $id = $tag['id'];
        $label = $tag['label'];
        $field = ucfirst($tag['target']);
        $def = 'vo.' . fmtVar($tag['target']);

        // 必填
        $required = $tag['required'];
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        $parseStr = '';
        $parseStr .= '<div class="form-group">';
        $parseStr .= '    <label class="col-md-2 control-label" for="textareaDefault">' . $label . $requiredLabel . '</label>';
        $parseStr .= '    <div class="col-md-8">';
        $parseStr .= '        <textarea id="' . $id . '" rows="5" name="{$Think.CONTROLLER_NAME}' . $field . '" class="form-control" ' . $requiredAttr . ' >{$' . $def . '}</textarea>';
        $parseStr .= '    </div>';
        $parseStr .= '</div>';

        return $parseStr;
    }

    public function _switch($tag, $content) {
        $label = $tag['label'];
        $field = ucfirst($tag['target']);
        $def = 'vo.' . fmtVar($tag['target']);

        $parseStr = '';
        $parseStr .= '<div class="form-group">';
        $parseStr .= '    <label class="col-md-2 control-label" for="textareaDefault">' . $label . '</label>';
        $parseStr .= '    <div class="col-md-8">';
        $parseStr .= '        <div class="switch switch-primary">';
        $parseStr .= '            <input type="checkbox" name="{$Think.CONTROLLER_NAME}' . $field . '" data-plugin-ios-switch <neq name="' . $def . '" value="0">checked<else/>adasf</neq> />';
        $parseStr .= '        </div>';
        $parseStr .= '    </div>';
        $parseStr .= '</div>';

        return $parseStr;
    }

    public function _spinner($tag, $content) {

        $label = $tag['label'];
        $min = $tag['min'];
        $max = $tag['max'];
        $field = ucfirst($tag['target']);
        $def = 'vo.' . fmtVar($tag['target']);

        // 必填
        $required = $tag['required'];
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        $parseStr = '';
        $parseStr .= '<div class="form-group">';
        $parseStr .= '    <label class="col-md-2 control-label">' . $label . $requiredLabel . '</label>';
        $parseStr .= '    <div class="col-md-8">';
        $parseStr .= '       <div data-plugin-spinner data-plugin-options=\'{ "value":{$' . $def . '}, "min": ' . $min . ', "max": ' . $max . ' }\'>';
        $parseStr .= '           <div class="input-group" style="width:150px;">';
        $parseStr .= '                <input name="{$Think.CONTROLLER_NAME}' . $field . '" type="text" class="spinner-input form-control" maxlength="3" ' . $requiredAttr . ' readonly>';
        $parseStr .= '                <div class="spinner-buttons input-group-btn">';
        $parseStr .= '                    <button type="button" class="btn btn-default spinner-up">';
        $parseStr .= '                        <i class="fa fa-angle-up"></i>';
        $parseStr .= '                    </button>';
        $parseStr .= '                    <button type="button" class="btn btn-default spinner-down">';
        $parseStr .= '                        <i class="fa fa-angle-down"></i>';
        $parseStr .= '                    </button>';
        $parseStr .= '                </div>';
        $parseStr .= '            </div>';
        $parseStr .= '        </div>';
        $parseStr .= '    </div>';
        $parseStr .= '</div>';

        return $parseStr;
    }

    public function _oneInput($tag, $content) {
        $label = $tag['label'];
        $field = ucfirst($tag['target']);

        $def = 'vo.' . fmtVar($tag['target']);

        // 必填
        $required = $tag['required'];
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        // 长度
        $max = $tag['max'];
        if ($max) {
            $maxAttr = 'maxlength=' . $max;
        }

        // 备注
        $remark = $tag['remark'];
        if ($remark) {
            $remarkStr = '&nbsp;' . $remark;
        }

        $parseStr = '';
        $parseStr .= '<div class="form-group">';
        $parseStr .= '   <label class="col-md-2 control-label">' . $label . $requiredLabel . '</label>';
        $parseStr .= '   <div class="col-md-8">';
        $parseStr .= '       <input ' . $maxAttr . ' placeholder="' . $label . '" type="text" class="form-control" name="{$Think.CONTROLLER_NAME}' . $field . '" value="{$' . $def . '}" ' . $requiredAttr . '>';
        $parseStr .= '   ' . $remarkStr;
        $parseStr .= '   </div>';
        $parseStr .= '</div>';

        return $parseStr;
    }

    public function _oneInput2($tag, $content) {
        $label = $tag['label'];
        $field = ucfirst($tag['target']);

        $def = 'vo.' . fmtVar($tag['target']);

        // 必填
        $required = $tag['required'];
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        // 长度
        $max = $tag['max'];
        if ($max) {
            $maxAttr = 'maxlength=' . $max;
        }

        // 备注
        $remark = $tag['remark'];
        if ($remark) {
            $remarkStr = '&nbsp;' . $remark;
        }

        $parseStr = '';
        $parseStr .= '<div  >';
        $parseStr .= '   <label class="col-md-2 control-label">' . $label . $requiredLabel . '</label>';
        $parseStr .= '   <div class="col-md-8" >';
        $parseStr .= '       <input ' . $maxAttr . ' placeholder="' . $label . '" type="text" readonly="readonly" class="form-control" name="{$Think.CONTROLLER_NAME}' . $field . '" value="{$' . $def . '}" ' . $requiredAttr . '>';
        $parseStr .= '   ' . $remarkStr;
        $parseStr .= '   </div>';
        $parseStr .= '</div>';

        return $parseStr;
    }

    public function _oneDate($tag, $content) {
        $label = $tag['label'];
        $field = ucfirst($tag['target']);
        $def = 'vo.' . fmtVar($tag['target']);

        // 必填
        $required = $tag['required'];
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        $parseStr = '';
        $parseStr .= '<div class="form-group">';
        $parseStr .= '    <label class="col-md-2 control-label">' . $label . $requiredLabel . '</label>';
        $parseStr .= '    <div class="col-md-8">';
        $parseStr .= '        <div class="input-group">';
        $parseStr .= '            <span class="input-group-addon">';
        $parseStr .= '                <i class="fa fa-calendar"></i>';
        $parseStr .= '            </span>';
        $parseStr .= '            <input name="{$Think.CONTROLLER_NAME}' . $field . '" type="text" value="{$' . $def . '}" ' . $requiredAttr . ' data-plugin-datepicker class="form-control">';
        $parseStr .= '        </div>';
        $parseStr .= '    </div>';
        $parseStr .= '</div>';

        return $parseStr;
    }

    public function _oneSelect($tag, $content) {
        $label = $tag['label'];
        $field = ucfirst($tag['target']);
        $def = 'vo.' . fmtVar($tag['target']);
        $source = $tag['source'];

        // 必填
        $required = $tag['required'];
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        // 多选
        $multiple = $tag['multiple'];
        $size = $tag['size'];
        if ($multiple) {
            $field .= '[]';
            $multipleAttr = 'multiple';
            $sizeAttr = ($size) ? 'size="' . $size . '"' : '';
        }

        $parseStr = '';
        $parseStr .= '<div class="form-group">';
        $parseStr .= '   <label class="col-md-2 control-label">' . $label . $requiredLabel . '</label>';
        $parseStr .= '   <div class="col-md-8">';
        $parseStr .= '       <select data-plugin-selectTwo class="form-control" name="{$Think.CONTROLLER_NAME}' . $field . '" ' . $requiredAttr . ' ' . $multipleAttr . ' ' . $sizeAttr . '>';
        if (!$multiple) {
            $parseStr .= '               <option value="">请选择</option>';
        }
        $parseStr .= '           <volist name="' . $source . '" id="vos">';
        if ($multiple) {
            $parseStr .= '               <option value="{$vos.key}" <in name="vos.key" value="$' . $def . '">selected</in>>{$vos.label}</option>';
        } else {
            $parseStr .= '               <option value="{$vos.key}" {$vos.readonly} <eq name="vos.key" value="$' . $def . '">selected</eq>>{$vos.label}</option>';
        }
        $parseStr .= '           </volist>';
        $parseStr .= '       </select>';
        $parseStr .= '   </div>';
        if ($multiple) {
            $parseStr .= '<div class="col-md-offset-2 col-md-8">对于WIN系统：按住 Ctrl 按钮来选择多个选项<br/>对于MAC系统：按住 command 按钮来选择多个选项</div>';
        }
        $parseStr .= '</div>';

        return $parseStr;
    }
    public function _oneSelect2($tag, $content) {
        $label = $tag['label'];
        $field = ucfirst($tag['target']);
        $def = 'vo.' . fmtVar($tag['target']);
        $source = $tag['source'];
        $class = $tag['class'];
        // 必填
        $required = $tag['required'];
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        // 多选
        $multiple = $tag['multiple'];
        $size = $tag['size'];
        if ($multiple) {
            $field .= '[]';
            $multipleAttr = 'multiple';
            $sizeAttr = ($size) ? 'size="' . $size . '"' : '';
        }

        $parseStr = '';
        $parseStr .= '<div class="form-group '.$class.'">';
        $parseStr .= '   <label class="col-md-2 control-label">' . $label . $requiredLabel . '</label>';
        $parseStr .= '   <div class="col-md-8">';
        $parseStr .= '       <select data-plugin-selectTwo class="form-control" name="{$Think.CONTROLLER_NAME}' . $field . '" ' . $requiredAttr . ' ' . $multipleAttr . ' ' . $sizeAttr . '>';
        if (!$multiple) {
            $parseStr .= '               <option value="">请选择</option>';
        }
        $parseStr .= '           <volist name="' . $source . '" id="vos">';
        if ($multiple) {
            $parseStr .= '               <option value="{$vos.key}" <in name="vos.key" value="$' . $def . '">selected</in>>{$vos.label}</option>';
        } else {
            $parseStr .= '               <option value="{$vos.key}" {$vos.readonly} <eq name="vos.key" value="$' . $def . '">selected</eq>>{$vos.label}</option>';
        }
        $parseStr .= '           </volist>';
        $parseStr .= '       </select>';
        $parseStr .= '   </div>';
        if ($multiple) {
            $parseStr .= '<div class="col-md-offset-2 col-md-8">对于WIN系统：按住 Ctrl 按钮来选择多个选项<br/>对于MAC系统：按住 command 按钮来选择多个选项</div>';
        }
        $parseStr .= '</div>';

        return $parseStr;
    }

    public function _oneUpload($tag, $content) {
        $label = $tag['label'];
        $field = ucfirst($tag['target']);
        $def = 'vo.' . fmtVar($tag['target']);

        // 必填
        $required = $tag['required'];
        $requiredAttr = '';
        if ($required) {
            $requiredLabel = '<span class="required">*</span>';
            $requiredAttr = 'required';
        }

        // 备注
        $remark = $tag['remark'];
        if ($remark) {
            $remarkStr = '&nbsp;' . $remark;
        }

        $parseStr = '';
        $parseStr .= '<div class="form-group">';
        $parseStr .= '    <label class="col-md-2 control-label">' . $label . $requiredLabel . '</label>';
        $parseStr .= '    <notempty name="' . $def . '">';
        $parseStr .= '        <div class="col-md-2">';
        $parseStr .= '            <div class="thumbnail">';
        $parseStr .= '                <input type="hidden" name="{$Think.CONTROLLER_NAME}Existed' . $field . '" value="{$' . $def . '}"/>';
        $parseStr .= '                <a class="upareaRemove btn btn-xs" data-target="thumbnail' . $field . '"><i class="fa fa-remove"></i>删除</a>';
        $parseStr .= '                <a class="upareaUnRemove btn btn-xs" data-target="thumbnail' . $field . '"><i class="fa fa-reply"></i>恢复</a>';
        $parseStr .= '                <div class="thumb-preview">';
        $parseStr .= '                    <img src="__UPLOAD__/{$' . $def . '}" class="img-responsive">';
        $parseStr .= '                </div>';
        $parseStr .= '            </div>';
        $parseStr .= '        </div>';
        $parseStr .= '    </notempty>';
        $parseStr .= '    <div id="thumbnail' . $field . '" class="col-md-6" <notempty name="' . $def . '">style="display:none"</notempty>>';
        $parseStr .= '        <div class="fileupload fileupload-new mb-md" data-provides="fileupload" >';
        $parseStr .= '            <div class="input-append validate-area">';
        $parseStr .= '                <div class="uneditable-input">';
        $parseStr .= '                    <i class="fa fa-file fileupload-exists"></i>';
        $parseStr .= '                    <span class="fileupload-preview"></span>';
        $parseStr .= '                </div>';
        $parseStr .= '            <span class="btn btn-default btn-file">';
        $parseStr .= '                <span class="fileupload-exists">变更</span>';
        $parseStr .= '                <span class="fileupload-new">选择文件</span>';
        $parseStr .= '                <input type="file" name="{$Think.CONTROLLER_NAME}' . $field . '" ' . $requiredAttr . '/>';
        $parseStr .= '           </span>';
        $parseStr .= '                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">移除</a>';
        $parseStr .= '            </div>';
        $parseStr .= '        </div>' . $remarkStr;
        $parseStr .= '    </div>';
        $parseStr .= '</div>';

        return $parseStr;
    }
}