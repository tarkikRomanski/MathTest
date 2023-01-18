<?php

namespace App\Controllers\API;

class TestController {
    public function getList() {
        $tests = scandir('tests');

        $testsQuantity = count($tests) - 2;

        $result = [];
        $j=0;

        for($i = 2; $i < $testsQuantity; $i++, $j++) {
            $key = 'test' . ($i - 2);

            $result[$key] = trim($tests[$i]);
        }

        $result['count'] = $testsQuantity;

        echo json_encode($result);
    }
}
