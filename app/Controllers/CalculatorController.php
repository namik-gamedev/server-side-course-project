<?php
require_once __DIR__ . '/../../core/Controller.php';

class CalculatorController extends Controller
{
    public function index()
    {
        if (isset($_GET['height']) && isset($_GET['weight'])) {
            $this->calculate();
        } else {
            $this->render('calculator.index', [
                'pageTitle' => 'Калькулятор ИМТ',
                'result' => null,
                'height' => '',
                'weight' => ''
            ]);
        }
    }

    public function calculate()
    {
        $height = (float) ($_GET['height'] ?? 0);
        $weight = (float) ($_GET['weight'] ?? 0);
        $result = null;

        if ($height > 0 && $weight > 0) {
            $bmi = $weight / (($height / 100) ** 2);
            $bmi = round($bmi, 1);
            if ($bmi < 18.5)
                $interpret = 'Недостаточный вес';
            elseif ($bmi < 25)
                $interpret = 'Нормальный вес';
            elseif ($bmi < 30)
                $interpret = 'Избыточный вес';
            else
                $interpret = 'Ожирение';
            $result = ['bmi' => $bmi, 'interpret' => $interpret];
        }

        $this->render('calculator.index', [
            'pageTitle' => 'Калькулятор ИМТ',
            'result' => $result,
            'height' => htmlspecialchars($height),
            'weight' => htmlspecialchars($weight)
        ]);
    }
}