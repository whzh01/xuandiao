<?php

namespace app\admin\validate;

use think\Validate;

class XdslistValidate extends Validate
{
    protected $rule = [
        ['stuid', 'unique:xdslist', '学生已经存在']
    ];

}