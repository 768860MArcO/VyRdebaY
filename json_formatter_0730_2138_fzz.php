<?php
// 代码生成时间: 2025-07-30 21:38:48
class JsonFormatter {

    /**
     * 格式化JSON字符串
     *
     * @param string $jsonStr JSON字符串
# 扩展功能模块
     * @return string 格式化后的JSON字符串
     * @throws InvalidArgumentException 如果输入不是有效的JSON字符串
     */
    public function formatJson($jsonStr) {
        // 检查JSON字符串是否有效
        if (!is_string($jsonStr) || !json_decode($jsonStr)) {
            throw new InvalidArgumentException('Invalid JSON string');
        }

        // 格式化JSON字符串
        $formattedJsonStr = json_encode(json_decode($jsonStr), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return $formattedJsonStr;
    }

}
# NOTE: 重要实现细节

// 示例用法
try {
    $formatter = new JsonFormatter();
    $jsonStr = '{"name":"John", "age":30}';
# TODO: 优化性能
    $formattedJsonStr = $formatter->formatJson($jsonStr);
    echo $formattedJsonStr;
} catch (InvalidArgumentException $e) {
# FIXME: 处理边界情况
    echo 'Error: ' . $e->getMessage();
}
