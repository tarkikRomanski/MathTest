<?php

namespace App\Controllers;

use App\Core\Controller;

class TestController extends Controller {
    public function showList() {
        $this->twig->display('tests-list.twig');
    }

    public function show() {
        $href = 'tests/' . $_GET['test_name'];
        $testData = file($href);

        $items = [];

        for ($i = 5, $questionsCount = count($testData); $i < $questionsCount; $i++) {
            $question = explode('/:i:/', $testData[$i]);
            $data = [
                'text' => $question[0],
                'options' => [],
            ];

            for ($j = 1, $optionsCount = count($question) - 1; $j < $optionsCount; $j++) {
                $data['options'][] = trim($question[$j]);
            }

            $items[] = $data;
        }

        $test = [
            'name' => trim($testData[1]),
            'time' => trim($testData[2]),
            'teacher' => trim($testData[3]),
            'items' => $items,
        ];

        $this->twig->display('test.twig', ['test' => $test]);
    }
}
