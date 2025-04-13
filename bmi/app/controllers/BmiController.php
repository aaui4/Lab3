<?php
class BmiController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function calculateBmi($name, $weight, $height) {
        // التأكد من وجود user_id في الجلسة
        if (!isset($_SESSION['user_id'])) {
            // إذا لم يكن هناك user_id في الجلسة، نعرض رسالة أو نقوم بتوجيهه إلى صفحة تسجيل الدخول
            echo "يرجى تسجيل الدخول أولاً";
            return; // وقف تنفيذ الدالة إذا لم يكن هناك user_id
        }

        // الحصول على user_id من الجلسة
        $user_id = $_SESSION['user_id'];

        // حساب الـ BMI
        $bmi = $weight / (($height / 100) ** 2);
        $bmi = round($bmi, 2);

        // تحديد الحالة بناءً على الـ BMI
        if ($bmi < 18.5) {
            $status = "Underweight";
        } elseif ($bmi < 25) {
            $status = "Normal weight";
        } elseif ($bmi < 30) {
            $status = "Overweight";
        } else {
            $status = "Obese";
        }

        // حفظ السجل في قاعدة البيانات
        $this->model->saveBmiRecord($name, $weight, $height, $bmi, $status, $user_id);

        // جلب تاريخ الـ BMI للمستخدم
        $bmiHistory = $this->model->getBmiHistoryByUser($user_id);

        // إرسال البيانات للعرض
        include '../app/views/bmi_result.php';
    }
}
?>
