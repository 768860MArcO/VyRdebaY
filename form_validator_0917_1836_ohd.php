<?php
// 代码生成时间: 2025-09-17 18:36:12
class FormValidator {

    /**
     * @var array 存储验证规则
     */
    private $rules = [];

    /**
     * @var array 存储错误信息
     */
    private $errors = [];

    /**
     * 添加验证规则
     * @param string $field 表单字段名
     * @param mixed $rule 验证规则
     * @return $this
     */
    public function addRule($field, $rule) {
        $this->rules[$field] = $rule;
        return $this;
    }

    /**
     * 验证表单数据
     * @param array $data 表单提交的数据
     * @return bool 验证是否通过
     */
    public function validate(array $data) {
        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule) {
                if (!$this->applyRule($field, $data[$field] ?? null, $rule)) {
                    $this->errors[$field][] = $rule['message'];
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * 应用单个验证规则
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @param array $rule 验证规则
     * @return bool 是否通过验证
     */
    private function applyRule($field, $value, $rule) {
        switch ($rule['type']) {
            case 'required':
                return !empty($value);
            case 'email':
                return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
            case 'min':
                return strlen($value) >= $rule['min'];
            case 'max':
                return strlen($value) <= $rule['max'];
            // 可以根据需要添加更多规则
            default:
                return true;
        }
    }

    /**
     * 获取错误信息
     * @return array 错误信息
     */
    public function getErrors() {
        return $this->errors;
    }
}

// 使用示例
$validator = new FormValidator();
$validator->addRule('email', ['type' => 'required', 'message' => 'Email is required.'])
             ->addRule('email', ['type' => 'email', 'message' => 'Invalid email format.'])
             ->addRule('password', ['type' => 'required', 'message' => 'Password is required.'])
             ->addRule('password', ['type' => 'min', 'min' => 8, 'message' => 'Password must be at least 8 characters long.']);

$data = [
    'email' => 'test@example.com',
    'password' => 'password123'
];

if ($validator->validate($data)) {
    echo 'Validation passed.';
} else {
    print_r($validator->getErrors());
}
